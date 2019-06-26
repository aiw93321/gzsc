<?php

namespace app\modules\web\controllers;

use app\common\models\User;
use app\modules\web\controllers\common\BaseController;
use \yii\helpers\Html;
/**
 * Default controller for the `web` module
 */
class AccountController extends BaseController
{
    public $layout ='main';
    //账户列表
    public function actionIndex()
    {
        $list = User::find()->orderBy(['uid'=>SORT_DESC])->all();
        return $this->render('index',['list'=>$list]);
    }

    //查询信息
    public function actionQuery(){
        $status = $this->post('status');
        $mix_kw = $this->post('mix_kw');
        $where=[];
        if ($status!=-1){
            $where['status']='status='.$status;
        }
        if ($mix_kw!=''){
            if (is_numeric($mix_kw)){
                $where['mobile'] ='mobile="'.$mix_kw.'"';
            }else{
                $where['nickname'] ='nickname="'.$mix_kw.'"';
            }
        }
        $wheres='';
            foreach ($where as $v){
                $wheres.=$v.' and ';
            }
            $wheres=' where '.rtrim($wheres,' and');
        $sql = "select * from user".$wheres;
        $user=\Yii::$app->db->createCommand($sql)->queryAll();
        if (!$user){
            return $this->renderJson([],'查不到您需要查询的用户信息！',-1);
        }else{
            return $this->renderJson($user,'查询成功！',200);
        }
    }

    //修改否则添加用户
    public function actionSet(){
        $id = $this->get('id');
        $user = User::findOne(['uid'=>$id]);
        if ($user){
            return $this->render('set',['user'=>$user,'title'=>'修改用户信息']);
        }else{
            return $this->render('set',['user'=>$user,'title'=>'创建用户']);
        }

    }

    public function actionAddSet(){
        $nickname = Html::encode($this->post('ncikname'));
        $mobile = Html::encode($this->post('mobile'));
        $email = Html::encode($this->post('email'));
        $login_name = Html::encode($this->post('login_name'));
        $login_pwd = Html::encode($this->post('login_pwd'));
        $id = Html::encode($this->post('id'));
        //根据id查询对应用户信息
        $user = User::findOne(['uid'=>$id]);
        $user->nickname=$nickname;
        $user->mobile=$mobile;
        $user->email=$email;
        $user->login_name=$login_name;
        $user->login_pwd=$login_pwd;
        $user->save();
    }

    //查看用户信息
    public function actionInfo(){
        $id = $this->get('id');
        $user = User::findOne(['uid'=>$id]);
        return $this->render('info',['user'=>$user]);
    }

}
