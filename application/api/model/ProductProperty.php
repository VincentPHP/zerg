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
 * ProductProperty  商品信息模型
 * @package app\api\model
 */
class ProductProperty extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden = ['id','delete_time','update_time','product_id'];

}