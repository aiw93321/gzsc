<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/6
 * Time: 14:20
 */

namespace app\common\services;

//所有服务的基类
class BaseService
{
    protected static $error_msg = null;
    protected static $error_code = null;
    public static function _err($msg = '', $code = -1){
        self::$error_msg = $msg;
        self::$error_code = $code;
        return false;
    }


    public static function getLastErrorMsg(){
        return self::$error_msg;
    }

    public static function getLastErrorCode(){
        return self::$error_code;
    }

}