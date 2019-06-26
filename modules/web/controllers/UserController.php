<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\modules\web\controllers\common\BaseController;
use yii\helpers\Html;
use app\common\models\User;
/**
 * Default controller for the `web` module
 */
class UserController extends BaseController
{
    public $layout =false;
    //登录界面
    public function actionLogin()
    {
        //当判断当前是get请求返回登录页面
        if (\Yii::$app->request->isGet)
        {
            return $this->render('login');
        }
        //当前POST
        if (\Yii::$app->request->isPost) {
            //获取当前的输入信息
            $name = Html::encode(trim($this->post('login_name')));
            $password = Html::encode(trim($this->post('login_pwd')));
            //判断当前是否为空
            if (empty($name) || empty($password)) {
//                JsRedirect::suess(UrlService::buildWeb('user/login'),'用户名长度超过6位');
                \Yii::$app->session->setFlash('flag', 'success');
                return $this->redirect(array('/web/user/login', 'error' => '用户名和密码不能为空！'));
            }

            //判断用户名是否合法
            if (mb_strlen($name) > 6) {
                \Yii::$app->session->setFlash('flag', 'success');
                $this->redirect(array('/web/user/login', 'error' => '用户名长度超过6位！'));
            }

            //判断密码是否合法
            if (mb_strlen($password) > 12) {
                \Yii::$app->session->setFlash('flag', 'success');
                return $this->redirect(array('/web/user/login', 'error' => '密码长度超过12位！'));
            }

            //判断当前用户是否存在
            if (!User::findOne(['nickname' => $name])) {
                \Yii::$app->session->setFlash('flag', 'success');
                return $this->redirect(array('/web/user/login', 'error' => '用户名或密码不正确！'));
            }

            $user_info = User::findOne(['nickname' => $name]);
            //判断当前用户是否存在
            if (!$user_info) {
                \Yii::$app->session->setFlash('flag', 'success');
                return $this->redirect(array('/web/user/login', 'error' => '用户名或密码不正确！'));
            }

            $pwd = md5($password . md5($user_info['login_salt']));
            //判断当前密码是否正确
            if ($pwd != $user_info['login_pwd']) {
                \Yii::$app->session->setFlash('flag', 'success');
                return $this->redirect(array('/web/user/login', 'error' => '用户名或密码不正确！'));
            }

            //保存用户的登录状态
            //cookies进行保存用户登录状态
            //加密字符串 + “#” +uid，加密字符串=md5(login_name,login_pwd,login_sait)
            $this->setLoginStatus($user_info);
            return $this->redirect(UrlService::buildWeb('/dashboard/index'));
        }
    }

    //注册编辑界面
    public function actionEdit()
    {
        $this->layout ='main';
        return $this->render('edit',['user'=>$this->current_user]);
    }

    //修改注册信息
    public function actionModifyEdit()
    {
        $name = $this->post('name');
        $email = $this->post('email');
        if (mb_strlen($name,'utf-8')<1){
            return $this->renderJson([],'请输入合法的用户名！',-1);
        }
        if (mb_strlen($email,'utf-8')<1){
            return $this->renderJson([],'请输入合法的邮箱地址！',-1);
        }
        $user_info = $this->current_user;
        $user_info->nickname = $name;
        $user_info->email = $email;
        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update(0);
        return $this->renderJson([],'修改成功',200);
    }

    //密码
    public function actionPwd()
    {
        $this->layout ='main';
        return $this->render('pwd',['user'=>$this->current_user]);
    }

    //修改密码
    public function actionModifyPwd()
    {
        $this->layout ='main';
        $old_password = $this->post('old_password');
        $new_password = $this->post('new_password');
        $old = md5($old_password.md5($this->current_user['login_salt']));
        if ($old!=$this->current_user['login_pwd'])
        {
            return $this->renderJson([],'原始密码输入错误，请核实！',-1);
        }
        if (mb_strlen($new_password,'utf-8')<6){
            return $this->renderJson([],'新密码长度不能小于6位！',-1);
        }
        $new = md5($new_password.md5($this->current_user['login_salt']));
        $user_info = $this->current_user;
        $user_info->login_pwd = $new;
        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update(0);
        $this->setLoginStatus($user_info);
        return $this->renderJson([],'修改成功',200);
    }

    //退出登录
    public function actionLogout()
    {
        $this->removeCookie('book');
        return $this->redirect(UrlService::buildWeb('/user/login'));
    }
}
