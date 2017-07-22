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
 * Product 模型
 * @package app\api\model
 */
class Product extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden =[
        'delete_time', 'main_img_id', 'pivot','from',
        'category_id', 'create_time', 'update_time'
    ];


    /**
     * 定义读取器(get+表名+Attr)驼峰命名
     * @param $value 需要组合的字段
     * @param $data 数据库获取的数据
     * @return string 组合完整的路径
     */
    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }


    /**
     * 关联商品图片
     * @return object 模型对象
     */
    public function imgs()
    {
        return $this->hasMany('ProductImage','product_id', 'id');
    }


    /**
     * 关联商品相信信息
     * @return object 模型对象
     */
    public function properties()
    {
        return $this->hasMany('ProductProperty','product_id', 'id');
    }


    /**
     * 获取商品数据
     * @param $count 需要获取的条数
     * @return false|object|collection 商品模型对象
     */
    public static function getMostRecent($count)
    {
        //指定获取条数 并且倒序
        return self::limit($count)->order('create_time desc')->select();
    }


    /**
     * 获取分类所属商品
     * @param $categoryID 分类ID
     * @return false|Collection  商品模型对象
     */
    public static function getProductByCategoryID($categoryID)
    {
        //根据分类ID获取下属商品
        return self::where('category_id','=',$categoryID)->select();
    }


    /**
     * 获取单个商品完整信息
     * @param $id 需要获取的商品ID
     * @return false|array 模型对象
     */
    public static function getProductDetail($id)
    {
        return self::with(['imgs' =>
                           function($query)
                           {
                               $query->with(['imgUrl'])->order('order','asc');
                           }
                        ])
                    ->with(['properties'])
                    ->find($id);
    }
}