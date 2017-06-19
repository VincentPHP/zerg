<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\validate;

use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取Http传入参数
        $request = Request::instance();
        $params  = $request->param();

        //对这些参数进行检验
        $result = $this->check($params);
        if(!$result)
        {
            $error = $this->error;
            throw new Exception($error);
        }
        else
        {
            return true;
        }
    }
}