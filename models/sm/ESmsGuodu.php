<?php

namespace app\models\sm;

use Yii;
use app\models\U;
use app\models\sm\ESms;

class ESmsGuodu extends ESms
{
	const SEND_URL = "http://221.179.180.158:9007/QxtSms/QxtFirewall";		
	const BALANCE_URL = "http://221.179.180.158:8081/QxtSms_surplus/surplus";			
	
	const ORDER_USERNAME = 'wushen';	
	const ORDER_PASSWORD = 'wushen123';	

	const PROM_USERNAME = 'gouwuc';	
	const PROM_PASSWORD = 'he1109';	

	public $contentType = 8;		// long message , 1: <=70(bytes)    2:2x67(bytes)  3:3x67(bytes)
	public $appendID = '0';
	public $validTime = '';	

	public function __construct()
	{			
		$this->username = ESmsGuodu::ORDER_USERNAME;
		$this->password = ESmsGuodu::ORDER_PASSWORD;	
		$this->message_is_gbk = true;
		$this->format = 'xml';				
	}

	public function selectPromChanel()
	{			
		$this->username = ESmsGuodu::PROM_USERNAME;
		$this->password = ESmsGuodu::PROM_PASSWORD;		
	}
	
	public function send()
	{
		$params = array();
		$params['OperID'] = $this->username;
		$params['OperPass'] = $this->password;		
		$params['SendTime'] = $this->sendtime;
		$params['DesMobile'] = $this->mobiles_str;
		if ($this->message_is_gbk)
			$message = iconv("UTF-8","GBK//IGNORE", $this->message);	
		else
			$message = $this->message;
		$params['Content'] = $message;		
		$params['ValidTime'] = $this->validTime;		
		$params['AppendID'] = $this->appendID;		
		$params['ContentType'] = $this->contentType;				
		//$this->submit(self::SEND_URL, $params);			// comment it if need test
		if (!$this->isSendOk())
		{
			U::W(array(self::SEND_URL, $params, $this->resp));
		}
	}

	public function isSendOk()
	{
		return true;		// just for test
		if ($this->resp_code != ESms::OK_CURL)
			return false;
		$sm_code = $this->resp->code;
		if (!in_array($sm_code, array('00', '01', '03')))
			return false;
		return true;
	}

	public function getErrorMsg()
	{
		if ($this->isSendOk())		
			return '';
		return isset($this->resp->code) ? $this->resp->code : '';
	}

	public function getBalance()
	{
		$params = array();
		$params['OperID'] = $this->username;
		$params['OperPass'] = $this->password;		
		$this->submit(self::BALANCE_URL, $params);
		if ($this->resp_code != ESms::OK_CURL)
			return 'err';
		return $this->resp->rcode;		
	}

	public function S($mobiles_str, $message, $sendtime='', $params=array())
	{
		if (!$this->isOrder)
			$this->selectPromChanel();
		$this->mobiles_str = $mobiles_str;
		$this->message = $message;
		//$this->sendtime = $sendtime;	//$sendtime='20131105161700'
		$this->sendtime = self::getNewSendTime($sendtime); 	// change 2013-11-05 16:17:00 -> '20131105161700'
		if (isset($params['user_id']))
			$this->appendID = $params['user_id'] % 10000;
		$this->send();
		return $this;
	}

	public function changePassword($newPassword)
	{
		// http://221.179.180.158:9001/QxtSms/QxtSetOperPass?OperID=wushen&OperPassOld=wushen123&OperPassNew=newpassword
		return;
	}

	public static function B($isProm=false)
	{
		$s = new ESmsGuodu;	
		if ($isProm)
			$s->selectPromChanel();
		return $s->getBalance();
	}

	public static function getNewSendTime($sendtime)
	{
		if (empty($sendtime))
			return '';
		$time_stamp =  strtotime($sendtime);
		$newSendTime = date("YmdHis", $time_stamp); 
		return $newSendTime;
	}

	// ---------------------  Test ----------------------	
	public static function S_test1()
	{
		U::W('before='.self::B());
		$s = ESmsGuodu::S('13871407676','壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒', ESmsGuodu::getNewSendTime(date("Y-m-d H:i:s")));
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		U::W('after='.self::B());
	}

	public static function S_test2()
	{
		U::W('before='.self::B());
		$s = new ESmsGuodu;	
		$s->mobiles_str = '13871407676';
		$s->message = '壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒1';
		$s->sendtime = ESmsGuodu::getNewSendTime(date("Y-m-d H:i:s"));		
		$s->send();
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		U::W('after='.self::B());
	}

	public static function S_test3()
	{
		U::W('before='.self::B());
		$s = ESmsGuodu::S('13871407676,13545222924','Hi，测试_多号_短_'.__FUNCTION__);
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		U::W('after='.self::B());
	}

	public static function S_test4()
	{
		U::W('before='.self::B());
		$s = new ESmsGuodu;	
		$s->mobiles_str = '13871407676';
		$s->message = 'Hi，测试_单号_短_定时_'.__FUNCTION__;
		$s->sendtime = ESmsGuodu::getNewSendTime(date("Y-m-d H:i:s", time()+2*3600));	
		U::W("timer is {$s->sendtime}");
		$s->send();
		if ($s->isSendOk())
			U::W('Send OK');
		else 
			U::W('Send ERR');
		U::W($s->resp);
		U::W('after='.self::B());
	}

}

/*
	public static function B($isProm=false)
	{
		$s = new ESmsGuodu;	
		if ($isProm)
			$s->selectPromChanel();
		return $s->getBalance();
	}

	public static function S($mobiles_str, $message, $sendtime='', $isProm=false)
	{
		$s = new ESmsGuodu;	
		if ($isProm)
			$s->selectPromChanel();
		$s->mobiles_str = $mobiles_str;
		$s->message = $message;
		$s->sendtime = $sendtime;		//$sendtime='20131105161700'
		$s->send();
		return $s;
	}
*/


