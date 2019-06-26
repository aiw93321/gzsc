<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/30
 * Time: 10:54
 */
namespace app\common\ar;

class JsRedirect
{
    //成功提示
    public static function suess($url,$msg)
    {
        \Yii::$app->session->setFlash('flag', 'success');
        $url=$url."?error=".$msg;
        header('Location:{$url}');
    }

    //错误提示
    public static function error()
    {

    }
}