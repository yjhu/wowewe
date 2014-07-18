<?php
/*
	http://hoyatech.net/wx/web/index.php	
	http://hoyatech.net/wx/web/index.php?r=msg

	http://127.0.0.1/wx/web/index.php?r=msg
	
*/
namespace app\controllers;

use Yii;
use app\models\U;
use app\models\WX;
use app\models\MUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use app\models\ReqBase;
use app\models\ReqText;
use app\models\ReqVoice;
use app\models\ReqVideo;
use app\models\ReqLocation;
use app\models\ReqLink;
use app\models\ReqImage;
use app\models\ReqEventSubscribe;
use app\models\ReqEventQrcode;
use app\models\ReqEventMenu;
use app\models\ReqEventLocation;

use app\models\RespBase;
use app\models\RespText;
use app\models\RespNews;
use app\models\RespNewsItem;
use app\models\RespImage;
use app\models\RespImageItem;
use app\models\RespVoice;
use app\models\RespVoiceItem;
use app\models\RespVideo;
use app\models\RespVideoItem;
use app\models\RespMusic;
use app\models\RespMusicItem;

class MsgController extends Controller
{
	public $enableCsrfValidation = false;
	public $localTest = false;
//	public $localTest = true;	
	
	public function actionIndex()
	{
		try
		{	
			//U::W([$_GET]);
			if ($this->localTest)
			{
				$_GET['signature'] = '228c2744ce651fb61cceb461c48fa03c608c1299';
				$_GET['echostr'] = '6372428126615300095';
				$_GET['timestamp'] = '1402529705';
				$_GET['nonce'] = '1023195716';
				
				//$req = Yii::createObject(['class' => 'app\models\ReqText','ToUserName'=>'to3toto', 'FromUserName'=>'from beijin', 'CreateTime'=>time(), 'MsgType'=>'text', 'MsgId'=>'1000', 'Content' => 'hello']);		
				$req = Yii::createObject(['class' => 'app\models\ReqImage','ToUserName'=>'to3toto', 'FromUserName'=>'from beijin', 'CreateTime'=>time(), 'MsgType'=>'image', 'MsgId'=>'1000', 'PicUrl' => 'http://images.com/1', 'MediaId'=>'m_0001']);		
				$reqStr = $req->toXmlString();		

				$res = WX::checkSignature();
				//if ($res) return $_GET['echostr'];				
			}
			else
			{
				$res = WX::checkSignature();
				//if ($res) return $_GET['echostr'];
			
				if (!isset($GLOBALS['HTTP_RAW_POST_DATA']))
				{
					throw new \Exception(U::toString(['No message data!', __FUNCTION__, $GLOBALS]));	
				}

				//$reqStr = $GLOBALS['HTTP_RAW_POST_DATA'];
				$reqStr = WX::getPostXmlStr();
			}
			
			$obj = simplexml_load_string($reqStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$obj = json_decode(json_encode($obj));			
			switch ($obj->MsgType)
			{   
				case ReqBase::REQ_MSG_TYPE_TEXT:	
					$req = \Yii::createObject(['class' => 'app\models\ReqText']);		
					$req->populate($obj);
					//$resp = $this->createRespText($req, "You sent a TEXT:{$req->Content}");
					//$resp = $this->createRespText($req, "You sent a TEXT:{$req->Content} ".WX::getOauth2Url());
					$resp = $this->createRespNewsDemo($req, 1);
					break;			

				case ReqBase::REQ_MSG_TYPE_IMAGE:	
					$req = \Yii::createObject(['class' => 'app\models\ReqImage']);	
					$req->populate($obj);
					$resp = $this->createRespText($req, 'You sent a IMAGE');
					break;			

				case ReqBase::REQ_MSG_TYPE_VOICE:	
					$req = \Yii::createObject(['class' => 'app\models\ReqVoice']);		
					$req->populate($obj);
					$resp = $this->createRespText($req, 'You sent a VOICE');
					break;	
					
				case ReqBase::REQ_MSG_TYPE_VIDEO:	
					$req = \Yii::createObject(['class' => 'app\models\ReqVideo']);		
					$req->populate($obj);
					$resp = $this->createRespText($req, 'You sent a VIDEO');
					break;			
					
				case ReqBase::REQ_MSG_TYPE_LOCATION:	
					$req = \Yii::createObject(['class' => 'app\models\ReqLocation']);		
					$req->populate($obj);
					$resp = $this->createRespText($req, 'You sent a LOCATION');
					break;		
					
				case ReqBase::REQ_MSG_TYPE_LINK:	
					$req = \Yii::createObject(['class' => 'app\models\ReqLink']);		
					$req->populate($obj);
					$resp = $this->createRespText($req, 'You sent a LINK');
					break;			

				case ReqBase::REQ_MSG_TYPE_EVENT:
					switch ($obj->Event)
					{   
						case ReqBase::EVENT_SUBSCRIBE:		
							if (isset($req->EventKey))
							{
								//new user subscribe qr
								$req = \Yii::createObject(['class' => 'app\models\ReqEventQrcode']);
								$req->populate($obj);
								$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey} {$req->Ticket}");
							}
							else
							{
								$req = \Yii::createObject(['class' => 'app\models\ReqEventSubscribe']);
								$req->populate($obj);
								$resp = $this->createRespText($req, "You {$req->Event}");

								// save (insert or update) userInfo arr to db
								$access_token = WX::getAccessTokenById($req->ToUserName);
								$arr = WX::WxGetUserInfo($access_token, $req->FromUserName);	
								$model = MUser::findOne($req->FromUserName);
								if (!$model)
									$model = new MUser;
								if (empty($arr['errcode']))
									$model->setAttributes($arr, false);
								else
									U::W(['WxGetUserInfo', $arr]);	
								$model->openid = $req->FromUserName;										
								if (!$model->save(false))
									U::W([__FUNCTION__, $model->getErrors()]);			
								//end
							}
							break;		
							
						case ReqBase::EVENT_UNSUBSCRIBE:
							$req = \Yii::createObject(['class' => 'app\models\ReqEventSubscribe']);
							$req->populate($obj);
							U::W($req);
							if (($model = MUser::findOne($req->FromUserName)) !== null) 
								$model->delete();							
							return WX::NO_RESP;
							
						case ReqBase::EVENT_CLICK:		
							$req = \Yii::createObject(['class' => 'app\models\ReqEventMenu']);
							$req->populate($obj);
							//$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey}");		
							//$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey}, https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx520c15f417810387&redirect_uri=http%3A%2F%2Fchong.qq.com%2Fphp%2Findex.php%3Fd%3D%26c%3DwxAdapter%26m%3DmobileDeal%26showwxpaytitle%3D1%26vb2ctag%3D4_2030_5_1194_60&response_type=code&scope=snsapi_base&state=123#wechat_redirect");																
							//$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey}, https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf0e81c3bee622d60&redirect_uri=http%3A%2F%2Fnba.bluewebgame.com%2Foauth_response.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");																														
							$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey}, ".WX::getOauth2Url());																																					
							break;				
						
						case ReqBase::EVENT_VIEW:
							$req = \Yii::createObject(['class' => 'app\models\ReqEventMenu']);
							$req->populate($obj);
							$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey}");						
							break;				
							
						case ReqBase::EVENT_SCAN:
							//old user subscribe
							$req = \Yii::createObject(['class' => 'app\models\ReqEventQrcode']);
							$req->populate($obj);
							$resp = $this->createRespText($req, "You {$req->Event} {$req->EventKey} {$req->Ticket}");																			
							break;				
							
						case ReqBase::EVENT_LOCATION:
							$req = \Yii::createObject(['class' => 'app\models\ReqEventLocation']);
							$req->populate($obj);
							$resp = $this->createRespText($req, 'EVENT_LOCATION');						
							break;	
							
						default:
							throw new \Exception(U::toString(['Invalid Event', __FUNCTION__, $obj]));
							break;						
					}
					break;	

				default:
					throw new \Exception(U::toString(['Invalid MsgType', __FUNCTION__, $obj]));
					break;
					
			}

