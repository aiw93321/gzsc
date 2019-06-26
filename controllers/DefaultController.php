<?php

namespace app\controllers;
use app\common\components\BaseWebController;

class DefaultController extends BaseWebController
{
//    public $layout =true;

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGet_captcha(){

    }

}