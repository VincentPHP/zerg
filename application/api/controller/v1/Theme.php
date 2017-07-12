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

class Theme
{
    /**
     * 获取专题列表
     * @url /theme?ids=id1,id2,id3,........
     * @return 一组theme模型
     */
    public function getSimpleList($ids='')
    {
        (new IDCollection())->goCheck();

        return 'success';
    }
}