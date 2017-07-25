<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\model;

/**
 * User 模型
 * @package app\api\model
 */
class User extends BaseModel
{
    /**
     * 关联用户地址模型
     * @return object 用户地址模型
     */
    public function address()
    {
        return self::hasOne('UserAddress','user_id', 'id');
    }


    /**
     * 获取用户数据
     * @param $openID 用户ID
     * @return false|array 用户信息
     */
    public static function getByOpenID($openID)
    {
        //获取一条用户信息
        return self::where('openid', '=', $openID)->find();
    }
}