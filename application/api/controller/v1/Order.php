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
use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;

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
        'checkExclusiveScope' => ['only' => 'placeOrder']
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
}