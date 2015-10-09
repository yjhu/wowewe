<?php

namespace app\models;

use yii\base\Object;

class BaiduDwz extends Object
{
    public static function dwz($long_url) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://dwz.cn/create.php");
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $data=array('url'=>$long_url);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $strRes=curl_exec($ch);
        curl_close($ch);
        $arrResponse=json_decode($strRes,true);
        if($arrResponse['status']!==0)
        {
            return false;
        }
        return $arrResponse['tinyurl'];
    }
}

