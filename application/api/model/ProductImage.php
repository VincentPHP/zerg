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
 * ProductImage 商品图片模型
 * @package app\api\model
 */
class ProductImage extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden = ['img_id','delete_time','product_id'];


    /**
     * 关联模型 获取图片路径
     * @return object 图片模型对象
     */
    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}