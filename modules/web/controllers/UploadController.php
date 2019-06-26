<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/5
 * Time: 16:58
 */

namespace app\modules\web\controllers;


use app\common\services\UploadService;
use app\modules\web\controllers\common\BaseController;

class UploadController extends BaseController
{
    public $enableCsrfValidation = false;
    private $allow_file_type =['jpg','gif','png','jpeg'];
    /**
     * 上传接口
     * bucket
     */
    public function actionPic(){
        $bucket = trim($this->post('bucket',''));
        $callback ="window.parent.upload";  // error success
        if (!$_FILES || !isset($_FILES['pic'])){
            return "<script>{$callback}.error('请选择文件资源在提交！')</script>";
        }

        $file_name = $_FILES['pic']['name'];
        $tmp_file_extend = explode(".",$file_name);
        if (!in_array(strtolower(end($tmp_file_extend)),$this->allow_file_type)){
           return "<script>{$callback}.error('请上传指定类型的图片！')</script>";
        }

        //上传图片的业务逻辑 todo
        $ret = UploadService::uploadByFile($file_name,$_FILES['pic']['tmp_name'],$bucket);
        if (!$ret){
            return "<script>{$callback}.error('".UploadService::getLastErrorMsg()."')</script>";
        }
        return "<script>{$callback}.success('{$ret['path']}')</script>";
    }
}