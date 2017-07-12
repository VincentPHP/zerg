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
 * IDMustBePostiveInt 数据验证拦截类
 * @package app\api\validate
 */
class IDMustBePostiveInt extends BaseValidate
{
    //验证字段及验证方法
    protected $rule = [
            'id' => 'require|isPositiveInteger',
        ];

    //验证不通过提示信息
    protected $message = [
        'id' => 'id必须是正整数',
    ];
}