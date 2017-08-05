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

use think\Log;
use think\Loader;
use think\Exception;
use app\api\model\Order as OrderModel;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;

//extend/wxpay/WxPay.Api.php
Loader::import('wxpay.WxPay', EXTEND_PATH, '.Api.php');

/**
 * Pay Service 支付业务层
 * @package app\api\service
 */
class Pay
{
    //订单ID
    private $orderID='';

    //订单号
    private $orderNO='';


    /**
     * 构造函数 给成员变量赋值
     * Pay constructor.
     * @param $orderID 订单ID号
     * @throws OrderException 订单异常
     */
    function __construct($orderID)
    {
        if(!$orderID)
        {
            throw new OrderException([
                'msg' => '订单号不允许为NULL',
            ]);
        }

        $this->orderID = $orderID;
    }


    /**
     * 支付逻辑主方法
     * @return array 客户端支付所需数据
     */
    public function pay()
    {
        //订单号可能根本不存在
        //订单号不属于当前用户
        //订单号有可能已被支付

        //订单数据校验
        $this->checkOrderValid();

        //库存量检测
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);

        if(!$status['pass'])
        {
            return $status;
        }

        //返回预订单数据
        return $this->makeWxPreOrder($status['orderPrice']);
    }


    /**
     * 生成预订单数据
     * @param $totalPrice
     * @return array
     * @throws TokenException
     */
    private function makeWxPreOrder($totalPrice)
    {
        //获取OpenID
        $openid = Token::getCurrentTokenVar('openid');

        if(!$openid)
        {
            //抛出Token异常
            throw new TokenException();
        }

        //设置预订单参数 订单号、交易类型、订单金额、商品描述、用户openid、回调地址
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice*100);
        $wxOrderData->SetBody('酱酒商贩');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url('https://www.aqphp.com');

        //调用统一下单 把预订单数据传过去
        return $this->getPaySignature($wxOrderData);
    }


    /**
     * 微信统一下单操作
     * @param $wxOrderData 预订单数据
     * @return array 客户端支付所需数据
     * @throws Exception 服务器异常类
     */
    private function getPaySignature($wxOrderData)
    {
        //微信统一下单
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);

        if($wxOrder['return_code'] != 'SUCCESS' ||
           $wxOrder['result_code'] != 'SUCCESS')
        {
            Log::record($wxOrder, 'error');
            Log::record('获取预支付订单失败', 'error');

            //抛出服务器内部错误
            throw new Exception('获取预支付订单失败，微信配置错误');
        }

        //prepay_id 处理
        $this->recordPreOrder($wxOrder);

        //获取客户端所需支付数据
        return $this->sign($wxOrder);
    }


    /**
     * 组合客户端所需支付信息
     * @param $wxOrder 预订单数据
     * @return array 客户端支付信息
     */
    private function sign($wxOrder)
    {
        //调用微信支付API
        $jsApiPayData = new \WxPayJsApiPay();

        //组合客户端所需支付数据
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());

        $rand = md5(time().mt_rand(0,1000));
        $jsApiPayData->SetNonceStr($rand);

        $jsApiPayData->SetPackage('prepay_id='.$wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');

        //获取签名
        $sign = $jsApiPayData->MakeSign();

        //获取组后的数据(数组)
        $rawValues = $jsApiPayData->GetValues();

        $rawValues['paySign'] = $sign;

        //删除客户端不需要的数据
        unset($rawValues['appId']);

        return $rawValues;
    }


    /**
     * 更新订单中的支付会话ID
     * @param $wxOrder
     */
    private function recordPreOrder($wxOrder)
    {
        OrderModel::where('id','=', $this->orderID)
                    ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }


    /**
     * 用户数据校验
     * @return bool true or false
     * @throws OrderException 订单异常
     * @throws TokenException Token异常
     */
    private function checkOrderValid()
    {
        $order = OrderModel::where('id','=', $this->orderID)
                             ->find();

        //检测订单号
        if(!$order)
        {
            throw new OrderException();
        }

        //检测用户ID
        if(!Token::isValidOperate($order->user_id))
        {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10005,
            ]);
        }

        //检测订单状态
        if($order->status != OrderStatusEnum::UNPAID)
        {
            throw new OrderException([
                'code' => 400,
                'msg'  => '订单已支付过了',
                'errorCode' => 80001,
            ]);
        }

        $this->orderNO = $order->order_no;

        return true;
    }
}