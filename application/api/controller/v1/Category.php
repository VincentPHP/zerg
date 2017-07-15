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

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;

/**
 * Category 控制器
 * @package app\api\controller\v1
 */
class Category
{
    /**
     * 获取所有分类
     * @url /category/all
     * @http GET
     * @return false|static[] 需要获取那些ID的数据 []为全部
     * @throws CategoryException 自定义分类异常类
     */
    public function getAllCategories()
    {
        //获取分类模型对象
        $categories = CategoryModel::all([], 'img');

        //抛出异常
        if($categories->isEmpty())
        {
            throw new CategoryException();
        }

        return $categories;
    }
}