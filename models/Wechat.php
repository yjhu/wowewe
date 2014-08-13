<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\web\HttpException;

use app\models\U;
use app\models\WxException;
use app\models\MUser;

use app\models\RespText;
use app\models\RespImage;
use app\models\RespNews;
use app\models\RespNewsItem;
use app\models\RespMusic;

class Wechat extends \yii\base\Object
{
	//const OPENID_TESTER1 = 'o6biBt5yaB7d3i0YTSkgFSAHmpdo';		// hoya hehb
	const OPENID_TESTER1 = 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o';			// woso hehb	
	//const OPENID_TESTER1 = 'oKgUduNHzUQlGRIDAghiY7ywSeWk';		// xiangyangunicom hbhe		
	//const OPENID_TESTER1 = 'oKgUduJJFo9ocN8qO9k2N5xrKoGE';		// xiangyangunicom kzeng		
	//const OPENID_TESTER1 = 'oKgUduNaK7mfojofz2qnSxa_FTMs';		// xiangyangunicom gtsun			
	
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'location';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';

	const EVENT_SUBSCRIBE = 'subscribe';
	const EVENT_UNSUBSCRIBE = 'unsubscribe';
	const EVENT_SCAN = 'SCAN';
	const EVENT_LOCATION = 'LOCATION';
	const EVENT_CLICK = 'CLICK';
	const EVENT_VIEW = 'VIEW';	

	const NO_RESP = '';
	const SIGNTYPE = 'sha1';
	
	public $debug =  false;
	public $localTest = false;
	
	public $oauth2cb = ['wap/oauth2cb'];		
	public $paynotifyUrl = ['wap/paynotify'];			

	private $_request;
	private $_gh_id;
	private $_gh;
	private $_appid;
	private $_accessToken;	

	// wxpay package parameters
	public $_parameters;	
	
	public function init()
	{
//		U::W('Wap init...');
	}

	private function log($log)
	{
		if ($this->debug) 
		{
			\app\models\U::W($log);
		}
	}

	public function getGhId()
	{
		return $this->_gh_id;
	}

	public function setGhId($gh_id)
	{
		$this->_gh_id = $gh_id;
	}

	public function getAppId()
	{
		return $this->_appid;
	}

	public function setAppId($appid)
	{
		$this->_appid = $appid;
	}
	
	public function getGh()
	{
		if($this->_gh !== null)
			return $this->_gh;	
		if (empty($this->_gh_id) && empty($this->_appid))
		{
			U::W(debug_backtrace());
			U::D("gh_id and appid can can not be empty at the same time!");
		}
		$db = \Yii::$app->db;
		$tableName = \app\models\MGh::tableName();
		if (!empty($this->_gh_id))
			$command = $db->createCommand("SELECT * FROM $tableName WHERE gh_id=:gh_id", [':gh_id'=>$this->_gh_id]);
		else
			$command = $db->createCommand("SELECT * FROM $tableName WHERE appid=:appid", [':appid'=>$this->_appid]);
		//$db->beginCache(YII_DEBUG ? 10 : 3600);
		$row = $command->queryOne();
		//$db->endCache();		
		if ($row === false)
			U::D("no exists in db!, gh_id={$this->_gh_id}, appid={$this->_appid}");
		$this->_gh = $row;
		return $row;
	}

	public function clearGh()
	{
		$this->_gh_id = null;
		$this->_appid = null;
		$this->_gh = null;
		$this->_accessToken = null;
	}
	
	public function getAccessToken($forceRefresh=false)
	{	
		if($this->_accessToken !== null)
			return $this->_accessToken;
			
		$key = __METHOD__.$this->_gh_id;

		if (!$forceRefresh)
		{
			$value = Yii::$app->cache->get($key);
			if ($value !== false)
			{
				$this->_accessToken = $value;
				U::W("getAccessToken from cache key=$key, value=$value");
				return $value;
			}
		}

		$arr = self::WxGetAccessToken($this->gh['appid'], $this->gh['appsecret']);
		if (!isset($arr['access_token']))
		{
			U::W([__METHOD__, $arr]);
			die('no access_token......');
		}
		$this->_accessToken = $arr['access_token'];
		Yii::$app->cache->set($key, $this->_accessToken, YII_DEBUG ? 10 : 3600);
		U::W("getAccessToken from weixin====, {$arr['access_token']}");
		
		return $this->_accessToken;		
	}

	public function valid()
	{
		if ($this->localTest)
		{
			$_GET['signature'] = '228c2744ce651fb61cceb461c48fa03c608c1299';
			//$_GET['echostr'] = '6372428126615300095';
			$_GET['timestamp'] = '1402529705';
			$_GET['nonce'] = '1023195716';
		}
		$echoStr = isset($_GET["echostr"]) ? $_GET["echostr"]: '';
		$token = $this->gh['token'];	
		if (!empty($echoStr)) 
		{
			if (self::checkSignature($token))
				die($echoStr);
			else 
				U::D('Invalid Signature in valid()');
		}  
		else 
		{
			if (self::checkSignature($token))
				return true;
			else
				U::D('Invalid Signature in valid().');			
		}
		return false;
	}
	
	public static function checkSignature($token)
	{
		$signature = isset($_GET["signature"])?$_GET["signature"]:'';
		$timestamp = isset($_GET["timestamp"])?$_GET["timestamp"]:'';
		$nonce = isset($_GET["nonce"])?$_GET["nonce"]:'';
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		return $tmpStr == $signature? true : false;
	}
	
