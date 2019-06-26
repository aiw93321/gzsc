<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/30
 * Time: 16:28
 */
namespace app\common\services;

//封装通用的方法
class UtilService
{
    public static function getIP(){
        //检验是否反向代理
            if (!empty($_SERVER['HTTP_FORWARDED_FOR'])){
                return $_SERVER['HTTP_FORWARDED_FOR'];
            }

                return $_SERVER['REMOTE_ADDR'];

    }

    public static function getRootPath(){
        return dirname(\Yii::$app->vendorPath);
    }
}