<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\service;

use think\Db;
use think\Log;
use think\Loader;
use think\Exception;
use app\api\model\Product;
use app\lib\enum\OrderStatusEnum;
use app\api\model\order as OrderModel;
use app\api\service\Order as OrderService;

Loader::import('wxpay.WxPay',EXTEND_PATH, '.Api.php');

/**
 * WxNotify Service 支付异步通知业务层
 * @package app\api\service
 */
class WxNotify extends \WxPayNotify
{
    /**
     * 重构JDK异步通知APi
     * @param array $data 回调解释出的参数
     * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    public function NotifyProcess($data, &$msg)
    {
        //微信支付状态
        if($data['result_code'] == 'SUCCESS')
        {
            //返回商户端订单号
            $orderNo = $data['out_trade_no'];

            //事务开始
            Db::startTrans();

            try
            {
                $order = OrderModel::where('order_no','=',$orderNo)
                                     ->find();

                if($order->status == OrderStatusEnum::UNPAID)
                {
                    $service = new OrderService();

                    //检测订单库存
                    $stockStatus = $service->checkOrderStock($order->id);

                    //如果库存通过
                    if($stockStatus['pass'])
                    {
                        //更新订单状态 (订单ID, 库存检测状态)
                        $this->updateOrderStatus($order->id, true);

                        //减商品库存
                        $this->reduceStock($stockStatus);
                    }
                    else
                    {
                        //更新订单状态 (订单ID, 库存检测状态)
                        $this->updateOrderStatus($order->id, false);
                    }
                }

                //提交事务
                Db::commit();

                return true;
            }
            catch(Exception $exception)
            {
                //事务回滚
                Db::rollback();

                Log::error($exception);

                return false;
            }
        }
        else
        {
            //支付失败 也返回true,因为返回false 微信异步会反复请求
            //我们只需要知道这个订单支付失败,不需要微信多次告诉我支付失败
            //所以 失败也返回true

            return true;
        }
    }


    /**
     * 对订单的商品进行减库存
     * @param $stockStatus 通过库存组合后的订单数据
     */
    private function reduceStock($stockStatus)
    {
        //循环对订单里的多个商品进行减库存
        //一个订单有N个商品 每个商品购买N个
        //循环获取订单某个商品数量 然后从商品表中进行减库存

        foreach($stockStatus as $singlePStatus)
        {
            Product::where('id','=', $singlePStatus['id'])
                     ->setDec('stock', $singlePStatus['count']);
        }
    }


    /**
     * 更新订单状态
     * @param $orderID 订单ID
     * @param $success 库存状态
     */
    private function updateOrderStatus($orderID, $success)
    {
        //模拟枚举类型 返回状态码
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;

        OrderModel::where('id','=', $orderID)
                    ->update(['status'=> $status]);
    }
}