	public function getPostStr() 
	{
		if ($this->localTest)		
		{
				return $this->getDemoRequestXml(Wechat::MSGTYPE_TEXT);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_CLICK, 'FuncQueryAccount');	// FuncQueryFee
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_SUBSCRIBE);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_UNSUBSCRIBE);				
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_IMAGE);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_LOCATION);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_LINK);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_VOICE);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_VIDEO);				
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_SCAN);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_LOCATION);
				//return $this->getDemoRequestXml(Wechat::MSGTYPE_EVENT, Wechat::EVENT_VIEW);
		}
		else
		{
			return file_get_contents("php://input");
			//return $GLOBALS['HTTP_RAW_POST_DATA'];			
		}
	}
	
	protected function getRequest($key=false) 
	{
		if ($this->_request === null)
		{
			$postStr = $this->getPostStr();
			$this->log($postStr);	
			if (empty($postStr)) 
			{
				U::W(['No post data!', __METHOD__, $GLOBALS]);
				exit;
			}
			$arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->_request = $arr;
		}
		if ($key === false)
			return $this->_request;
		if (isset($this->_request[$key])) 
			return $this->_request[$key];
		else
			return null;
	}

	protected function getRequestString() 
	{		
		$arr = $this->getRequest();
		foreach($arr as $key => $val)
			$items[] = "$key=$val";
		return implode(',', $items);
	}
	
	protected function onSubscribe() { return $this->responseText($this->getRequestString()); }
	
	protected function onUnsubscribe() { return $this->responseText($this->getRequestString()); }
	
	protected function onText() { return $this->responseText($this->getRequestString()); }
	
	protected function onImage() { return $this->responseText($this->getRequestString()); }
	
	protected function onLocation() { return $this->responseText($this->getRequestString()); }
	
	protected function onLink() { return $this->responseText($this->getRequestString()); }
	
	protected function onView() { return $this->responseText($this->getRequestString()); }
	
	protected function onClick() { return $this->responseText($this->getRequestString()); }
	
	protected function onEventLocation() { return $this->responseText($this->getRequestString()); }
	
	protected function onVoice() { return $this->responseText($this->getRequestString()); }
	
	protected function onVideo() { return $this->responseText($this->getRequestString()); }
	
	protected function onScan() { return $this->responseText($this->getRequestString()); }

	protected function onUnknown()
	{
		throw new \Exception(U::toString(['Invalid MsgType or Event', __METHOD__, $this->getRequest()]));	
	}

	public function checkOpenid() 
	{
//			U::W('aaaaaaaaaaaa');	
		$gh_id = $this->getGhId();	
//			U::W('bbbbbb'.$gh_id);			
		$FromUserName = $this->getRequest('FromUserName');
//			U::W('cccc'.$FromUserName);			

		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$FromUserName]);
