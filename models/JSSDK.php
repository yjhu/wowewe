<?php
namespace app\models;

use Yii;
use app\models\U;

class JSSDK
{
  private $appId;
  private $appSecret;

  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() 
  {
    $filename = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR. "jsapi_ticket_{$this->appId}.json"; 
    if (file_exists($filename)) {
        $data = json_decode(file_get_contents($filename), true);
        if ($data['expire_time'] > time()) {
            $ticket = $data['jsapi_ticket'];
            return $ticket;
        }
    }
    $accessToken = $this->getAccessToken();
    // 如果是企业号用以下 URL 获取 ticket
    // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
    $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
    $res = json_decode($this->httpGet($url), true);
    $ticket = $res['ticket'];
    if ($ticket) {
        $data['expire_time'] = time() + 7000;
        $data['jsapi_ticket'] = $ticket;
        $fp = fopen($filename, "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
    }
    return $ticket;
  }

private function getAccessToken() 
{
     $filename = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR. "access_token_{$this->appId}.json";
    if (file_exists($filename)) {
        $data = json_decode(file_get_contents($filename), true);
        if ($data['expire_time'] > time()) {
            $access_token = $data['access_token'];
            return $access_token;
        }
    }
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
    $res = json_decode($this->httpGet($url), true);
    $access_token = $res['access_token'];
    if ($access_token) {
        $data['expire_time'] = time() + 7000;
        $data['access_token'] = $access_token;
        $fp = fopen($filename, "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
    }
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//added by hehb begin
    curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);    
//end
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
}

