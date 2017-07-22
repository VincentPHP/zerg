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

use app\lib\exception\TokenException;
use think\Cache;
use think\Request;

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


    /**
     * 从缓存中获取某个值
     * @param $key
     * @return mixed
     * @throws TokenException
     */
    public static function getCurrentTokenVar($key)
    {
        //从Header中获取Token
        $token = Request::instance()->header('token');

        //获取缓存信息
        $vars = Cache::get($token);

        //抛出异常
        if(!$vars)
        {
            throw new TokenException();
        }
        else
        {
            if(!is_array($vars))
            {
                //转换JSON格式为数组
                $vars = json_decode($vars, true);
            }

            //如果缓存里不存在需要的Key 抛出异常
            if(array_key_exists($key, $vars))
            {
                return $vars[$key];
            }
            else
            {
                throw new Exception('尝试获取的Token变量并不存在');
            }
        }
    }



    public static function getCurrentUid()
    {
        //获取Token
        return self::getCurrentTokenVar('uid');
    }
}