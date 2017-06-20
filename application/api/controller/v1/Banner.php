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
use think\Exception;

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
        (new IDMustBePostiveInt())->goCheck();

        $banner = BannerModel::getBannerID($id);

        //抛出异常
        if(!$banner)
        {
            throw  new BannerMissException();
        }

        return json($banner);
    }
}