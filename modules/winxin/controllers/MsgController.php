<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/18
 * Time: 10:47
 */
namespace app\modules\winxin\controllers;

use app\common\components\BaseWebController;

class MsgController extends BaseWebController
{
    public function actionIndex()
    {
    	// $log_name = "D:/http/Apache24/htdocs/basic/common/key/logs.txt";
     //    $req=$_REQUEST;
     //    // $req = file_get_contents('php://input');
     //    $req=json_encode($req);
     //    $reqs="-----------------------".date('Y-m-d h:i:s')."--------------\n".$req."\n";
     //    $myfile = fopen($log_name, "a+");
     //    fwrite($myfile,$reqs);
     //    fclose($myfile);
    	if (!$this->getSHA1()) {
    		return "签名信息不一致！";
    	}
    	if (array_key_exists('echostr', $_GET) && $_GET['echostr']) {
    		return $_GET['echostr'];
    	}
    }


    /**
	 * 用SHA1算法生成安全签名
	 * @param string $token 票据
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
	 * @param string $encrypt 密文消息
	 */
	public function getSHA1()
	{
		$signature = trim($this->get('signature',''));
        $timestamp = trim($this->get('timestamp',''));
        $nonce = trim($this->get('nonce',''));
        $token = \Yii::$app->params['weixin']['token'];
        $tmpArr = array($token,$timestamp, $nonce);
        sort($tmpArr);
        $tmpStr=implode( $tmpArr );
        $tmpStr=sha1( $tmpStr);
        if ($tmpStr==$signature) {
        	return true;
        }else{
        	return false;
        }
	}
}