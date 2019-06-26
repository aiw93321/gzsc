<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

/**
 * Default controller for the `m` module
 */
class ProductController extends Controller
{
    public $layout ='main';
    //商品列表首页
    public function actionIndex()
    {
        return $this->render('index');
    }

    //商品详情页

    public function actionInfo()
    {
        return $this->render('info');
    }

    //会员支付界面
    public function actionOrder()
    {
        return $this->render('order');
    }
}
