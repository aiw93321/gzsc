<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

/**
 * Default controller for the `web` module
 */
class BookController extends BaseController
{
    public $layout ='main';
    //首页界面
    public function actionIndex()
    {
        return $this->render('index');
    }

    //展示页面
    public function actionInfo()
    {
        return $this->render('info');
    }

    //注册编辑界面
    public function actionSet()
    {
        return $this->render('set');
    }

    //修改密码
    public function actionImages()
    {
        return $this->render('images');
    }
}
