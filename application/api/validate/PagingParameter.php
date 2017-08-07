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
 * PagingParameter 分页参数验证器
 * @package app\api\validate
 */
class PagingParameter extends BaseValidate
{
    /**
     * @var array 验证字段 => 必填 必须是正整数
     */
    protected $rule =[
        'page' => 'require|isPositiveInteger',
        'size' => 'require|isPositiveInteger',
    ];


    /**
     * @var array 字段 => 验证不通过提示信息
     */
    protected $message =[
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数',
    ];
}