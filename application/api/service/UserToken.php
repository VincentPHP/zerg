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

use app\lib\exception\WeChatException;

class UserToken
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;


    public function __construct($code)
    {
        $this->code        = $code;
        $this->wxAppID     = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl  = sprintf(config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    public function get()
    {
        $result = curl_get($this->wxLoginUrl);

        $wxResult = json_decode($result, true);

        if(empty($wxResult))
        {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        else if(array_key_exists('errcode', $wxResult))
        {
            $this->processloginError($wxResult);
        }
        else
        {
            $this->grantToken($wxResult);
        }

        return $wxResult;
    }



    private function grantToken($wxResult)
    {
        //拿到penID
        //数据库查找openID
        //如果存在 则不处理、否则新增一条User记录
        //生成令牌、准备缓存数据、写入缓存
        //把令牌返回客户端

        $openid = $wxResult['openid'];
    }


    private function processloginError($wxResult)
    {
        throw new WeChatException([
            'msg'     => $wxResult['errmsg'],
            'errCode' => $wxResult['errcode'],
        ]);
    }
}