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

/**
 * IDCollection ID验证器
 * @package app\api\validate
 */
class IDCollection extends BaseValidate
{
    //验证字段及验证方法
    protected $rule = [
        'ids' => 'require|checkIDs',
    ];

    //验证不通过提示信息
    protected $message =[
        'ids' => 'ids参数必须是以逗号分隔的多个正整数',
    ];

    /**
     * 验证数据格式
     * @param $value 用户请求的数据
     * @return bool True OR False
     */
    protected function checkIDs($value)
    {
        //截取数据为数组
        $values = explode(',', $value);

        //验证是否为空
        if(empty($values))
        {
            return false;
        }

        //验证是否是正整数
        foreach($values as $id)
        {
            if(!$this->isPositiveInteger($id))
            {
                return false;
            }
        }

        return true;
    }
}