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
 * WeChatException 微信异常类
 * @package app\lib\exception
 */
class WeChatException extends BaseException
{
    //状态码
    public $code  = 400;

    //错误提示信息
    public $msg   = '微信接口调用失败';

    //错误码
    public $errorCode = 999;
}