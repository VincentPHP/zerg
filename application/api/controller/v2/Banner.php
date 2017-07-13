<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

namespace app\api\controller\v2;

/**
 * Banner 控制器
 * @package app\api\controller\v2
 */
class Banner
{
    /**
     * 获取指定ID的Banner信息
     * @url  /banner/:id
     * @http GET
     * @id   是Banner的ID号
     */
    public function getBanner()
    {
        return "This is V2 Version";
    }
}