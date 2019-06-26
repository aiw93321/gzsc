<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

/**
 * Default controller for the `m` module
 */
class PayController extends Controller
{
    public $layout ='main';

    //商品列表首页
    public function actionBuy()
    {
        return $this->render('buy');
    }

}
