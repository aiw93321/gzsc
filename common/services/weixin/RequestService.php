<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/6/26
 * Time: 16:59
 */
namespace app\common\services\weixin;
use app\common\services\BaseService;
use app\common\models\OauthAccessToken;
class RequestService extends BaseService
{
    public static function getAccessToken(){
        $date_now = date('Y-m-d H:i:s');
        $access_token_info = OauthAccessToken::find()->where('>','expired_time',$date_now)->limit(1)->one();
        if ($access_token_info){
            return $access_token_info['access_token'];
        }
        //获取参数信息
        self::send();

    }

    public static function send($appid,$secret){
        //拼装请求地址
        $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&'.$appid.'&'.$secret;
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
    }
}