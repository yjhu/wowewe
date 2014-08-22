<?php

namespace app\models\sm;

use Yii;
use app\models\U;
use app\models\sm\ESms;

class ESmsYmt extends ESms
{
	const USERNAME = '6SDK-EMY-6688-KCSQT';	
	const PASSWORD = '200507';	
	const SEND_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/sendsms.action";		
	const SEND_URL_TIMER = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/sendtimesms.action";
	const BALANCE_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/querybalance.action";

	const REGISTER_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/regist.action";		
	const UNREGISTER_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/logout.action";			
	const STATUS_REPORT_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/getreport.action";
	const MODIFY_PASSWORD_URL = "http://sdk4report.eucp.b2m.cn:8080/sdkproxy/changepassword.action";
	const TE_FU_NUM = 439267;

	const WEB_SERVICE_URL = 'http://sdk4report.eucp.b2m.cn:8080/sdk/SDKService';
	public $key='200507';		// just for webservice

	public function __construct()
	{			
		$this->username = ESmsYmt::USERNAME;
		$this->password = ESmsYmt::PASSWORD;	
		$this->message_is_gbk = false;
		$this->format = 'xml';				
	}

	public function send()
	{
		$params = array();
		$params['cdkey'] = $this->username;
		$params['password'] = $this->password;		
		$params['sendtime'] = $this->sendtime;		// yyyymmddhhnnss
		$params['phone'] = $this->mobiles_str;
		if ($this->message_is_gbk)
			$message = iconv("UTF-8","GBK//IGNORE", $this->message);	
		else
			$message = $this->message;		
		$params['message'] = $message;
		if (empty($this->sendtime))
			unset($params['sendtime']);
		$url = empty($this->sendtime) ? self::SEND_URL : self::SEND_URL_TIMER;
		$this->submit($url, $params);
		if (!$this->isSendOk())		
		{
			U::W(array($url, $params, $this->resp));
		}		
	}

	public function isSendOk()
	{
		if ($this->resp_code != ESms::OK_CURL)
			return false;

		$sm_code = $this->resp->error;
		return $sm_code == 0 ? true : false;
	}

	public function getErrorMsg()
	{
		if ($this->isSendOk())		
			return '';
		return isset($this->resp->error) ? $this->resp->error : '';		
	}

	public function getBalance()
	{
		$params = array();
		$params['cdkey'] = $this->username;
		$params['password'] = $this->password;	
		$this->submit(self::BALANCE_URL, $params);
		if ($this->resp_code != ESms::OK_CURL)
			return 'err';		
		return $this->resp->message * 10;		
	}

	public function S($mobiles_str, $message, $sendtime='', $params=array())
	{
		$this->mobiles_str = $mobiles_str;
		$this->message = $message;
		//$this->sendtime = $sendtime;		//$sendtime='20131105161700'
		$this->sendtime = self::getNewSendTime($sendtime); 	// change 2013-11-05 16:17:00 -> '20131105161700'		
		$this->send();
		return $this;
	}

	public static function B($isProm=false)	
	{
		$s = new ESmsYmt;	
		return $s->getBalance();
	}

	public function changePassword($password)
	{
		set_time_limit(0);	
		$this->modifyPassword($password);				// step1
		$this->unRegisterKey($this->password);				// step2
		sleep(2*60);
		$this->registerKey($password);						// step3
	}

	public function registerKey($password)
	{
		$params = array();
		$params['cdkey'] = $this->username;
		$params['password'] = $password;	
		$this->submit(self::REGISTER_URL, $params);
		if (!$this->isSendOk())
		{
			U::W(array(self::REGISTER_URL, $params, $this->resp));
		}							
	}

	public function unRegisterKey($password)
	{
		$params = array();
		$params['cdkey'] = $this->username;
		$params['password'] = $password;	
		$this->submit(self::UNREGISTER_URL, $params);
		if (!$this->isSendOk())
		{
			U::W(array(self::UNREGISTER_URL, $params, $this->resp));
		}									
	}

	public function modifyPassword($newPassword)
	{
		$params = array();
		$params['cdkey'] = $this->username;
		$params['password'] = $this->password;	
		$params['newPassword'] = $newPassword;	
		$this->submit(self::MODIFY_PASSWORD_URL, $params);
		if (!$this->isSendOk())
		{
			U::W(array(self::MODIFY_PASSWORD_URL, $params, $this->resp));
		}									
	}

	public function getBalanceWs()
	{
		// just for webservice	
		include_once 'ymt/Client.php';		
		$client = new Client(self::WEB_SERVICE_URL, $this->username, $this->password, $this->key);
		$client->setOutgoingEncoding("UTF-8");		
		$balance = $client->getBalance();
		U::W($balance);
		return $balance;	
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
		$s = ESmsYmt::S('13871407676','壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒', ESmsYmt::getNewSendTime(date("Y-m-d H:i:s")));
		//$s = ESmsYmt::S('13871407676','壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒');
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
		$s = new ESmsYmt;	
		$s->mobiles_str = '13871407676';
		$s->message = '壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒捌玖拾0123456789壹贰叁肆伍陆柒1';
		$s->sendtime = ESmsYmt::getNewSendTime(date("Y-m-d H:i:s"));		
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
		$s = ESmsYmt::S('13871407676,13545222924','Hi，测试_多号_短_'.__FUNCTION__);
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
		$s = new ESmsYmt;	
		$s->mobiles_str = '13871407676';
		$s->message = 'Hi，测试_单号_短_定时_'.__FUNCTION__;
		$s->sendtime = ESmsYmt::getNewSendTime(date("Y-m-d H:i:s", time()+2*3600));	
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
	// login();   //激活序列号
	// updatePassword();  //修改密码
	// logout();          //注销序列号 
	// registDetailInfo();//注册企业信息
	// getEachFee();      //得到单价 
	// getMO();           //接收短信
	// getVersion();      //得到版本号 

	const OK = 0;
	const ERROR_CURL = 8001;
	const ERROR_HTTP_RESPONSE_NOT_WELL_FORMED = 8002;	
	

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
			//U::W(array($requestUrl, $postFields));
			$resp = Util::curl($requestUrl, $postFields);
		}
		catch (Exception $e)
		{
			$resp = new stdClass();		
			$resp->error = self::ERROR_CURL;
			$resp->message = $e->getMessage();			
			L('ESmsYmt submit err,'.$e->getCode().','.$e->getMessage());
			return $resp;			
		}
		$respObject = @simplexml_load_string(trim($resp));
		if (false === $respObject)
		{
			L(array('HTTP_RESPONSE_NOT_WELL_FORMED', $resp));
			$resp = new stdClass();					
			$resp->error = self::ERROR_HTTP_RESPONSE_NOT_WELL_FORMED;
			$resp->message = "HTTP_RESPONSE_NOT_WELL_FORMED";
			return $resp;
		}
		$resp = json_decode(json_encode($respObject));
		if ($resp->error != ESmsYmt::OK)
		{
			L(array($url, $params, $resp));
		}
		//U::W($resp);		
		return $resp;
	}

	public $cdkey='6SDK-EMY-6688-KCSQT';		
	public $password='200507';	
	public $sendtime='';					//yyyymmddhhnnss
	public $phone;		
	public $message;		


	public static function S($mobiles_str, $message, $sendtime='')
	{
		$s = new ESmsYmt;	
		$s->mobiles_str = $mobiles_str;
		$s->message = $message;
		$s->sendtime = $sendtime;		//$sendtime='20131105161700'
		$s->send();
		return $s;
	}
*/


