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


    /**
     * snap_items字段 读取器
     * @param $value 字段数据
     * @return mixed|null 转换为JSON格式的数据
     */
    public function getSnapITemsAttr($value)
    {
        if(empty($value))
        {
            return null;
        }

        return json_decode($value);
    }


    /**
     * snap_address字段 读取器
     * @param $value 字段数据
     * @return mixed|null 转换为JSON格式的数据
     */
    public function getSnapAddressAttr($value)
    {
        if(empty($value))
        {
            return null;
        }

        return json_decode($value);
    }

    
    /**
     * 分页获取用户订单数据
     * @param $uid 用户ID
     * @param int $page 分页数
     * @param int $size 每页条数
     * @return \think\Paginator
     */
    public static function getSummaryByUser($uid, $page=1, $size=15)
    {
        $pagingData = self::where('user_id', '=', $uid)
                            ->paginate($size, true, ['page'=>$page]);

        return $pagingData;
    }
}