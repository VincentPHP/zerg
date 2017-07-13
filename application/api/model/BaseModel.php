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

use think\Model;

/**
 * BaseModel 基类模型
 * @package app\api\model
 */
class BaseModel extends Model
{
    /**
     * 定义读取器
     * @param  $value  接收到的数据
     * @param  $data   查询数据库得到的数据
     * @return string  拼接好的图片完整地址
     */
    protected function prefixImgUrl($value, $data)
    {
        //获取需要组合URL
        $finalUrl = $value;

        //如果是本地图片则组合路径
        if($data['from'] == 1)
        {
            //预设网址+Url字段数据
            $finalUrl = config('setting.img_frefix').$value;
        }

        return $finalUrl;
    }
}