<?php

namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

/**
 * Default controller for the `web` module
 */
class FinanceController extends BaseController
{
    public $layout ='main';
    //首页界面
    public function actionIndex()
    {
        return $this->render('index');
    }

    //展示页面
    public function actionAccount()
    {
        return $this->render('account');
    }

    //支付详情页
    public function actionPay_info()
    {
        return $this->render('pay_info');
    }
}
