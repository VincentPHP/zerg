<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\controller;

use app\api\service\Token as TokenService;
use think\Controller;

/**
 * BaseController 控制器基类
 * @package app\api\controller
 */
class BaseController extends Controller
{
    /**
     * 前置方法 检测作用域权限 允许用户以上权限
     */
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }


    /**
     * 前置方法 检测权限作用域 只允许用户访问
     */
    protected function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}