<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Html;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\U;
use app\models\WxException;
use app\models\Wechat;
use app\models\MUser;
use app\models\MStaff;
use app\models\MGh;
use app\models\MOrder;
use app\models\MItem;
use app\models\MMobnum;
use app\models\MDisk;
use app\models\MG2048;


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
		//U::W(['init....', $_GET,$_POST]);
	}

	public function beforeAction($action)
	{
		return true;
	}


	public function afterAction($action, $result)
	{
		U::W("{$this->id}/{$this->action->id}:".Yii::getLogger()->getElapsedTime());
		return parent::afterAction($action, $result);
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
			//if ($user !== null)
			//	Yii::$app->user->login($user);
			//return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
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
		//$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		//if ($user !== null)
		//	Yii::$app->user->login($user);
		//else
		//	U::W("not found, $openid");
		//return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
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
		Yii::$app->wx->setParameterComm();
/*		
		Yii::$app->wx->setParameter("body", 'itemdesc');
		Yii::$app->wx->setParameter("out_trade_no", Wechat::generateOutTradeNo());
		Yii::$app->wx->setParameter("total_fee", "1");
		Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");
*/
		$detail = $model->detail;
		Yii::$app->wx->setParameter("body", $detail);
		Yii::$app->wx->setParameter("out_trade_no", $model->oid);
		//Yii::$app->wx->setParameter("total_fee",  "{$model->feesum}");
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

	//http://127.0.0.1/wx/web/index.php?r=wap/prom&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prom:gh_1ad98f5481f3
	//http://wosotech.com/wx/web/index.php?r=wap/prom&gh_id=gh_1ad98f5481f3
	//http://wosotech.com/wx/webtest/wxpay-jsapi-demo.html
	public function actionProm()
	{
		$this->layout = false;		
		//$gh_id = $_GET['gh_id'];
		//$gh_id = Yii::$app->session['gh_id'];	
		//$openid = Yii::$app->session['openid'];
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		
		Yii::$app->wx->setGhId($gh_id);
		//test native url begin		
		//$productId = 'item1';
		//$url = Yii::$app->wx->create_native_url($productId);	
		//U::W($url);		
		//$tag = Html::a('click here to pay', $url);		
		$item = ['iid'=>'4198489411','title'=>'title1','price'=>'169900', 'new_price'=>'119900', 'url'=>'http://baidu.com', 'pic_url'=>'53a95055dcf97_b.png', 'seller_cids'=>'100'];
 		return $this->render('prom', ['item' => $item]);
	}	

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_03a74ac96138	
	public function actionLuck()
	{
		$this->layout = 'wap';
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
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
			
			
		}		
 		return $this->render('luck', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
	}	

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_03a74ac96138
	public function actionG2048()
	{
		//$this->layout = 'wap';
		$this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');

		//$a = \app\models\MG2048::getScoreTop($gh_id);
		
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
/*
		if (!Yii::$app->user->isGuest)
			$username = Yii::$app->user->identity->username;
		else
			$username = '';
*/
		if ($model === null)
			$username = '';
		else
			$username = $model->nickname;
		$result = '';
 		return $this->render('games/2048/index', ['model' => $model, 'result'=>$result, 'subscribed'=>$subscribed, 'username'=>$username, 'gh_id'=>$gh_id, 'openid'=>$openid]);
	}	
               
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/gsave:gh_1ad98f5481f3
	public function actionG2048save()
	{            
		$msg = 0;
		$this->layout = false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');				
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
    
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/suggest:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/suggest:gh_03a74ac96138
	public function actionSuggest()
	{
		//$this->layout = 'wap';
	    $this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');		
		//Yii::$app->wx->setGhId($gh_id);
		
		$ar = new \app\models\MSuggest;
		$ar->gh_id = $gh_id;
		$ar->openid = $openid;
		
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);		
		$subscribed = ($model !== null && $model->subscribe) ? true : false;
		if ($ar->load(Yii::$app->request->post())) 
		{
			if ($subscribed)
			//if (1)
			{				
				$ar->nickname = $model->nickname;
				$ar->headimgurl = $model->headimgurl;				
				if ($ar->save(true)) 
				{
					//return $this->redirect(['index']);
					U::W(['kkkkkkkkkkkkkkkkkkkk']);
					//$result = $this->renderPartial('result', ['msg'=>$msg]);
				}
				else
				{
					U::W($ar->getErrors());
				}	
			}	
			else
			{
				U::W("openid=$openid is not subscribed");
			}
			//Yii::$app->session->setFlash('submit_ok');
			//return $this->refresh();
		}

		$query =  \app\models\MSuggest::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => [
					//'name' => SORT_ASC,
					'id' => SORT_DESC
				]
			],
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		$query = new \yii\db\Query();
		$query->select('*')->from(\app\models\MSuggest::tableName())->where(['gh_id'=>$gh_id])->orderBy(['id' => SORT_DESC])->limit(10);   
		$rows = $query->createCommand()->queryAll();
		//U::W($rows);
		foreach($rows as &$row)
		{
			$create_time= strtotime($row['create_time']);
			$d = time()  - $create_time;
			$d_days = round($d/86400);
			$d_hours = round($d/3600);
			$d_minutes = round($d/60);
			if($d_days>0 && $d_days<4){
				//document.write(d_days+"天前");
				$row['create_time_new'] = $d_days."天前";
			}else if($d_days<=0 && $d_hours>0){
				//document.write(d_hours+"小时前");
				$row['create_time_new'] = $d_hours."小时前";
			}else if($d_hours<=0 && $d_minutes>0){
				//document.write(d_minutes+"分钟前");
				$row['create_time_new'] = $d_minutes."分钟前";
			}else{
				$row['create_time_new'] = $row['create_time'];
			}
		}

 		//return $this->render('product', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
		//return $this->render('suggest', ['model' => $model1, 'subscribed'=>$subscribed, 'username'=>$username]);
		return $this->render('suggest',['ar' => $ar,'dataProvider' => $dataProvider, 'rows' =>$rows, 'gh_id'=>$gh_id, 'openid'=>$openid]);
	}	
			
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/product:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/product:gh_03a74ac96138	
	public function actionProduct()
	{
		$this->layout ='wapy';
		//$this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');				
		return $this->render('product',['gh_id'=>$gh_id, 'openid'=>$openid]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prodsave:gh_1ad98f5481f3
	public function actionProdsave()
	{			
		//U::W([$_GET, $_POST, $_SERVER]);
		//U::W([$_GET, $_POST]);
		//U::W('aaaaaaaaaaaaaaa');
		//if (!Yii::$app->request->isAjax)
		//	return;	
		//U::W('bbbbb');			
		$this->layout = false;
		//$gh_id = Yii::$app->session['gh_id'];
		//$openid = Yii::$app->session['openid'];
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');		
		
		Yii::$app->wx->setGhId($gh_id);	
		if (0)
		{
			$_GET["cid"] = MItem::ITEM_CAT_DIY;
		}
		$order = new MOrder;
		$order->oid = MOrder::generateOid();
		$order->gh_id = $gh_id;
		$order->openid = $openid;
		$order->cid = $_GET["cid"];
		switch ($_GET["cid"]) 
		{
			case MItem::ITEM_CAT_DIY:
				if (0)
				{
					$_GET['cardType'] = 1;
					$_GET['flowPack'] =2;
					$_GET['voicePack'] = 1;
					$_GET['msgPack'] = 1;
					$_GET['callshowPack'] = 1;
					$_GET['otherPack'] = 1;
					$_GET['feeSum'] = 1;
					$_GET['selectNum'] = '18672725352';
					$_GET['office'] = 1;
					$_GET['username'] = 'hehb';
					$_GET['usermobile'] = '18672725352';
					$_GET['userid'] = '422428197452232344';					
				}			
				$order->title = '自由组合套餐';			
				$order->attr = "{$_GET['cardType']},{$_GET['flowPack']},{$_GET['voicePack']},{$_GET['msgPack']},{$_GET['callshowPack']},{$_GET['otherPack']}";				
				break;
			case MItem::ITEM_CAT_CARD_WO:
				$order->title = '微信沃卡';			
				$order->attr = "{$_GET['cardType']}";				
				break;
			case MItem::ITEM_CAT_CARD_XIAOYUAN:
				$order->title = '沃派校园套餐';			
				$order->attr = "{$_GET['cardType']}";
				break;		
			case MItem::ITEM_CAT_MOBILE_IPHONE4S:
				$order->title = 'Apple iPhone4s';			
				$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}, {$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}";
				break;				
			case MItem::ITEM_CAT_MOBILE_K1:
				$order->title = 'K1';			
				$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}, {$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}";
				break;				
			case MItem::ITEM_CAT_MOBILE_HTC516:
				$order->title = 'HTC516';			
				$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}, {$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}";
				break;		
			case MItem::ITEM_CAT_GOODNUMBER:
				$order->title = '精选靓号';			
				$order->attr = "{$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}, {$_GET['plan126']}";
				break;				
				
			default:
				U::W(['invalid data cat', $cid, __METHOD__,$_GET]);
				return;
		}				
		$order->feesum = $_GET['feeSum'] * 100;
		$order->office_id = $_GET['office'];					
		$order->select_mobnum = $_GET['selectNum'];		
		$order->userid = isset($_GET['userid']) ? $_GET['userid'] : '';
		$order->username = isset($_GET['username']) ? $_GET['username'] : '';
		$order->usermobile = isset($_GET['usermobile']) ? $_GET['usermobile'] : '';
		$order->detail = $order->getDetailStr();

		$mobnum = MMobnum::findOne($_GET['selectNum']);
		if ($mobnum === null ||$mobnum->status != MMobnum::STATUS_UNUSED)
		{
			return json_encode(['status'=>1, 'errmsg'=>$mobnum === null ? "mobile doest not exist" : "mobile locked!"] );
		}
		
		if ($order->save(false))
		{
			//U::W('save ok....');	
			$mobnum->status = MMobnum::STATUS_LOCKED;
			$mobnum->locktime = time();
			$mobnum->save(false);

			// clear win flag
			$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
			if ($model !== null)
			{
				$model->cnt = 0;						
				$model->win = 0;
				$model->win_time = 0;
				$model->save(false);
			}

			//send wx message and sm 
			$manager = MStaff::findOne(['office_id'=>$order->office_id, 'is_manager'=>1]);
			if ($manager !== null)
			{
				U::W('sendWxm');
				$manager->sendWxm($order->getWxNoticeToManager());
				U::W('sendSm');
				$manager->sendSm($order->getSmNoticeToManager());
			}

			// send wx message to user
			$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice()]]);					

		}
		else
		{
			U::W([__METHOD__, $order->getErrors()]);
		}
		
		Yii::$app->wx->clearGh();
		Yii::$app->wx->setGhId(MGh::GH_WOSO);
		$url = Yii::$app->wx->create_native_url($order->oid);
		Yii::$app->wx->clearGh();
		Yii::$app->wx->setGhId($gh_id);		
		
		//U::W(json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]));
		return json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=mobileNum&currentPage=1&cid=10&feeSum=1
	//http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=diskRestCnt&cid=10
	//http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=orderview&oid=53de91f9d3773
	//http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=g2048Save&bigNum=1&best=2&score=100
	public function actionAjaxdata($cat)
	{
		//if (!Yii::$app->request->isAjax)
		//	return;
		$this->layout = false;		
		switch ($cat) 
		{
			case 'orderclose':
				$oid = isset($_GET["oid"]) ? $_GET["oid"] : 1;
				$model = MOrder::findOne($oid);
				if ($model === null)
					U::D(["invalid oid:$oid", __METHOD__]);
				$model->status = MOrder::STATUS_CLOSED_USER;
				if ($model->save(true, ['status']))
				{				
					$mobnum = MMobnum::findOne($model->select_mobnum);
					if ($mobnum !== null)
					{
						$mobnum->status = MMobnum::STATUS_UNUSED;
						$mobnum->save(false);				
					}
					$data['code'] = 0;
				}		
				else
					return json_encode(['code'=>1, 'errmsg'=>'save db error']);				
				break;

			case 'orderview':
				$oid = isset($_GET["oid"]) ? $_GET["oid"] : 1;
				$data = MOrder::find()->select('*')->where("oid=:oid", [':oid'=>$oid])->asArray()->one();

				$data['statusName'] = MOrder::getOrderStatusName($data['status']);
					
				break;
		
			case 'myorder':
				$gh_id = U::getSessionParam('gh_id');
				$openid = U::getSessionParam('openid');										
				$page = isset($_GET["currentPage"]) ? $_GET["currentPage"] : 1;
				$size = isset($_GET['size']) ? $_GET['size'] : 8;	
				$data = MOrder::find()->select('*')->where("gh_id=:gh_id AND openid=:openid", [':gh_id'=>$gh_id, ':openid'=>$openid])->orderBy(['oid' => SORT_DESC])->offset(($page-1)*$size)->limit($size)->asArray()->all();				
				foreach($data as &$row)
				{
					$row['statusName'] = MOrder::getOrderStatusName($row['status']);
				}	
				unset($row);	
				break;

			case 'officeorder':
				$gh_id = U::getSessionParam('gh_id');
				$openid = U::getSessionParam('openid');										
				$page = isset($_GET["currentPage"]) ? $_GET["currentPage"] : 1;
				$size = isset($_GET['size']) ? $_GET['size'] : 8;	
				$orderby = isset($_GET["orderby"]) ? $_GET["orderby"] : 'oid';
				$asc = isset($_GET["asc"]) ? $_GET["asc"] : 0;
				$office_id = isset($_GET["office_id"]) ? $_GET["office_id"] : 0;
				$data = MOrder::find()->select('*')->where("gh_id=:gh_id AND office_id=:office_id", [':gh_id'=>$gh_id, ':office_id'=>$office_id])->orderBy([$orderby => $asc == 1 ? SORT_ASC : SORT_DESC])->offset(($page-1)*$size)->limit($size)->asArray()->all();				
				foreach($data as &$row)
				{
					$row['statusName'] = MOrder::getOrderStatusName($row['status']);
				}	
				unset($row);	
				break;
		
			case 'mobileNum':
				$page = isset($_GET["currentPage"]) ? $_GET["currentPage"] : 1;
				$size = isset($_GET['size']) ? $_GET['size'] : 8;	
				$feeSum = isset($_GET['feeSum']) ? $_GET['feeSum'] : 100000;
				$feeSum = $feeSum * 100;
				$cid = isset($_GET["cid"]) ? $_GET["cid"] : MItem::ITEM_CAT_DIY;		
				$num_cat = MMobnum::getNumCat($cid);
				$data = MMobnum::find()->select('num,ychf,zdxf')->where("status=:status AND num_cat=:num_cat AND zdxf <= :zdxf", [':status'=>MMobnum::STATUS_UNUSED, ':num_cat'=>$num_cat, ':zdxf'=>$feeSum])->offset(($page-1)*$size)->limit($size)->asArray()->all();         				
				break;
				
			case 'diskclick':
				$gh_id = U::getSessionParam('gh_id');
				$openid = U::getSessionParam('openid');										
				$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);						
				if ($model === null)
					$model = MDisk::initDefault($gh_id, $openid);
				else if ($model->cnt > 0)
					$model->cnt = $model->cnt - 1;
				else
					return json_encode(['code'=>1, 'errmsg'=>'has no qualification']);				
				$data = U::makeDiskResult();	
				if ($data['code'] == 0)
				{	
					if ($data['value'] % 2 == 0)
					{
						$model->cnt = 0;						
						$model->win = 1;
						$model->win_time = time();
					}
				}
				$model->save(false);						
				break;

			case 'diskRestCnt':
				$gh_id = U::getSessionParam('gh_id');
				$openid = U::getSessionParam('openid');										
				$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);		
				if ($model === null)
				{
					$model = MDisk::initDefault($gh_id, $openid);
					$model->save(false);
					$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);							
				}
				$data = $model->getAttributes();
				$cur_time = time();	
				if ($model->win == 1 && $cur_time - $model->win_time < 30*60)
					$alreadyWin = 1;
				else 
					$alreadyWin = 0;
				$data['alreadyWin'] = $alreadyWin;
				$data['code'] = 0; 
				break;

			case 'g2048Save':
				$gh_id = U::getSessionParam('gh_id');
				$openid = U::getSessionParam('openid');					
				Yii::$app->wx->setGhId($gh_id);
				$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
				if ($user === null)
					$user = new MUser;		
				
				if (!empty($user->subscribe))
				{
					$model = new \app\models\MG2048;
					$model->gh_id = $gh_id;
					$model->openid = $openid;
					$model->best = $_GET['best'];
					$model->score = $_GET['score'];
					$model->big_num = $_GET['bigNum'];		
					if (!$model->save(false))
					{
						U::W([__METHOD__, $model->getErrors()]);
						return json_encode(['code'=>1, 'errmsg'=>'save score to db error']);
					}		
				}
				$data['code'] = 0;
				$data['isSubscribed'] = empty($user->subscribe) ? 0 : 1;
				$data['position'] = MG2048::getCurrentScorePosition($gh_id, $_GET['score']);
				break;
				
			default:
				U::W(['invalid data cat', $cat, __METHOD__,$_GET]);
				return;
		}		
		//U::W([$data]);
		//U::W(json_encode($data));
		return json_encode($data);
	}

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardwo:gh_1ad98f5481f3
    public function actionCardwo()
    {
        $this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		Yii::$app->wx->setGhId($gh_id);

        return $this->render('card', ['cid'=>MItem::ITEM_CAT_CARD_WO, 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardxiaoyuan:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardxiaoyuan:gh_03a74ac96138
    public function actionCardxiaoyuan()
    {
        $this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
	    Yii::$app->wx->setGhId($gh_id);

        return $this->render('card', ['cid'=>MItem::ITEM_CAT_CARD_XIAOYUAN, 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mobilelist:gh_03a74ac96138
    public function actionMobilelist()
    {
        $this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		Yii::$app->wx->setGhId($gh_id);

        //return $this->render('mobile');
        return $this->render('mobilelist', ['gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    public function actionMobilelistxxx()
    {
        $this->layout =false;
			Yii::$app->session['gh_id'] = MGh::GH_XIANGYANGUNICOM;
			Yii::$app->session['openid'] =  MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;			
        
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		Yii::$app->wx->setGhId($gh_id);

        //return $this->render('mobile');
        return $this->render('mobilelist', ['gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    public function actionMobile()
    {
        $this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		Yii::$app->wx->setGhId($gh_id);

        //return $this->render('mobile');
        return $this->render('mobile', ['cid'=>$_GET['cid'], 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

/*
	//http://127.0.0.1/wx/web/index.php?r=wap/disk&gh_id=gh_03a74ac96138&openid=111
	public function actionDisk()
	{
		$this->layout = false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');    	
		//$rotateParam = U::getRotateParam();
		return $this->render('games/disk/index');
	}
*/
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/disk:gh_03a74ac96138
	public function actionDisk()
	{
		$this->layout =false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');

		/*
		$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		$cur_time = time();	
		$alreadyWin = 0;		
		if ($model === null)
			$restCnt = MDisk::MDISK_CNT_PER_DAY;
		else if ($model->win == 1 && $cur_time - $model->win_time < 30*60)
		{
			$alreadyWin = 1;
			$restCnt = $model->cnt;
		}
		else
			$restCnt = $model->cnt;
		*/

/*			
		if (win)
		{
			//display disk and alert you win already,
		}
		else if (has_disk_cnt)
			goto disk_rotate
		else
			echo 'sorry, please come here tomorrow';
*/			
		//return $this->render('games/disk/index', ['alreadyWin'=>$alreadyWin, 'restCnt'=>$restCnt]);
		return $this->render('games/disk/index');
	}

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/home:gh_03a74ac96138
    public function actionHome()
    {
        $this->layout = 'wap';

	    $gh_id = U::getSessionParam('gh_id');
	    $openid = U::getSessionParam('openid');
		Yii::$app->session['gh_id'] = $gh_id;
		Yii::$app->session['openid'] = $openid;		
	    
	    Yii::$app->wx->setGhId($gh_id);

        return $this->render('home');
    }

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/goodnumber:gh_03a74ac96138
	public function actionGoodnumber()
	{
		$this->layout =false;

		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		Yii::$app->wx->setGhId($gh_id);

		return $this->render('goodnumber', ['cid'=>MItem::ITEM_CAT_GOODNUMBER, 'gh_id'=>$gh_id, 'openid'=>$openid]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_03a74ac96138
	public function actionOrder()
	{		
		$this->layout = false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');

		$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
	
		return $this->render('order', ['user'=>$user, 'gh_id'=>$gh_id, 'openid'=>$openid]);
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
$wxPayHelper->setParameter("notify_url", "http://wosotech.com/wx/web/index.php?r=wap/paynotify");
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

    public function actionMobilek1()
    {
        $this->layout =false;
        //return $this->render('mobile');
        return $this->render('mobile', ['cid'=>MItem::ITEM_CAT_MOBILE_K1]);
    }

    public function actionMobilehtc516()
    {
        $this->layout =false;
        //return $this->render('mobile');
        return $this->render('mobile', ['cid'=>MItem::ITEM_CAT_MOBILE_HTC516]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mobileiphone4s:gh_03a74ac96138
    public function actionMobileiphone4s()
    {
        $this->layout =false;
        //return $this->render('mobile');
        return $this->render('mobile', ['cid'=>MItem::ITEM_CAT_MOBILE_IPHONE4S]);
    }

		
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

		$url = "http://baidu.com";
		$tag = Html::a('来挑战', $url);

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

//		$sql = "SELECT * FROM `wx_g2048` ORDER BY `score` ASC ";


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


	//http://127.0.0.1/wx/web/index.php?r=wap/aboutqr&name=jack&qrurl=http://wosotech.com/wx/runtime/qr/gh_03a74ac96138_1.jpg
	public function actionAboutqr()
	{
		$name = $_GET['name'];
		$qrurl = $_GET['qrurl'];
		$this->layout = 'wap';
 		return $this->render('aboutqr', ['name' => $name, 'qrurl'=>$qrurl]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wap/mall&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mall:gh_1ad98f5481f3
	public function actionMall()
	{		
		//$gh_id = Yii::$app->session['gh_id'];	
		//$openid = Yii::$app->session['openid'];
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		
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

	//http://127.0.0.1/wx/web/index.php?r=wap/diy&gh_id=gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/diy:gh_1ad98f5481f3
	//http://114.215.178.32/wx/web/index.php?r=wap/diy&gh_id=gh_1ad98f5481f3
	public function actionDiy()
	{
		$this->layout = false;		
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');				
		//Yii::$app->wx->setGhId();		
 		return $this->render('diy');
	}	
/
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
        
*/	


