<?php

namespace app\models;

use \DOMDocument;
use app\models\U;
use app\models\Alipay;

class AlipaySubmit {

	var $alipay_config;
	//var $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?';
	var $alipay_gateway_new = 'http://wappaygw.alipay.com/service/rest.htm?';

	function __construct($alipay_config){
		$this->alipay_config = $alipay_config;
	}
    function AlipaySubmit($alipay_config) {
    	$this->__construct($alipay_config);
    }
	
	function buildRequestMysign($para_sort) {
		$prestr = Alipay::createLinkstring($para_sort);
		
		$mysign = "";
		switch (strtoupper(trim($this->alipay_config['sign_type']))) {
			case "MD5" :
				$mysign = Alipay::md5Sign($prestr, $this->alipay_config['key']);
				break;
			case "RSA" :
				$mysign = Alipay::rsaSign($prestr, $this->alipay_config['private_key_path']);
				break;
			case "0001" :
				$mysign = Alipay::rsaSign($prestr, $this->alipay_config['private_key_path']);
				break;
			default :
				$mysign = "";
		}
		
		return $mysign;
	}

	function buildRequestPara($para_temp) {
		$para_filter = Alipay::paraFilter($para_temp);
		$para_sort = Alipay::argSort($para_filter);
		$mysign = $this->buildRequestMysign($para_sort);
		$para_sort['sign'] = $mysign;
		if($para_sort['service'] != 'alipay.wap.trade.create.direct' && $para_sort['service'] != 'alipay.wap.auth.authAndExecute') {
			$para_sort['sign_type'] = strtoupper(trim($this->alipay_config['sign_type']));
		}		
		return $para_sort;
	}

	function buildRequestParaToString($para_temp) {
		$para = $this->buildRequestPara($para_temp);
		$request_data = Alipay::createLinkstringUrlencode($para);		
		return $request_data;
	}
	
	function buildRequestForm($para_temp, $method, $button_name) {
		$para = $this->buildRequestPara($para_temp);		
		$sHtml = "<form id='alipaysubmit' name='alipaysubmit' action='".$this->alipay_gateway_new."_input_charset=".trim(strtolower($this->alipay_config['input_charset']))."' method='".$method."'>";
		while (list ($key, $val) = each ($para)) {
            $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }

        $sHtml = $sHtml."<input type='submit' value='".$button_name."'></form>";		
		$sHtml = $sHtml."<script>document.forms['alipaysubmit'].submit();</script>";		
		return $sHtml;
	}
	
	function buildRequestHttp($para_temp) {
		$sResult = '';
		$request_data = $this->buildRequestPara($para_temp);
		$sResult = Alipay::getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config['cacert'],$request_data,trim(strtolower($this->alipay_config['input_charset'])));
		return $sResult;
	}
	
	function buildRequestHttpInFile($para_temp, $file_para_name, $file_name) {
		$para = $this->buildRequestPara($para_temp);
		$para[$file_para_name] = "@".$file_name;
		$sResult = Alipay::getHttpResponsePOST($this->alipay_gateway_new, $this->alipay_config['cacert'],$para,trim(strtolower($this->alipay_config['input_charset'])));
		return $sResult;
	}
	
	function parseResponse($str_text) {
		$para_split = explode('&',$str_text);
		foreach ($para_split as $item) {
			$nPos = strpos($item,'=');
			$nLen = strlen($item);
			$key = substr($item,0,$nPos);
			$value = substr($item,$nPos+1,$nLen-$nPos-1);
			$para_text[$key] = $value;
		}
		if( ! empty ($para_text['res_data'])) {
			if($this->alipay_config['sign_type'] == '0001') {
				$para_text['res_data'] = Alipay::rsaDecrypt($para_text['res_data'], $this->alipay_config['private_key_path']);
			}
			
			$doc = new DOMDocument();
			$doc->loadXML($para_text['res_data']);
			$para_text['request_token'] = $doc->getElementsByTagName( "request_token" )->item(0)->nodeValue;
		}

		if(!empty($para_text['res_error'])) {
			$respObject = @simplexml_load_string($para_text['res_error']);
			$para_text['res_error_arr'] = json_decode(json_encode($respObject), true);			
			Alipay::logResult($para_text['res_error_arr']);
		}
		
		return $para_text;
	}
	
	function query_timestamp() {
		$url = $this->alipay_gateway_new."service=query_timestamp&partner=".trim(strtolower($this->alipay_config['partner']))."&_input_charset=".trim(strtolower($this->alipay_config['input_charset']));
		$encrypt_key = "";		
		$doc = new DOMDocument();
		$doc->load($url);
		$itemEncrypt_key = $doc->getElementsByTagName( "encrypt_key" );
		$encrypt_key = $itemEncrypt_key->item(0)->nodeValue;		
		return $encrypt_key;
	}
}
?>