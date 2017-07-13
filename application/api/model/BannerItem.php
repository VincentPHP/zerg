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
 * BannerItem 模型
 * @package app\api\model
 */
class BannerItem extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden = [
        'id','img_id','banner_id',
        'update_time','delete_time'];


    /**
     * 关联模型(一对多关联）
     * @return bject Image模型对象
     */
    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}
