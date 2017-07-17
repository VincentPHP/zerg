<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\controller\v1;

use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code='')
    {
//       (new TokenGet())->goCheck();

        $result = new UserToken($code);

        $token = $result->get();

        return $token;
    }
}