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

/**
 * Token 控制器
 * @package app\api\controller\v1
 */
class Token
{
    /**
     * 获取Token
     * @param string $code 客户端码
     * @return array Token令牌
     */
    public function getToken($code='')
    {
        //数据验证
//        (new TokenGet())->goCheck();

        //调用Service 实现业务
        $result = new UserToken($code);

        //接受Token
        $token = $result->get();

        return ['token' => $token];
    }
}