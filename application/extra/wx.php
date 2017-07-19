<?php
/* +----------------------------------------------------------------
 * | Software: [AQPHP framework]
 * |	 Site: www.aqphp.com
 * |----------------------------------------------------------------
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.aqphp.com All Rights Reserved.
 * +----------------------------------------------------------------*/

/**
 * 微信类配置文件
 */
return [

    //小程序ID
    'app_id'     => 'wxfd3217267ad51400',

    //小程序Key
    'app_secret' => 'f9de61fb6283de3ddffb97f863a8a5a6',

    //小程序Api
    'login_url'  => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
];