<?php

namespace app\controllers;

use app\common\components\BaseWebController;
use app\common\services\applog\AppLogService;
use yii;
use yii\log\FileTarget;
class ErrorController extends BaseWebController
{
//    public $layout =false;
    /**
     * @return string
     * @throws yii\base\InvalidConfigException
     * @throws yii\log\LogRuntimeException
     */
    public function actionError()
    {
      $err_msg="";
      //记录错误信息到文件和数据库
      $error = Yii::$app->errorHandler->exception;
      if ($error) {
        $file = $error->getFile();
        $line = $error->getLine();
        $message = $error->getMessage();
        $code = $error->getCode();

        $log = new FileTarget();
        $log->logFile = \Yii::$app->getRuntimePath()."/logs/error.log";
        $err_msg = $message."[file:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}][POST_DATA:".http_build_query($_POST)."]";
        $log->messages[]=[
          $err_msg,
          1,
          'Application',
          microtime(true)
        ];
        $log->export();
        //写入数据库
          AppLogService::addErrorLog(\Yii::$app->id,$err_msg);

      }
      return $this->render('error');
    }

}
