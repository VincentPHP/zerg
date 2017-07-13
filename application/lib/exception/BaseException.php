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

use think\Exception;
use Throwable;

/**
 * BaseException 基类异常类
 * @package app\lib\exception
 */
class BaseException extends Exception
{
    //HTTP 状态码 404,200;
    public $code = 400;

    //错误具体信息
    public $msg = '参数错误';

    //自定义错误码
    public $errorCode = '10000';

    /**
     * 构造方法 自定指定所需信息
     * BaseException constructor.
     * @param array $params 需要提示的数据
     */
    public function __construct($params = [])
    {
        if(!is_array($params))
        {
            return ;
            // throw new Exception('参数必须为素组');
        }

        //设置状态码
        if(array_key_exists('code', $params))
        {
            $this->code = $params['code'];
        }

        //设置提示信息
        if(array_key_exists('msg', $params))
        {
            $this->msg = $params['msg'];
        }

        //设置错误码
        if(array_key_exists('errorCode', $params))
        {
            $this->errorCode = $params['errorCode'];
        }
    }
}