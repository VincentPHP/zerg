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

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule = [
            'id'  => 'require|isPositiveInteger',
        ];

    protected function isPositiveInteger($value, $rule='', $data='', $field='')
    {
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0)
        {
            return true;
        }
        else
        {
            return $field."必须是正整数";
        }
    }
}