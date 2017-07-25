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
 * ForbiddenException Scope 前置方法 异常类
 * @package app\lib\exception
 */
class ForbiddenException extends BaseException
{
    //状态码
    public $code = 403;

    //错误提示信息
    public $msg = '权限等级不够';

    //错误码
    public $errorCode = 10003;
}