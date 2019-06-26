<?php

namespace app\modules\web\controllers;

use app\common\models\Member;
use app\modules\web\controllers\common\BaseController;
use app\common\services\UtilService;
/**
 * Default controller for the `web` module
 */
class MemberController extends BaseController
{
    public $layout ='main';
    //首页界面
    public function actionIndex()
    {
        $list = Member::find()->all();
        return $this->render('index',['list'=>$list]);
    }

    //展示页面
    public function actionInfo()
    {
        $id = $this->get('id');
        $list = Member::findOne(['id'=>$id]);
        return $this->render('info',['list'=>$list]);
    }

    //注册编辑界面
    public function actionSet()
    {
        $id = $this->get('id');
        $list = Member::findOne(['id'=>$id]);
        return $this->render('set',['list'=>$list]);
    }

    //注册提交页面
    public function actionSetSubmit(){
        $name = $this->post('name');
        $tel = $this->post('tel');
        if (strlen($name)>16){
            return $this->renderJson([],'用户名长度超过8位！',-1);
        }
        if (!strlen($tel)==11){
            return $this->renderJson([],'手机号不合法请核实！',-1);
        }
        $db = \Yii::$app->db;
        $sql="SELECT * FROM `member` WHERE nickname = :name or mobile =:mobile";
        $list = $db->createCommand($sql,[
           ':name' => $name,
           ':mobile' => $tel
        ])->queryAll();
        if ($list){
            return $this->renderJson([],'注册信息已存在！',-1);
        }
        $time = date('Y-m-d h:i:s');
        $mumer = new Member();
        $mumer->nickname = $name;
        $mumer->mobile = $tel;
        $mumer->salt = uniqid();
        $mumer->reg_ip = UtilService::getIP();
        $mumer->updated_time = $time;
        $mumer->created_time = $time;
        $mumer->save(0);
        return $this->renderJson([],'操作成功',200);
    }

    //修改密码
    public function actionComment()
    {
        return $this->render('comment');
    }
}
