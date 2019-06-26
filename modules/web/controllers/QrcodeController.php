<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

/**
 * Default controller for the `web` module
 */
class QrcodeController extends BaseController
{
    public $layout = 'main';

    //首页界面
    public function actionIndex()
    {
        return $this->render('index');
    }

    //注册界面
    public function actionSet()
    {
        return $this->render('set');
    }

}