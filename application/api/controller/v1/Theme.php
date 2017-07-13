<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;

/**
 * Theme 控制器
 * @package app\api\controller\v1
 */
class Theme
{
    /**
     * 获取专题列表
     * @url /theme?ids=id1,id2,id3,........
     * @http GET
     * @param $ids 需要获取的主题
     * @return object 一组theme模型对象
     * @throws ThemeException 主题自定义异常
     */
    public function getSimpleList($ids='')
    {
        //数据验证
        (new IDCollection())->goCheck();

        //截取为数组
        $ids = explode(',', $ids);

        //获取模型对象 Collection
        $result = ThemeModel::getThemeByIds($ids);

        //抛出异常
        if($result->isEmpty())
        {
            throw new ThemeException();
        }

        return $result;
    }


    /**
     * 获取主题商品
     * @url /theme/:id
     * @http GET
     * @param $id 需要获取的商品
     * @throws ThemeException 主题自定义异常
     */
    public function getComplexOne($id)
    {
        //数据验证
        (new IDMustBePostiveInt())->goCheck();

        //获取模型查询返回的数组
        $theme = ThemeModel::getThemeWithProduct($id);

        //抛出异常
        if(!$theme)
        {
            throw new ThemeException();
        }

        return $theme;
    }
}