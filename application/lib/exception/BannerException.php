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
 * BannerException Banner异常类
 * @package app\lib\exception
 */
class BannerException extends BaseException
{
    //状态码
    public $code = 404;

    //错误具体信息
    public $msg  = '请求Banner不存在';

    //错误码
    public $errorCode = 20000;

}