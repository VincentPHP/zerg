<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\lib\exception;

/**
 * OrderException 订单异常类
 * @package app\lib\exception
 */
class OrderException extends BaseException
{
    //状态码
    public $code =404;

    //错误提示信息
    public $msg = '订单不存在，请检查ID';

    //错误码
    public $errorCode = 80000;

}