//			U::W('ddddd');					
		if ($model === null)
		{
			//U::W('no.....');
			$model = new MUser;		
		}
		if (empty($model->nickname) ||!$model->subscribe)
		{
			//U::W('yes.....');
			try
			{						
				$arr = $this->WxGetUserInfo($FromUserName);
			}
			catch(\Exception $e)
			{
				// refresh accessToken 
				U::W('refresh accessToken.....then get user again........');
				$this->getAccessToken(true);
				$arr = $this->WxGetUserInfo($FromUserName);
			}			
			$model->setAttributes($arr, false);
			$model->gh_id = $this->getRequest('ToUserName');			
			$model->openid = $FromUserName;			
		}
		$model->msg_time = time();
		if (!$model->save(false))
			U::W([__METHOD__, $model->getErrors()]);	
	}
	
	public function run($gh_id) 
	{
		try
		{		
			$this->setGhId($gh_id);
			$this->valid();		
			$MsgType = $this->getRequest('MsgType');
			U::W('TTTTTTTTTTT44444');					
			//$this->setGhId($this->getRequest('ToUserName'));
			$this->checkOpenid();
			U::W('TTTTTTTTTTT555');					
			switch ($MsgType) 
			{
				case Wechat::MSGTYPE_TEXT:
					$resp = $this->onText();
					break;

				case Wechat::MSGTYPE_IMAGE:
					$resp = $this->onImage();
					break;

				case Wechat::MSGTYPE_LOCATION:
					$resp = $this->onLocation();
					break;

				case Wechat::MSGTYPE_LINK:
					$resp = $this->onLink();
					break;

				case Wechat::MSGTYPE_VOICE:
					$resp = $this->onVoice();
					break;

				case Wechat::MSGTYPE_VIDEO:	
					$resp = $this->onVideo();	
					break;

				case Wechat::MSGTYPE_EVENT:
					$Event = $this->getRequest('Event');
					switch ($Event) 
					{
						case Wechat::EVENT_SUBSCRIBE:
							$resp =$this->onSubscribe();
							break;

						case Wechat::EVENT_UNSUBSCRIBE:
							$resp =$this->onUnsubscribe();
							break;

						case Wechat::EVENT_SCAN:
							$resp =$this->onScan();
							break;

						case Wechat::EVENT_LOCATION:
							$resp =$this->onEventLocation();
							break;

						case Wechat::EVENT_CLICK:
							$resp =$this->onClick();
							break;

						case Wechat::EVENT_VIEW:
							$resp =$this->onView();
							break;

						default:
							$resp = $this->onUnknown();
							break;
					}
					break;

				default:
					$resp = $this->onUnknown();
					break;
			}			
			$xml = empty($resp) ? self::NO_RESP : sprintf("%s", $resp);
			$this->log($xml);			
			return $xml;
		}
		catch(\Exception $e)
		{
			U::W($e->getMessage());
			return self::NO_RESP;
		}
	}

	protected function responseText($content, $funcFlag = 0)
	{
		return new RespText($this->getRequest('FromUserName'), $this->getRequest('ToUserName'), $content, $funcFlag);
	}

	protected function responseImage($MediaId, $funcFlag = 0)
	{
		return new RespImage($this->getRequest('FromUserName'), $this->getRequest('ToUserName'), $MediaId, $funcFlag);
	}

	protected function responseMusic($title, $description, $musicUrl, $hqMusicUrl, $ThumbMediaId, $funcFlag = 0) 
	{
		return new RespMusic($this->getRequest('FromUserName'), $this->getRequest('ToUserName'), $title, $description, $musicUrl, $hqMusicUrl, $ThumbMediaId, $funcFlag);
	}

	protected function responseNews($items, $funcFlag = 0) 
	{
		return new RespNews($this->getRequest('FromUserName'), $this->getRequest('ToUserName'), $items, $funcFlag);
	}

	protected function responseLocalImage($type, $localFile, $funcFlag = 0)
	{
		$arr = $this->WxMediaUpload($type, $localFile);
		$MediaId = $arr['media_id'];
		return new RespImage($this->getRequest('FromUserName'), $this->getRequest('ToUserName'), $MediaId, $funcFlag);
	}

	public function getDemoRequestXml($MsgType, $Event=Wechat::EVENT_SUBSCRIBE, $EventKey = 'FuncQueryAccount') 
	{
		$openid = Wechat::OPENID_TESTER1;
		//$gh_id = Yii::$app->wx->getGhid();
		$gh_id = $this->getGhId();
		switch ($MsgType) 
		{
			case Wechat::MSGTYPE_TEXT:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1402545118</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[Xy]]></Content>
<MsgId>6023885413174756692</MsgId>
</xml>
EOD;
				break;

			case Wechat::MSGTYPE_IMAGE:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1402716823</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<PicUrl><![CDATA[http://mmbiz.qpic.cn/mmbiz/sfPia9sGialANxsfkib9L3pLolJcbrtXkkPFxRUNFeTry12vibeDHOhIibvDmVquhPIiboSbv0tm6GRO7UU7tkAQEXTA/0]]></PicUrl>
<MsgId>6024622880534320141</MsgId>
<MediaId><![CDATA[1HxU1hdTALQ2KwCxEUz7RvVWYKiCZxYCWLovam3GT19KHd1G_gDCUlc6tuOIKq1f]]></MediaId>
</xml>
EOD;
				break;

			case Wechat::MSGTYPE_LOCATION:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1402716680</CreateTime>
<MsgType><![CDATA[location]]></MsgType>
<Location_X>30.512074</Location_X>
<Location_Y>114.315926</Location_Y>
<Scale>16</Scale>
<Label><![CDATA[wuchang district wuhan,hubei province, china]]></Label>
<MsgId>6024622266353996807</MsgId>
</xml>
EOD;
				break;

			case Wechat::MSGTYPE_LINK:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1351776360</CreateTime>
<MsgType><![CDATA[link]]></MsgType>
<Title><![CDATA[title]]></Title>
<Description><![CDATA[desc]]></Description>
<Url><![CDATA[http://baidu.com]]></Url>
<MsgId>1234567890123456</MsgId>
</xml>
EOD;
				break;

			case Wechat::MSGTYPE_VOICE:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1402716535</CreateTime>
<MsgType><![CDATA[voice]]></MsgType>
<MediaId><![CDATA[bFvd4vTiEb89CpfKVg8AsKJOBNSU0m3kZtL2pxnx4mSgQMvqo9EDHNKAyU6ZsUre]]></MediaId>
<Format><![CDATA[amr]]></Format>
<MsgId>6024621643583738876</MsgId>
<Recognition><![CDATA[voice text]]></Recognition>
</xml>				
EOD;
				break;

			case Wechat::MSGTYPE_VIDEO:	
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>1402717029</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<MediaId><![CDATA[MP_AE2Ofqe-YPzwHjgsI8zm5ScOz5nh34JfnfTsY52UimfvFaOssz_exTtIxnzCQ]]></MediaId>
<ThumbMediaId><![CDATA[X6bSlsb_sVIZnsDFJHsA36KI5XIdZIhAt0i6r1aPKCYdlFQzjpJXp-eHmBRGfBMx]]></ThumbMediaId>
<MsgId>6024623765297583125</MsgId>
</xml>
EOD;
				break;

			case Wechat::MSGTYPE_EVENT:
				switch ($Event) 
				{
					case Wechat::EVENT_SUBSCRIBE:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>
EOD;
						break;

					case Wechat::EVENT_UNSUBSCRIBE:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[unsubscribe]]></Event>
</xml>				
EOD;
						break;

					case Wechat::EVENT_SCAN:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[SCAN]]></Event>
<EventKey><![CDATA[$EventKey]]></EventKey>
<Ticket><![CDATA[TICKET]]></Ticket>
</xml>
EOD;
						break;

					case Wechat::EVENT_LOCATION:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[LOCATION]]></Event>
<Latitude>23.137466</Latitude>
<Longitude>113.352425</Longitude>
<Precision>119.385040</Precision>
</xml>
EOD;
						break;

					case Wechat::EVENT_CLICK:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[CLICK]]></Event>
<EventKey><![CDATA[$EventKey]]></EventKey>
</xml>
EOD;
						break;

					case Wechat::EVENT_VIEW:
				$xml = <<<EOD
<xml>
<ToUserName><![CDATA[$gh_id]]></ToUserName>
<FromUserName><![CDATA[$openid]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[VIEW]]></Event>
<EventKey><![CDATA[$EventKey]]></EventKey>
</xml>
EOD;
						break;
				}
				break;
				
			default:
				die('invalid Demo MsgType');
				break;				
		}
		return $xml;
	}

	public static function WxApi($gatewayUrl, $sysParams=[], $postFields = null, $format='json')
	{
		$requestUrl = $gatewayUrl . "?";
		foreach ($sysParams as $sysParamKey => $sysParamValue)
		{
			$requestUrl .= "$sysParamKey=" . urlencode($sysParamValue) . "&";
		}
		$requestUrl = substr($requestUrl, 0, -1);
		try
		{
			//U::W($requestUrl);
			$resp = U::curl($requestUrl, $postFields);
			//U::W($resp);
		}
		catch (Exception $e)
		{
			U::W($e->getCode().':'.$e->getMessage());
			return ['errcode'=>$e->getCode(), 'errmsg'=>$e->getMessage()];
		}

		if ("json" === $format)
		{
			$arr = json_decode($resp, true);
			if (null !== $arr)
				return $arr;
		}
		else if("xml" === $format)
		{
			$respObject = @simplexml_load_string($resp);
			if (false !== $respObject)
				return json_decode(json_encode($respObject), true);			
		}
		U::W($resp);
		return ['errcode'=>90000, 'errmsg'=>'HTTP_RESPONSE_NOT_WELL_FORMED'];
	}

	public function checkWxApiResp($resp, $params=[])
	{
		if (!empty($resp['errcode']))
		{
			U::W([$resp, $params]);
			if ($resp['errcode'] == 40001)
			{
				U::W('checkWxApiResp, refresh token.');
				$this->getAccessToken(true);		
				return true;
			}
			throw new WxException($resp);
		}
		return true;
	}
	
	public function WxGetAccessToken()
	{
		$gh = $this->gh;
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/token", ['grant_type'=>'client_credential', 'appid'=>$gh['appid'], 'secret'=>$gh['appsecret']]);
		$this->checkWxApiResp($arr, [__METHOD__, $this->gh]);
		return $arr;		
	}

	public function WxMenuCreate($menu)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/menu/create", ['access_token'=>$this->accessToken], self::json_encode($menu));		
		$this->checkWxApiResp($arr, [__METHOD__, $menu]);
		return $arr;				
	}

	public function WxMenuGet()
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/menu/get", ['access_token'=>$this->accessToken]);		
		$this->checkWxApiResp($arr, [__METHOD__]);		
		return $arr;				
	}

	public function WxMenuDelete()
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/menu/delete", ['access_token'=>$this->accessToken]);		
		$this->checkWxApiResp($arr, [__METHOD__]);
		return $arr;				
	}

	public function WxGetUserInfo($openid)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/user/info", ['access_token'=>$this->accessToken, 'openid'=>$openid, 'lang'=>'zh_CN']);
		$this->checkWxApiResp($arr, [__METHOD__, $openid]);
		return $arr;
	}

	public function WxGetOauth2Url($scope='snsapi_userinfo', $state='')
	{
		$appid = $this->gh['appid'];
		//snsapi_base, snsapi_userinfo
		//$redirect_uri = urlencode("http://wosotech.com/wx/web/index.php?r=wap/oauth2cb");
		//$redirect_uri = urlencode("http://wosotech.com/wx/web/index.php?r=wap/oauth2cb");		
		//U::W(Url::to($this->oauth2cb, true));
		//$redirect_uri = urlencode(Url::to($this->oauth2cb, true));	
		$redirect_uri = urlencode(urldecode(Url::to($this->oauth2cb, true)));
		//$redirect_uri = Url::to($this->oauth2cb, true);	
		//U::W($redirect_uri);
		//exit;				
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state={$state}#wechat_redirect";
		//$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}#wechat_redirect";		
		return $url;
	}
	
	public function WxGetOauth2AccessToken($code)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/sns/oauth2/access_token", ['appid'=>$this->gh['appid'], 'secret'=>$this->gh['appsecret'], 'code'=>$code, 'grant_type'=>'authorization_code']);
