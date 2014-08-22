<?php

namespace app\models\sm;

use Yii;
use app\models\U;

/*
http://221.179.180.158:9001/QxtSms/QxtSetOperPass?OperID=wushen&OperPassOld=wushen123&OperPassNew=newpassword
*/
class ESms extends \yii\base\Object
{
	const OK_CURL = 0;		
	const ERROR_CURL = 8001;	
	const ERROR_HTTP_RESPONSE_NOT_WELL_FORMED = 8002;	

	public $username;		
	public $password;	
	public $sendtime;
	public $mobiles_str;		
	public $message;			
	public $message_is_gbk = false;

	public $method = 'POST';					// GET, POST

	public $format = 'xml';					// json, xml, plain

	public $resp_code;
	public $resp;

	public $isOrder = false;					// COMM(cuxiao), ORDER

	public $debug = false;
	
	public function init()
	{
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
			} else {
				$postFields = $params;
			}
			
			if ($this->debug)
			{
				U::W(array($requestUrl, $postFields));
				$this->resp_code = ESms::OK_CURL;	
				return;
			}
			//U::W(array($requestUrl, $postFields));
			$resp = U::curl($requestUrl, $postFields);	
			if ($this->message_is_gbk)			
				$resp = iconv("GBK","UTF-8//IGNORE", $resp);
			//U::W($resp);
		}
		catch (Exception $e)
		{
			U::W(array(__FUNCTION__, get_class($this), 'ERROR_CURL', $url, $params));	
			$this->resp_code = ESms::ERROR_CURL;
			$this->resp = $e->getCode().','.$e->getMessage();
			return;			
		}

		$respWellFormed = false;
		if ("json" == $this->format)
		{
			$respObject = json_decode($resp);
			if (null !== $respObject)
			{
				$respWellFormed = true;
			}
		}
		else if("xml" == $this->format)
		{
			//$respObject = @simplexml_load_string($resp);
			$respObject = @simplexml_load_string(trim($resp));			
			if (false !== $respObject)
			{
				$respWellFormed = true;
				$respObject = json_decode(json_encode($respObject));
			}
		}
		else
		{
			$respWellFormed = true;
			$respObject = $resp;
		}
		
		if (false === $respWellFormed)
		{
			U::W(array(__FUNCTION__, get_class($this), 'HTTP_RESPONSE_NOT_WELL_FORMED', $resp, $url, $params));	
			$this->resp_code = ESms::ERROR_HTTP_RESPONSE_NOT_WELL_FORMED;			
			$this->resp = 'HTTP_RESPONSE_NOT_WELL_FORMED';
			return;
		}
		$this->resp_code = ESms::OK_CURL;		
		$this->resp = $respObject;	
		//U::W($this->resp);		
	}

	protected function isSendOk()
	{
		throw new CException(Yii::t('yii','{className} does not support get() functionality.',
			array('{className}'=>get_class($this))));
	}

}


/*

*/



