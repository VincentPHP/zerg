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

/**
 * OrderPlace 订单数据验证器
 * @package app\api\validate
 */
class OrderPlace extends BaseValidate
{
    /**
     * @var array 验证订单数据 必填 自定义验证方法
     */
    protected $rule = [
        'products' => 'require|checkProducts',
    ];


    /**
     * @var array 验证子集数据 是否为正整数
     */
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count'      => 'require|isPositiveInteger',
    ];


    /**
     * 验证订单数据
     * @param $values 二维数组 订单数据
     * @return bool true or exception
     * @throws ParameterException 通用异常
     */
    protected function checkProducts($values)
    {
        //如果数据 不是数组 抛出通用异常
        if(!is_array($values))
        {
            throw new ParameterException([
                'msg' => '商品参数不正确',
            ]);
        }

        //如果数据 为空 抛出通用异常
        if(empty($values))
        {
            throw new ParameterException([
                'msg' => '商品列表不能为空',
            ]);
        }

        //循环进行 单个商品数据验证
        foreach($values as $value)
        {
            $this->checkProduct($value);
        }

        return true;
    }


    /**
     * 验证商品子集数据
     * @param $value  商品数据
     * @throws ParameterException 通用异常
     */
    protected function checkProduct($value)
    {
        //调用基类进行 子集数据验证
        $validate = new BaseValidate($this->singleRule);

        $result = $validate->check($value);

        //如果 验证失败 抛出通用异常
        if(!$result)
        {
            throw new ParameterException([
                'msg' => '商品列表参数错误',
            ]);
        }
    }
}