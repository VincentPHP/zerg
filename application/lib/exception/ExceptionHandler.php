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

use think\exception\Handle;
use think\Log;
use think\Request;

/**
 * ExceptionHandler 服务器异常类
 * @package app\lib\exception
 */
class ExceptionHandler extends Handle
{
    //状态码
    private $code;

    //错误提示信息
    private $msg;

    //错误码
    private $errorCode;

    //需要返回客户端当前请求路径

    /**
     * 将异常抛出及设置服务器异常提示
     * @param \Exception $e 全局异常类
     * @return json 异常提示信息
     */
    public function render(\Exception $e)
    {
        if($e instanceof BaseException)
        {
            //如果是自定义的异常
            $this->code = $e->code;
            $this->msg  = $e->msg;
            $this->errorCode = $e->errorCode;
        }
        else
        {
            if(config('app_debug'))
            {
                // return default error page
                return parent::render($e);
            }
            else
            {
                $this->code = 500;
                $this->msg  = '服务器内部错误，不想告诉你';
                $this->errorCode = 999;

                //错误写入日志
                $this->recordErrorLog($e);
            }
        }

        //获取请求
        $request = Request::instance();

        $result = [
            'msg'         => $this->msg,
            'error_code'  => $this->errorCode,
            'request_url' => $request->url()
        ];

        return json($result, $this->code);
    }

    /**
     * 将错误信息写入日志
     * @param \Exception $e 服务器端的错误信息
     */
    private function recordErrorLog(\Exception $e)
    {
        Log::init([
                'type'  =>  'File',
                'path'  =>  LOG_PATH,
                'level' =>  ['error']
            ]);
        Log::record($e->getMessage(),'error');
    }
}