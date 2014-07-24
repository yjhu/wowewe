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
		U::W([__METHOD__, $GLOBALS]);
		include_once("WxPayHelper.php");		
		$commonUtil = new \CommonUtil();
		$wxPayHelper = new \WxPayHelper();
		$wxPayHelper->setParameter("bank_type", "WX");
		$wxPayHelper->setParameter("body", "test");
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
		Yii::$app->wx->setAppId($arr['AppId']);
		$productId = $arr['ProductId'];
		$openid = $arr['OpenId'];		

		// handle input and return xml response
		// get row from db by productId, then setParameter 
		Yii::$app->wx->setParameterComm();
		Yii::$app->wx->setParameter("body", "item desc");
		Yii::$app->wx->setParameter("out_trade_no", Wechat::generateOutTradeNo());
		Yii::$app->wx->setParameter("total_fee", "19900");
		Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");
		$xmlStr = Yii::$app->wx->create_native_package();
		if (Yii::$app->wx->debug)
			U::W($xmlStr);
		return $xmlStr;
		
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/paynotify
	public function actionPaynotify()
	{		
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
		Yii::$app->wx->setAppId($arr['AppId']);
		$openid = $arr['OpenId'];		
		
		// GET data
		if(!isset($_GET['out_trade_no']) || !isset($_GET['sign']) || !isset($_GET['trade_mode']) || 
			!isset($_GET['trade_state']) || !isset($_GET['partner']) || !isset($_GET['bank_type']) ||
			!isset($_GET['totel_fee']) || !isset($_GET['fee_type']) || !isset($_GET['notify_id']) ||
			!isset($_GET['transaction_id']) || !isset($_GET['time_end']))
		{
			U::W(['Invalid GET data from wx server', __METHOD__, $_GET]);
			exit;
		}				
		$out_trade_no = $_GET["out_trade_no"];		
		$trade_state = $_GET['trade_state'];
		$transaction_id = $_GET['transaction_id'];		
		$attach = Yii::$app->request->get('attach', '');		

		//save to db
		//do some things at once?, for example, https://api.weixin.qq.com/pay/delivernotify...
		//Yii::$app->wx->WxPayDeliverNotify($openid, $transaction_id, $out_trade_no);
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
		\app\models\MWarn::insertOne($arr['AppId'], $arr['ErrorType'], $arr['Description'], $arr['AlarmContent'], $arr['TimeStamp']);
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
		$gh_id = Yii::$app->session['gh_id'];	
		$openid = Yii::$app->session['openid'];
		Yii::$app->wx->setGhId($gh_id);
		//test native url begin		
		//$productId = 'item1';
		//$url = Yii::$app->wx->create_native_url($productId);	
		//U::W($url);		
		//$tag = Html::a('click here to pay', $url);		
		$item = ['iid'=>'4198489411','title'=>'title1','price'=>'169900', 'new_price'=>'119900', 'url'=>'http://baidu.com', 'pic_url'=>'53a95055dcf97_b.png', 'seller_cids'=>'100'];
 		return $this->render('prom', ['item' => $item]);
	}	

	public function actionLuck1()
	{
		$this->layout = 'wap';
		$gh_id = MGh::GH_XIANGYANGUNICOM;	
		Yii::$app->wx->setGhId($gh_id);		
		$model = new MUser;		
		$subscribed = false;			
		$username = '';		
		$result = '';
		$lucy_msg = [];
		if ($model->load(Yii::$app->request->post())) 
		{
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
 		return $this->render('luck', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
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

