<?php

namespace app\models\sm;

use Yii;
use app\models\U;
use app\models\sm\ESms;

class ESmsJuxin extends ESms
{
	const SEND_URL = "http://api.app2e.com/smsBigSend.api.php";
	const BALANCE_URL = "http://api.app2e.com/getBalance.api.php";			
	
	const ORDER_USERNAME = 'mitototech_auth';	
	const ORDER_PASSWORD = '123456';	

	const PROM_USERNAME = 'mitototech';	
	const PROM_PASSWORD = '123456';	

	public function __construct()
	{			
		$this->username = ESmsJuxin::ORDER_USERNAME;
		$this->password = ESmsJuxin::ORDER_PASSWORD;	
		$this->message_is_gbk = true;
		$this->format = 'json';		
		$this->method = 'POST';
		//$this->debug = true;
	}

	public function selectPromChanel()
	{			
		$this->username = ESmsJuxin::PROM_USERNAME;
		$this->password = ESmsJuxin::PROM_PASSWORD;		
	}
	
	public function send()
	{
		$params = array();
		$params['username'] = $this->username;
		$params['pwd'] = md5($this->password);		
		//$params['SendTime'] = $this->sendtime;
		$params['p'] = $this->mobiles_str;
		if ($this->message_is_gbk)
			$message = iconv("UTF-8","GBK//IGNORE", $this->message);	
		else
			$message = $this->message;
		$params['msg'] = $message;		
		$this->submit(self::SEND_URL, $params);	
		if (!$this->isSendOk())
		{
			U::W(array(self::SEND_URL, $params, $this->resp));
		}
	}

	public function isSendOk()
	{
		if ($this->debug)
			return true;
		if ($this->resp_code != ESms::OK_CURL)
			return false;
		$sm_code = $this->resp->status;
		if (!in_array($sm_code, array('100')))
			return false;
		return true;
	}

	public function getErrorMsg()
	{
		if ($this->isSendOk())		
			return '';
		return isset($this->resp->status) ? $this->resp->status : '';
	}

	public function S($mobiles_str, $message, $sendtime='', $params=array())
	{
		if (!$this->isOrder)
			$this->selectPromChanel();
		$this->mobiles_str = $mobiles_str;
		$this->message = $message;
		//$this->sendtime = $sendtime;	//$sendtime='20131105161700'
		//$this->sendtime = self::getNewSendTime($sendtime); 	// change 2013-11-05 16:17:00 -> '20131105161700'
		$this->send();
		return $this;
	}

	/*
	Yii::import('ext.sm.*');			
	U::W('after='.ESmsJuxin::B(true));	
	*/
	public static function B($isProm=false)
	{
		$s = new ESmsJuxin;	
		if ($isProm)
			$s->selectPromChanel();
		$s->method = 'GET';			
		return $s->getBalance();
	}

	public function getBalance()
	{
		$params = array();
		$params['username'] = $this->username;
		$params['pwd'] = md5($this->password);				
		$this->submit(self::BALANCE_URL, $params);
		if ($this->resp_code != ESms::OK_CURL)
			return 'err';
		return $this->resp->balance;		
	}

/*
		$s = Yii::app()->sm->S('13871407676', 'how do you do', '', 'juxin');
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		Yii::import('ext.sm.*');			
		U::W('after='.ESmsJuxin::B(true));	

		ESmsJuxin::S_test();	
		return;
*/
	public static function S_test()
	{
		U::W('before='.self::B(true));
		$s = new ESmsJuxin;	
		$s->mobiles_str = '13871407676';
		$s->message = 'hello, world';
		//$s->sendtime = ESmsJuxin::getNewSendTime(date("Y-m-d H:i:s"));		
		if (!$s->isOrder)
			$s->selectPromChanel();		
		$s->send();
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		U::W('after='.self::B(true));
	}


}

/*

*/


