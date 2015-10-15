<?php

namespace app\models;

use yii\base\Object;

class DwzService extends Object
{
    public static function baidu($long_url) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://dwz.cn/create.php");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $data=array('url'=>$long_url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $strRes=curl_exec($ch);
        curl_close($ch);
//        echo $strRes;
        $arrResponse=json_decode($strRes,true);
//        var_dump($arrResponse);
        if($arrResponse['status']!==0)
        {
            return false;
        }
        return $arrResponse['tinyurl'];
    }
    
    public static function so985($long_url) {
        $ch = curl_init();
        $url = "http://985.so/api.php?url=" . urlencode($long_url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $strRes=curl_exec($ch);        
        curl_close($ch);
        $strRes = substr($strRes, 3); // delete UTF-8 BOM bytes
        return $strRes;        
    }
    
    public static function sina($long_url) {
        $apiKey='405221104';
        $apiUrl='https://api.weibo.com/2/short_url/shorten.json?source='.$apiKey.'&url_long='.urlencode($long_url);
        $curlObj = curl_init();
        curl_setopt($curlObj, CURLOPT_URL, $apiUrl);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
//        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
        $response = curl_exec($curlObj);
        curl_close($curlObj);
        echo $response;
        return $response;
    }
    
    public static function qqurl($long_url) {
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://qqurl.com/create/");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $data=array('url'=>$long_url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $response_json=curl_exec($ch);
        curl_close($ch);
        $response_arr=json_decode($response_json,true);
//        echo $response_json;
        if($response_arr['status']!=0)
        {
            /**错误处理*/
//            echo iconv('UTF-8','GBK',$response_arr['err_msg'])."\n";
            return false;
        } else {
            /** 成功 */
//            echo $response_arr['short_url']."\n";
            return $response_arr['short_url'];
        }
    }
}

