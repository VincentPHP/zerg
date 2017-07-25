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

use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use app\lib\success\SuccessMessage;
use app\lib\exception\UserException;
use think\Controller;

/**
 * Address 控制器
 * @package app\api\controller\v1
 */
class Address extends Controller
{
    /**
     * 访问某个方法前先执行前置方法
     * @var array 前置方法=>只有=>触发前置操作的方法
     */
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];


    /**
     * 前置方法 检测作用域权限
     * @return bool true or exception
     * @throws ForbiddenException 前置方法异常类
     * @throws TokenException  Token异常类
     */
    protected function checkPrimaryScope()
    {
        //获取Token中的作用域
        $scope = TokenService::getCurrentTokenVar('scope');

        //抛出Token异常
        if(!$scope) throw new TokenException();

        //检验是否在作用域内
        if($scope >= ScopeEnum::User)
        {
            return true;
        }
        else
        {
            //抛出前置方法异常
            throw new ForbiddenException();
        }
    }

    /**
     * 创建或更新用户地址
     * @return SuccessMessage
     * @throws UserException
     */
    public function createOrUpdateAddress()
    {
        //根据Token获取用户UID
        //根据用户UID来查找用户数据，判断用户是否存在，如果不存在抛出异常
        //获取客户从客户端提交的地址信息
        //根据用户地址信息是否存在，从而判断是添加地址还是更新地址

        //验证数据
        $validate = new AddressNew();

        $validate->goCheck();

        //获取用户ID
        $uid  = TokenService::getCurrentUid();

        //获取用户信息
        $user = UserModel::get($uid);

        if(!$user)
        {
            //抛出异常
            throw new UserException();
        }

        //用户提交的数据
        $dataArray = $validate->getDataByRule(input('post.'));

        //获取到的用户地址
        $userAddress = $user->address;

        if(!$userAddress)
        {
            //新增用户地址
            $user->address()->save($dataArray);
        }
        else
        {
            //更新用户地址
            $user->address->save($dataArray);
        }

        return json(new SuccessMessage(),'201');
    }
}