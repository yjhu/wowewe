<?php

namespace app\models;


use Yii;
use yii\base\Exception;

class U
{
	public static function toString($obj="")
	{
		if (is_array($obj))
			$str = print_r($obj, true);
		else if(is_object($obj))		 
			$str = print_r($obj, true);						
		else 
			$str = "{$obj}";
		return $str;	
	}	

	public static function W($obj="", $log_file='')
	{
		$str = U::toString($obj);
		if (empty($log_file))
			$log_file = Yii::$app->getRuntimePath().'/errors.log';
			
		$date =date("Y-m-d H:i:s");
		$log_str = sprintf("%s,%s\n",$date,$str);
		error_log($log_str, 3, $log_file);
	}	

	public static function parseQuery($str, $and=';', $eq=':') 
	{
		$arr = array();
		$pairs = explode($and, $str);
		foreach($pairs as $pair) 
		{
			list($name, $value) = explode($eq, $pair, 2);
			$arr[$name] = $value;
		}
		return $arr;
	}

	public static function curl($url, $postFields = null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}

		//U::W($url);			
		if (is_array($postFields) && 0 < count($postFields))
		{
			$postBodyString = "";
			$postMultipart = false;
			foreach ($postFields as $k => $v)
			{
				if("@" != substr($v, 0, 1))
				{
					$postBodyString .= "$k=" . urlencode($v) . "&"; 
				}
				else
				{
					$postMultipart = true;
				}
			}
			//U::W($postBodyString);			
			unset($k, $v);
			curl_setopt($ch, CURLOPT_POST, true);
			if ($postMultipart)
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
			}
			else
			{
				curl_setopt($ch, CURLOPT_POSTFIELDS, substr($postBodyString,0,-1));
			}
		}
		else if (!empty($postFields))
		{
			curl_setopt($ch, CURLOPT_POST, true);		
			$postBodyString = $postFields;
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postBodyString);
			//U::W($postBodyString);	
		}
		
		$reponse = curl_exec($ch);
		
		if (curl_errno($ch))
		{
			throw new Exception(curl_error($ch),0);
		}
		else
		{
			$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			if (200 !== $httpStatusCode)
			{
				throw new Exception($reponse,$httpStatusCode);
			}
		}
		curl_close($ch);
		return $reponse;
	}

	public static function generateRandomString($length = 32)
	{
		$chars = 'ABCDEFGHIJKLM
		NOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		return substr(str_shuffle(str_repeat($chars, 5)), 0, $length);
	}

	public static function generateRandomStr($length = 16) 
	{  
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
		$str ="";  
		for ($i=0; $i<$length; $i++)
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		return $str;  
	}

	public static function D($str) 
	{
		U::W($str);
		die($str);	
	}

/*
	public static function getMobileLuck($pn)
	{
		$result = '';

		//$loca = U::curl("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$pn."&output=json");
		//$loca = json_decode($loca, true);	
		//U::W($loca);

		$loca = file_get_contents("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$pn."&output=json&callback=querycallback");
		$loca = substr($loca, 14, -2);  
		$loca = json_decode($loca, true);	
		U::W($loca);

		

		$lucy_msg = file_get_contents("http://jixiong.showji.com/api.aspx?m=".$pn."&output=json&callback=querycallback");
		$lucy_msg = substr($lucy_msg, 14, -2);  
		$lucy_msg = json_decode($lucy_msg, true);	
		U::W($lucy_msg);
		$result .= "<b>vendor</b><br/>";

		return $result;
		
	}
*/


}

/*
	public static function L($msg, $level=Logger::LEVEL_INFO, $category='application')
	{
		Yii::log(CVarDumper::dumpAsString($msg), $level, $category);
	}

	public static function T($msg, $category='application')
	{
		Yii::trace(CVarDumper::dumpAsString($msg), $category);
	}
*/

