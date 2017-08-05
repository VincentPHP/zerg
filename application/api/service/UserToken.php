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

use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

/**
 * UserToken Token Service业务层
 * @package app\api\service
 */
class UserToken extends Token
{
    //客户端码
    protected $code;

    //小程序ID
    protected $wxAppID;

    //小程序Key
    protected $wxAppSecret;

    //小程序Api地址
    protected $wxLoginUrl;


    /**
     * 构造函数 进行初始赋值
     * UserToken constructor.
     * @param $code 客户端生成码
     */
    public function __construct($code)
    {
        $this->code        = $code;
        $this->wxAppID     = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl  = sprintf(config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }


    /**
     * 获取Token
     * @return string Token 令牌
     * @throws Exception 全局异常
     */
    public function get()
    {
        //发送请求
        $result = curl_get($this->wxLoginUrl);

        //结构化数据
        $wxResult = json_decode($result, true);

        if(empty($wxResult))
        {
            //抛出服务器异常
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        }
        else if(array_key_exists('errcode', $wxResult))
        {
            $this->processloginError($wxResult);
        }
        else
        {
            return $this->grantToken($wxResult);
        }
    }


    /**
     * 实现Token业务
     * @param $wxResult 微信返回数据
     * @return string Token令牌
     */
    private function grantToken($wxResult)
    {
        //拿到penID
        //数据库查找openID
        //如果存在 则不处理、否则新增一条User记录
        //生成令牌、准备缓存数据、写入缓存
        //把令牌返回客户端

        //接收openID
        $openID = $wxResult['openid'];

        //查询是否存在该用户
        $user = UserModel::getByOpenID($openID);

        //如果用户存在 获取ID 不存在 则创建后获取ID
        $uid = $user ? $user->id : $this->newUser($openID);

        //组合缓存结构数据
        $cachedValue = $this->prepareCachedValue($wxResult, $uid);

        //将数据添加至缓存
        $token = $this->saveToCache($cachedValue);

        return $token;
    }


    /**
     * 将数据保存到缓存中
     * @param $cachedValue
     * @return string
     * @throws TokenException
     */
    private function saveToCache($cachedValue)
    {
        //获取生成的Token
        $key = self::generateToken();

        //需要缓存的数据
        $value = json_encode($cachedValue);

        //设置过期时间
        $expire_in = config('setting.token_expire_in');

        //将数据保存到缓存中
        $request = cache($key, $value, $expire_in);

        //抛出异常
        if(!$request)
        {
            throw new TokenException([
                'msg' =>  '服务器缓存异常',
                'errorCode' => 10002,
            ]);
        }

        return $key;
    }


    /**
     * 组合缓存所需数据
     * @param $wxResult 微信返回数据
     * @param $uid 用户ID
     * @return array 需要缓存的数据
     */
    private function prepareCachedValue($wxResult, $uid)
    {
        $cachedValue          = $wxResult;
        $cachedValue['uid']   = $uid;

        //权限作用域 用户
        $cachedValue['scope'] = ScopeEnum::User;

        return $cachedValue;
    }


    /**
     * 创建新用户
     * @param $openID 微信用户ID
     * @return int 用户ID
     */
    private function newUser($openID)
    {
        //调用模型方法 创建用户
        $user = UserModel::create(['openid' => $openID,]);

        return $user->id;
    }


    /**
     * 自定义异常（方便拓展）
     * @param $wxResult 微信错误信息
     * @throws WeChatException 微信异常类
     */
    private function processloginError($wxResult)
    {
        //重构为微信错误信息
        throw new WeChatException([
            'msg'     => $wxResult['errmsg'],
            'errCode' => $wxResult['errcode'],
        ]);
    }
}