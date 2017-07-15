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
 * Category 模型
 * @package app\api\model
 */
class Category extends BaseModel
{
    /**
     * @var array 指定隐藏的字段
     */
    protected $hidden =[
        'update_time','delete_time','create_time'
    ];

    /**
     * 关联Image模型 获得分类图片
     * @return object 关联Image模型对象
     */
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }
}