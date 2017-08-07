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

use app\api\service\WxNotify;
use app\api\service\Pay as PayService;
use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;

/**
 * Pay 支付控制器
 * @package app\api\controller\v1
 */
class Pay extends BaseController
{
    /**
     * 访问某个方法 之前先执行 前置方法
     * @var array 前置方法 => 只有 => 出发前置操作的方法
     */
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];


    /**
     * 请求预订单信息
     * @param string $id 需要支付的订单ID
     * @return array 客户端拉起支付所需数据
     */
    public function getPreOrder($id='')
    {
        //验证数据
        (new IDMustBePostiveInt())->goCheck();

        //支付Service业务层
        $pay = new PayService($id);

        return $pay->pay();
    }


    /**
     * 异步通知地址
     */
    public function redirectNotify()
    {
        //通知频率为15/15/30/180/1800/1800/1800/1800/3600, 单位:秒
        //特点:POST、Xml格式、不会携带参数

        //1.检查库存量,超卖
        //2.更新这个订单的status状态
        //3.减库存

        //如果 成功处理,我们返回微信 成功处理的信息。
        //如果 处理失败,我们返回微信 处理失败的信息。

        //重构微信支付JDK
        $notify = new WxNotify();

        $notify->Handle();
    }


    /**
     * 转发微信支付重定向信息 进行XDebug调试
     * @return mixed 回复微信订单状态
     */
    public function receiveNotify()
    {
        //获取微信发送的请求
        $xmlData = file_get_contents('php://input');

        //组合重定向地址+XDebug调试地址
        $url = config('wx.pay_back_redirect').'?XDEBUG_SESSION_START=12350';

        //转送POST请求
        $result = curl_post_raw($url, $xmlData);

        return $result;
    }
}