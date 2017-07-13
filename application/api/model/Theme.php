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
 * Theme 模型
 * @package app\api\model
 */
class Theme extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden = ['delete_time','update_time','topic_img_id','head_img_id'];


    /**
     * 关联模型 获取主题图片
     * @return object 关联模型对象
     */
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }


    /**
     * 关联模型 获取主题内头部图片
     * @return object 关联模型对象
     */
    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }


    /**
     * 获取主题下所属商品
     * @return object 商品模型关联对象
     */
    public function products()
    {
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }


    /**
     * 获取指定主题数据
     * @param $ids 需要获取的主题ID
     * @return false | object 关联模型对象
     */
    public static function getThemeByIds($ids)
    {
        $theme = self::with(['topicImg','headImg'])->select($ids);

        return $theme;
    }


    /**
     * 获取主题及所属商品
     * @param $id 主题ID
     * @return false|array 获取主题商品
     */
    public static function getThemeWithProduct($id)
    {
        $theme = self::with(['products','topicImg','headImg'])->find($id);

        return $theme;
    }
}