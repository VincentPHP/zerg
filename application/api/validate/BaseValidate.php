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

use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

/**
 * BaseValidate 基类验证器
 * @package app\api\validate
 */
class BaseValidate extends Validate
{
    /**
     * 执行验证方法
     * @return bool
     * @throws ParameterException
     */
    public function goCheck()
    {
        //获取Http传入参数
        $request = Request::instance();

        $params  = $request->param();

        //对这些参数进行检验
        $result = $this->batch()->check($params);

        //抛出异常
        if(!$result)
        {
            throw new ParameterException(['msg'=>$this->error]);
        }
        else
        {
            return true;
        }
    }

    /**
     * 验证是否为正整数
     * @param $value 用户提交的数据
     * @param string $rule
     * @param string $data
     * @param string $field 验证的字段
     * @return bool false OR true
     */
    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}