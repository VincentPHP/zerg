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
 * Count 数值范围验证器
 * @package app\api\validate
 */
class Count extends BaseValidate
{
    /**
     * @var array 验证是否为正整数和是否在数值范围
     */
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15',
    ];
}