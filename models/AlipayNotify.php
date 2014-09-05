<?php

namespace app\models;

use \DOMDocument;
use app\models\U;
use app\models\Alipay;

class AlipayNotify 
{
	var $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';
	var $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';
	var $alipay_config;

	function __construct($alipay_config){
		$this->alipay_config = $alipay_config;
	}

    function AlipayNotify($alipay_config) {
    	$this->__construct($alipay_config);
    }

	function verifyNotify(){
		if(empty($_POST)) {//判断POST来的数组是否为空
			return false;
		}
		else {
			
			//对notify_data解密
			$decrypt_post_para = $_POST;
			if ($this->alipay_config['sign_type'] == '0001') {
				$decrypt_post_para['notify_data'] = Alipay::rsaDecrypt($decrypt_post_para['notify_data'], $this->alipay_config['private_key_path']);
			}
			
			//notify_id从decrypt_post_para中解析出来（也就是说decrypt_post_para中已经包含notify_id的内容）
			$doc = new DOMDocument();
			$doc->loadXML($decrypt_post_para['notify_data']);
			$notify_id = $doc->getElementsByTagName( "notify_id" )->item(0)->nodeValue;
			
			//获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
			$responseTxt = 'true';
			if (! empty($notify_id)) {$responseTxt = $this->getResponse($notify_id);}
			
			//生成签名结果
			$isSign = $this->getSignVeryfy($decrypt_post_para, $_POST["sign"],false);
			
			//写日志记录
			//if ($isSign) {
			//	$isSignStr = 'true';
			//}
			//else {
			//	$isSignStr = 'false';
			//}
			//$log_text = "responseTxt=".$responseTxt."\n notify_url_log:isSign=".$isSignStr.",";
			//$log_text = $log_text.createLinkString($_POST);
			//Alipay::logResult($log_text);
			
			//验证
			//$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
			//isSign的结果不是true，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
			if (preg_match("/true$/i",$responseTxt) && $isSign) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function verifyReturn(){
		if(empty($_GET)) {
			return false;
		}
		else {
			//生成签名结果
			$isSign = $this->getSignVeryfy($_GET, $_GET["sign"],true);
			
			//写日志记录
			//if ($isSign) {
			//	$isSignStr = 'true';
			//}
			//else {
			//	$isSignStr = 'false';
			//}
			//$log_text = "return_url_log:isSign=".$isSignStr.",";
			//$log_text = $log_text.createLinkString($_GET);
			//Alipay::logResult($log_text);
			
			//验证
			//$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
			//isSign的结果不是true，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
			if ($isSign) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	function decrypt($prestr) {
		return Alipay::rsaDecrypt($prestr, trim($this->alipay_config['private_key_path']));
	}
	
	function sortNotifyPara($para) {
		$para_sort['service'] = $para['service'];
		$para_sort['v'] = $para['v'];
		$para_sort['sec_id'] = $para['sec_id'];
		$para_sort['notify_data'] = $para['notify_data'];
		return $para_sort;
	}
	
	function getSignVeryfy($para_temp, $sign, $isSort) {
		$para = Alipay::paraFilter($para_temp);
		
		if($isSort) {
			$para = Alipay::argSort($para);
		} else {
			$para = $this->sortNotifyPara($para);
		}
		
		$prestr = Alipay::createLinkstring($para);		
		$isSgin = false;
		switch (strtoupper(trim($this->alipay_config['sign_type']))) {
			case "MD5" :
				$isSgin = Alipay::md5Verify($prestr, $sign, $this->alipay_config['key']);
				break;
			case "RSA" :
				$isSgin = Alipay::md5Verify($prestr, trim($this->alipay_config['ali_public_key_path']), $sign);
				break;
			case "0001" :
				$isSgin = Alipay::md5Verify($prestr, trim($this->alipay_config['ali_public_key_path']), $sign);
				break;
			default :
				$isSgin = false;
		}
		
		return $isSgin;
	}

	function getResponse($notify_id) {
		$transport = strtolower(trim($this->alipay_config['transport']));
		$partner = trim($this->alipay_config['partner']);
		$veryfy_url = '';
		if($transport == 'https') {
			$veryfy_url = $this->https_verify_url;
		}
		else {
			$veryfy_url = $this->http_verify_url;
		}
		$veryfy_url = $veryfy_url."partner=" . $partner . "&notify_id=" . $notify_id;
		$responseTxt = Alipay::getHttpResponseGET($veryfy_url, $this->alipay_config['cacert']);
		
		return $responseTxt;
	}
}
?>
