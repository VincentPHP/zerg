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
use app\lib\exception\BannerMissException;

class Banner
{
    /**
     * 获取指定ID的Banner信息
     * @url  /banner/:id
     * @id   是Banner的ID号
     * @http GET
     */
    public function getBanner($id)
    {
        //AOP 面向切面编程
        (new IDMustBePostiveInt())->goCheck();

        $banner = BannerModel::with('items')->find($id);
//        $banner = BannerModel::getBannerByID($id);

        //抛出异常
        if(!$banner)
        {
            throw  new BannerMissException();
        }

        return $banner;
    }
}