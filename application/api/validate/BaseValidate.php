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
        //初始化 Request
        $request = Request::instance();

        //获取Http传入参数
        $params  = $request->param();

        //对这些参数进行检验
        $result = $this->batch()->check($params);

        if(!$result)
        {
            //抛出通用异常
            throw new ParameterException([
                'msg'=>$this->error,
            ]);
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


    /**
     * 判断参数是否为空
     * @param $value 参数
     * @param string $rule
     * @param string $data
     * @param string $field
     * @return bool false OR true
     */
    protected function isNotEmpty($value, $rule='', $data='', $field='')
    {
        return !empty($value) ? true : false;
    }


    /**
     * 验证是否是手机号
     * @param $value 需要验证的手机号
     * @return bool true or false
     */
    protected function isMobile($value)
    {
        $rule = '/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';

        $result = preg_match($rule, $value);

        return $result ? true : false;
    }


    /**
     * 拦截请求中多余的参数
     * @param $arrays  请求的参数
     * @return array   拦截后的数组
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if(
            array_key_exists('uid',$arrays) or
            array_key_exists('user_id', $arrays)
        )
        {
            throw new ParameterException([
                'msg' => '参数中包含有非法的参数名user_id或uid',
            ]);
        }

        $newArray = [];

        //循环获取相应数据
        foreach($this->rule as $key => $value)
        {
            $newArray[$key] = $arrays[$key];
        }

        return $newArray;
    }
}