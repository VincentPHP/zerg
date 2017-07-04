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

use think\Db;
use think\Model;

class Banner extends Model
{
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function getBannerByID($id)
    {
        //$result = Db::table('banner_item')->where('banner_id','=', $id)->select();
        //闭包写法
        $result = Db::table('banner_item')
            ->where(function ($query) use ($id){
                    $query->where('banner_id','=', $id);
                })
            ->select();

        //ORM Obeject Relation Mapping 对象关系映射
        //模型 特指TP5的模型
        return $result;
    }
}