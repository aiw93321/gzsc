<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;
/**
 * Default controller for the `web` module
 */
class StatController extends BaseController
{
    public $layout ='main';
    //首页
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionProduct()
    {
        return $this->render('product');
    }


    public function actionMember()
    {
        return $this->render('member');
    }

    public function actionShare()
    {
        return $this->render('share');
    }
}
