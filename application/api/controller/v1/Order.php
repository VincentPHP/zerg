<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\model\Order as OrderModel;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;

/**
 * Order 订单控制器
 * @package app\api\controller\v1
 */
class Order extends BaseController
{
    /**
     * 访问某个方法前先执行前置方法
     * @var array 前置方法=>只有=>触发前置操作的方法
     */
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope'   => ['only' => 'getDetail,getSummaryByUser'],
    ];


    //用户在选择商品，向API提交包含它所选择商品的相关信息
    //API在接收到信息后，需要检查订单相关的商品的库存
    //有库存，把订单数据存入数据库中==下单成功了，返回客户端消息，告诉客户可以支付

    //调用支付接口，进行支付
    //还需要再次进行库存量检测
    //服务器这边就可以调用微信支付的支付接口进行支付

    //小程序根据服务器返回的结果拉起微信支付
    //微信会返回给我们一个支付的结果（异步）

    //成功---也需要进行库存量检查
    //成功---进行库存量的扣除


    /**
     * 用户下单
     * @url /order
     * @http POST
     * @return array  订单ID、下单时间、订单号
     */
    public function placeOrder()
    {
        //验证数据
        (new OrderPlace())->goCheck();

        //获取提交数据 指定为数组
        $product = input('post.products/a');

        //获取用户ID
        $uid = TokenService::getCurrentUid();

        //创建订单
        $order = new OrderService();

        $status = $order->place($uid, $product);

        return $status;
    }


    /**
     * 获取用户订单简要信息
     * @param int $page 分页数
     * @param int $size 每页条数
     * @return array 组合后的订单数据
     */
    public function getSummaryByUser($page=1, $size=15)
    {
        //验证数据
        (new PagingParameter())->goCheck();

        //用户ID
        $uid = TokenService::getCurrentUid();

        //分页获取用户订单数据
        $pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);

        if($pagingOrders->isEmpty())
        {
            return [
                'data' => [],
                'current_page' => $pagingOrders->getCurrentPage(),
            ];
        }

        //隐藏指定字段 转换为数组
        $data = $pagingOrders->hidden(['snap_items','snap_address','prepay_id'])->toArray();

        return [
            'data' => $data,
            'current_page' => $pagingOrders->getCurrentPage(),
        ];
    }


    /**
     * 获取订单完整信息
     * @param $id 订单ID
     * @return object 订单数据
     * @throws OrderException 订单异常
     */
    public function getDetail($id)
    {
        //验证数据
        (new IDMustBePostiveInt())->goCheck();

        //获取订单数据
        $orderDetail = OrderModel::get($id);

        if(!$orderDetail)
        {
            //抛出订单异常
            throw new OrderException();
        }

        return $orderDetail->hidden(['prepay_id']);
    }
}