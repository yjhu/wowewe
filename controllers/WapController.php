<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

use app\models\U;
use app\models\WxException;
use app\models\Wechat;
use app\models\MUser;
use app\models\MGh;
use app\models\MOrder;
use app\models\MItem;

class WapController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	public function init()
	{
		//U::W(['init....', $_GET,$_POST, $GLOBALS]);
		U::W(['init....', $_GET,$_POST]);
	}

	public function beforeAction($action)
	{
		return true;
	}

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{		
		//$item = \app\models\MItem::findOne(['gh_id'=>'gh_03a74ac96138', 'cid' => \app\models\MItem::ITEM_CAT_CARD_WO]);
		//U::W($item);	
		return $this->render('index');
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3
	public function actionOauth2cb()
	{
		if (Yii::$app->wx->localTest)
		{
			$openid = Wechat::OPENID_TESTER1;
			list($route, $gh_id) = explode(':', $_GET['state']);
			Yii::$app->session['gh_id'] = $gh_id;
			Yii::$app->session['openid'] = $openid;			
			$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
			if ($user !== null)
				Yii::$app->user->login($user);
			return $this->redirect([$route]);
		}
	
		if (empty($_GET['code']))
		{
			U::W([__METHOD__, $_GET, 'no code']);
			return;
		}		
		$code = $_GET['code'];
		if ($code == 'authdeny')
		{
			return 'Sorry, we can not do anything for you without your authrization!';
		}

		list($route, $gh_id) = explode(':', $_GET['state']);
		Yii::$app->wx->setGhId($gh_id);
		$token = Yii::$app->wx->WxGetOauth2AccessToken($code);
		if (!isset($token['access_token']))
		{
			U::W([__METHOD__, $token]);
			return null;
		}
		$oauth2AccessToken = $token['access_token'];
		$openid = $token['openid'];

		if (isset($token['scope']) && $token['scope'] == 'snsapi_userinfo')
		{
			$oauth2UserInfo = Yii::$app->wx->WxGetOauth2UserInfo($oauth2AccessToken, $openid);
			U::W($oauth2UserInfo);
			Yii::$app->session->set('oauth2UserInfo', $oauth2UserInfo);
		}

		Yii::$app->session['gh_id'] = $gh_id;
		Yii::$app->session['openid'] = $openid;
		$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($user !== null)
			Yii::$app->user->login($user);
		else
			U::W("not found, $openid");
		return $this->redirect([$route]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/nativepackage
	public function actionNativepackage()
	{		
		//U::W([__METHOD__, $GLOBALS]);	
		if (Yii::$app->wx->localTest)
		{
			$postStr = <<<EOD
			<xml>
			<OpenId><![CDATA[oSHFKsycXkOO3JNwifurCR7Z9-qc]]></OpenId>
			<AppId><![CDATA[wx79c2bf0249ede62a]]></AppId>
			<IsSubscribe>1</IsSubscribe>
			<ProductId><![CDATA[1234]]></ProductId>
			<TimeStamp>1405827894</TimeStamp>
			<NonceStr><![CDATA[rz1yehZmknd4i6CN]]></NonceStr>
			<AppSignature><![CDATA[583934d2393f0d27c0b6aab4230cb16a1d1f291a]]></AppSignature>
			<SignMethod><![CDATA[sha1]]></SignMethod>
			</xml>
EOD;
		}
		else
			$postStr = Yii::$app->wx->getPostStr();
		if (empty($postStr)) 
		{
			U::W(['No postStr', __METHOD__, $GLOBALS]);
			exit;
		}
		$arr = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		//we should check $arr signature first
		if (Yii::$app->wx->debug)
			U::W($arr);
		if (empty($arr['AppId']))
		{
			U::W(['No AppId', __METHOD__, $postStr]);
			exit;
		}
		
		//$arr['ProductId'] = '53d89b592bfec'; 
		Yii::$app->wx->setAppId($arr['AppId']);
		$productId = $arr['ProductId'];
		$openid = $arr['OpenId'];
		$model = MOrder::findOne($productId);
		if ($model === null)
		{
			U::W(['order does not exist!', __METHOD__, $arr]);
			exit;		
		}
		//$detail = "{$model->title}, {$model->attr}";
		//$detail='desc';
		//$title = "{$model->title}";
		Yii::$app->wx->setParameterComm();
/*		
		Yii::$app->wx->setParameter("body", urlencode("item desc"));
		Yii::$app->wx->setParameter("out_trade_no", Wechat::generateOutTradeNo());
		Yii::$app->wx->setParameter("total_fee", "1");
		Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");
*/
		//Yii::$app->wx->setParameter("body", urlencode($desc));		
		$detail = $model->detail;
		Yii::$app->wx->setParameter("body", $detail);
		Yii::$app->wx->setParameter("out_trade_no", $model->oid);
//		Yii::$app->wx->setParameter("total_fee",  "{$model->feesum}");
		Yii::$app->wx->setParameter("total_fee",  "1");
		Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");		
		$xmlStr = Yii::$app->wx->create_native_package();
		if (Yii::$app->wx->debug)
			U::W($xmlStr);
		return $xmlStr;
		
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/paynotify
	public function actionPaynotify()
	{		
		//U::W(['actionPaynotify', $_GET,$_POST]);
		// receive the pay notify from wx server and save the order to db
		// POST data
		if (Yii::$app->wx->localTest)		
		{
			$postStr = <<<EOD
			<xml>
			<OpenId><![CDATA[111222]]></OpenId>
			<AppId><![CDATA[wx79c2bf0249ede62a]]></AppId>
			<IsSubscribe>1</IsSubscribe>
			<TimeStamp>1369743908</TimeStamp>
			<NonceStr><![CDATA[YvMZOX28YQkoU1i4NdOnlXB1]]></NonceStr>
			<AppSignature><![CDATA[a9274e4032a0fec8285f147730d88400392acb9e]]></AppSignature>
			<SignMethod><![CDATA[sha1]]></SignMethod >
			</xml>
EOD;
			/*

		    [0] => Array
		        (
		            [r] => wap/paynotify
		            [bank_billno] => 201408016461876
		            [bank_type] => 3006
		            [discount] => 0
		            [fee_type] => 1
		            [input_charset] => UTF-8
		            [notify_id] => 6qgi2XQy3Lg65VTEMfLiX-6o3Yh7d-e8gIVdcWQmUjCH9enV3oNg-8-aWOjbjk2xYbFmi4c0ec5RzldyH7CqFswIdDmAXv7Z
		            [out_trade_no] => 53db6263258cc
		            [partner] => 1220047701
		            [product_fee] => 1
		            [sign] => 9C83069BE5AFB74E9A353FC6CD190D05
		            [sign_type] => MD5
		            [time_end] => 20140801174831
		            [total_fee] => 1
		            [trade_mode] => 1
		            [trade_state] => 0
		            [transaction_id] => 1220047701201408013245460110
		            [transport_fee] => 0
		        )

			// Note: this OpenId and AppId is money receiver woso, not xiangyang!
		    [1] => Array
		        (
		            [OpenId] => oSHFKsycXkOO3JNwifurCR7Z9-qc
		            [AppId] => wx79c2bf0249ede62a
		            [IsSubscribe] => 0
		            [TimeStamp] => 1406886511
		            [NonceStr] => 2AyW087NTmQxIXuf
		            [AppSignature] => a52c16bb2291995b1441b3255f4e3f2a048e8c3c
		            [SignMethod] => sha1
		        )
			            
			*/
			$_GET['out_trade_no'] = Wechat::generateOutTradeNo();
			$_GET['sign'] = 'sign';
			$_GET['trade_mode'] = 1;
			$_GET['trade_state'] = 0;
			$_GET['partner'] = '1209999999';
			$_GET['bank_type'] = 'WX';
			$_GET['totel_fee'] = 19900;
			$_GET['fee_type'] = 1;
			$_GET['notify_id'] = Wechat::generateOutTradeNo();
			$_GET['transaction_id'] = '1209999999'.date('Ymd').substr(uniqid(), -10);
			$_GET['time_end'] = date("YmdHis");
		}
		else
			$postStr = Yii::$app->wx->getPostStr();
		if (empty($postStr)) 
		{
			U::W(['No postStr from wx server', __METHOD__, $GLOBALS]);
			exit;
		}
		$arr = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		//we should check $arr signature first
		if (Yii::$app->wx->debug)
			U::W([$_GET, $arr]);
		if (empty($arr['AppId']))
		{
			U::W(['No AppId from wx server', __METHOD__, $postStr]);
			exit;
		}		

		// GET data  (!isset($_GET['bank_type'])) ||
		if((!isset($_GET['out_trade_no'])) || (!isset($_GET['sign'])) || (!isset($_GET['trade_mode'])) || 
			(!isset($_GET['trade_state'])) || (!isset($_GET['partner'])) || 
			(!isset($_GET['total_fee'])) || (!isset($_GET['fee_type'])) || (!isset($_GET['notify_id'])) ||
			(!isset($_GET['transaction_id'])) || (!isset($_GET['time_end'])))
		{
			U::W(['Invalid GET data from wx server...', __METHOD__, $_GET, $_POST]);
			exit;
		}				
		//$attach = Yii::$app->request->get('attach', '');		
		$order = MOrder::findOne($_GET["out_trade_no"]);
		if ($order === null)
		{
			U::W(['oid does not exist!', __METHOD__, $_GET, $_POST]);
			return 'success';
		}
		if ($_GET['trade_state'] == 0	)
			$order ->status = MOrder::STATUS_PAYED;
		else
			$order ->status = MOrder::STATUS_PAYED_ERR;

		$order ->notify_id = $_GET['notify_id'];
		$order ->partner = $_GET['partner'];
		$order ->time_end = $_GET['time_end'];
		$order ->total_fee = $_GET['total_fee'];
		$order ->trade_state = $_GET['trade_state'];
		$order ->transaction_id = $_GET['transaction_id'];
		$order ->appid_recv = $arr['AppId'];
		$order ->openid_recv = $arr['OpenId'];		
		$order ->issubscribe_recv = $arr['IsSubscribe'];
		$order->save(false);
		if ($_GET['trade_state'] == 0	)
		{
			Yii::$app->wx->clearGh();		
			Yii::$app->wx->setAppId($arr['AppId']);
			$arr = Yii::$app->wx->WxPayDeliverNotify($arr['OpenId'], $_GET['transaction_id'], $_GET["out_trade_no"]);
			U::W($arr);
			try
			{		
				Yii::$app->wx->clearGh();
				Yii::$app->wx->setGhId($order->gh_id);
				$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$order->openid,'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice(true)]]);					
				U::W($arr);		
			}
			catch (\Exception $e)
			{
				U::W($e->getCode().':'.$e->getMessage());
			}			
		}
		else
		{
			U::W(['trade_state is not 0', __METHOD__, $_GET, $_POST]);		
		}
		return 'success';	
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/warningnotify
	public function actionWarningnotify()
	{		
		// receive the warning notify from wx server, we need handle it ASAP
		if (Yii::$app->wx->localTest)
		{
			$postStr = <<<EOD
			<xml>
			<AppId><![CDATA[wxf8b4f85f3a794e77]]></AppId>
			<ErrorType>100</ErrorType>
			<Description><![CDATA[Description]]></Description>
			<AlarmContent><![CDATA[AlarmContent]]></AlarmContent>
			<TimeStamp>1393860740</TimeStamp>
			<AppSignature><![CDATA[f8164781a303f4d5a944a2dfc68411a8c7e4fbea]]></AppSignature>
			<SignMethod><![CDATA[sha1]]></SignMethod>
			</xml>
EOD;
		}
		else
			$postStr = Yii::$app->wx->getPostStr();
		if (empty($postStr)) 
		{
			U::W(['No postStr', __METHOD__, $GLOBALS]);
			exit;
		}
		$arr = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		if (Yii::$app->wx->debug)
			U::W($arr);
		/*		
		Array
		(			
		    [AppId] => wx79c2bf0249ede62a
		    [TimeStamp] => 1406280115
		    [ErrorType] => 1
		    [Description] => test
		    [AlarmContent] => test
		    [AppSignature] => b44c579c286bf1679b2d1038205f4a75017bf72f
		    [SignMethod] => sha1
		)
		*/
		//\app\models\MWarn::insertOne($arr['AppId'], $arr['ErrorType'], $arr['Description'], $arr['AlarmContent'], $arr['TimeStamp']);
		return 'success';	
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/feedback
	public function actionFeedback()
	{		
		$postStr = Yii::$app->wx->getPostStr();	
		$arr = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		if (Yii::$app->wx->debug)
			U::W($arr);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/mall&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mall:gh_1ad98f5481f3
	public function actionMall()
	{		
		$gh_id = Yii::$app->session['gh_id'];	
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		//U::W($_GET);	
		if (Yii::$app->user->isGuest)
		{
			//return 'please login first';
			$username = 'hehbhehb';
		}
		else
		{
			$openid = Yii::$app->user->identity->id;
			$username = Yii::$app->user->identity->username;		
		}
		//return $openid.$username;
		
		$rawData = array(
			['iid'=>'4198489411','title'=>'K-Touch titl1','price'=>'169900', 'new_price'=>'119900', 'url'=>'http://baidu.com', 'pic_url'=>'53a95055dcf97_b.png', 'seller_cids'=>'100'],
			['iid'=>'4198489412','title'=>'title2','price'=>'20100', 'new_price'=>'18800', 'url'=>'http://baidu.com', 'pic_url'=>'53a957d22b5e8_b.png', 'seller_cids'=>'100'],			
			['iid'=>'4198489413','title'=>'title3','price'=>'30100', 'new_price'=>'28800', 'url'=>'http://baidu.com', 'pic_url'=>'53a9611ab18ab_b.png', 'seller_cids'=>'100'],						
		);		

		$dataProvider = new ArrayDataProvider([
			'allModels' => $rawData,
			'pagination' => [
				'pageSize' => 2,
			],
			'sort' => [
				'attributes' => ['price', 'title'],
			],
			'key'=>'iid',
			
		]);

 		return $this->render('mall', ['dataProvider' => $dataProvider]);
	}    
        
	//http://127.0.0.1/wx/web/index.php?r=wap/prom&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prom:gh_1ad98f5481f3
	//http://www.hoyatech.net/wx/web/index.php?r=wap/prom&gh_id=gh_1ad98f5481f3
	//http://www.hoyatech.net/wx/webtest/wxpay-jsapi-demo.html
	public function actionProm()
	{
		$this->layout = false;		
		$gh_id = $_GET['gh_id'];
		//$gh_id = Yii::$app->session['gh_id'];	
		//$openid = Yii::$app->session['openid'];
		
		Yii::$app->wx->setGhId($gh_id);
		//test native url begin		
		//$productId = 'item1';
		//$url = Yii::$app->wx->create_native_url($productId);	
		//U::W($url);		
		//$tag = Html::a('click here to pay', $url);		
		$item = ['iid'=>'4198489411','title'=>'title1','price'=>'169900', 'new_price'=>'119900', 'url'=>'http://baidu.com', 'pic_url'=>'53a95055dcf97_b.png', 'seller_cids'=>'100'];
 		return $this->render('prom', ['item' => $item]);
	}	

	//http://127.0.0.1/wx/web/index.php?r=wap/aboutqr&name=jack&qrurl=http://wosotech.com/wx/runtime/qr/gh_03a74ac96138_1.jpg
	public function actionAboutqr()
	{
		$name = $_GET['name'];
		$qrurl = $_GET['qrurl'];
		$this->layout = 'wap';
 		return $this->render('aboutqr', ['name' => $name, 'qrurl'=>$qrurl]);
	}
	
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_03a74ac96138	
	public function actionLuck()
	{
		$this->layout = 'wap';
		$gh_id = Yii::$app->session['gh_id'];	
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model === null)
		{
			$model = new MUser;		
			$subscribed = false;			
		}
		else if ($model->subscribe)
			$subscribed = true;
		else
			$subscribed = false;

		if (!Yii::$app->user->isGuest)
			$username = Yii::$app->user->identity->username;
		else
			$username = '';
		
		$result = '';
		$lucy_msg = [];
		if ($model->load(Yii::$app->request->post())) 
		{
			if (Yii::$app->user->isGuest)
				$username = $model->mobile;
		
			$loca = file_get_contents("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$model->mobile."&output=json&callback=querycallback");
			$loca = substr($loca, 14, -2);  
			$loca = json_decode($loca, true);	
			//$lucy_msg = file_get_contents("http://jixiong.showji.com/api.aspx?m=".$model->mobile."&output=json&callback=querycallback");
			//$lucy_msg = substr($lucy_msg, 14, -2);  
			//$lucy_msg = json_decode($lucy_msg, true);	
			$lucy_msg = U::getMobileLuck($model->mobile);
			$lucy_msg['Mobile'] = $model->mobile;

			$result = $this->renderPartial('luck_result', ['loca'=>$loca, 'lucy_msg'=>$lucy_msg]);
			
			//if ($subscribed)
			if (0)
			{
				$msg = [
					'touser'=>$openid, 
					'msgtype'=>'news', 
					'news'=> [
						'articles'=>[
							['title'=>"靓号运程", 'description'=>"{$username}: {$lucy_msg['JXDetail']},{$lucy_msg['GX']},{$lucy_msg['GXDetail']}", 'url'=>'http://mp.weixin.qq.com/s?__biz=MzAwODAwMDMyOA==&mid=200371259&idx=1&sn=a9bb6f76733b66122f4fff0a3e50c6f0#rd', 'picurl'=>'http://hoyatech.net/wx/web/images/earth.jpg'],
						]				
					]
				];
			
				try
				{
					$arr = Yii::$app->wx->WxMessageCustomSend($msg);
					U::W($arr);		
				}
				catch (\Exception $e)
				{
					U::W($e->getCode().':'.$e->getMessage());
				}
			}
			
		}		
 		return $this->render('luck', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
	}	

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_1ad98f5481f3
	public function actionG2048()
	{
		$this->layout = 'wap';
		$gh_id = Yii::$app->session['gh_id'];	
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model === null)
		{
			$model = new MUser;		
			$subscribed = false;			
		}
		else if ($model->subscribe)
			$subscribed = true;
		else
			$subscribed = false;

		if (!Yii::$app->user->isGuest)
			$username = Yii::$app->user->identity->username;
		else
			$username = '';
		
		$result = '';
/*		
		$lucy_msg = [];
		if ($model->load(Yii::$app->request->post())) 
		{
			if (Yii::$app->user->isGuest)
				$username = $model->mobile;
		
			$loca = file_get_contents("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=".$model->mobile."&output=json&callback=querycallback");
			$loca = substr($loca, 14, -2);  
			$loca = json_decode($loca, true);	
			//$lucy_msg = file_get_contents("http://jixiong.showji.com/api.aspx?m=".$model->mobile."&output=json&callback=querycallback");
			//$lucy_msg = substr($lucy_msg, 14, -2);  
			//$lucy_msg = json_decode($lucy_msg, true);	
			$lucy_msg = U::getMobileLuck($model->mobile);
			$lucy_msg['Mobile'] = $model->mobile;

			$result = $this->renderPartial('luck_result', ['loca'=>$loca, 'lucy_msg'=>$lucy_msg]);
		}		
*/		
 		return $this->render('games/2048/index', ['model' => $model, 'result'=>$result, 'subscribed'=>$subscribed, 'username'=>$username]);
	}	
               
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/gsave:gh_1ad98f5481f3
	public function actionG2048save()
	{            
		$msg = 0;
		$this->layout = false;
		$gh_id = Yii::$app->session['gh_id'];
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if (!Yii::$app->user->isGuest)
			$username = Yii::$app->user->identity->username.',';
		else
			$username = '';
		
		$model = new \app\models\MG2048;
		$model->gh_id = $gh_id;
		$model->openid = $openid;
		$model->best = $_GET['best'];
		$model->score = $_GET['score'];
		$model->big_num = $_GET['bigNum'];
		
		$model1 = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model1 === null)
		{
			$model1 = new MUser;		
			$subscribed = false;			
		}
		else if ($model1->subscribe)
			$subscribed = true;
		else
			$subscribed = false;
		
		/*
		$url = "http://baidu.com";
		$tag = Html::a('来挑战', $url);
		*/
		
		/*
		if ($user !== null)
		{
			try
			{
				//$msg = ['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>"我的2048游戏最后得分3600分，简直碉堡了！ 已击败90%的人，小伙伴们{$tag}我吧!"]];
				$msg = [
					'touser'=>$openid, 
					'msgtype'=>'news', 
					'news'=> [
						'articles'=>[
							['title'=>"游戏2048", 'description'=>"我的2048游戏最后得分3600分，简直碉堡了！ 已击败90%的人，小伙伴们来挑战我吧!", 'url'=>Yii::$app->wx->WxGetOauth2Url('snsapi_base', "wap/g2048:{$gh_id}"), 'picurl'=>''],
						]				
					]
				];				
					
				$arr = Yii::$app->wx->WxMessageCustomSend($msg);
				U::W($arr);		
			}
			catch (\Exception $e)
			{
				U::W($e->getCode().':'.$e->getMessage());
			}
		}
		*/
//		$sql = "SELECT * FROM `wx_g2048` ORDER BY `score` ASC ";

		if($subscribed)
		{
			if ($model->save(false)) {
				//return $this->redirect(['index']);
			}
			else
			{
				U::W($model->getErrors());
			}		
			
			$sql = "SELECT COUNT(*) FROM wx_g2048 WHERE score >= :score";
			$command = yii::$app->db->createCommand($sql);
			$command->bindValue(':score', $_GET['score']);
			$rowCount = $command->queryScalar();

			$msg = $rowCount; //ranking of score
		}
		
		//return 'ok';
		return $msg;
	}	
    
    
	//http://127.0.0.1/wx/web/index.php?r=wap/diy&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/diy:gh_1ad98f5481f3
	//http://114.215.178.32/wx/web/index.php?r=wap/diy&gh_id=gh_1ad98f5481f3
	public function actionDiy()
	{
		$this->layout = false;		
		Yii::$app->wx->setGhId();		
 		return $this->render('diy');
	}	
 
	public function actionAccount($openid, $gh_id, $reason)
	{
		//$openid = $_GET['openid'];
		//$gh_id = $_GET['gh_id'];
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);		
		if ($model === null) {
			U::W([ 'model does not exists', __METHOD__, $_GET]);
			throw new \yii\web\HttpException(500, "This identity does not exist, openid={$openid}");
		}

		if (\Yii::$app->request->isPost) 
		{
			$model->load(\Yii::$app->request->post());
			//U::W($model->getAttributes());
			if ($model->save(true, ['mobile'])) 
			{
				if($reason=="FuncQueryAccount")
				{
					return $this->redirect(['wap/billdetail', 'mobile' => $model->mobile]);
				}
			}
			else
				U::W($model->getErrors());
		}       
		return $this->render('account',['model' => $model]);
	}
                
	public function actionBilldetail($mobile)
	{
		return $this->render('billDetail', ['mobile'=>$mobile]);
	}
        
	
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/suggest:gh_1ad98f5481f3
	public function actionSuggest()
	{
		$this->layout = 'wap';
		$gh_id = Yii::$app->session['gh_id'];	
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		
		$ar = new \app\models\MSuggest;
		$ar->gh_id = $gh_id;
		$ar->openid = $openid;
		//$model1->title = $_GET['title'];
		//$model1->mobile = $_GET['mobile'];
		//$model1->detail = $_GET['detail'];			
		
		if ($model === null)
		{
			$model = new MUser;		
			$subscribed = false;			
		}
		else if ($model->subscribe)
			$subscribed = true;
		else
			$subscribed = false;

		if (!Yii::$app->user->isGuest)
			$username = Yii::$app->user->identity->username;
		else
			$username = '';
		
		if ($ar->load(Yii::$app->request->post())) 
		{
			//if (Yii::$app->user->isGuest)
			//	$username = $model->mobile;
			//U::W($ar->getAttributes());
			//$result = $this->renderPartial('luck_result', ['loca'=>$loca, 'lucy_msg'=>$lucy_msg]);			
			if ($ar->save(true)) {
				//return $this->redirect(['index']);
				//U::W(['kkkkkkkkkkkkkkkkkkkk']);
				//$result = $this->renderPartial('result', ['msg'=>$msg]);
			}
			else
			{
				U::W($ar->getErrors());
			}	
			
			Yii::$app->session->setFlash('submit_ok');
			return $this->refresh();

		}		
 		//return $this->render('product', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
		//return $this->render('suggest', ['model' => $model1, 'subscribed'=>$subscribed, 'username'=>$username]);
		return $this->render('suggest',['ar' => $ar]);
	}	
	
	
	
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/product:gh_1ad98f5481f3
	public function actionProduct()
	{
		$this->layout =false;
		return $this->render('product');

	}

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prodsave:gh_1ad98f5481f3
	public function actionProdsave()
	{			
		//U::W([$_GET, $_POST, $_SERVER]);
		$this->layout = 'wap';
		$gh_id = Yii::$app->session['gh_id'];
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);		
		if (0)
		{
			$cardType = 1;
			$flowPack =2;
			$voicePack = 1;
			$msgPack = 1;
			$callshowPack = 1;
			$feeSum =  7;	
			$selectNum = '15527766232';
		}
		else
		{
			$cardType = $_GET["cardType"];
			$flowPack =$_GET["flowPack"];
			$voicePack = $_GET["voicePack"];
			$msgPack = $_GET["msgPack"];
			$callshowPack = $_GET["callshowPack"];
			$feeSum =  $_GET["feeSum"];
			$selectNum = $_GET["selectNum"];
		}
		$feeSum = $feeSum * 100;
		$order = new MOrder;
		$order->oid = MOrder::generateOid();
		$order->gh_id = $gh_id;
		$order->openid = $openid;
		$order->feesum = $feeSum;
		$order->title = '自由组合套餐';
		$order->cid = MItem::ITEM_CAT_DIY;
		$order->attr = "$cardType,$flowPack,$voicePack,$msgPack,$callshowPack,$selectNum";
		$order->detail = $order->getDetail();
		$order->save(false);

		if (Wechat::isAndroid())
		{			
			try
			{
				$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice()]]);					
				U::W($arr);		
			}
			catch (\Exception $e)
			{
				U::W($e->getCode().':'.$e->getMessage());
			}
		}
		
		Yii::$app->wx->clearGh();
		Yii::$app->wx->setGhId(MGh::GH_WOSO);
		$url = Yii::$app->wx->create_native_url($order->oid);
		Yii::$app->wx->clearGh();
		Yii::$app->wx->setGhId($gh_id);		
		
		//U::W(json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]));
		return json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]);
	}

    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=mobileNum&currentPage=1
	public function actionAjaxdata($cat)
	{
		U::W($_GET);
		if (!Yii::$app->request->isAjax)
			return;
		$this->layout = false;		
		$page = isset($_GET["currentPage"]) ? $_GET["currentPage"] : 0;
		$size = isset($_GET["size"]) ? $_GET["size"] : 50;
		switch ($cat) 
		{
			case 'mobileNum':
				$data = [
					['num'=>'18696205015', 'ychf'=>100, 'zdxf'=>0],
					['num'=>'18696205016', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205017', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205018', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205019', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205020', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205021', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205022', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205023', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205024', 'ychf'=>0, 'zdxf'=>0],					
					['num'=>'18696205025', 'ychf'=>0, 'zdxf'=>0],					
					['num'=>'18696205026', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205027', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205028', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205029', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205030', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205031', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205032', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205033', 'ychf'=>0, 'zdxf'=>0],
					['num'=>'18696205034', 'ychf'=>600, 'zdxf'=>0],					
				];
				break;
			default:
				U::W(['invalid data cat', $cat, __METHOD__,$_GET]);
				return;
		}		
		return json_encode($data);
	}

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/card:gh_1ad98f5481f3
    public function actionCard()
    {

        $this->layout =false;
        return $this->render('card');
    }



}




