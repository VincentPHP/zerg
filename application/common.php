<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


/**
 * 发送http请求
 * @param $url string get 请求地址
 * @param int $httpCode 返回状态码
 * @return mixed
 */
function curl_get($url, &$httpCode=0)
{
    //初始化curl
    $ch = curl_init();

    //请求地址
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //不做证书校验，部署在Linux环境改为true
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    //执行
    $file_contents = curl_exec($ch);

    //获取请求状态码
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    //关闭资源
    curl_close($ch);

    return $file_contents;
}


/**
 * 随机获取字符串
 * @param $length 字符串长度
 * @return null|string 返回生成的字符串
 */
function getRandChar($length)
{
    //自定义字符串
    $str = 'ZXCVBNMASDFGHJKLPOIUYTREWQasdfghjklzxcvbnmqwertyuiop123987654';

    //定义空字符串
    $randChar = null;

    //获取字符串长度
    $max = strlen($str) - 1;

    //截取字符串
    for($i=0; $i<$length; $i++)
    {
        $randChar .= $str[rand(0, $max)];
    }

    return $randChar;
}