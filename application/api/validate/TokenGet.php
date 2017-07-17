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

class TokenGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];

    protected $message=[
        'code' => '没有code不能获取Token',
    ];
}