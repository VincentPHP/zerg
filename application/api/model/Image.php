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
 * Image 图片模型
 * @package app\api\model
 */
class Image extends BaseModel
{
    /**
     * @var array 隐藏指定字段
     */
    protected $hidden =['id', 'from', 'delete_time', 'update_time'];


    /**
     * 定义读取器(get+表名+Attr)驼峰命名
     * @param  $value  接收到的数据
     * @param  $data   查询数据库得到的数据
     * @return string  拼接好的图片完整地址
     */
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}