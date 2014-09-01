<?php
namespace app\models;

use Yii;
use app\models\U;

class MMapbd extends \yii\base\Object
{
	const MAP_BAIDU_KEY = 'z8qVNA7A6V6cLZ2mPnaD2cTi';
	
	public $format = 'xml';		//json, xml

	public $method = 'GET';	

	public $debug = false;

	public $resp_code = 0;

	public $resp;	

	public function getAk()
	{
		return self::MAP_BAIDU_KEY;
	}
	
	//http://api.map.baidu.com/telematics/v3/distance?waypoints=118.77147503233,32.054128923368;116.3521416286,39.965780080447;116.28215586757,39.965780080447&ak=E4805d16520de693a3fe707cdc962045
	public function getDistance($lon0, $lat0, $lon1, $lat1)
	{
		//$arr = $this->submit('http://api.map.baidu.com/telematics/v3/distance', ['waypoints'=>"$lon0,$lat0;$lon1,$lat1", 'ak'=>$this->getAk(), 'output'=>$this->format, 'coord_type'=>'bd09ll']);			
		$arr = $this->submit('http://api.map.baidu.com/telematics/v3/distance', ['waypoints'=>"$lon0,$lat0;$lon1,$lat1", 'ak'=>$this->getAk(), 'output'=>$this->format]);
		//U::W($arr);
		//return $arr['results']['distance'];
		return intval($arr['results']['distance']);
	}

	public function submit($url, $params)
	{
		try
		{
			$requestUrl = $url . '?';
			if ($this->method == 'GET') 
			{
				$requestUrl .= http_build_query($params);
				$postFields = null;				
			} 
			else 
			{
				$postFields = $params;
			}
			
			//U::W(array($requestUrl, $postFields));
			$resp = U::curl($requestUrl, $postFields);	
			//U::W($resp);
		}
		catch (Exception $e)
		{
			U::W($e->getCode().':'.$e->getMessage());
			return ['errcode'=>$e->getCode(), 'errmsg'=>$e->getMessage()];
		}

		if ("json" === $this->format)
		{
			$arr = json_decode($resp, true);
			if (null !== $arr)
				return $arr;
		}
		else if("xml" === $this->format)
		{
			$respObject = @simplexml_load_string($resp);
			if (false !== $respObject)
				return json_decode(json_encode($respObject), true);			
		}
		U::W($resp);
		return ['errcode'=>90000, 'errmsg'=>'HTTP_RESPONSE_NOT_WELL_FORMED'];		
	}

	
}

/*

*/
