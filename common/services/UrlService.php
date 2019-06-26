<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 13:44
 */
namespace app\common\services;

//构建链接
use yii\helpers\Url;

class UrlService
{
    //构建web所有的链接
    public static function buildWeb($path,$params=[])
    {
        $path = Url::toRoute(array_merge([$path],$params));
        return '/web'.$path;
    }

    //构建会员端的链接
    public static function buildMUrl($path,$params=[])
    {
        $path = Url::toRoute(array_merge([$path],$params));
        return '/m'.$path;
    }

    //构建官网的链接
    public  static function build3WUrl($path,$params=[])
    {
        $path = Url::toRoute(array_merge([$path],$params));
        return $path;
    }

    //空链接
    public static function buildNullUrl()
    {
        return 'javascript:void(0);';
    }

    public static function buildPicUrl($bucket,$image_key){
        $Urls=$_SERVER['HTTP_HOST'];//获取当前域名
        $upload_config = \Yii::$app->params['upload'];
        return "http://".$Urls.$upload_config[$bucket].'/'.$image_key;
    }
}