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
 * TokenException Token异常类
 * @package app\lib\exception
 */
class TokenException extends BaseException
{
    //状态码
    public $code = 401;

    //错误提示信息
    public $msg  = 'Token已经过期或无效Token';

    //错误码
    public $errorCode = 10001;
}