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

use app\api\model\Banner as BannerModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerException;

/**
 * Banner 控制器
 * @package app\api\controller\v1
 */
class Banner
{
    /**
     * 获取指定ID的Banner信息
     * @url  /banner/:id
     * @http GET
     * @id   Banner的ID号
     * @return array|false 一组模型对象
     * @throws BannerException Banner自定义异常
     */
    public function getBanner($id)
    {
        //AOP 面向切面编程
        (new IDMustBePostiveInt())->goCheck();

        //获取模型返回数组
        $banner = BannerModel::getBannerByID($id);

        //抛出异常
        if(!$banner)
        {
            throw new BannerException();
        }

        return $banner;
    }
}