//U::W($arr);		
		$this->checkWxApiResp($arr, [__METHOD__, $code]);
		return $arr;
	}

	public function WxGetOauth2UserInfo($oauth2AccessToken, $openid)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/sns/userinfo", ['access_token'=>$oauth2AccessToken, 'openid'=>$openid, 'lang'=>'zh_CN']);		
		$this->checkWxApiResp($arr, [__METHOD__, $oauth2AccessToken, $openid]);
		return $arr;						
	}

	public function WxMessageCustomSend($msg)
	{
	U::W(self::json_encode($msg));
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/message/custom/send", ['access_token'=>$this->accessToken], self::json_encode($msg));
		$this->checkWxApiResp($arr, [__METHOD__, $msg]);
		return $arr;						
	}

	//$type: image,voice,video,thumb
	public function WxMediaUpload($type, $filename)
	{
		$key = $type.$filename;
		$arr = Yii::$app->cache->get($key);
		if ($arr === false)
		{
			$arr = self::WxApi("http://file.api.weixin.qq.com/cgi-bin/media/upload", ['access_token'=>$this->accessToken, 'type'=>$type], ['file'=>"@{$filename}"]);		
			$this->checkWxApiResp($arr, [__METHOD__, $type, $filename]);
			Yii::$app->cache->set($key, $arr, YII_DEBUG ? 100 : 2*24*3600);
		}
		return $arr;
	}

	public function WxMediaGetUrl($media_id)
	{
		$access_token = $this->accessToken;
		$url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}";
		return $url;
	}

	public function WxMediaDownload($media_id, $localFileName)
	{
		//$arr = self::WxApi("http://file.api.weixin.qq.com/cgi-bin/media/get", ['access_token'=>$this->accessToken, 'media_id'=>$media_id]);
		//$this->checkWxApiResp($arr, [__METHOD__, $media_id]);
		//U::W($arr);
		//return $arr;	
		self::downloadFile($this->WxMediaGetUrl($media_id), $localFileName);
	}

	public function WxgetQRCode($scene_id, $forever=0)
	{
		if ($forever)
			$post = ['action_name'=>'QR_LIMIT_SCENE', 'action_info'=>['scene'=>['scene_id'=>$scene_id]]];
		else
			$post = ['expire_seconds'=>1800, 'action_name'=>'QR_SCENE', 'action_info'=>['scene'=>['scene_id'=>$scene_id]]];
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/qrcode/create", ['access_token'=>$this->accessToken], self::json_encode($post));
		$this->checkWxApiResp($arr, [__METHOD__, $scene_id, $forever]);
		return $arr;								
	}

	public function WxGetQRUrl($ticket)
	{
		return 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($ticket);
	}

	public function WxGetSubscriberList()
	{
		$openids = [];
		do
		{
			$params['access_token'] = $this->accessToken;
			try
			{
				$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/user/get", $params);
				$this->checkWxApiResp($arr, [__METHOD__]);
			}
			catch(\Exception $e)
			{
				U::W($e->getMessage());
				return $openids;
			}			
			$openids = array_merge($openids, $arr['data']['openid']);
			$params['next_openid'] = $arr['next_openid'];
			if ($arr['count'] < 10000)
				break;
			if (empty($arr['next_openid']))
				break;							
		} while(true);
		//U::W($openids);
		return $openids;						
	}

	public function WxGroupListGet()
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/groups/get", ['access_token'=>$this->accessToken]);
		$this->checkWxApiResp($arr, [__METHOD__]);
		return $arr['groups'];
	}

	public function WxGroupCreate($group)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/groups/create", ['access_token'=>$this->accessToken], self::json_encode($group));
		$this->checkWxApiResp($arr, [__METHOD__, $group]);
		//U::W("{$arr['group']['id']},{$arr['group']['name']}");		
		return $arr;						
	}

	public function WxGroupUpdate($group)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/groups/update", ['access_token'=>$this->accessToken], self::json_encode($group));
		$this->checkWxApiResp($arr, [__METHOD__, $group]);
		return $arr;						
	}

	public function WxGroupMoveMember($openid, $to_groupid)
	{
		$arr = self::WxApi("https://api.weixin.qq.com/cgi-bin/groups/members/update", ['access_token'=>$this->accessToken], self::json_encode(['openid'=>$openid, 'to_groupid'=>$to_groupid]));
		$this->checkWxApiResp($arr, [__METHOD__, $openid, $to_groupid]);
		return $arr;						
	}
	
	public function getSignature($arrdata,$method="sha1") 
	{
		if (!function_exists($method))
			return false;
		ksort($arrdata);
		$paramstring = "";
		foreach($arrdata as $key => $value)
		{
			if(strlen($paramstring) == 0)
				$paramstring .= $key . "=" . $value;
			else
				$paramstring .= "&" . $key . "=" . $value;
		}
		$paySign = $method($paramstring);
		return $paySign;
	}

	//Yii::$app->wx->WxPayDeliverNotify($openid, $transaction_id, $out_trade_no);
	public function WxPayDeliverNotify($openid, $transid, $out_trade_no, $status=1, $msg='ok')
	{
		$postdata = [
			"appid"=>$this->gh['appid'],
			"appkey"=>$this->gh['paysignkey'],
			"openid"=>$openid,
			"transid"=>strval($transid),
			"out_trade_no"=>strval($out_trade_no),
			"deliver_timestamp"=>strval(time()),
			"deliver_status"=>strval($status),
			"deliver_msg"=>$msg
		];
		$postdata['app_signature'] = $this->getSignature($postdata);
		$postdata['sign_method'] = 'sha1';
		unset($postdata['appkey']);		
		$arr = self::WxApi("https://api.weixin.qq.com/pay/delivernotify", ['access_token'=>$this->accessToken], self::json_encode($postdata));
		$this->checkWxApiResp($arr, [__METHOD__, $postdata]);
		return $arr;								
	}

	public function WxPayOrderQuery($out_trade_no)
	{
		$partnerid = $this->gh['partnerid'];
		$partnerkey = $this->gh['partnerkey'];		
		$sign = strtoupper(md5("out_trade_no=$out_trade_no&partner={$partnerid}&key={$partnerkey}"));
		$postdata = [
			"appid"=>$this->gh['appid'],
			"appkey"=>$this->gh['paysignkey'],
			"package"=>"out_trade_no=$out_trade_no&partner={$partnerid}&sign=$sign",
			"timestamp"=>strval(time())
		];
		$postdata['app_signature'] = $this->getSignature($postdata);
		$postdata['sign_method'] = 'sha1';
		unset($postdata['appkey']);
		$arr = self::WxApi("https://api.weixin.qq.com/pay/orderquery", ['access_token'=>$this->accessToken], self::json_encode($postdata));
		$this->checkWxApiResp($arr, [__METHOD__, $postdata]);
		U::W($arr);
		U::W($arr['order_info']);
		return $arr;								
	}

	public static function generateOutTradeNo()
	{
		return uniqid();
		//return Yii::$app->wx->create_noncestr();
	}

	public static function supportWeixinPay()
	{
		return false;
		//return self::isWeixinBrowser() && self::getWeixinBrowserVer() >= 5;
	}

	public static function isAndroid()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT']))
			return true;
		return stripos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false ? true : false;
	}

	public static function isIos()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT']))
			return false;	
		if (stripos($_SERVER['HTTP_USER_AGENT'], 'IPhone') !== false)
			return true;
		if (stripos($_SERVER['HTTP_USER_AGENT'], 'IPad') !== false)		
			return true;
		return false;
	}

	public static function isWeixinBrowser()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT']))
			return true;
		return stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false ? false : true;
	}

	public static function getWeixinBrowserVer()
	{
		preg_match('/.*?(MicroMessenger\/([0-9.]+))\s*/', $_SERVER['HTTP_USER_AGENT'], $matches);
		return $matches[2];
	}
	
	static function json_encode($arr) 
	{
		return json_encode($arr, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
		//return self::my_json_encode($arr);
	}

	public static function downloadFile($url, $localFileName) 
	{  
		set_time_limit(0);
		//file_put_contents($localFileName, file_get_contents($url));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 0); 
		curl_setopt($ch,CURLOPT_URL,$url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if(strlen($url) > 5 && strtolower(substr($url,0,5)) == "https" ) 
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSLVERSION,3);			
		}		
		$file_content = curl_exec($ch);
		curl_close($ch);
		$downloaded_file = fopen($localFileName, 'w');
		fwrite($downloaded_file, $file_content);
		fclose($downloaded_file);
		return true;
	}
	
	// ------------------------ Wxpay ------------------------	
	protected static function sign($content, $key) 
	{
		if (empty($key))
			die("the PARTNERKEY can not be empty");
		if (empty($content))
			die("the PARTNER sign content can not be empty");
		$signStr = $content . "&key=" . $key;
		return strtoupper(md5($signStr));
	}
	
	public static function verifySignature($content, $sign, $md5Key)
	{
		$signStr = $content . "&key=" . $md5Key;
		$calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
		return $calculateSign == $tenpaySign;
	}

	public static function formatQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v) 
		{
			if (null != $v && "null" != $v && "sign" != $k) 
			{
				if($urlencode)
					$v = urlencode($v);
				$buff .= $k . "=" . $v . "&";
			}
		}
		$reqPar;
		if (strlen($buff) > 0)
			$reqPar = substr($buff, 0, strlen($buff)-1);
		return $reqPar;
	}
	
	public static function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
			if($urlencode)
				$v = urlencode($v);
			$buff .= strtolower($k) . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
			$reqPar = substr($buff, 0, strlen($buff)-1);
		return $reqPar;
	}

	public static function arrayToXml($arr)
	{
		$xml = "<xml>";
		foreach ($arr as $key=>$val)
		{
			if (is_numeric($val))
				$xml .= "<".$key.">".$val."</".$key.">"; 
			else
				$xml .= "<".$key."><![CDATA[".$val."]]></".$key.">";  
		}
		$xml .= "</xml>";
		return $xml; 
	}

	public static  function create_noncestr($length = 16) 
	{  
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
		$str ="";  
		for ( $i = 0; $i < $length; $i++ ) 
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
		return $str;  
	}
	
	protected function check_cft_parameters()
	{
		if(!isset($this->_parameters["bank_type"]) || !isset($this->_parameters["body"]) || !isset($this->_parameters["partner"]) || 
			!isset($this->_parameters["out_trade_no"]) || !isset($this->_parameters["total_fee"]) || !isset($this->_parameters["fee_type"]) ||
			!isset($this->_parameters["notify_url"]) || !isset($this->_parameters["spbill_create_ip"]) || !isset($this->_parameters["input_charset"]))
		{	
			U::W(['Invalid cft_parameters', __METHOD__, $this->_parameters]);
			return false;
		}
		else
			return true;
	}
	
	protected function get_cft_package()
	{
		$partnerkey = $this->gh['partnerkey'];
		if (empty($partnerkey))
			U::D('partnerkey can not be empty!');
		ksort($this->_parameters);
		$unSignParaString = self::formatQueryParaMap($this->_parameters, false);
		$paraString = self::formatQueryParaMap($this->_parameters, true);
		return $paraString . "&sign=" . self::sign($unSignParaString, $partnerkey);
	}
	
	protected function get_biz_sign($bizObj)
	{
		$appkey = $this->gh['paysignkey'];
		foreach ($bizObj as $k => $v)
			$bizParameters[strtolower($k)] = $v;
		$bizParameters["appkey"] = $appkey;
		ksort($bizParameters);
		$bizString = self::formatBizQueryParaMap($bizParameters, false);
		return sha1($bizString);
	}

	public function setParameter($key, $val) 
	{
		$this->_parameters[$key] = $val;
	}

	public function getParameter($key) 
	{
		return $this->_parameters[$key];
	}

	public function setParameterComm() 
	{
		$this->setParameter("bank_type", "WX");
		$this->setParameter("partner", $this->gh['partnerid']);
		$this->setParameter("fee_type", "1");
		$this->setParameter("input_charset", "UTF-8");
		$this->setParameter("notify_url", urldecode(Url::to($this->paynotifyUrl, true)));
	}
	
	public function create_biz_package()
	{
		$appid = $this->gh['appid'];
		if($this->check_cft_parameters() == false)   
			U::D("invalid cft_parameters ".__METHOD__);
		$nativeObj["appId"] = $appid;
		$nativeObj["package"] = $this->get_cft_package();
		$nativeObj["timeStamp"] = time();
		$nativeObj["nonceStr"] = self::create_noncestr();
		$nativeObj["paySign"] = $this->get_biz_sign($nativeObj);
		$nativeObj["signType"] = self::SIGNTYPE;		   
		return json_encode($nativeObj);		   
	}

	public function create_native_url($productid)
	{
		$appid = $this->gh['appid'];	
		$nativeObj["appid"] = $appid;
		$nativeObj["productid"] = urlencode($productid);
		$nativeObj["timestamp"] = time();
		$nativeObj["noncestr"] = self::create_noncestr();
		$nativeObj["sign"] = $this->get_biz_sign($nativeObj);
		$bizString = self::formatBizQueryParaMap($nativeObj, false);
		return "weixin://wxpay/bizpayurl?".$bizString;
	}

	public function create_native_package($retcode=0, $reterrmsg="ok")
	{
		$appid = $this->gh['appid'];	
		if($this->check_cft_parameters() == false && $retcode == 0)
			U::D("invalid cft_parameters ".__METHOD__);
		$nativeObj["AppId"] = $appid;
		$nativeObj["Package"] = $this->get_cft_package();
		$nativeObj["TimeStamp"] = time();
		$nativeObj["NonceStr"] = self::create_noncestr();
		$nativeObj["RetCode"] = $retcode;
		$nativeObj["RetErrMsg"] = $reterrmsg;
		$nativeObj["AppSignature"] = $this->get_biz_sign($nativeObj);
		$nativeObj["SignMethod"] = self::SIGNTYPE;
		return  self::arrayToXml($nativeObj);
	}



}


