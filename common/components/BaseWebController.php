<?php
namespace app\common\components;
use \yii\web\Controller;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/29
 * Time: 11:00
 */

/**
 * 集成常用公共方法，提供给所有的Controller使用
 * get，post，setcookie，getcookie，removecookie，renderjson
 */
class BaseWebController extends Controller
{
    public $enableCsrfValidation = false;

    //获取http的get参数
    public function get($key,$value=""){

        return \Yii::$app->request->get($key,$value);

    }

    //获取http的post参数
    public function post($key,$value=""){

        return \Yii::$app->request->post($key,$value);

    }

    //设置cookie值
    public function setCookie($name,$value,$expire=0){

         $cookies = \Yii::$app->response->cookies;
         $cookies->add(new \yii\web\Cookie([
             'name' => $name,
             'value' =>$value,
             'expire' => $expire
         ]));
    }

    //获取cookie
    public function getCookie($name,$value,$default_val=''){
        $cookies = \Yii::$app->request ->cookies;
        return $cookies->getValue($name,$value,$default_val);
    }

    //删除cookie
    public function removeCookie($name){
        $cookies = \Yii::$app->response->cookies;
        return $cookies->remove($name);
    }

    //api统一的json格式方法
    public function renderJson($data=[],$msg='ok',$code=200){
        header("Content-type:application/json");
        return json_encode([
            'code' => $code,
            'msg'=> $msg,
            'data' => $data,
            'req_id' => uniqid()
        ]);
    }
}