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

use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;

/**
 * Product 控制器
 * @package app\api\controller\v1
 */
class Product
{
    /**
     * @url /product/recent?count=15
     * @http GET
     * @param int $count 获取商品条数
     * @return object 一组模型对象
     * @throws ProductException 商品自定义异常
     */
    public function getRecent($count=15)
    {
        //验证数据
        (new Count())->goCheck();

        //获取模型对象 Collection
        $products = ProductModel::getMostRecent($count);

        //抛出异常
        if($products->isEmpty())
        {
            throw new ProductException();
        }

        //临时隐藏字段summary
        $products = $products->hidden(['summary']);

        return $products;
    }
}