			//U::W($reqStr);
			U::W($req);	
			U::W($resp);		
			$str = $resp->toXmlString();
			//U::W($str);
			return $str;
		}
		catch(\Exception $e)
		{
			U::W($e->getMessage());
			return WX::NO_RESP;
		}							
	}

	public function createRespText($req, $content)
	{
		$resp = \Yii::createObject([
			'class' => 'app\models\RespText', 
			'ToUserName' => $req->FromUserName, 
			'FromUserName'=> $req->ToUserName,
			'CreateTime'=>time(),
			'MsgType'=>RespBase::RESP_MSG_TYPE_TEXT,								
		]);
		$resp->Content = $content;
		return $resp;	
	}

	public function createRespNewsDemo($req, $count=1)
	{
		$resp = \Yii::createObject([
			'class' => 'app\models\RespNews', 
			'ToUserName' => $req->FromUserName, 
			'FromUserName'=> $req->ToUserName,
			'CreateTime'=>time(),
			'MsgType'=>RespBase::RESP_MSG_TYPE_NEWS,								
		]);

		for ($i=0;$i<$count;$i++)
		{
			$resp->Articles[] = \Yii::createObject([
				'class' => 'app\models\RespNewsItem', 
				'Title' => "Welcome to Woso-{$i}", 
				'Description'=> "Woso technology company is a leading global provider of mobile Internet services, offering some WeiXin services for the end user of China UnionComm to address the fundamental and rapidly growing needs. Description-{$i}",
				'PicUrl'=>"http://hoyatech.net/wx/web/images/earth.jpg",
//				'Url'=>"http://hoyatech.net/wx/web/index.php",	
				'Url'=>WX::getOauth2Url(),					
			]);
		}

		$resp->ArticleCount = min(count($resp->Articles), RespNews::MAX_ARTICLE_COUNT);
		return $resp;	
	}

	public function createRespImageDemo($req)
	{
		$resp = \Yii::createObject([
			'class' => 'app\models\RespImage', 
			'ToUserName' => $req->FromUserName, 
			'FromUserName'=> $req->ToUserName,
			'CreateTime'=>time(),
			'MsgType'=>RespBase::RESP_MSG_TYPE_IMAGE,								
		]);
		$resp->Image = \Yii::createObject([
			'class' => 'app\models\RespImageItem', 
			'MediaId' => "a123", 
		]);
		return $resp;	
	}
	
}

/*

//$resp = $this->createRespText($req, 'You sent a TEXT:'.$req->Content);
$resp = $this->createRespNewsDemo($req, 2);
//$resp = $this->createRespImageDemo($req);
U::W($resp);
$str = $resp->toXmlString();
U::W($str);
return;


<xml>
<ToUserName><![CDATA[gh_78539d18fdcc]]></ToUserName>
<FromUserName><![CDATA[o6biBt5yaB7d3i0YTSkgFSAHmpdo]]></FromUserName>
<CreateTime>123456789</CreateTime>
<MsgType><![CDATA[event]]></MsgType>
<Event><![CDATA[subscribe]]></Event>
</xml>

<xml>
<ToUserName><![CDATA[gh_78539d18fdcc]]></ToUserName>
<FromUserName><![CDATA[o6biBt5yaB7d3i0YTSkgFSAHmpdo]]></FromUserName>
<CreateTime>1402545118</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[hello]]></Content>
<MsgId>6023885413174756692</MsgId>
</xml>

*/
