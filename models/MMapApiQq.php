<?php
namespace app\models;

use Yii;
use app\models\U;

class MMapApiQq extends \yii\base\Object
{
    const MAP_QQ_KEY = 'ZUVBZ-SVQAJ-PT7FR-KAI5G-IEAAE-YOFIE';
    
    const MAP_QQ_JS_KEY = '';
        
    public $format = 'json';

    public $method = 'GET';    

    public static function getAk()
    {
        return self::MAP_QQ_KEY;
    }

    public static function getJsak()
    {
        return self::MAP_QQ_JS_KEY;
    }

    public function getAddress($lon, $lat)
    {
        $arr = $this->submit('http://apis.map.qq.com/ws/geocoder/v1', ['location'=>"$lat,$lon", 'coord_type' => 5, 'get_poi' => 0, 'key'=>self::getAk(), 'output'=>$this->format]);
        //return $arr['result']['formatted_addresses']['recommend'];   
        return ($arr['status'] != 0 || empty($arr['result']['address'])) ? '' : $arr['result']['address']; 
    }

    public function submit($url, $params)
    {
        try {
            $requestUrl = $url . '?';
            if ($this->method == 'GET') {
                $requestUrl .= http_build_query($params);
                $postFields = null;                
            } else {
                $postFields = $params;
            }            
            $resp = U::curl($requestUrl, $postFields);    
        } catch (Exception $e) {
            U::W($e->getCode().':'.$e->getMessage());
            return ['errcode'=>$e->getCode(), 'errmsg'=>$e->getMessage()];
        }
        if ("json" === $this->format) {
            $arr = json_decode($resp, true);
            if (null !== $arr)
                return $arr;
        } else if("xml" === $this->format) {
            $respObject = @simplexml_load_string($resp);
            if (false !== $respObject) {
                return json_decode(json_encode($respObject), true);            
            }
        }
        return ['errcode'=>90000, 'errmsg'=>'HTTP_RESPONSE_NOT_WELL_FORMED'];        
    }

    
}

