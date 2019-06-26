<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    public $layout ='main';
    //账号绑定登录界面
    public function actionBind()
    {
        return $this->render('bind');
    }

    //购物车界面
    public function actionCart(){
        return $this->render('bind');
    }

    //我的订单列表
    public function actionOrder(){
        return $this->render('order');
    }

    //用户中心
    public function actionIndex(){
        return $this->render('index');
    }

    //用户中心默认地址
    public function actionAddress(){
        return $this->render('address');
    }

    //用户中心修改地址
    public function actionAddress_set(){
        return $this->render('address_set');
    }

    //用户中心修改地址
    public function actionFav(){
        return $this->render('fav');
    }

    //我的评论列表
    public function actionComment(){
        return $this->render('comment');
    }

    //我的评论列表详情
    public function actionComment_set(){
        return $this->render('comment_set');
    }
}