/*
Oauth2AccessToken Array
(
    [access_token] => OezXcEiiBSKSxW0eoylIeDkMu7p6jFFOBgWifxvPgGwusvBLu_kuBRqVorsls1teafLUOnksy1z5JFMFSGGZKcWZCTbL1dj9xiNivhs7NhyM2xuvXweMFe-qAhUEIpgOSiiIfUqEFlTdotgdyfXUaQ
    [expires_in] => 7200
    [refresh_token] => OezXcEiiBSKSxW0eoylIeDkMu7p6jFFOBgWifxvPgGwusvBLu_kuBRqVorsls1tesACPogIR7RzQhqMDiWYDqzfvvhNCFaz66UKJ279BrYikBPZc5KaTFvbFesDIohMkMwxDhngrcus9L4U-Fb74Kg
    [openid] => o6biBt5yaB7d3i0YTSkgFSAHmpdo
    [scope] => snsapi_userinfo
)

$oauth2UserInfo
2014-06-17 12:21:03,Array
(
    [subscribe] => 1
    [openid] => oySODt2YXO_JMcFWpFO5wyuEYX-0
    [nickname] =>1111
    [sex] => 1
    [language] => zh_CN
    [city] =>111
    [province] =>11
    [country] =>11
    [headimgurl] => http://wx.qlogo.cn/mmopen/KBRNPfvbbrVbucASwD74Dric6NSCnVDycQNgicHwpYdFT74jhT7T6t6jT62zcOTtmumN7ia8QRtbRmvFRuzXPrBGqTQ22XuFk4w/0
    [subscribe_time] => 1402976898
)

include_once("WxPayHelper.php");		
$commonUtil = new \CommonUtil();
$wxPayHelper = new \WxPayHelper();
$wxPayHelper->setParameter("bank_type", "WX");
$wxPayHelper->setParameter("body", urlencode("test a"));
$wxPayHelper->setParameter("partner", "1220047701");
$wxPayHelper->setParameter("out_trade_no", $commonUtil->create_noncestr());
$wxPayHelper->setParameter("total_fee", "1");
$wxPayHelper->setParameter("fee_type", "1");
$wxPayHelper->setParameter("notify_url", "http://www.hoyatech.net/wx/web/index.php?r=wap/paynotify");
$wxPayHelper->setParameter("spbill_create_ip", "127.0.0.1");
$wxPayHelper->setParameter("input_charset", "UTF-8");
$xmlStr = $wxPayHelper->create_native_package();
U::W($xmlStr);
return $xmlStr;

	        return Yii::$app->view->render('/wap/mall', [
	                'dataProvider' => $dataProvider,
//	                'searchModel' => $searchModel
	        ]);
		return $this->redirect(['index']);


		//$bank_billno = $_GET['bank_billno'];		
		
		$xmlStr = file_get_contents("php://input");
		U::W($xmlStr);
		U::W([$_GET, $_POST, $GLOBALS]);
		
		//$xmlStr = $GLOBALS['HTTP_RAW_POST_DATA'];
		$xmlStr = file_get_contents("php://input");
		$obj = simplexml_load_string($xmlStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		$arr = json_decode(json_encode($obj), true);			
		U::W($arr);
		U::W($arr['OpenId']);	//AppId, IsSubscribe
				
		
		$xmlStr = $GLOBALS['HTTP_RAW_POST_DATA'];
		// handle input and return xml response		
		include_once("WxPayHelper.php");
		$commonUtil = new CommonUtil();
		$wxPayHelper = new WxPayHelper();
		$wxPayHelper->setParameter("bank_type", "WX");
		$wxPayHelper->setParameter("body", "test");
		$wxPayHelper->setParameter("partner", "1900000109");
		$wxPayHelper->setParameter("out_trade_no", $commonUtil->create_noncestr());
		$wxPayHelper->setParameter("total_fee", "1");
		$wxPayHelper->setParameter("fee_type", "1");
		$wxPayHelper->setParameter("notify_url", "htttp://www.baidu.com");
		$wxPayHelper->setParameter("spbill_create_ip", "127.0.0.1");
		$wxPayHelper->setParameter("input_charset", "UTF-8");
		echo $wxPayHelper->create_native_package();

	        $searchModel = new Mail();
	        $dataProvider = $searchModel->search(Yii::$app->request->get(), $this->data);

	        return Yii::$app->view->render('panels/mail/detail', [
	                'panel' => $this,
	                'dataProvider' => $dataProvider,
	                'searchModel' => $searchModel
	        ]);

		$rawData = array(
			['iid'=>'4198489411','title'=>'item1 title','price'=>'12300', 'new_price'=>'12300', 'url'=>'http://baidu.com', 'pic_url'=>'53a95055dcf97_b.png', 'seller_cids'=>'100'],
			['iid'=>'4198489412','title'=>'item2 title','price'=>'25300', 'new_price'=>'20000', 'url'=>'http://baidu.com', 'pic_url'=>'53a957d22b5e8_b.png', 'seller_cids'=>'100'],			
			['iid'=>'4198489413','title'=>'item3 title','price'=>'35300', 'new_price'=>'30000', 'url'=>'http://baidu.com', 'pic_url'=>'53a9611ab18ab_b.png', 'seller_cids'=>'100'],						
		);		

			$openid = Yii::$app->user->identity->openid;
		
*/

