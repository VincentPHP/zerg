<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\service;

/**
 * Token Service基类
 * @package app\api\service
 */
class Token
{
    /**
     * 生成加密Token
     * @return string Token令牌
     */
    public static function generateToken()
    {
        //用三组字符串进行MD5加密

        //32位字符串组成一组随机字符串
        $randChar = getRandChar(32);

        //获取时间戳
        $timeStamp = $_SERVER['REQUEST_TIME_FLOAT'];

        //salt 盐
        $salt = config('secure.token_salt');

        return md5($randChar.$timeStamp.$salt);
    }
}