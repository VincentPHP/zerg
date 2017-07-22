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
 * UserException 用户类异常
 * @package app\lib\exception
 */
class UserException extends BaseException
{
    //状态码
    public $code = 404;

    //错误信息
    public $msg  = '用户不存在';

    //错误码
    public $errorCode = 70000;
}