/*
errcode errmsg
-1 	    系统繁忙
0		请求成功
40001 	获取access_token时AppSecret错误，或者access_token无效
40002 	不合法的凭证类型
40003 	不合法的OpenID
40004 	不合法的媒体文件类型
40005 	不合法的文件类型
40006 	不合法的文件大小
40007 	不合法的媒体文件id
40008 	不合法的消息类型
40009 	不合法的图片文件大小
40010 	不合法的语音文件大小
40011 	不合法的视频文件大小
40012 	不合法的缩略图文件大小
40013 	不合法的APPID
40014 	不合法的access_token
40015 	不合法的菜单类型
40016 	不合法的按钮个数
40017 	不合法的按钮个数
40018 	不合法的按钮名字长度
40019 	不合法的按钮KEY长度
40020 	不合法的按钮URL长度
40021 	不合法的菜单版本号
40022 	不合法的子菜单级数
40023 	不合法的子菜单按钮个数
40024 	不合法的子菜单按钮类型
40025 	不合法的子菜单按钮名字长度
40026 	不合法的子菜单按钮KEY长度
40027 	不合法的子菜单按钮URL长度
40028 	不合法的自定义菜单使用用户
40029 	不合法的oauth_code
40030 	不合法的refresh_token
40031 	不合法的openid列表
40032 	不合法的openid列表长度
40033 	不合法的请求字符，不能包含\uxxxx格式的字符
40035 	不合法的参数
40038 	不合法的请求格式
40039 	不合法的URL长度
40050 	不合法的分组id
40051 	分组名字不合法
41001 	缺少access_token参数
41002 	缺少appid参数
41003 	缺少refresh_token参数
41004 	缺少secret参数
41005 	缺少多媒体文件数据
41006 	缺少media_id参数
41007 	缺少子菜单数据
41008 	缺少oauth code
41009 	缺少openid
42001 	access_token超时
42002 	refresh_token超时
42003 	oauth_code超时
43001 	需要GET请求
43002 	需要POST请求
43003 	需要HTTPS请求
43004 	需要接收者关注
43005 	需要好友关系
44001 	多媒体文件为空
44002 	POST的数据包为空
44003 	图文消息内容为空
44004 	文本消息内容为空
45001 	多媒体文件大小超过限制
45002 	消息内容超过限制
45003 	标题字段超过限制
45004 	描述字段超过限制
45005 	链接字段超过限制
45006 	图片链接字段超过限制
45007 	语音播放时间超过限制
45008 	图文消息超过限制
45009 	接口调用超过限制
45010 	创建菜单个数超过限制
45015 	回复时间超过限制
45016 	系统分组，不允许修改
45017 	分组名字过长
45018 	分组数量超过上限
46001 	不存在媒体数据
46002 	不存在的菜单版本
46003 	不存在的菜单数据
46004 	不存在的用户
47001 	解析JSON/XML内容错误
48001 	api功能未授权
50001 	用户未授权该api 


define('APPID', "wx79c2bf0249ede62a");  //woso appid
define('APPKEY',"Yat5dfJA2M8v8kZXH9rDk9q7Ae8dqmxRVApfsoiVxUrhvk8DFipBILgDzNFvVPSBJkZctFbqw0LNhfijqE8R8RLZfW04RGk8MkDXQoDES1Ac84LEtjdAt6hzJTNKG7on"); //paysign key
define('SIGNTYPE', "sha1"); //method
define('PARTNERKEY', "wosotech20140526huyajun197310070");
define('APPSERCERT', "c4d53595acf30e9caf09c155b3d95253");	// woso


	public static function my_json_encode($arr) 
	{
		$parts = array ();
		$is_list = false;
		//Find out if the given array is a numerical array
		$keys = array_keys ( $arr );
		$max_length = count ( $arr ) - 1;
		if (($keys [0] === 0) && ($keys [$max_length] === $max_length )) 
		{ 	
			//See if the first key is 0 and last key is length - 1
			$is_list = true;
			for($i = 0; $i < count ( $keys ); $i ++) { //See if each key correspondes to its position
				if ($i != $keys [$i]) { //A key fails at position check.
					$is_list = false; //It is an associative array.
					break;
				}
			}
		}
		foreach ( $arr as $key => $value ) 
		{
			if (is_array ( $value )) { //Custom handling for arrays
				if ($is_list)
					$parts [] = self::json_encode ( $value ); 
				else
					$parts [] = '"' . $key . '":' . self::json_encode ( $value );
			} else {
				$str = '';
				if (! $is_list)
					$str = '"' . $key . '":';
				//Custom handling for multiple data types
				if (is_numeric ( $value ) && $value<2000000000)
					$str .= $value; //Numbers
				elseif ($value === false)
				$str .= 'false'; //The booleans
				elseif ($value === true)
				$str .= 'true';
				else
					$str .= '"' . addslashes ( $value ) . '"'; //All other things
				// :TODO: Is there any more datatype we should be in the lookout for? (Object?)
				$parts [] = $str;
			}
		}
		$json = implode ( ',', $parts );
		if ($is_list)
			return '[' . $json . ']'; //Return numerical JSON
		return '{' . $json . '}'; //Return associative JSON
	}


	function sign($content, $key) {
		    if (null == $key) {
		    }
			if (null == $content) {
		    }
		    $signStr = $content . "&key=" . $key;
		
		    return strtoupper(md5($signStr));
	}
	
	function verifySignature($content, $sign, $md5Key) {
		$signStr = $content . "&key=" . $md5Key;
		$calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
		return $calculateSign == $tenpaySign;
	}

	function genAllUrl($toURL, $paras) {
		$allUrl = null;
		if(null == $toURL){
			die("toURL is null");
		}
		if (strripos($toURL,"?") =="") {
			$allUrl = $toURL . "?" . $paras;
		}else {
			$allUrl = $toURL . "&" . $paras;
		}

		return $allUrl;
	}

	function splitParaStr($src, $token) {
		$resMap = array();
		$items = explode($token,$src);
		foreach ($items as $item){
			$paraAndValue = explode("=",$item);
			if ($paraAndValue != "") {
				$resMap[$paraAndValue[0]] = $parameterValue[1];
			}
		}
		return $resMap;
	}
	
	static function trimString($value){
		$ret = null;
		if (null != $value) {
			$ret = $value;
			if (strlen($ret) == 0) {
				$ret = null;
			}
		}
		return $ret;
	}
	
	function formatQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
			if (null != $v && "null" != $v && "sign" != $k) {
			    if($urlencode){
				   $v = urlencode($v);
				}
				$buff .= $k . "=" . $v . "&";
			}
		}
		$reqPar;
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	function formatBizQueryParaMap($paraMap, $urlencode){
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v){
		//	if (null != $v && "null" != $v && "sign" != $k) {
			    if($urlencode){
				   $v = urlencode($v);
				}
				$buff .= strtolower($k) . "=" . $v . "&";
			//}
		}
		$reqPar;
		if (strlen($buff) > 0) {
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
	function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
        	 if (is_numeric($val))
        	 {
        	 	$xml.="<".$key.">".$val."</".$key.">"; 

        	 }
        	 else
        	 	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>";
        return $xml; 
    }

	function setParameter($parameter, $parameterValue) {
		$this->parameters[self::trimString($parameter)] = self::trimString($parameterValue);
	}
	function getParameter($parameter) {
		return $this->parameters[$parameter];
	}
	
	function create_noncestr( $length = 16 ) {  
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
		$str ="";  
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str;  
	}
	
	function check_cft_parameters(){
		if($this->parameters["bank_type"] == null || $this->parameters["body"] == null || $this->parameters["partner"] == null || 
			$this->parameters["out_trade_no"] == null || $this->parameters["total_fee"] == null || $this->parameters["fee_type"] == null ||
			$this->parameters["notify_url"] == null || $this->parameters["spbill_create_ip"] == null || $this->parameters["input_charset"] == null
			)
		{
			return false;
		}
		return true;

	}
	protected function get_cft_package(){
			//$commonUtil = new CommonUtil();
			$partnerkey = $this->gh['partnerkey'];
			ksort($this->parameters);
			$unSignParaString = $this->formatQueryParaMap($this->parameters, false);
			$paraString = $this->formatQueryParaMap($this->parameters, true);

			//$md5SignUtil = new MD5SignUtil();
//			return $paraString . "&sign=" . $this->sign($unSignParaString,self::trimString(PARTNERKEY));
			\app\models\U::W([$partnerkey, $this->parameters]);
			return $paraString . "&sign=" . $this->sign($unSignParaString,self::trimString($partnerkey));
	}
	
	protected function get_biz_sign($bizObj){
		 foreach ($bizObj as $k => $v){
			 $bizParameters[strtolower($k)] = $v;
		 }
	
		 	$appkey = $this->gh['paysignkey'];	
		 	$bizParameters["appkey"] = $appkey;
		 	ksort($bizParameters);
		 	//var_dump($bizParameters);
		 	//$commonUtil = new CommonUtil();
		 	$bizString = $this->formatBizQueryParaMap($bizParameters, false);
		 	//var_dump($bizString);
			\app\models\U::W($bizParameters);
		 	return sha1($bizString);
	}

	function create_biz_package(){
		  
			if($this->check_cft_parameters() == false) {   
		    }
		 	$appid = $this->gh['appid'];	
		    
		    $nativeObj["appId"] = $appid;		    
		    $nativeObj["package"] = $this->get_cft_package();
		    $nativeObj["timeStamp"] = time();
		    //$nativeObj["timeStamp"] =strval(time());
		    $nativeObj["nonceStr"] = $this->create_noncestr();
		    $nativeObj["paySign"] = $this->get_biz_sign($nativeObj);
		    $nativeObj["signType"] = self::SIGNTYPE;
		    return   json_encode($nativeObj);
	}

	function create_native_url($productid){

			//$commonUtil = new CommonUtil();
		 	$appid = $this->gh['appid'];				
		    $nativeObj["appid"] = $appid;
		    $nativeObj["productid"] = urlencode($productid);
		    $nativeObj["timestamp"] = time();
		    $nativeObj["noncestr"] = $this->create_noncestr();
		    $nativeObj["sign"] = $this->get_biz_sign($nativeObj);
		    $bizString = $this->formatBizQueryParaMap($nativeObj, false);
		    return "weixin://wxpay/bizpayurl?".$bizString;
		    
	}

	function create_native_package($retcode = 0, $reterrmsg = "ok")
	{
		   if($this->check_cft_parameters() == false && $retcode == 0) 
		   {
		    }
		 	$appid = $this->gh['appid'];						    
		    $nativeObj["AppId"] = $appid;
		    $nativeObj["Package"] = $this->get_cft_package();
		    $nativeObj["TimeStamp"] = time();
		    $nativeObj["NonceStr"] = $this->create_noncestr();
		    $nativeObj["RetCode"] = $retcode;
		    $nativeObj["RetErrMsg"] = $reterrmsg;
		    $nativeObj["AppSignature"] = $this->get_biz_sign($nativeObj);
		    $nativeObj["SignMethod"] = self::SIGNTYPE;
		    //$commonUtil = new CommonUtil();

		    return  $this->arrayToXml($nativeObj);
		   
	}
*/


