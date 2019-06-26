<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/30
 * Time: 13:14
 */
namespace app\modules\web\controllers\common;

use app\common\components\BaseWebController;
use app\common\models\AppAccessLog;
use app\common\models\AppLog;
use app\common\models\User;
use app\common\services\applog\AppLogService;
use app\common\services\UrlService;

//web的独有的验证
class BaseController extends BaseWebController
{
    public $layout = 'main';
    public $current_user = null;
    public $allowAllAction = [
        'web/user/login'
    ];

    //验证登录
    public function beforeAction($action)
    {
        //验证是否登录有效
        $is_login = $this->checkLoginStatus();
        if (in_array($action->getUniqueId(),$this->allowAllAction))
        {
            return true;
        }
        if (!$is_login){
            if (\Yii::$app->request->isAjax){
                $this->renderJson([],'未登录，请先登录',-302);
            }else{
                $this->redirect(UrlService::buildWeb('/user/login'));
            }
            return false;
        }

        //记录所有用户的访问
        AppLogService::addAppAccessLog($this->current_user['uid']);

        return true;

    }

    //效验登录状态  返回true或者false
    private function checkLoginStatus()
    {
        $auth_cookie = $this->getCookie("book","");
        if (!$auth_cookie){
            return false;
        }

        list($auth_token,$uid) = explode('#',$auth_cookie);
        if (!$auth_token || !$uid){
            return false;
        }
        if (preg_match('/^[A-Za-z]+$/',$uid) ||preg_match('/^.{4,8}$/',$uid) ){
            return false;
        }

        $user_info = User::findOne(['uid'=>$uid]);
        if (!$user_info){
            return false;
        }
        //加密字符串 + “#” +uid，加密字符串=md5(login_name,login_pwd,login_sait)
        if ($this->token_md5($user_info) != $auth_token){
            return false;
        }
        $this->current_user = $user_info;
        return true;
    }


    //统一生成加密字段
    public function token_md5($user_info){
        return md5($user_info['login_name'].$user_info['login_pwd'].$user_info['login_salt']);
    }

    //设置登录状态的方法
    public function setLoginStatus($user_info)
    {
        $auth_token = $this->token_md5($user_info);
        $this->setCookie('book',$auth_token.'#'.$user_info['uid']);
    }

    //删除登录状态
    public function removeLoginStatus(){
        $this->removeCookie('book');
    }

}