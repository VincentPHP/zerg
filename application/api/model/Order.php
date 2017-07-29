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
 * Order 模型
 * @package app\api\model
 */
class Order extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden = ['user_id','update_time','delete_time'];


    /**
     * 开启自动补充时间字段 create_time,update_time,delete_time
     * @var bool true or false 开启或关闭
     */
    protected $autoWriteTimestamp = true;
}