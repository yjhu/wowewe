<?php

namespace app\controllers;

use app\models\Alipay;
use app\models\AlipaySubmit;
use app\models\HeatMap;
use app\models\JSSDK;
use app\models\MDisk;
use app\models\MG2048;
use app\models\MGh;
use app\models\MItem;
use app\models\MMarketingRegion;
use app\models\MMarketingServiceCenter;
use app\models\MMobnum;
use app\models\MOffice;
use app\models\MOfficeCampaignDetail;
use app\models\MOfficeCampaignPicCategory;
use app\models\MOfficeCampaignScore;
use app\models\MOrder;
use app\models\MOrderTrail;
use app\models\MPkg;
use app\models\MSceneDetail;
use app\models\MStaff;
use app\models\MUser;
use app\models\MWinMobileFee;
use app\models\MWinMobileNum;
use app\models\OpenidBindMobile;
use app\models\search\OpenidBindMobileSearch;
use app\models\MOfficeScoreEvent;


use app\models\U;
use app\models\Wechat;
use app\models\wxpay\NativePay;
use app\models\wxpay\WxPayApi;
use app\models\wxpay\WxPayConfig;
use app\models\wxpay\WxPayNotify;
use app\models\wxpay\WxPayUnifiedOrder;
use Yii;

require_once __DIR__ . "/../models/wxpay/WxPayData.php";

use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class WapController extends Controller {
    public function behaviors() {
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

    public function init() {
        //U::W(['init....', $_GET,$_POST, $GLOBALS]);
        U::W(['init....', $_GET, $_POST, Yii::$app->request->getUrl()]);
    }

    public function beforeAction($action) {
        return true;
    }

    public function afterAction($action, $result) {
        U::W("{$this->id}/{$this->action->id}:" . Yii::getLogger()->getElapsedTime());
        return parent::afterAction($action, $result);
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        //$item = \app\models\MItem::findOne(['gh_id'=>'gh_03a74ac96138', 'cid' => \app\models\MItem::ITEM_CAT_CARD_WO]);
        //U::W($item);
        return $this->render('index');
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3:cid=11:oid=12
    public function actionOauth2cb() {
        if (Yii::$app->wx->localTest) {
            $openid = MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;
            //list($route, $gh_id) = explode(':', $_GET['state']);
            $arr = explode(':', $_GET['state']);
            $route = $arr[0];
            $gh_id = $arr[1];
            unset($arr[0], $arr[1]);
            $r[] = $route;
            foreach ($arr as $str) {
                list($key, $val) = explode('=', $str);
                $r[$key] = $val;
            }
            Yii::$app->session['gh_id'] = $gh_id;
            Yii::$app->session['openid'] = $openid;
            $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
            //if ($user !== null)
            //    Yii::$app->user->login($user);
            //return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
            //return $this->redirect([$route]);
            return $this->redirect($r);
        }

        if (empty($_GET['code'])) {
            U::W([__METHOD__, $_GET, 'no code']);
            return;
        }
        $code = $_GET['code'];
        if ($code == 'authdeny') {
            return 'Sorry, we can not do anything for you without your authrization!';
        }

        $arr = explode(':', $_GET['state']);
        $route = $arr[0];
        $gh_id = $arr[1];
        unset($arr[0], $arr[1]);
        $r[] = $route;
        foreach ($arr as $str) {
            list($key, $val) = explode('=', $str);
            $r[$key] = $val;
        }

        Yii::$app->wx->setGhId($gh_id);
        $token = Yii::$app->wx->WxGetOauth2AccessToken($code);
        if (!isset($token['access_token'])) {
            U::W([__METHOD__, $token]);
            return null;
        }
        $oauth2AccessToken = $token['access_token'];
        $openid = $token['openid'];

        if (isset($token['scope']) && $token['scope'] == 'snsapi_userinfo') {
            $oauth2UserInfo = Yii::$app->wx->WxGetOauth2UserInfo($oauth2AccessToken, $openid);
            U::W($oauth2UserInfo);
            Yii::$app->session->set('oauth2UserInfo', $oauth2UserInfo);
        }
        Yii::$app->session['gh_id'] = $gh_id;
        Yii::$app->session['openid'] = $openid;
        //if ($route == 'wap/wxpaytest' || $route == 'wap/orderinfotest')
        if (1) {
            U::W('WITH GH_ID');
            $r['gh_id'] = $gh_id;
            $r['openid'] = $openid;
            return $this->redirect($r);
        }
        return $this->redirect($r);
    }

    public function getOauth2UserInfo() {
        if (Yii::$app->wx->localTest) {
            $openid = MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;
            //list($route, $gh_id) = explode(':', $_GET['state']);
            $arr = explode(':', $_GET['state']);
            $route = $arr[0];
            $gh_id = $arr[1];
            unset($arr[0], $arr[1]);
            $r[] = $route;
            foreach ($arr as $str) {
                list($key, $val) = explode('=', $str);
                $r[$key] = $val;
            }
            Yii::$app->session['gh_id'] = $gh_id;
            Yii::$app->session['openid'] = $openid;
            $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
            //if ($user !== null)
            //    Yii::$app->user->login($user);
            //return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
            //return $this->redirect([$route]);
            return $this->redirect($r);
        }

        if (empty($_GET['code'])) {
            U::W([__METHOD__, $_GET, 'no code']);
            return;
        }
        $code = $_GET['code'];
        if ($code == 'authdeny') {
            return 'Sorry, we can not do anything for you without your authrization!';
        }

        $arr = explode(':', $_GET['state']);
        $route = $arr[0];
        $gh_id = $arr[1];
        unset($arr[0], $arr[1]);
        $r[] = $route;
        foreach ($arr as $str) {
            list($key, $val) = explode('=', $str);
            $r[$key] = $val;
        }

        Yii::$app->wx->setGhId($gh_id);
        $token = Yii::$app->wx->WxGetOauth2AccessToken($code);
        if (!isset($token['access_token'])) {
            U::W([__METHOD__, $token]);
            return null;
        }
        $openid = $token['openid'];
        if (isset($token['scope']) && $token['scope'] == 'snsapi_userinfo') {
            $oauth2UserInfo = Yii::$app->wx->WxGetOauth2UserInfo($token['access_token'], $token['openid']);
            $token['oauth2UserInfo'] = $oauth2UserInfo;
        }
        //$token['gh_id'],$token['openid'],$token['oauth2UserInfo']
        Yii::$app->session['gh_id'] = $token['gh_id'];
        Yii::$app->session['openid'] = $token['openid'];
        return $token;
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/nativepackage
    public function actionNativepackagev2() {
        U::W([__METHOD__, $GLOBALS]);
        if (Yii::$app->wx->localTest) {
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
        } else {
            $postStr = Yii::$app->wx->getPostStr();
        }

        if (empty($postStr)) {
            U::W(['No postStr', __METHOD__, $GLOBALS]);
            exit;
        }
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (Yii::$app->wx->debug) {
            U::W($arr);
        }

        if (empty($arr['AppId'])) {
            U::W(['No AppId', __METHOD__, $postStr]);
            exit;
        }

        //$arr['ProductId'] = '53d89b592bfec';
        Yii::$app->wx->setAppId($arr['AppId']);
        $productId = $arr['ProductId'];
        $openid = $arr['OpenId'];
        $model = MOrder::findOne($productId);
        if ($model === null) {
            U::W(['order does not exist!', __METHOD__, $arr]);
            exit;
        }
        Yii::$app->wx->setParameterComm();
        $detail = $model->detail;
        Yii::$app->wx->setParameter("body", $detail);
        Yii::$app->wx->setParameter("out_trade_no", $model->oid);
        Yii::$app->wx->setParameter("total_fee", "{$model->feesum}");
        //Yii::$app->wx->setParameter("total_fee",  "1");
        Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");
        $xmlStr = Yii::$app->wx->create_native_package();
        if (Yii::$app->wx->debug) {
            U::W($xmlStr);
        }

        return $xmlStr;

    }

    //http://127.0.0.1/wx/web/index.php?r=wap/paynotify
    public function actionPaynotifyv2() {
        U::W(['actionPaynotify', $_GET, $_POST]);
        // receive the pay notify from wx server and save the order to db
        // POST data
        if (Yii::$app->wx->localTest) {
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
            $_GET['transaction_id'] = '1209999999' . date('Ymd') . substr(uniqid(), -10);
            $_GET['time_end'] = date("YmdHis");
        } else {
            $postStr = Yii::$app->wx->getPostStr();
        }

        if (empty($postStr)) {
            U::W(['No postStr from wx server', __METHOD__, $GLOBALS]);
            exit;
        }
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //we should check $arr signature first
        if (Yii::$app->wx->debug) {
            U::W([$_GET, $arr]);
        }

        if (empty($arr['AppId'])) {
            U::W(['No AppId from wx server', __METHOD__, $postStr]);
            exit;
        }

        // GET data  (!isset($_GET['bank_type'])) ||
        if ((!isset($_GET['out_trade_no'])) || (!isset($_GET['sign'])) || (!isset($_GET['trade_mode'])) ||
            (!isset($_GET['trade_state'])) || (!isset($_GET['partner'])) ||
            (!isset($_GET['total_fee'])) || (!isset($_GET['fee_type'])) || (!isset($_GET['notify_id'])) ||
            (!isset($_GET['transaction_id'])) || (!isset($_GET['time_end']))) {
            U::W(['Invalid GET data from wx server...', __METHOD__, $_GET, $_POST]);
            exit;
        }
        //$attach = Yii::$app->request->get('attach', '');
        $order = MOrder::findOne($_GET["out_trade_no"]);
        if ($order === null) {
            U::W(['oid does not exist!', __METHOD__, $_GET, $_POST]);
            return 'success';
        }
        if ($_GET['trade_state'] == 0) {
            $order->status = MOrder::STATUS_SUCCEEDED;
        } else {
            U::W(['status error', __METHOD__, $_GET, $_POST]);
        }

        $order->notify_id = $_GET['notify_id'];
        $order->partner = $_GET['partner'];
        $order->time_end = $_GET['time_end'];
        $order->total_fee = $_GET['total_fee'];
        $order->trade_state = $_GET['trade_state'];
        $order->transaction_id = $_GET['transaction_id'];
        $order->appid_recv = $arr['AppId'];
        $order->openid_recv = $arr['OpenId'];
        $order->issubscribe_recv = $arr['IsSubscribe'];
        $order->pay_kind = MOrder::PAY_KIND_WECHAT;
        $order->save(false);
        if ($_GET['trade_state'] == 0) {
            Yii::$app->wx->clearGh();
            Yii::$app->wx->setAppId($arr['AppId']);
            $arr = Yii::$app->wx->WxPayDeliverNotify($arr['OpenId'], $_GET['transaction_id'], $_GET["out_trade_no"]);
            //U::W($arr);
            try
            {
                Yii::$app->wx->clearGh();
                Yii::$app->wx->setGhId($order->gh_id);
                $arr = Yii::$app->wx->WxMessageCustomSend(['touser' => $order->openid, 'msgtype' => 'text', 'text' => ['content' => $order->getWxNotice(true)]]);
                //U::W($arr);
            } catch (\Exception $e) {
                U::W($e->getCode() . ':' . $e->getMessage());
            }
        } else {
            U::W(['trade_state is not 0', __METHOD__, $_GET, $_POST]);
        }
        return 'success';
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/warningnotify
    public function actionWarningnotifyv2() {
        // receive the warning notify from wx server, we need handle it ASAP
        if (Yii::$app->wx->localTest) {
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
        } else {
            $postStr = Yii::$app->wx->getPostStr();
        }

        if (empty($postStr)) {
            U::W(['No postStr', __METHOD__, $GLOBALS]);
            exit;
        }
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (Yii::$app->wx->debug) {
            U::W($arr);
        }

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

    //http://127.0.0.1/wx/web/index.php?r=wap/nativenotify
    public function actionNativenotify() {
        $notify = new NativeNotifyCallBack();
        $respXml = $notify->Handle(true);
        U::W($respXml);
        return $respXml;
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/warningnotify
    public function actionWarningnotify() {
        // receive the warning notify from wx server, we need handle it ASAP
        if (Yii::$app->wx->localTest) {
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
        } else {
            $postStr = Yii::$app->wx->getPostStr();
        }

        if (empty($postStr)) {
            U::W(['No postStr', __METHOD__, $GLOBALS]);
            exit;
        }
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//        if (Yii::$app->wx->debug)
        U::W([__METHOD__, $arr]);
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
        return 'success';
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/feedback
    public function actionFeedback() {
        $postStr = Yii::$app->wx->getPostStr();
        $arr = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (Yii::$app->wx->debug) {
            U::W($arr);
        }

    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_03a74ac96138
    public function actionLuck() {
        $this->layout = 'wap';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        Yii::$app->wx->setGhId($gh_id);
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            $model = new MUser;
            $subscribed = false;
        } else if ($model->subscribe) {
            $subscribed = true;
        } else {
            $subscribed = false;
        }

        if (!Yii::$app->user->isGuest) {
            $username = Yii::$app->user->identity->username;
        } else {
            $username = '';
        }

        $result = '';
        $lucy_msg = [];
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->isGuest) {
                $username = $model->mobile;
            }

            $loca = file_get_contents("http://api.showji.com/Locating/www.show.ji.c.o.m.aspx?m=" . $model->mobile . "&output=json&callback=querycallback");
            $loca = substr($loca, 14, -2);
            $loca = json_decode($loca, true);
            $lucy_msg = U::getMobileLuck($model->mobile);
            $lucy_msg['Mobile'] = $model->mobile;
            $result = $this->renderPartial('luck_result', ['loca' => $loca, 'lucy_msg' => $lucy_msg]);
        }
        return $this->render('luck', ['model' => $model, 'result' => $result, 'lucy_msg' => $lucy_msg, 'subscribed' => $subscribed, 'username' => $username]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/iphone6sub&cat=0
    //http://wosotech.com/wx/web/index.php?r=wap/oauth2cb&state=wap/cardlist:gh_03a74ac96138
    //http://wosotech.com/wx/web/index.php?r=wap/iphone6sub&cat=1
    public function actionIphone6sub() {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : 0;
        $this->layout = 'wap';
        $model = new \app\models\MIphone6Sub;
        $cat = Yii::$app->request->get('cat', 0);
        $model->cat = $cat;
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                U::W([$_GET, $_POST, $model->getErrors()]);
                Yii::$app->session->setFlash('success', '此身份证号码已存在!');
            } else {
                Yii::$app->session->setFlash('success', '预订信息提交成功，请您敬侯佳音节！');
            }

            return $this->refresh();
        }
        $n = \app\models\MIphone6Sub::find()->where(['cat' => $cat])->count();
        return $this->render('iphone6sub', ['model' => $model, 'n' => $n + 999]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_03a74ac96138
    public function actionG2048() {
        $this->layout = 'wapy';
        //$this->layout =false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        //$a = \app\models\MG2048::getScoreTop($gh_id);

        Yii::$app->wx->setGhId($gh_id);
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            $model = new MUser;
            $subscribed = false;
        } else if ($model->subscribe) {
            $subscribed = true;
        } else {
            $subscribed = false;
        }

        if ($model === null) {
            $username = '';
        } else {
            $username = $model->nickname;
        }

        $result = '';
        return $this->render('games/2048/index', ['model' => $model, 'result' => $result, 'subscribed' => $subscribed, 'username' => $username, 'gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/gsave:gh_1ad98f5481f3
    public function actionG2048save() {
        $msg = 0;
        //$this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (!Yii::$app->user->isGuest) {
            $username = Yii::$app->user->identity->username . ',';
        } else {
            $username = '';
        }

        $model = new \app\models\MG2048;
        $model->gh_id = $gh_id;
        $model->openid = $openid;
        $model->best = $_GET['best'];
        $model->score = $_GET['score'];
        $model->big_num = $_GET['bigNum'];

        $model1 = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model1 === null) {
            $model1 = new MUser;
            $subscribed = false;
        } else if ($model1->subscribe) {
            $subscribed = true;
        } else {
            $subscribed = false;
        }

        if ($subscribed) {
            if ($model->save(false)) {
                //return $this->redirect(['index']);
            } else {
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
    public function actionSuggest() {
        $this->layout = 'wapy';
        //$this->layout =false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $ar = new \app\models\MSuggest;
        $ar->gh_id = $gh_id;
        $ar->openid = $openid;
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $subscribed = ($model !== null && $model->subscribe) ? true : false;
        if ($ar->load(Yii::$app->request->post())) {
            if ($subscribed) {
                $ar->nickname = $model->nickname;
                $ar->headimgurl = $model->headimgurl;
                if (!$ar->save(true)) {
                    U::W($ar->getErrors());
                }
            } else {
                U::W("openid=$openid is not subscribed");
            }
        }

        $query = \app\models\MSuggest::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    //'name' => SORT_ASC,
                    'id' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $query = new \yii\db\Query();
        $query->select('*')->from(\app\models\MSuggest::tableName())->where(['gh_id' => $gh_id])->orderBy(['id' => SORT_DESC])->limit(10);
        $rows = $query->createCommand()->queryAll();
        foreach ($rows as &$row) {
            $create_time = strtotime($row['create_time']);
            $d = time() - $create_time;
            $d_days = round($d / 86400);
            $d_hours = round($d / 3600);
            $d_minutes = round($d / 60);
            if ($d_days > 0 && $d_days < 4) {
                $row['create_time_new'] = $d_days . "天前";
            } else if ($d_days <= 0 && $d_hours > 0) {
                $row['create_time_new'] = $d_hours . "小时前";
            } else if ($d_hours <= 0 && $d_minutes > 0) {
                $row['create_time_new'] = $d_minutes . "分钟前";
            } else {
                $row['create_time_new'] = $row['create_time'];
            }
        }
        return $this->render('suggest', ['ar' => $ar, 'dataProvider' => $dataProvider, 'rows' => $rows, 'gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/product:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/product:gh_03a74ac96138
    public function actionProduct() {
        $this->layout = 'wapy';
        //$this->layout =false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        return $this->render('product', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

/*
//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prodsave-v2:gh_1ad98f5481f3
public function actionProdsaveV2()
{
$this->layout = false;
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');
Yii::$app->wx->setGhId($gh_id);
$order = new MOrder;
$order->oid = MOrder::generateOid();
$order->gh_id = $gh_id;
$order->openid = $openid;
$order->cid = $_GET["cid"];

switch ($_GET["cid"])
{
case MItem::ITEM_CAT_DIY:
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
$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_K1:
$order->title = 'K1';
$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_HTC516:
$order->title = 'HTC516';
$order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
break;
case MItem::ITEM_CAT_GOODNUMBER:
$order->title = '精选靓号';
$order->attr = "{$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}, {$_GET['plan126']}";
break;
case MItem::ITEM_CAT_MOBILE_APPLE_5C_8G_WHITE:
$order->title = '苹果5C 8G 白色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_APPLE_5C_8G_BLUE:
$order->title = '苹果5C 8G 蓝色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_HTC_8160_SILVER:
$order->title = 'HTC 8160 银色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_SAMSUNG_7506V_BLACK:
$order->title = '三星 7506V 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7298A_CHUNLEI_WHITE:
$order->title = '酷派 7298A 春雷 白色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_LENOVOA_A850_BLACK:
$order->title = '联想 A850+ 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7295C_WHITE:
$order->title = '酷派 7295C 白色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_APPLE_5S_32G_SILVER:
$order->title = '苹果 5S 32G 银色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7296_BLACK:
$order->title = '酷派 7296 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7296_WHITE:
$order->title = '酷派 7296 白色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_K1_WHITE:
$order->title = '酷派 K1 白色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7235_BLACK:
$order->title = '酷派 7235 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7230S_BLACK:
$order->title = '酷派 7230S 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_HISENSE_U939:
$order->title = '海信 U939';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_COOLPAD_7295C_BLACK:
$order->title = '酷派 7295C 黑色';
$order->attr = "{$_GET['prom']}";
break;
case MItem::ITEM_CAT_MOBILE_XIAOMI4:
$order->title = '小米4';
$order->attr = "{$_GET['prom']}";
break;

//双十一活动 手机 begin
//----------------------------------------------------------
//ITEM_CAT_MOBILE_IPHONE4S iPhone 4S  8GB GSM  =12
//ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE 荣耀6 =328
//ITEM_CAT_MOBILE_XIAOMI4 小米4 =331
//const ITEM_CAT_APPLE_5S_16G = 332;
//const ITEM_CAT_APPLE_6_16G = 333;
//const ITEM_CAT_MOBILE_XIAOMI_HM_NOTE = 334;
//const ITEM_CAT_MOBILE_SONY_S55U = 335;
//const ITEM_CAT_MOBILE_XIAOMI_HM_1S = 336;

case MItem::ITEM_CAT_APPLE_5S_16G:
$order->title = 'APPLE 苹果 iPhone5S';
$order->attr = "{$_GET['prom']}";
break;

case MItem::ITEM_CAT_APPLE_6_16G:
$order->title = 'APPLE 苹果 iPhone6';
$order->attr = "{$_GET['prom']}";
break;

case MItem::ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE:
$order->title = '华为HuaWei 荣耀6';
$order->attr = "{$_GET['prom']}";
break;

case MItem::ITEM_CAT_MOBILE_XIAOMI_HM_NOTE:
$order->title = '红米Note';
$order->attr = "{$_GET['prom']}";
break;

case MItem::ITEM_CAT_MOBILE_SONY_S55U:
$order->title = 'SONY 索尼 S55u';
$order->attr = "{$_GET['prom']}";
break;

case MItem::ITEM_CAT_MOBILE_XIAOMI_HM_1S:
$order->title = '红米1S';
$order->attr = "{$_GET['prom']}";
break;

// 双十一活动 手机 end

case MItem::ITEM_CAT_CARD_45GLIULIANG:
$order->title = '45G包年流量套餐';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_96GLIULIANG:
$order->title = '96G包年流量套餐';
$order->attr = "{$_GET['cardType']}";
break;

//双十一活动 上网卡 begin
//----------------------------------------------------------
//const ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG = 708;
//const ITEM_CAT_CARD_1111_3GLIULIANG = 709;
//const ITEM_CAT_CARD_1111_6GLIULIANG = 710;
//const ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG = 711;
//const ITEM_CAT_CARD_1111_45GLIULIANG = 712;
//const ITEM_CAT_CARD_1111_96GLIULIANG = 713;
case MItem::ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG:
$order->title = '200元本地流量卡5G';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_1111_3GLIULIANG:
$order->title = '3G半年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_1111_6GLIULIANG:
$order->title = '6G年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG:
$order->title = '100元本地流量卡5G';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_1111_45GLIULIANG:
$order->title = '45G包年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_1111_96GLIULIANG:
$order->title = '96G包年卡';
$order->attr = "{$_GET['cardType']}";
break;
//双十一活动 上网卡 end

case MItem::ITEM_KIND_INTERNET_CARD_FLOW100MB:
$order->title = '10元包100MB 3G省内流量包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW300MB:
$order->title = '20元包300MB 3G省内流量包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW500MB:
$order->title = '30元包500MB 3G省内流量包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW1GB_1:
$order->title = '50元包1G 3G省内流量包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW2DOT5GB:
$order->title = '100元包2.5G 3G省内流量包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW1GB_2:
$order->title = '100元包1G 全国流量半年包';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_FLOW_FREE:
$order->title = '拼人品 抢流量包';
$order->attr = "{$_GET['cardType']}";

$ar = MOrder::find()->where("gh_id = :gh_id AND usermobile = :usermobile AND cid = :cid", [':gh_id'=>$gh_id, ':usermobile'=>$_GET["usermobile"], ':cid'=>$_GET["cid"]])->one();
if ($ar !== null)
{
//U::W([$_GET, $_POST, $ar->getErrors()]);
//Yii::$app->session->setFlash('success','手机号码已参加!');
//return $this->refresh();
return;
}

$user_founder = MWinMobileNum::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
$user_founder->finished = 1;
$user_founder->save();

break;

case MItem::ITEM_KIND_INTERNET_CARD_300YUANSHICHANGBANNIANKA:
$order->title = '300元时长半年卡';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_600YUANSHICHANGNIANKA:
$order->title = '600元时长年卡';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_KIND_INTERNET_CARD_1200YUANSHICHANGNIANKA:
$order->title = '1200元时长年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_SXYW_WKHB:
$order->title = '沃看湖北可看在线卫视及各种栏目10元包6G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_SXYW_AIQIYI10:
$order->title = '爱奇艺内容丰富10元包2.5G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_SXYW_AIQIYI15:
$order->title = '爱奇艺内容丰富15元包6G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_SXYW_PPTV:
$order->title = 'PPTV无广告流畅收看内容丰富15元包6G';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_LYJHXJ:
$order->title = '老友季焕新机';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_D12_IPHONE6:
$order->title = '苹果iPhone6';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_D12_HONGMI_NOTE:
$order->title = '红米Note';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_D12_HUAWEI_MATE7:
$order->title = '华为Mate7';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_D12_45G_SHANGWANGKA:
$order->title = '45G上网卡';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_D12_96G_SHANGWANGKA:
$order->title = '96G上网卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_4GTAOCAN:
$order->title = '4G套餐';
$order->attr = "{$_GET['cardType']}";
break;

//doubledan
case MItem::ITEM_CAT_CARD_DD_100YUAN5G_SHANGWANGKA:
$order->title = '100元本地流量卡5G';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_DD_3GBANNIAN_SHANGWANGKA:
$order->title = '3G半年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_CARD_DD_6GNIANKA_SHANGWANGKA:
$order->title = '6G年卡';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_DD_IPHONE4S:
$order->title = '苹果 iPhone4S';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_DD_IPHONE5S:
$order->title = '苹果 iPhone5S 16GB';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_DD_HONOR6:
$order->title = '华为荣耀6';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_DD_XIAOMI4:
$order->title = '小米4';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_DD_SAMSUNGG5108Q:
$order->title = '三星G5108Q';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_DD_SAMSUNGNOTE3:
$order->title = '三星Note3';
$order->attr = "{$_GET['cardType']}";
break;

//购机有优惠 2015-3-20
case MItem::ITEM_CAT_MOBILE_OPPOR830S:
$order->title = 'OPPO R830S';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_MOBILE_LIANGXIANGA399:
$order->title = '联想 A399';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5:
$order->title = '中兴 V5';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_MOBILE_HONGMI2:
$order->title = '红米2';
$order->attr = "{$_GET['cardType']}";
break;

//双4G双百兆手机
case MItem::ITEM_CAT_MOBILE_MEILANNOTE_16G:
$order->title = '魅蓝note 16G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_MEIZUMX4_16G:
$order->title = '魅族 MX4';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_IPHONE6_16G:
$order->title = 'iPhone6 16G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_IPHONE6PLUS_16G:
$order->title = 'iPhone6 Plus 16G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_IPHONE6_64G:
$order->title = 'iPhone6 64G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_IPHONE6_128G:
$order->title = 'iPhone6 128G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_IPHONE6PLUS_64G:
$order->title = 'iPhone6 Plus 64G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5S:
$order->title = '中兴V5S';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_HUAWEI_MT7:
$order->title = '华为 Mate7';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE4S_8G:
$order->title = 'iPhone4S 8G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE5C_8G:
$order->title = 'iPhone5C 8G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE6_16G:
$order->title = 'iPhone6 16G';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_G5108Q:
$order->title = '三星 G5108Q';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_9006V:
$order->title = '三星 9006V';
$order->attr = "{$_GET['cardType']}";
break;


//老用户户专享 参与机型及优惠合约
case MItem::ITEM_CAT_MOBILE_SANXIN_SM_G9006VW:
$order->title = '三星SM-G9006V/W';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_HTC_ONE:
$order->title = 'HTC One';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_ZHONGXING_Q801U:
$order->title = '中兴 Q801U';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_LIANXIANG_A606:
$order->title = '联想A606';
$order->attr = "{$_GET['cardType']}";
break;
case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5S_1:
$order->title = '中兴V5S';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_KIND_INTERNET_CARD_FLOW100MB_GUONEI:
$order->title = '10元包100M 3G国内流量包';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_KIND_INTERNET_CARD_FLOW300MB_GUONEI:
$order->title = '20元包300M 3G国内流量包';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_KIND_INTERNET_CARD_FLOW500MB_GUONEI:
$order->title = '30元包500M 3G国内流量包';
$order->attr = "{$_GET['cardType']}";
break;

case MItem::ITEM_KIND_ZZYW:
$order->title = '增值业务';
$order->attr = "{$_GET['cardType']}";
break;

default:
U::W(['invalid data cat', $_GET["cid"], __METHOD__,$_GET]);
return;
}

$order->val_pkg_3g4g = isset($_GET['pkg3g4g']) ? $_GET['pkg3g4g'] : '';
$order->val_pkg_period = isset($_GET['pkgPeriod']) ? $_GET['pkgPeriod'] : 0;
$order->val_pkg_monthprice = isset($_GET['pkgMonthprice']) ? $_GET['pkgMonthprice'] : 0;
$order->val_pkg_plan = isset($_GET['pkgPlan']) ? $_GET['pkgPlan'] : '';
$order->feesum = $_GET['feeSum'] * 100;

//订购流量包时，不需用户选择营业厅， 直接指定新华路营业厅
if($_GET["cid"]== 702 || $_GET["cid"]== 703 || $_GET["cid"]== 704)
{
$order->office_id = 16;
}
else
{
$order->office_id = (isset($_GET['office']) && $_GET['office'] !=  MOrder::NO_CHOICE) ? $_GET['office'] : 0;
}


$order->userid = (isset($_GET['userid']) && $_GET['userid'] !=  MOrder::NO_CHOICE) ? $_GET['userid'] : '';
$order->username = (isset($_GET['username']) && $_GET['username'] !=  MOrder::NO_CHOICE) ? $_GET['username'] : '';
$order->usermobile = (isset($_GET['usermobile']) && $_GET['usermobile'] !=  MOrder::NO_CHOICE) ? $_GET['usermobile'] : '';
//$order->pay_kind = isset($_GET['pay_kind']) ? $_GET['pay_kind'] : MOrder::PAY_KIND_CASH;
$order->address = (isset($_GET['address']) && $_GET['address'] !=  MOrder::NO_CHOICE) ? $_GET['address'] : '';
$order->kaitong = (isset($_GET['kaitong']) && $_GET['kaitong'] !=  MOrder::NO_CHOICE) ? $_GET['kaitong'] : '';

$order->memo = (isset($_GET['memo']) && $_GET['memo'] !=  MOrder::NO_CHOICE) ? $_GET['memo'] : '';

$order->detail = $order->getDetailStr();
if ($_GET['selectNum'] != MOrder::NO_CHOICE)
{
$order->select_mobnum = $_GET['selectNum'];
$mobnum = MMobnum::findOne($_GET['selectNum']);
if ($mobnum === null ||$mobnum->status != MMobnum::STATUS_UNUSED)
{
return json_encode(['status'=>1, 'errmsg'=>$mobnum === null ? "mobile doest not exist" : "mobile locked!"] );
}
}
else
{
$order->select_mobnum = '';
}

$wid = Yii::$app->request->get('wid', '');
if (!empty($wid))
{
list($scene_id, $scene_src_id) = explode('_', $wid);
$order->scene_id = $scene_id;
$order->scene_src_id = $scene_src_id;
if(empty($order->item))
U::W("@@@@@@@@@@@@@@@@@@@NULL@@@@@@@@@@@@@@@@@@@@@@@@@@@");
$order->scene_amt = $order->feesum * $order->item->scene_percent /100;
}

if ($order->save(false))
{
if (isset($mobnum))
{
$mobnum->status = MMobnum::STATUS_LOCKED;
$mobnum->locktime = time();
$mobnum->save(false);
}

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
if ($manager !== null && !empty($manager->openid))
{
//U::W('sendWxm');
//$manager->sendWxm($order->getWxNoticeToManager());
//U::W('sendSm');
//$manager->sendSm($order->getSmNoticeToManager());
$arr = $order->sendTemplateNoticeToManager($manager);
} else {
U::W(['Have no manager or the manager has not binded openid', $order]);
}

// send wx message to user
//$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice()]]);
$arr = $order->sendTemplateNoticeToCustom();
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

return json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]);
}
 */

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/prodsave:gh_1ad98f5481f3
    public function actionProdsave() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $order = new MOrder;
        $order->oid = MOrder::generateOid();
        $order->gh_id = $gh_id;
        $order->openid = $openid;
        $order->cid = $_GET["cid"];

        switch ($_GET["cid"]) {
            case MItem::ITEM_CAT_DIY:
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
                $order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_K1:
                $order->title = 'K1';
                $order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_HTC516:
                $order->title = 'HTC516';
                $order->attr = "{$_GET['modelColor']}, {$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_GOODNUMBER:
                $order->title = '精选靓号';
                $order->attr = "{$_GET['planFlag']}, {$_GET['plan66']}, {$_GET['plan96']}, {$_GET['plan126']}";
                break;
            case MItem::ITEM_CAT_MOBILE_APPLE_5C_8G_WHITE:
                $order->title = '苹果5C 8G 白色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_APPLE_5C_8G_BLUE:
                $order->title = '苹果5C 8G 蓝色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_HTC_8160_SILVER:
                $order->title = 'HTC 8160 银色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_SAMSUNG_7506V_BLACK:
                $order->title = '三星 7506V 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7298A_CHUNLEI_WHITE:
                $order->title = '酷派 7298A 春雷 白色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_LENOVOA_A850_BLACK:
                $order->title = '联想 A850+ 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7295C_WHITE:
                $order->title = '酷派 7295C 白色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_APPLE_5S_32G_SILVER:
                $order->title = '苹果 5S 32G 银色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7296_BLACK:
                $order->title = '酷派 7296 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7296_WHITE:
                $order->title = '酷派 7296 白色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_K1_WHITE:
                $order->title = '酷派 K1 白色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7235_BLACK:
                $order->title = '酷派 7235 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7230S_BLACK:
                $order->title = '酷派 7230S 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_HISENSE_U939:
                $order->title = '海信 U939';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_COOLPAD_7295C_BLACK:
                $order->title = '酷派 7295C 黑色';
                $order->attr = "{$_GET['prom']}";
                break;
            case MItem::ITEM_CAT_MOBILE_XIAOMI4:
                $order->title = '小米4';
                $order->attr = "{$_GET['prom']}";
                break;

            //双十一活动 手机 begin
            //----------------------------------------------------------
            //ITEM_CAT_MOBILE_IPHONE4S iPhone 4S  8GB GSM  =12
            //ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE 荣耀6 =328
            //ITEM_CAT_MOBILE_XIAOMI4 小米4 =331
            //const ITEM_CAT_APPLE_5S_16G = 332;
            //const ITEM_CAT_APPLE_6_16G = 333;
            //const ITEM_CAT_MOBILE_XIAOMI_HM_NOTE = 334;
            //const ITEM_CAT_MOBILE_SONY_S55U = 335;
            //const ITEM_CAT_MOBILE_XIAOMI_HM_1S = 336;

            case MItem::ITEM_CAT_APPLE_5S_16G:
                $order->title = 'APPLE 苹果 iPhone5S';
                $order->attr = "{$_GET['prom']}";
                break;

            case MItem::ITEM_CAT_APPLE_6_16G:
                $order->title = 'APPLE 苹果 iPhone6';
                $order->attr = "{$_GET['prom']}";
                break;

            case MItem::ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE:
                $order->title = '华为HuaWei 荣耀6';
                $order->attr = "{$_GET['prom']}";
                break;

            case MItem::ITEM_CAT_MOBILE_XIAOMI_HM_NOTE:
                $order->title = '红米Note';
                $order->attr = "{$_GET['prom']}";
                break;

            case MItem::ITEM_CAT_MOBILE_SONY_S55U:
                $order->title = 'SONY 索尼 S55u';
                $order->attr = "{$_GET['prom']}";
                break;

            case MItem::ITEM_CAT_MOBILE_XIAOMI_HM_1S:
                $order->title = '红米1S';
                $order->attr = "{$_GET['prom']}";
                break;

            // 双十一活动 手机 end

            case MItem::ITEM_CAT_CARD_45GLIULIANG:
                $order->title = '45G包年流量套餐';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_96GLIULIANG:
                $order->title = '96G包年流量套餐';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_120GLIULIANG:
                $order->title = '120G流量上网卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_240GLIULIANG:
                $order->title = '240G流量上网卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_60YUANBAO5G_SHANGWANGKA:
                $order->title = '60元包5G上网卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            //双十一活动 上网卡 begin
            //----------------------------------------------------------
            //const ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG = 708;
            //const ITEM_CAT_CARD_1111_3GLIULIANG = 709;
            //const ITEM_CAT_CARD_1111_6GLIULIANG = 710;
            //const ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG = 711;
            //const ITEM_CAT_CARD_1111_45GLIULIANG = 712;
            //const ITEM_CAT_CARD_1111_96GLIULIANG = 713;
            case MItem::ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG:
                $order->title = '200元本地流量卡5G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_1111_3GLIULIANG:
                $order->title = '3G半年卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_1111_6GLIULIANG:
                $order->title = '6G年卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG:
                $order->title = '100元本地流量卡5G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_1111_45GLIULIANG:
                $order->title = '45G包年卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_1111_96GLIULIANG:
                $order->title = '96G包年卡';
                $order->attr = "{$_GET['cardType']}";
                break;
            //双十一活动 上网卡 end

            case MItem::ITEM_KIND_INTERNET_CARD_FLOW100MB:
                $order->title = '10元包100MB 3G省内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW300MB:
                $order->title = '20元包300MB 3G省内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW500MB:
                $order->title = '30元包500MB 3G省内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW1GB_1:
                $order->title = '50元包1G 3G省内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW2DOT5GB:
                $order->title = '100元包2.5G 3G省内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW1GB_2:
                $order->title = '100元包1G 全国流量半年包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_FLOW_FREE:
                $order->title = '拼人品 抢流量包';
                $order->attr = "{$_GET['cardType']}";

                $ar = MOrder::find()->where("gh_id = :gh_id AND usermobile = :usermobile AND cid = :cid", [':gh_id' => $gh_id, ':usermobile' => $_GET["usermobile"], ':cid' => $_GET["cid"]])->one();
                if ($ar !== null) {
                    //U::W([$_GET, $_POST, $ar->getErrors()]);
                    //Yii::$app->session->setFlash('success','手机号码已参加!');
                    //return $this->refresh();
                    return;
                }

                $user_founder = MWinMobileNum::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                $user_founder->finished = 1;
                $user_founder->save();

                break;

            case MItem::ITEM_KIND_INTERNET_CARD_300YUANSHICHANGBANNIANKA:
                $order->title = '300元时长半年卡';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_600YUANSHICHANGNIANKA:
                $order->title = '600元时长年卡';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_KIND_INTERNET_CARD_1200YUANSHICHANGNIANKA:
                $order->title = '1200元时长年卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_SXYW_WKHB:
                $order->title = '沃看湖北可看在线卫视及各种栏目10元包6G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_SXYW_AIQIYI10:
                $order->title = '爱奇艺内容丰富10元包2.5G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_SXYW_AIQIYI15:
                $order->title = '爱奇艺内容丰富15元包6G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_SXYW_PPTV:
                $order->title = 'PPTV无广告流畅收看内容丰富15元包6G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_LYJHXJ:
                $order->title = '老友季焕新机';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_D12_IPHONE6:
                $order->title = '苹果iPhone6';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_D12_HONGMI_NOTE:
                $order->title = '红米Note';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_D12_HUAWEI_MATE7:
                $order->title = '华为Mate7';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_D12_45G_SHANGWANGKA:
                $order->title = '45G上网卡';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_D12_96G_SHANGWANGKA:
                $order->title = '96G上网卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_4GTAOCAN:
                $order->title = '4G套餐';
                $order->attr = "{$_GET['cardType']}";
                break;

            //doubledan
            case MItem::ITEM_CAT_CARD_DD_100YUAN5G_SHANGWANGKA:
                $order->title = '100元本地流量卡5G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_DD_3GBANNIAN_SHANGWANGKA:
                $order->title = '3G半年卡';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_CARD_DD_6GNIANKA_SHANGWANGKA:
                $order->title = '6G年卡';
                $order->attr = "{$_GET['cardType']}";
                break;
                
            case MItem::ITEM_CAT_CARD_4GQGSJTC6GBNB:
                $order->title = '4G全国数据套餐6G半年包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_CARD_4GQGSJTC12GBNB:
                $order->title = '4G全国数据套餐12G半年包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_CARD_4GQGSJTC17GBNB:
                $order->title = '4G省内数据套餐17G半年包';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_CARD_45GBNLLTC:
                $order->title = '45G包年流量套餐';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_CARD_600YSCNK:
                $order->title = '600元时长年卡';
                $order->attr = "{$_GET['cardType']}";
                break;                                          

            case MItem::ITEM_CAT_DD_IPHONE4S:
                $order->title = '苹果 iPhone4S';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_DD_IPHONE5S:
                $order->title = '苹果 iPhone5S 16GB';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_DD_HONOR6:
                $order->title = '华为荣耀6';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_DD_XIAOMI4:
                $order->title = '小米4';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_DD_SAMSUNGG5108Q:
                $order->title = '三星G5108Q';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_DD_SAMSUNGNOTE3:
                $order->title = '三星Note3';
                $order->attr = "{$_GET['cardType']}";
                break;

            //购机有优惠 2015-3-20
            case MItem::ITEM_CAT_MOBILE_OPPOR830S:
                $order->title = 'OPPO R830S';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LIANGXIANGA399:
                $order->title = '联想 A399';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5:
                $order->title = '中兴 V5';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_HONGMI2:
                $order->title = '红米2';
                $order->attr = "{$_GET['cardType']}";
                break;

            //双4G双百兆手机
            case MItem::ITEM_CAT_MOBILE_MEILANNOTE_16G:
                $order->title = '魅蓝note 16G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_MEIZUMX4_16G:
                $order->title = '魅族 MX4';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_IPHONE6_16G:
                $order->title = 'iPhone6 16G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_IPHONE6PLUS_16G:
                $order->title = 'iPhone6 Plus 16G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_IPHONE6_64G:
                $order->title = 'iPhone6 64G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_IPHONE6_128G:
                $order->title = 'iPhone6 128G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_IPHONE6PLUS_64G:
                $order->title = 'iPhone6 Plus 64G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5S:
                $order->title = '中兴V5S';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_HUAWEI_MT7:
                $order->title = '华为 Mate7';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE4S_8G:
                $order->title = 'iPhone4S 8G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE5C_8G:
                $order->title = 'iPhone5C 8G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE6_16G:
                $order->title = 'iPhone6 16G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_G5108Q:
                $order->title = '三星 G5108Q';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_9006V:
                $order->title = '三星 9006V';
                $order->attr = "{$_GET['cardType']}";
                break;

            //双4G双百兆手机 5.1 活动
            case MItem::ITEM_CAT_MOBILE_4G_LIANGXIANG_A3600:
                $order->title = '联想A3600';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_KUPAI_7061:
                $order->title = '酷派7061';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_KUPAI_Y76:
                $order->title = '酷派y76';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_XIAOMI_4G:
                $order->title = '小米4（4G）';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_HTC_820U:
                $order->title = 'HTC 820U';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_IPHONE6_16G:
                $order->title = 'iPhone6 (16G)';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_SANXING_N9106W:
                $order->title = '三星N9106W';
                $order->attr = "{$_GET['cardType']}";
                break;
            //双4G双百兆手机 7.22 cid from 4000
            case MItem::ITEM_CAT_MOBILE_4G_KAMEIOU_C6:
                $order->title = '卡美欧 C6';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_FEIXUN_C630LW:
                $order->title = '斐讯 C630Lw';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_TCL_P502U:
                $order->title = 'TCL P502U';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_FEIXUN_E653:
                $order->title = '斐讯 E653';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_XIAOLAJIAO_LA2S:
                $order->title = '小辣椒 LA2S';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_IPHONE6PLUS_16G:
                $order->title = 'iPhone6 Plus 16G';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_4G_IPHONE6S:
                $order->title = 'iPhone6s';
                $order->attr = "{$_GET['cardType']}";
                break;


            //老用户户专享 参与机型及优惠合约
            case MItem::ITEM_CAT_MOBILE_SANXIN_SM_G9006VW:
                $order->title = '三星SM-G9006V/W';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_HTC_ONE:
                $order->title = 'HTC One';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_ZHONGXING_Q801U:
                $order->title = '中兴 Q801U';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_LIANXIANG_A606:
                $order->title = '联想A606';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_MOBILE_ZHONGXINGV5S_1:
                $order->title = '中兴V5S';
                $order->attr = "{$_GET['cardType']}";
                break;

            //老用户户专享 6.18
            case MItem::ITEM_CAT_MOBILE_LYH_IPHONE6PLUS_128GB:
                $order->title = 'iPhone6+ 128G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_KUPAI_Y76:
                $order->title = '酷派 Y76';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_XIAOMI4_4G:
                $order->title = '小米手机4 联通4G';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_HONGMI2_4G:
                $order->title = '红米手机2 联通4G双卡版';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_HONGMINOTE_4G:
                $order->title = '红米NOTE 4G双卡双待';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_CFSF:
                $order->title = '存费送费 5折优惠';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LYH_CFSYW:
                $order->title = '存费送业务 5折优惠';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_MOBILE_LESHI1:
                $order->title = '乐视（Letv）乐1';
                $order->attr = "{$_GET['cardType']}";
                break;
            //老用户户专享 6.18 end
            //6.30 
            case MItem::ITEM_CAT_MOBILE_LYH_KUPAI_K1:
                $order->title = '酷派K1 （7260）';
                $order->attr = "{$_GET['cardType']}";
                break;   

            case MItem::ITEM_CAT_MOBILE_LYH_HUAWEI_MT7:
                $order->title = '华为MT7';
                $order->attr = "{$_GET['cardType']}";
                break;                 

            case MItem::ITEM_CAT_MOBILE_LYH_LESHI1:
                $order->title = '乐视乐1';
                $order->attr = "{$_GET['cardType']}";
                break;  

            case MItem::ITEM_CAT_MOBILE_LYH_RONGYAO_4X_HI:
                $order->title = '荣耀4X（高配版）';
                $order->attr = "{$_GET['cardType']}";
                break; 

            case MItem::ITEM_CAT_MOBILE_LYH_RONGYAO_4X_ST:
                $order->title = '荣耀4X（标配版）';
                $order->attr = "{$_GET['cardType']}";
                break; 

            case MItem::ITEM_CAT_MOBILE_LYH_IPHONE4S_8GB:
                $order->title = 'iPhone4S 8GB';
                $order->attr = "{$_GET['cardType']}";
                break; 
                
            case MItem::ITEM_CAT_MOBILE_LYH_IPHONE5S_16GB:
                $order->title = 'iPhone5S 16GB';
                $order->attr = "{$_GET['cardType']}";
                break;                 
            //6.30 end
            case MItem::ITEM_CAT_MOBILE_LYH_HTC_8160:
                $order->title = 'HTC 8160';
                $order->attr = "{$_GET['cardType']}";
                break;  
            case MItem::ITEM_CAT_MOBILE_LYH_SAMSUNG_N9006:
                $order->title = '三星SM-N9006';
                $order->attr = "{$_GET['cardType']}";
                break;  
            case MItem::ITEM_CAT_MOBILE_LYH_KUPAI_7296:
                $order->title = '酷派 7296';
                $order->attr = "{$_GET['cardType']}";
                break;                  
            case MItem::ITEM_CAT_MOBILE_LYH_IPHONE_64G:
                $order->title = 'iPhone6 64G 灰色';
                $order->attr = "{$_GET['cardType']}";
                break; 
                

            case MItem::ITEM_KIND_INTERNET_CARD_FLOW100MB_GUONEI:
                $order->title = '10元包100M 3G国内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_KIND_INTERNET_CARD_FLOW300MB_GUONEI:
                $order->title = '20元包300M 3G国内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_KIND_INTERNET_CARD_FLOW500MB_GUONEI:
                $order->title = '30元包500M 3G国内流量包';
                $order->attr = "{$_GET['cardType']}";
                break;

            //惠购流量包 begin
            case MItem::ITEM_CAT_HGLLB_3G_GN_10Y100M:
                $order->title = '3G国内流量 10元 100M';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_HGLLB_3G_GN_20Y300M:
                $order->title = '3G国内流量 20元 300M';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_HGLLB_3G_GN_30Y500M:
                $order->title = '3G国内流量 30元 500M';
                $order->attr = "{$_GET['cardType']}";
                break;                
            case MItem::ITEM_CAT_HGLLB_3G_SN_10Y100M:
                $order->title = '3G省内流量 10元 100M';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_HGLLB_3G_SN_20Y300M:
                $order->title = '3G省内流量 20元 300M';
                $order->attr = "{$_GET['cardType']}";
                break;
            case MItem::ITEM_CAT_HGLLB_3G_SN_30Y500M:
                $order->title = '3G省内流量 30元 500M';
                $order->attr = "{$_GET['cardType']}";
                break;             

            case MItem::ITEM_CAT_HGLLB_WO_PPTV:
                $order->title = 'Wo+视频 PPTV定向流量包月';
                $order->attr = "{$_GET['cardType']}";
                break;      
            case MItem::ITEM_CAT_HGLLB_KG:
                $order->title = '酷狗';
                $order->attr = "{$_GET['cardType']}";
                break;    
            case MItem::ITEM_CAT_HGLLB_LHTX:
                $order->title = '漏话提醒';
                $order->attr = "{$_GET['cardType']}";
                break;    
            case MItem::ITEM_CAT_HGLLB_KJTX:
                $order->title = '开机提醒';
                $order->attr = "{$_GET['cardType']}";
                break;   
            case MItem::ITEM_CAT_HGLLB_4G_SN_BNB:
                $order->title = '4G省内半年包(100元包1.5G)';
                $order->attr = "{$_GET['cardType']}";
                break;   

            //惠购流量包 end
            case MItem::ITEM_CAT_HD_XYYHJ:
                $order->title = '校园优惠季';
                $order->attr = "{$_GET['cardType']}";
                break;   

            case MItem::ITEM_CAT_HD_LLB:
                $order->title = '流量宝';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_KIND_ZZYW:
                $order->title = '增值业务';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_KDTH_10MTC:
                $order->title = '智慧沃家 10M套餐';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_KDTH_20MTC:
                $order->title = '智慧沃家 20M套餐';
                $order->attr = "{$_GET['cardType']}";
                break;

            case MItem::ITEM_CAT_KDTH_50MTC:
                $order->title = '智慧沃家 50M套餐';
                $order->attr = "{$_GET['cardType']}";
                break;
            
            case MItem::ITEM_CAT_KDTH_100MTCA:
                $order->title = '智慧沃家 100M套餐A';
                $order->attr = "{$_GET['cardType']}";
                break;
            
            case MItem::ITEM_CAT_KDTH_100MTCB:
                $order->title = '智慧沃家 100M套餐B';
                $order->attr = "{$_GET['cardType']}";
                break;
                

            default:
                U::W(['invalid data cat', $_GET["cid"], __METHOD__, $_GET]);
                return;
        }

        $order->val_pkg_3g4g = isset($_GET['pkg3g4g']) ? $_GET['pkg3g4g'] : '';
        $order->val_pkg_period = isset($_GET['pkgPeriod']) ? $_GET['pkgPeriod'] : 0;
        $order->val_pkg_monthprice = isset($_GET['pkgMonthprice']) ? $_GET['pkgMonthprice'] : 0;
        $order->val_pkg_plan = isset($_GET['pkgPlan']) ? $_GET['pkgPlan'] : '';
        $order->feesum = $_GET['feeSum'] * 100;

        //订购流量包时，不需用户选择营业厅， 直接指定新华路营业厅
        if ($_GET["cid"] == 702 || $_GET["cid"] == 703 || $_GET["cid"] == 704) {
            $order->office_id = 16;
        } else {
            $order->office_id = (isset($_GET['office']) && $_GET['office'] != MOrder::NO_CHOICE) ? $_GET['office'] : 0;
        }

        $order->userid = (isset($_GET['userid']) && $_GET['userid'] != MOrder::NO_CHOICE) ? $_GET['userid'] : '';
        $order->username = (isset($_GET['username']) && $_GET['username'] != MOrder::NO_CHOICE) ? $_GET['username'] : '';
        $order->usermobile = (isset($_GET['usermobile']) && $_GET['usermobile'] != MOrder::NO_CHOICE) ? $_GET['usermobile'] : '';
        //$order->pay_kind = isset($_GET['pay_kind']) ? $_GET['pay_kind'] : MOrder::PAY_KIND_CASH;
        $order->address = (isset($_GET['address']) && $_GET['address'] != MOrder::NO_CHOICE) ? $_GET['address'] : '';
        $order->kaitong = (isset($_GET['kaitong']) && $_GET['kaitong'] != MOrder::NO_CHOICE) ? $_GET['kaitong'] : '';

        $order->memo = (isset($_GET['memo']) && $_GET['memo'] != MOrder::NO_CHOICE) ? $_GET['memo'] : '';

        $order->detail = $order->getDetailStr();
        if ($_GET['selectNum'] != MOrder::NO_CHOICE) {
            $order->select_mobnum = $_GET['selectNum'];
            $mobnum = MMobnum::findOne($_GET['selectNum']);
            if ($mobnum === null || $mobnum->status != MMobnum::STATUS_UNUSED) {
                return json_encode(['status' => 1, 'errmsg' => $mobnum === null ? "mobile doest not exist" : "mobile locked!"]);
            }
        } else {
            $order->select_mobnum = '';
        }

        $wid = Yii::$app->request->get('wid', '');
        if (!empty($wid)) {
            list($scene_id, $scene_src_id) = explode('_', $wid);
            $order->scene_id = $scene_id;
            $order->scene_src_id = $scene_src_id;
            if (empty($order->item)) {
                U::W("@@@@@@@@@@@@@@@@@@@NULL@@@@@@@@@@@@@@@@@@@@@@@@@@@");
            }

            $order->scene_amt = $order->feesum * $order->item->scene_percent / 100;
        }

        if ($order->save(false)) {
            if (isset($mobnum)) {
                $mobnum->status = MMobnum::STATUS_LOCKED;
                $mobnum->locktime = time();
                $mobnum->save(false);
            }

            // clear win flag
            $model = MDisk::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
            if ($model !== null) {
                $model->cnt = 0;
                $model->win = 0;
                $model->win_time = 0;
                $model->save(false);
            }


//send wx message and sm
$manager = MStaff::findOne(['office_id'=>$order->office_id, 'is_manager'=>1]);
if ($manager !== null && !empty($manager->openid))
{
//U::W('sendWxm');
$manager->sendWxm($order->getWxNoticeToManager());
//U::W('sendSm');
//$manager->sendSm($order->getSmNoticeToManager());
try {
$arr = $order->sendTemplateNoticeToManager($manager);
} catch(\Exception $e) {
U::W($e->getMessage());
}

} else {
U::W(['Have no manager or the manager has not binded openid', $order]);
}

/*

// send wx message to user
//$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$openid, 'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice()]]);
$arr = $order->sendTemplateNoticeToCustom();
 */

        } else {
            U::W([__METHOD__, $order->getErrors()]);
        }

        $jsApiParameters = $order->GetOrderJsApiParameters();
        return json_encode(['oid' => $order->oid, 'status' => 0, 'pay_url' => $jsApiParameters]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=mobileNum&currentPage=1&cid=10&feeSum=1
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=diskRestCnt&cid=10
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=orderview&oid=53de91f9d3773
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=g2048Save&bigNum=1&best=2&score=100
    public function actionAjaxdata($cat) {
        //if (!Yii::$app->request->isAjax)
        //    return;
        $this->layout = false;
        switch ($cat) {
            case 'orderclose':
                $oid = isset($_GET["oid"]) ? $_GET["oid"] : 1;
                $model = MOrder::findOne($oid);
                if ($model === null) {
                    U::D(["invalid oid:$oid", __METHOD__]);
                }

                $model->status = MOrder::STATUS_BUYER_CLOSED;
                if ($model->save(true, ['status'])) {
                    $mobnum = MMobnum::findOne($model->select_mobnum);
                    if ($mobnum !== null) {
                        $mobnum->status = MMobnum::STATUS_UNUSED;
                        $mobnum->save(false);
                    }
                    $data['code'] = 0;
                } else {
                    return json_encode(['code' => 1, 'errmsg' => 'save db error']);
                }

                break;

            case 'orderview':
                $oid = isset($_GET["oid"]) ? $_GET["oid"] : 1;
                $data = MOrder::find()->select('*')->where("oid=:oid", [':oid' => $oid])->asArray()->one();
                $data['statusName'] = MOrder::getOrderStatusName($data['status']);
                $order = MOrder::findOne($oid);
                if ($order->status == MOrder::STATUS_SUBMITTED) {
                    $jsApiParameters = $order->GetOrderJsApiParameters();
                    $data['url'] = $jsApiParameters;
                } else {
                    $data['url'] = '';
                }
                break;

            case 'myorder':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                $page = isset($_GET["currentPage"]) ? $_GET["currentPage"] : 1;
                $size = isset($_GET['size']) ? $_GET['size'] : 8;
                $data = MOrder::find()->select('*')->where("gh_id=:gh_id AND openid=:openid AND status!=:status", [':gh_id' => $gh_id, ':openid' => $openid, ':status' => MOrder::STATUS_DRAFT])->orderBy(['oid' => SORT_DESC])->offset(($page - 1) * $size)->limit($size)->asArray()->all();
                foreach ($data as &$row) {
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
                $data = MOrder::find()->select('*')->where("gh_id=:gh_id AND office_id=:office_id", [':gh_id' => $gh_id, ':office_id' => $office_id])->orderBy([$orderby => $asc == 1 ? SORT_ASC : SORT_DESC])->offset(($page - 1) * $size)->limit($size)->asArray()->all();
                foreach ($data as &$row) {
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
                $data = MMobnum::find()->select('num,ychf,zdxf')->where("status=:status AND num_cat=:num_cat AND zdxf <= :zdxf", [':status' => MMobnum::STATUS_UNUSED, ':num_cat' => $num_cat, ':zdxf' => $feeSum])->offset(($page - 1) * $size)->limit($size)->asArray()->all();
                break;

            case 'diskclick':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                $model = MDisk::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                if ($model === null) {
                    $model = MDisk::initDefault($gh_id, $openid);
                } else if ($model->cnt > 0) {
                    $model->cnt = $model->cnt - 1;
                } else {
                    return json_encode(['code' => 1, 'errmsg' => 'has no qualification']);
                }

                $data = U::makeDiskResult();
                if ($data['code'] == 0) {
                    if ($data['value'] % 2 == 0) {
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
                $model = MDisk::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                if ($model === null) {
                    $model = MDisk::initDefault($gh_id, $openid);
                    $model->save(false);
                    $model = MDisk::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                }
                $data = $model->getAttributes();
                $cur_time = time();
                if ($model->win == 1 && $cur_time - $model->win_time < 30 * 60) {
                    $alreadyWin = 1;
                } else {
                    $alreadyWin = 0;
                }

                $data['alreadyWin'] = $alreadyWin;
                $data['code'] = 0;
                break;

            case 'g2048Save':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                Yii::$app->wx->setGhId($gh_id);
                $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                if ($user === null) {
                    $user = new MUser;
                }

                if (!empty($user->subscribe)) {
                    $model = new \app\models\MG2048;
                    $model->gh_id = $gh_id;
                    $model->openid = $openid;
                    $model->best = $_GET['best'];
                    $model->score = $_GET['score'];
                    $model->big_num = $_GET['bigNum'];
                    if (!$model->save(false)) {
                        U::W([__METHOD__, $model->getErrors()]);
                        return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                    }
                }
                $data['code'] = 0;
                $data['isSubscribed'] = empty($user->subscribe) ? 0 : 1;
                $data['position'] = MG2048::getCurrentScorePosition($gh_id, $_GET['score']);
                break;

            case 'getnearestoffice':
                $gh_id = U::getSessionParam('gh_id');
                $lat = $_GET["lat"];
                $lon = $_GET["lon"];
                $rows = MOffice::getNearestOffices($gh_id, $lon, $lat);
                U::W($rows);
                $data['code'] = 0;
                $data['offices'] = $rows;
                break;

            case 'pkginfo':
                $gh_id = U::getSessionParam('gh_id');
                $cid = isset($_GET["cid"]) ? $_GET["cid"] : MItem::ITEM_CAT_MOBILE_APPLE_5S_32G_SILVER;
                $pkg3g4g = isset($_GET["pkg3g4g"]) ? $_GET["pkg3g4g"] : '';
                $period = isset($_GET["pkgPeriod"]) ? $_GET["pkgPeriod"] : 12;
                $monthprice = isset($_GET["pkgMonthprice"]) ? $_GET["pkgMonthprice"] : 46;
                $plan = $_GET["pkgPlan"] == 'null' ? '' : $_GET["pkgPlan"];

                //$data = MPkg::find()->select('*')->where(
                //    "gh_id=:gh_id AND cid=:cid AND pkg3g4g=:pkg3g4g AND period=:period AND monthprice=:monthprice AND plan=:plan",
                //    [':gh_id'=>$gh_id, ':cid'=>$cid, ':pkg3g4g'=>$pkg3g4g, ':period'=>$period, ':monthprice'=>$monthprice, ':plan'=>$plan])->asArray()->one();

                $data = MPkg::find()->select('*')->where(
                    "gh_id=:gh_id AND cid=:cid AND pkg3g4g=:pkg3g4g AND period=:period AND monthprice=:monthprice",
                    [':gh_id' => $gh_id, ':cid' => $cid, ':pkg3g4g' => $pkg3g4g, ':period' => $period, ':monthprice' => $monthprice])->asArray()->one();

                //foreach($data as &$row)
                //{
                //    $row['statusName'] = MOrder::getOrderStatusName($row['status']);
                //}
                //unset($row);
                break;

            case 'wlinfo':
                U::W("++++++++++++++++++++++++++++++++++++++");
                $wl_url_1 = isset($_GET["wl_url_1"]) ? $_GET["wl_url_1"] : '';
                $wl_url_2 = isset($_GET["wl_url_2"]) ? $_GET["wl_url_2"] : '';

                $wl_url = "http://www.kuaidi100.com/query?type=" . $wl_url_1 . "&postid=" . $wl_url_2;
                //U::W($wl_url);
                $data = file_get_contents($wl_url);
                //$data = substr($lucy_msg, 14, -2);
                $data = json_decode($data, true);
                //U::W($data);
                break;

            case 'woketixian':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                U::W("----------assdfsdf1-----------");
                U::W($openid);
                Yii::$app->wx->setGhId($gh_id);
                $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

                $model = new \app\models\MSceneDetail;
                $model->gh_id = $gh_id;
                $model->openid = $openid;
                $model->scene_id = $user->scene_id;
                $model->scene_amt = (-1) * $_GET['ljtx'];
                $model->memo = $_GET['memo'];
                $model->czhm = $_GET['czhm'];

                if (!$model->save(false)) {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                }

                $user->scene_balance = $user->scene_balance - abs($model->scene_amt);
                if (!$user->save(false)) {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                }

                $data['ljtx'] = abs($model->scene_amt);
                break;

            case 'wokeqdyl':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                U::W("----------wokeqdyl-----------");
                U::W($openid);
                Yii::$app->wx->setGhId($gh_id);
                $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                U::W("$$$$$$$$$$$$$$$$$$$$$$$$$");
                U::W($user);

                $model = new \app\models\MSceneDetail;
                $model->gh_id = $gh_id;
                $model->openid = $openid;
                $model->scene_id = $user->scene_id;

                $money_max = 8;     //每日签到有礼，8个沃点封顶；
                if ($user->sign_money == 0)     //第1次签到;
                {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = 1;
                } else if (strtotime(date("Y-m-d")) - strtotime($user->sign_time) < 1)     //签到只能一天一次
                {
                    //$user->sign_time = date("Y-m-d");
                    //$user->sign_money = 1;
                    $data['sign_money'] = 'marked';
                    break;
                } else if ((strtotime(date("Y-m-d")) - strtotime($user->sign_time)) / 86400 > 1)     //超过一天未签到，
                {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = 1;
                } else {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = (2 * $user->sign_money > $money_max) ? $money_max : 2 * $user->sign_money;

                }

                $model->scene_amt = $user->sign_money;

                $model->memo = $_GET['memo'];
                $model->cat = MSceneDetail::CAT_SIGN;

                if (!$model->save(false)) {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                }

                //$user->scene_balance = $user->scene_balance + abs($model->scene_amt);

                if (!$user->save(false)) {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                }

                $data['sign_money'] = $user->sign_money;
                break;

            case 'czsjhm':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid');
                Yii::$app->wx->setGhId($gh_id);
                $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
                if ($user === null) {
                    $user = new MUser;
                }

                if (!empty($user->subscribe)) {
                    $user->gh_id = $gh_id;
                    $user->openid = $openid;

                    $user->user_account_charge_mobile = $_GET['czhm1'];
                    if (!$user->save(false)) {
                        U::W([__METHOD__, $user->getErrors()]);
                        return json_encode(['code' => 1, 'errmsg' => 'save score to db error']);
                    }
                }
                $data['czsjhm'] = $user->user_account_charge_mobile;
                break;

            default:
                U::W(['invalid data cat', $cat, __METHOD__, $_GET]);
                return;
        }
        U::W([$data]);
        U::W(json_encode($data));
        return json_encode($data);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mobilelist:gh_03a74ac96138
    public function actionMobilelist() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        //若非会员先跳到会员注册页面，先注册
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $models = MItem::find()->where(['kind' => MItem::ITEM_KIND_MOBILE])->orderBy(['price' => SORT_ASC])->all();
        $query = new \yii\db\Query();
        $query->select('*')->from(\app\models\MActivity::tableName())->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $rows = $query->createCommand()->queryAll();
        foreach ($models as &$model) {
            foreach ($rows as &$row) {
                $ids = explode(",", $row['iids']);
                if (in_array($model['iid'], $ids)) {
                    $model['price'] = ($model['price'] * $row['discount']) / 10;
                    $model['title_hint'] = "<span class='activity'>限时促销!</span>&nbsp;&nbsp;" . $model['title_hint'];
                }
            }
        }
        return $this->render('mobilelist', ['gh_id' => $gh_id, 'openid' => $openid, 'models' => $models]);
    }

    public function actionMobilelistxxx() {
        $this->layout = 'wapy';
//        $gh_id = U::getSessionParam('gh_id');
        //        $openid = U::getSessionParam('openid');

        $gh_id = MGh::GH_XIANGYANGUNICOM;
        $openid = MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;

        Yii::$app->wx->setGhId($gh_id);
        $models = MItem::find()->where(['kind' => MItem::ITEM_KIND_MOBILE])->orderBy(['price' => SORT_ASC])->all();
        $query = new \yii\db\Query();
        $query->select('*')->from(\app\models\MActivity::tableName())->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $rows = $query->createCommand()->queryAll();
        foreach ($models as &$model) {
            foreach ($rows as &$row) {
                $ids = explode(",", $row['iids']);
                if (in_array($model['iid'], $ids)) {
                    $model['price'] = ($model['price'] * $row['discount']) / 10;
                    $model['title_hint'] = "<span class='activity'>限时促销!</span>&nbsp;&nbsp;" . $model['title_hint'];
                }
            }
        }
        return $this->render('mobilelist', ['gh_id' => $gh_id, 'openid' => $openid, 'models' => $models]);
    }

    public function actionMobile() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $item = MItem::findOne(['gh_id' => $gh_id, 'cid' => $_GET['cid']]);
        return $this->render('mobile', ['cid' => $_GET['cid'], 'gh_id' => $gh_id, 'openid' => $openid, 'user' => $user, 'item' => $item]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardlist:gh_03a74ac96138
    public function actionCardlist() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        //若非会员先跳到会员注册页面，先注册
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        
        $kind = $_GET['kind'];
        $models = MItem::find()->where(['kind' => $kind])->orderBy(['price' => SORT_ASC])->all();
        return $this->render('cardlist', ['gh_id' => $gh_id, 'openid' => $openid, 'models' => $models, 'kind' => $kind]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/card:gh_03a74ac96138
    public function actionCard() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('card', ['cid' => $_GET['cid'], 'gh_id' => $gh_id, 'openid' => $openid]);
    }

    //惠购流量包20150827
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/hgllblist:gh_03a74ac96138
    public function actionHgllblist() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        //若非会员先跳到会员注册页面，先注册
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $kind = $_GET['kind'];
        $models = MItem::find()->where(['kind' => $kind])->orderBy(['cid' => SORT_ASC])->all();
        return $this->render('hgllblist', ['gh_id' => $gh_id, 'openid' => $openid, 'models' => $models, 'kind' => $kind]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/hgllb:gh_03a74ac96138
    public function actionHgllb() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('hgllb', ['cid' => $_GET['cid'], 'gh_id' => $gh_id, 'openid' => $openid]);
    }




    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/disk:gh_03a74ac96138
    public function actionDisk() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        return $this->render('games/disk/index');
    }

    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wap/disk1:gh_03a74ac96138#wechat_redirect
    public function actionDisk1() {
        $this->layout = false;
        
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $wx_user = \app\models\MUser::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
        ]);
        if (empty($wx_user) || $wx_user->subscribe === 0) {
            return $this->render('need_subscribe');
        }

        if (empty($wx_user->openidBindMobiles)) {
            $url = Url::to();
            Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        
        return $this->render('games/disk/index_new', [
            'observer' => $wx_user
        ]);

    }


    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/home:gh_03a74ac96138
    public function actionHome() {
        $this->layout = 'wap';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->session['gh_id'] = $gh_id;
        Yii::$app->session['openid'] = $openid;
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('home');
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/goodnumber:gh_03a74ac96138
    public function actionGoodnumber() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('goodnumber', ['cid' => MItem::ITEM_CAT_GOODNUMBER, 'gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_03a74ac96138
    public function actionOrder() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('order', ['user' => $user, 'gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/myorder:gh_03a74ac96138
    public function actionMyorder() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $orders = $user->getOrders();

        return $this->render('myorder', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user, 'orders' => $orders]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/myorderdetail:gh_03a74ac96138
    public function actionMyorderdetail() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $oid = $_GET['oid'];
        $order = MOrder::findOne(['oid' => $oid]);

        return $this->render('myorderdetail', ['user' => $user, 'order' => $order]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/officeorder:gh_03a74ac96138
    public function actionOfficeorder() {
        $this->layout = false;
        //    $gh_id = U::getSessionParam('gh_id');
        //    $openid = U::getSessionParam('openid');
        $staff_id = $_GET['staff_id'];

        $staff = MStaff::findOne(['staff_id' => $staff_id]);
        if (isset($_GET['office_id'])) {
            $office = MOffice::findOne(['office_id' => $_GET['office_id']]);
        } else {
            $office = $staff->office;
        }

//        $orders = MOrder::findBySql('select * from wx_order where office_id = :office_id and status != :status and create_time > DATE_SUB(NOW(), INTERVAL 7 day)',
        //            [':office_id' => $office->office_id, ':status' => MOrder::STATUS_DRAFT])
        //            ->all();
        $orders = MOrder::getOfficeOrders($office->office_id);

        return $this->render('officeorder', ['office' => $office, 'staff' => $staff, 'orders' => $orders]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/officeorderdetail:gh_03a74ac96138
    public function actionOfficeorderdetail() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        //$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);

        $office_id = $_GET['office_id'];
        $office = MOffice::findOne(['office_id' => $office_id]);

        $staff_id = $_GET['staff_id'];
        $staff = MStaff::findOne(['staff_id' => $staff_id]);

        $oid = $_GET['oid'];
        $order = MOrder::findOne(['oid' => $oid]);

        return $this->render('officeorderdetail', ['office' => $office, 'staff' => $staff, 'order' => $order]);
    }

    public function actionOrderxianxiapay($oid) {
        $order = MOrder::findOne(['oid' => $oid]);
        $order->pay_kind = MOrder::PAY_KIND_CASH;
        $order->save(false);
        return $this->redirect(['order', 'gh_id' => $order->gh_id, 'openid' => $order->openid]);
    }

    public function actionOrderchangestatusajax() {
        $oid = $_GET['oid'];
        $status = $_GET['status'];
        $order = MOrder::findOne(['oid' => $oid]);
        $status_old = $order->status;
        $pay_kind_old = $order->pay_kind;
        $order->status = $status;
        if ($order->save(false)) {
            $orderTrail = new MOrderTrail;
            $orderTrail->oid = $oid;
            $orderTrail->status_old = $status_old;
            $orderTrail->status_new = $order->status;
            $orderTrail->pay_kind_old = $pay_kind_old;
            $orderTrail->pay_kind_new = $order->pay_kind;
            $orderTrail->staff_id = empty($_GET['staff_id']) ? 0 : $_GET['staff_id'];
            $orderTrail->save(false);
        }
        return json_encode(['code' => 0]);
    }

    public function actionOrderrefundajax() {
        $oid = $_GET['oid'];
        $status = $_GET['status'];
        $order = MOrder::findOne(['oid' => $oid]);
        $status_old = $order->status;
        $pay_kind_old = $order->pay_kind;
        if ($order->refund($status)) {
            $orderTrail = new MOrderTrail;
            $orderTrail->oid = $oid;
            $orderTrail->status_old = $status_old;
            $orderTrail->status_new = $order->status;
            $orderTrail->pay_kind_old = $pay_kind_old;
            $orderTrail->pay_kind_new = $order->pay_kind;
            $orderTrail->staff_id = empty($_GET['staff_id']) ? 0 : $_GET['staff_id'];
            $orderTrail->save(false);
        }
        return json_encode(['code' => 0]);
    }

    public function actionHandlecallpayout() {
        $this->layout = false;
        $oid = $_GET['oid'];
        $order = MOrder::findOne(['oid' => $oid]);
        $status_old = $order->status;
        $pay_kind_old = $order->pay_kind;
        $order->status = MOrder::STATUS_SUBMITTED;
        $order->pay_kind = MOrder::PAY_KIND_WECHAT;
        if ($order->save(false)) {
            $orderTrail = new MOrderTrail;
            $orderTrail->oid = $oid;
            $orderTrail->status_old = $status_old;
            $orderTrail->status_new = $order->status;
            $orderTrail->pay_kind_old = $pay_kind_old;
            $orderTrail->pay_kind_new = $order->pay_kind;
            $orderTrail->staff_id = empty($_GET['staff_id']) ? 0 : $_GET['staff_id'];
            $orderTrail->save(false);
        }
        return json_encode(['code' => 0]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/nearestoffice:gh_03a74ac96138
    public function actionNearestoffice() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        return $this->render('nearestoffice', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/woke:gh_03a74ac96138
    public function actionWoke() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        //$openid = \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            throw new NotFoundHttpException('user does not exists');
        }

        if ((!empty($model->scene_id)) && (!empty($model->mobile))) {
            return $this->redirect(['wokelist']);
        }

        if (Yii::$app->request->isPost) {
            $model->setScenario('bind_mobile');
            $model->load(Yii::$app->request->post());
            if ($model->save(true, ['mobile', 'verifyCode'])) {
                $qr = $model->getQrImageUrl();
                return $this->redirect(['wokelist']);
            } else {
                U::W($model->getErrors());
            }
        }
        return $this->render('woke', ['gh_id' => $gh_id, 'openid' => $openid, 'model' => $model]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wokelist:gh_03a74ac96138:openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE
    public function actionWokelist() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($model->openidBindMobiles)) {
            $url = Url::to();
            Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt<0 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //可提现沃点
        $ktxwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=1 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //预期沃点
        $yqwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=0', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //预期沃点 包含粉丝取消关注
        $yqwd_fans_qx_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status<>1 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        U::W(count($yqwd_fans_qx_scenes));
        return $this->render('wokelist', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'scenes' => $scenes, 'ktxwd_scenes' => $ktxwd_scenes, 'yqwd_scenes' => $yqwd_scenes, 'yqwd_fans_qx_scenes' => $yqwd_fans_qx_scenes]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/tjyl:gh_03a74ac96138:openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE
    public function actionTjyl() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($model->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt<0 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //可提现沃点
        $ktxwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=1 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //预期沃点
        $yqwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=0', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        //预期沃点 包含粉丝取消关注
        $yqwd_fans_qx_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status<>1 ORDER BY create_time DESC', [':gh_id' => $gh_id, ':scene_id' => $model->scene_id])->all();

        U::W(count($yqwd_fans_qx_scenes));
        return $this->render('tjyl', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'scenes' => $scenes, 'ktxwd_scenes' => $ktxwd_scenes, 'yqwd_scenes' => $yqwd_scenes, 'yqwd_fans_qx_scenes' => $yqwd_fans_qx_scenes]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/rhtg:gh_03a74ac96138
    public function actionRhtg() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        /*
        if (empty($model->openidBindMobiles)) {
        Yii::$app->getSession()->set('RETURN_URL', Url::to());
        return $this->redirect(['addbindmobile', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
         */

        return $this->render('rhtg', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model]);
    }

    public static function getHyzxDateStart() {
        return U::getFirstDayOfLastMonth();
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/hyzx:gh_03a74ac96138
    public function actionHyzx() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($model->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        $scenes = $ktxwd_scenes = $yqwd_scenes = $yqwd_fans_qx_scenes = [];
        $date_start = static::getHyzxDateStart();
        $date_end = date("Y-m-d");
        //U::W("$date_start, $date_end");
        if (empty($model->staff)) {
            $model->getQrImageUrl();
            return $this->refresh();
        }
        $fans = $model->staff->getFansByRange($date_start, $date_end);
        $mobiledFans = $model->staff->getMobiledFansByRange($date_start, $date_end);
        return $this->render('hyzx', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'scenes' => $scenes, 'ktxwd_scenes' => $ktxwd_scenes, 'yqwd_scenes' => $yqwd_scenes, 'yqwd_fans_qx_scenes' => $yqwd_fans_qx_scenes, 'fans' => $fans, 'mobiledFans' => $mobiledFans]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wdkhjl:gh_03a74ac96138
    public function actionWdkhjl() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($model->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        $myManagers = $model->getManagers();
        //U::W($myManagers);
        return $this->render('wdkhjl', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'myManagers' => $myManagers]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/orderinfo:gh_03a74ac96138
    public function actionOrderinfo($oid) {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $model = MOrder::findOne($oid);
        if (\Yii::$app->request->isPost) {
            if (isset($_POST['paykind'])) {
                $_POST['MOrder']['pay_kind'] = $_POST['paykind'];
            }

            $model->setAttributes($_POST['MOrder'], false);

            $model->save(false);
            if ($model->pay_kind == MOrder::PAY_KIND_CASH) {
                $model->status = MOrder::STATUS_SUBMITTED;
                $model->save(false);
                //return $this->redirect(['wap/order']);
                //去新的订单页面
                return $this->redirect(['wap/myorder']);
            }

            if ($model->pay_kind == MOrder::PAY_KIND_ALIWAP) {
                $this->layout = false;
                //U::W($model->getAttributes());
                $alipay_config = Alipay::getAlipayConfig();
                $format = "xml";
                $v = "2.0";
                $req_id = uniqid();
                $notify_url = "http://wosotech.com/wx/web/alipaynotify.php";
                $call_back_url = "http://wosotech.com/wx/web/alipaycallback.php";
                $merchant_url = "http://wosotech.com/wx/web/alipaymerchant.php";
                $seller_email = 'wosotech@126.com';
                $out_trade_no = $model->oid;
                $subject = $model->detail;
                $total_fee = $model->feesum;
                $req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';
                $para_token = array(
                    "service" => "alipay.wap.trade.create.direct",
                    "partner" => trim($alipay_config['partner']),
                    "sec_id" => trim($alipay_config['sign_type']),
                    "format" => $format,
                    "v" => $v,
                    "req_id" => $req_id,
                    "req_data" => $req_data,
                    "_input_charset" => trim(strtolower($alipay_config['input_charset'])),
                );
                //U::W($para_token);
                $alipaySubmit = new AlipaySubmit($alipay_config);
                $html_text = $alipaySubmit->buildRequestHttp($para_token);
                //U::W($html_text);
                $html_text = urldecode($html_text);
                $arr = $alipaySubmit->parseResponse($html_text);
                if (!empty($arr['res_error'])) {
                    U::W($arr);
                    $msg = print_r($arr['res_error_arr'], true);
                    return $this->render('alipay_msg', ['msg' => $msg]);
                }
                //U::W($arr);
                $request_token = $arr['request_token'];
                $req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
                $parameter = array(
                    "service" => "alipay.wap.auth.authAndExecute",
                    "partner" => trim($alipay_config['partner']),
                    "sec_id" => trim($alipay_config['sign_type']),
                    "format" => $format,
                    "v" => $v,
                    "req_id" => $req_id,
                    "req_data" => $req_data,
                    "_input_charset" => trim(strtolower($alipay_config['input_charset'])),
                );
                $alipaySubmit = new AlipaySubmit($alipay_config);
                $html_text = $alipaySubmit->buildRequestForm($parameter, 'get', 'OK');
                return $this->render('alipay_submit', ['msg' => $html_text]);
            }
        }
        //$office = MOffice::findOne($model->office_id);
        $item = MItem::findOne(['gh_id' => $gh_id, 'cid' => $model->cid]);
        //$item = MItem::findOne($model->cid);

/*
$input = new WxPayUnifiedOrder();
$input->SetBody("test");
$input->SetAttach("test");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee("1");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
$input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openid);
$unifiedOrder = WxPayApi::unifiedOrder($input);
U::W($unifiedOrder);
$jsApiParameters = $this->GetJsApiParameters($unifiedOrder);
U::W($jsApiParameters);
 */
//        $jsApiParameters = $order->GetOrderJsApiParameters();
        $jsApiParameters = '';
        return $this->render('orderinfo', ['gh_id' => $gh_id, 'openid' => $openid, 'model' => $model, 'item' => $item, 'jsApiParameters' => $jsApiParameters]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/orderinfotest:gh_03a74ac96138
    public function actionOrderinfotest() {

        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $oid = '55306A960191B';
        $model = MOrder::findOne($oid);
        $item = MItem::findOne(['gh_id' => $gh_id, 'cid' => $model->cid]);

        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openid);
        $unifiedOrder = WxPayApi::unifiedOrder($input);
        U::W($unifiedOrder);
        $jsApiParameters = $this->GetJsApiParameters($unifiedOrder);
        U::W($jsApiParameters);

        return $this->render('orderinfo', ['gh_id' => $gh_id, 'openid' => $openid, 'model' => $model, 'item' => $item, 'jsApiParameters' => $jsApiParameters]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wxpaytest:gh_03a74ac96138
    public function actionWxpaytest() {

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

//        $this->layout = false;
        //        $this->layout = 'wap';
        $this->layout = 'wapy';

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $notify = new NativePay();
        $url = $notify->GetPrePayUrl("123456789");
        $url2 = '';
/*
$input = new WxPayUnifiedOrder();
$input->SetBody("test2");
$input->SetAttach("test2");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee("1");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test2");
//$input->SetNotify_url("http://wosotech.com/wx/vendor/wxpay/example/notify.php");
$input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("123456789");
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
 */

        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openid);
        $unifiedOrder = WxPayApi::unifiedOrder($input);
        U::W($unifiedOrder);
        $jsApiParameters = $this->GetJsApiParameters($unifiedOrder);
        U::W($jsApiParameters);

        return $this->render('wxpaytest', ['url1' => $url, 'url2' => $url2, 'jsApiParameters' => $jsApiParameters]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showpage:gh_03a74ac96138
    public function actionShowpage() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showpage', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/show4ginfo:gh_03a74ac96138
    public function actionShow4ginfo() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('show4ginfo', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showk1info:gh_03a74ac96138
    public function actionShowk1info() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showk1info', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/4gtaocan:gh_03a74ac96138
    public function action4gtaocan() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('4gtaocan', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    public function actionOrder4gtaocan() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('order4gtaocan', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //校园优惠季 20150829
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showxyyhjinfo:gh_03a74ac96138
    public function actionShowxyyhjinfo() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showxyyhjinfo', ['gh_id' => $gh_id, 'openid' => $openid]);
    }
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/xyyhj:gh_03a74ac96138
    public function actionXyyhj() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('xyyhj', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //流量宝活动 20150829
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showllbhdinfo:gh_03a74ac96138
    public function actionShowllbhdinfo() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showllbhdinfo', ['gh_id' => $gh_id, 'openid' => $openid]);
    }
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/llbhd:gh_03a74ac96138
    public function actionLlbhd() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('llbhd', ['gh_id' => $gh_id, 'openid' => $openid]);
    }



    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/lyhzxyh:gh_03a74ac96138
    public function actionLyhzxyh() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $models = MItem::find()->where(['kind' => MItem::ITEM_KIND_MOBILE])->orderBy(['price' => SORT_ASC])->all();
    
        //若非会员先跳到会员注册页面，先注册
        if (empty($model->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        Yii::$app->wx->setGhId($gh_id);

        $flag1 = 0;
        $flag2 = 0;

        //王珊珊加到测试用户中
        //if ($model->bindMobileIsInside('wx_t1')) {
        if ($model->bindMobileIsInside('wx_t1') || ($openid == \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || ($openid == 'oKgUduA4LGHA1E-W-wOnqy6egGJQ'))) {
            $flag1 = 1;
        } elseif ($model->bindMobileIsInside('wx_t2')) {
            $flag1 = 1;
        } else {
            $flag1 = 0;
        }

        /*4月第4周老用户活动*/
        if ($model->bindMobileIsInside('wx_t3') || ($openid == \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || ($openid == 'oKgUduA4LGHA1E-W-wOnqy6egGJQ'))) {
            $flag2 = 1;
        }

       /*6月第3周老用户活动*/
       /*
        if ($model->bindMobileIsInside('wx_oldcustomers150618')) {
            $flag2 = 1;
        }
        */
        
        return $this->render('lyhzxyh', ['gh_id' => $gh_id, 'openid' => $openid, 'models' => $models, 'flag1' => $flag1, 'flag2' => $flag2]);

        //return $this->render('lyhzxyhhint', ['gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    public function actionLyhzxyhhint() {
        $this->layout = 'wapy';

        return $this->render('lyhzxyhhint');
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/thsj:gh_03a74ac96138
    public function actionThsj() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('thsj', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/vipfwzq:gh_03a74ac96138
    public function actionVipfwzq() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($model->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        Yii::$app->wx->setGhId($gh_id);

        return $this->render('vipfwzq', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    public function getLLBCatsByMobiles($mobiles) {
        $mobleCats = [
            '18607271289' => '904',
            '18607271213' => '904',
            '18607271126' => '904',
            '18671091119' => '904',
            '18607277170' => '904',
            '13545296480' => '702',
            '13545296480' => '703',
        ];
        $cats = [];
        foreach ($mobiles as $mobile) {
            foreach ($mobleCats as $mob => $mobleCat) {
                if ($mobile == $mob) {
                    $cats[] = $mobleCat;
                }
            }
        }
        //return ['702', '703'];
        return $cats;
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/llb:gh_03a74ac96138:kind=4
    public function actionLlb() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $kind = $_GET['kind'];

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        $cats = $this->getLLBCatsByMobiles($user->getBindMobileNumbers());
        if (empty($cats)) {
            return $this->render('lyhzxyhhint', ['gh_id' => $gh_id, 'openid' => $openid]);
        }

        //$models = MItem::find()->where(['kind'=>$kind, 'cid'=>$cats])->orderBy(['price'=>SORT_ASC])->all();
        $models = MItem::find()->where(['kind' => $kind])->orderBy(['price' => SORT_ASC])->all();

        U::W("$$$$$$$$$$$$$$$$$$$$$$$$$");
        U::W($models);
        U::W($cats);
        return $this->render('llb', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user, 'models' => $models, 'kind' => $kind]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/querybymobile1:gh_03a74ac96138
    public function actionQuerybymobile1() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        /*
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if (empty($user->openidBindMobiles)) {
        Yii::$app->getSession()->set('RETURN_URL', Url::to());
        return $this->redirect(['addbindmobile', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
         */

        return $this->render('querybymobile1', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //ratchet UI frameworks , only for test
    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/ratchet:gh_03a74ac96138
    public function actionRatchet() {
        $this->layout = false;
        /*
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
         */
        return $this->render('ratchet');
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/dudaosubmit:gh_03a74ac96138
    public function actionDudaosubmit() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        /*
        $myPoints = HeatMap::find()->where(['gh_id'=>$gh_id, 'openid'=>$openid, 'status'=>0])->orderBy(['heat_map_id' => SORT_DESC])->all();
        if (!empty($myPoints)) {
        $myPoint = $myPoints[0];
        } else {
        $myPoint = null;
        }
         */

        //return $this->render('dudaosubmit', ['gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$model, 'jssdk'=>$jssdk, 'myPoint'=>$myPoint]);
        return $this->render('dudaosubmit', ['gh_id' => $gh_id, 'openid' => $openid, 'jssdk' => $jssdk]);

        //return $this->render('dudaosubmit');
    }

    public function actionDudaoview() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        /*
        $myPoints = HeatMap::find()->where(['gh_id'=>$gh_id, 'openid'=>$openid, 'status'=>0])->orderBy(['heat_map_id' => SORT_DESC])->all();
        if (!empty($myPoints)) {
        $myPoint = $myPoints[0];
        } else {
        $myPoint = null;
        }
         */

        //return $this->render('dudaosubmit', ['gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$model, 'jssdk'=>$jssdk, 'myPoint'=>$myPoint]);
        return $this->render('dudaoview', ['gh_id' => $gh_id, 'openid' => $openid, 'jssdk' => $jssdk]);
        //return $this->render('dudaoview');
    }

    public function actionQdxcjspb1($backwards = true, $pop = false) {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }
        //$models_mr = new MMarketingRegion();

        $models_mr = MMarketingRegion::find()->all();

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        return $this->render('qdxcjspb1', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'models_mr' => $models_mr, 'backwards' => $backwards]);
    }

    public function actionQdxcjspb2($backwards = true, $pop = false) {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $mr_id = $_GET['mr_id'];
        $mr = MMarketingRegion::findOne(['id' => $mr_id]);

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        return $this->render('qdxcjspb2', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'mr' => $mr, 'models_msc' => $mr->mscs, 'backwards' => $backwards]);
    }

    public function actionQdxcjspb3($backwards = true, $pop = false) {
        //$this->layout = 'wap';
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $msc_id = $_GET['msc_id'];
        $msc = MMarketingServiceCenter::findOne(['id' => $msc_id]);

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        return $this->render('qdxcjspb3', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'msc' => $msc, 'models_office' => $msc->offices, 'backwards' => $backwards]);
    }

    public function actionQdxcjspb4($backwards = true, $pop = false) {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $office_id = $_GET['office_id'];
        $office = MOffice::findOne(['office_id' => $office_id]);

        $campaign_pic_categories = MOfficeCampaignPicCategory::find()->orderBy('sort_order')->all();

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        return $this->render('qdxcjspb4', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'office' => $office, 'models_categories' => $campaign_pic_categories, 'backwards' => $backwards]);
    }

    /*评分页面*/
    public function actionQdxcjspb5($backwards = true, $pop = false) {
        $this->layout = false;

        //$gh_id = U::getSessionParam('gh_id');
        $gh_id = 'gh_03a74ac96138';
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $model_category_id = $_GET['model_category_id'];
        $model_ocpc = MOfficeCampaignPicCategory::findOne(['id' => $model_category_id]);

        $office_id = $_GET['office_id'];
        $office = MOffice::findOne(['office_id' => $office_id]);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $staff = $user->staff;

        //office_campaign_detail
        $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_category_id, 'office_id' => $office_id]);

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        return $this->render('qdxcjspb5', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'office' => $office, 'staff' => $staff, 'model_office_campaign_detail' => $model_office_campaign_detail, 'supervisor' => $office->supervisor, 'model_ocpc' => $model_ocpc, 'backwards' => $backwards]);
    }

    /*排行榜页面*/
    public function actionQdxcjspbpm($backwards = true, $pop = false) {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        //return $this->render('qdxcjspbpm', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('qdxcjspbpm', ['wx_user' => $wx_user, 'backwards' => $backwards]);
    }

    /*督导门店选择页面*/
    public function actionCsmdzltj1() {
        //$this->layout = 'wap';
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $staff_id = $_GET['staff_id'];
        $staff = MStaff::findOne(['staff_id' => $staff_id]);
        $offices = [];
        if ($staff->isSelfOperatedOfficeDirector()) {
            $offices = array($staff->directedOffice);
        }

        if ($staff->isSupervisor()) {
            $offices = array_merge($offices, $staff->supervisedOffices);
        }

        return $this->render('csmdzltj1', ['gh_id' => $gh_id, 'openid' => $openid, 'staff' => $staff, 'models_office' => $offices, 'staff_id' => $staff_id]);}

    public function actionCsmdzltj2() {
        //$this->layout = 'wap';
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $office_id = $_GET['office_id'];
        $staff_id = $_GET['staff_id'];
        $office = MOffice::findOne(['office_id' => $office_id]);
        $staff = MStaff::findOne(['staff_id' => $staff_id]);

        $campaign_pic_categories = MOfficeCampaignPicCategory::find()->orderBy('sort_order')->all();

        return $this->render('csmdzltj2', ['gh_id' => $gh_id, 'openid' => $openid, 'model_office' => $office, 'model_staff' => $staff, 'models_categories' => $campaign_pic_categories]);
    }

    /*督导提交图片的页面*/
    public function actionCsmdzltj3() {
        //$this->layout = 'wap';
        $this->layout = false;

        $office_id = $_GET['office_id'];
        $model_office = MOffice::findOne(['office_id' => $office_id]);

        //$campaign_pic_categories = MOfficeCampaignPicCategory::find()->orderBy('sort_order')->all();

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        //$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        $model_category_id = $_GET['model_category_id'];
        $model_ocpc = MOfficeCampaignPicCategory::findOne(['id' => $model_category_id]);

        return $this->render('csmdzltj3', ['gh_id' => $gh_id, 'openid' => $openid, 'model_office' => $model_office, 'model_ocpc' => $model_ocpc, 'jssdk' => $jssdk]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/handleqdxcjspb:gh_03a74ac96138
    public function actionHandleqdxcjspb() {

        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $office_campaign_id = empty($_GET['office_campaign_id']) ? 0 : $_GET['office_campaign_id'];
        $staff_id = empty($_GET['staff_id']) ? 0 : $_GET['staff_id'];
        $score = empty($_GET['score']) ? 0 : $_GET['score'];
        $comment = empty($_GET['comment']) ? '' : $_GET['comment'];

        $model = new MOfficeCampaignScore;
        //$model->gh_id = $gh_id;
        //$model->openid = $openid;

        $model->office_campaign_id = $office_campaign_id;
        $model->staff_id = $staff_id;
        $model->score = $score;
        $model->comment = $comment;

        $model->save(false);

        return json_encode(['code' => 0]);
    }

    public function actionHandlecsmdzltj() {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $office_id = empty($_GET['office_id']) ? 0 : $_GET['office_id'];
        $cat = empty($_GET['cat']) ? 1 : $_GET['cat'];
        $media_id = empty($_GET['serverId']) ? 0 : json_decode($_GET['serverId'], true);

        if (empty($media_id)) {
            //U::W([$_GET]);
            return json_encode(['code' => 1]);
        }

        $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $cat, 'office_id' => $office_id]);
        if (!empty($model_office_campaign_detail)) {
            U::W("model_office_campaign_detail Not NULL , update ...");
            $model_office_campaign_detail->delete();
        }

        $model = new MOfficeCampaignDetail;
        //$model->gh_id = $gh_id;
        //$model->openid = $openid;

        $model->office_id = $office_id;
        $model->pic_category = $cat;
        //$model->media_id = $media_id;

        //$model->pic_url = "{$media_id}.jpg";
        $media_url = array();
        foreach ($media_id as $media) {
            $filename = $media . ".jpg";
            $log_file_path = $model->getPicFileByMedia($filename);
            Yii::$app->wx->setGhId('gh_03a74ac96138');
            //Yii::$app->wx->WxMediaDownload($model->media_id, $log_file_path);
            Yii::$app->wx->WxMediaDownload($media, $log_file_path);
            U::compress_image_file($log_file_path);
            $media_url[] = $filename;
        }
        $model->pic_url = implode(",", $media_url);
        $model->save(false);

        return json_encode(['code' => 0]);
    }

    /*推荐有礼 用户view*/
    public function actionTjyl1() {
        //$this->layout = 'wap';
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user]);
    }

    /*会员中心 新版 powered by ratchet */
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/hyzx1:gh_03a74ac96138
    /*我*/
    public function actionHyzx1() {

        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
//        $openid = 'oKgUduKP1yXx_e4JviO9X-cGzm90';
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $scenes = $ktxwd_scenes = $yqwd_scenes = $yqwd_fans_qx_scenes = [];
        $date_start = static::getHyzxDateStart();
        $date_end = date("Y-m-d");
        //U::W("$date_start, $date_end");
        if (empty($user->staff)) {
            $user->getQrImageUrl();
            return $this->refresh();
        }

        $fans = $user->staff->getFansByRange($date_start, $date_end);
        $mobiledFans = $user->staff->getMobiledFansByRange($date_start, $date_end);
        //return $this->render('hyzx', ['gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$model, 'scenes'=>$scenes, 'ktxwd_scenes'=>$ktxwd_scenes, 'yqwd_scenes'=>$yqwd_scenes, 'yqwd_fans_qx_scenes'=>$yqwd_fans_qx_scenes, 'fans'=>$fans, 'mobiledFans'=>$mobiledFans]);

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('hyzx1', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user, 'mobiledFans' => $mobiledFans]);
    }

    /*活动*/
    public function actionHyzx2() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('hyzx2', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user]);
    }

    /*营业厅*/
    public function actionHyzx3() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $staff = $user->staff;

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('hyzx3', ['user' => $user, 'staff' => $staff]);
    }

    /*设置*/
    public function actionHyzx4() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('hyzx4', ['user' => $user]);
    }

    //绑定管理 新版
    public function actionBdgl() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        //return $this->render('tjyl1', ['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('bdgl', ['user' => $user]);
    }

    public function actionChonghuafeiajax() {
        $czhm = $_GET['czhm'];
        $czje = $_GET['czje'];
        $gh_id = $_GET['gh_id'];
        $openid = $_GET['openid'];

//        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        //        if (empty($wx_user)) return json_encode(['code' => -1]);

        $user_account = new \app\models\MUserAccount;
        $user_account->gh_id = $gh_id;
        $user_account->openid = $openid;
        $user_account->cat = \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE;
        $user_account->amount = -$czje * 100;
        $user_account->memo = "提现充话费申请";
        $user_account->charge_mobile = $czhm;
        $user_account->status = \app\models\MUserAccount::STATUS_CHARGE_REQUEST;
        $user_account->save(false);

        return json_encode(['code' => 0]);
    }

    public function actionQxchonghuafeiajax() {
        $uid = $_GET['uid'];

        $user_account = \app\models\MUserAccount::findOne(['id' => $uid]);
        if (empty($user_account)) {
            return json_encode(['code' => 0]);
        }

        if (
            $user_account->cat != \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE ||
            $user_account->status != \app\models\MUserAccount::STATUS_CHARGE_REQUEST
        ) {
            return json_encode(['code' => -1]);
        }

        $user_account->delete();
        return json_encode(['code' => 0]);
    }

    //我的推广
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wdtg:gh_03a74ac96138
    public function actionWdtg() {
        //$this->layout = 'wap';
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
//        $openid = 'oKgUduKP1yXx_e4JviO9X-cGzm90';
        Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $fans = $user->getFans();

        return $this->render('wdtg', ['user' => $user, 'fans' => $fans]);
    }

    //员工管理
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/yggl1:gh_03a74ac96138
    public function actionYggl1() {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
//        \Yii::warning(\yii\helpers\Json::encode([$gh_id, $openid]));
        $employee = \app\models\ClientEmployee::findOneByWechatOpenid($gh_id, $openid);
//        \Yii::warning(\yii\helpers\Json::encode($employee));
        $outlets = $employee->outlets;
//        \Yii::warning(\yii\helpers\Json::encode($outlets));

        return $this->render('yggl1', ['outlet_id' => $outlets[0]->outlet_id]);
    }

    public function actionYggl2() {
        $this->layout = false;
        $is_agent = $_GET['is_agent'];
        $outlet_id = $_GET['outlet_id'];
        if ($is_agent) {
            $agent_id = $_GET['entity_id'];
            $entity = \app\models\ClientAgent::findOne(['agent_id' => $agent_id]);
        } else {
            $employee_id = $_GET['entity_id'];
            $entity = \app\models\ClientEmployee::findOne(['employee_id' => $employee_id]);
        }
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);

        return $this->render('yggl2', [
            'entity' => $entity,
            'is_agent' => $is_agent,
            'outlet' => $outlet,
        ]);
    }

    //员工查询
    public function actionYgglchaxunajax() {
        $office_id = $_GET['office_id'];
        $searchStr = $_GET['searchStr'];
        //$searchStr = $_GET['searchStr'];
        /*
        $uid   = $_GET['uid'];

        $user_account = \app\models\MUserAccount::findOne(['id' => $uid]);
        if (empty($user_account)) return json_encode(['code' => 0]);
        if (
        $user_account->cat    != \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE ||
        $user_account->status != \app\models\MUserAccount::STATUS_CHARGE_REQUEST
        ) {
        return json_encode(['code' => -1]);
        }
        P
        $user_account->delete();
         */

//        $data = MStaff::find()->select('*')->where(['office_id'=>$office_id])->andFilterWhere(['like', 'name', $searchStr])->asArray()->all();
        $data = MStaff::find()->select('*')->orFilterWhere(['like', 'name', $searchStr])->orFilterWhere(['like', 'mobile', $searchStr])->andWhere(['office_id' => $office_id, 'cat' => MStaff::SCENE_CAT_IN])->asArray()->all();
        //U::W("+++++++++++++++++++++++");
        //U::W($data);
        return json_encode(['code' => 0, 'data' => $data]);
    }

    //员工增加
    public function actionZjygajax() {
        $employee_name = $_GET['ygxm'];
        $employee_mobile = $_GET['ygsjhm'];
        $outlet_id = $_GET['office_id'];
        $is_agent = !$_GET['yuangongFlag'];
        $position = $_GET['ygzw'];

        if ($is_agent) {
            return \app\models\ClientAgent::addOutletAgent($employee_name, $employee_mobile, $position, $outlet_id);
        } else {
            return \app\models\ClientEmployee::addOutletEmployee($employee_name, $employee_mobile, $position, $outlet_id);
        }

        return json_encode(['code' => 0]);
    }

    //员工删除
    public function actionYgglshanchuajax() {
        $is_agent = $_GET['is_agent'];
        $entity_id = $_GET['entity_id'];
        $outlet_id = $_GET['outlet_id'];

        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        if ($is_agent) {
            $ret = $outlet->deleteAgent($entity_id);
        } else {
            $ret = $outlet->deleteEmployee($entity_id);
        }

        if (false === $ret) {
            return json_encode(['code' => -1]);
        } else {
            return json_encode(['code' => 0]);
        }

    }

    //员工修改
    public function actionYgglxiugaiajax() {
        $is_agent = $_GET['is_agent'];
        $entity_id = $_GET['entity_id'];
        $outlet_id = $_GET['outlet_id'];
        $mobile = $_GET['mobile'];
        $position = $_GET['position'];

        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        if ($is_agent) {
            $ret = $outlet->alterAgent($entity_id, $mobile, $position);
        } else {
            $ret = $outlet->alterEmployee($entity_id, $mobile, $position);
        }
        if (false === $ret) {
            return json_encode(['code' => -1]);
        } else {
            return json_encode(['code' => 0]);
        }

    }

    //粉丝管理
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/fsgl1:gh_03a74ac96138
    public function actionFsgl1() {
        //$this->layout = 'wap';
        $this->layout = false;
        //    $gh_id = U::getSessionParam('gh_id');
        //    $openid = U::getSessionParam('openid');
        $staff_id = $_GET['staff_id'];

        $staff = MStaff::findOne(['staff_id' => $staff_id]);

        $office = $staff->office;
        return $this->render('fsgl1', ['office' => $office, 'staff' => $staff]);
    }

    public function actionFsgl2() {
        //$this->layout = 'wap';
        $this->layout = false;
        //    $gh_id = U::getSessionParam('gh_id');
        //    $openid = U::getSessionParam('openid');
        $id = $_GET['id'];

        $user = MUser::findOne(['id' => $id]);

        $office = \app\models\MOffice::findOne([
            'office_id' => $user->belongto,
        ]);
        return $this->render('fsgl2', ['office' => $office, 'user' => $user]);
    }

    //粉丝查询
    public function actionFsglchaxunajax() {
        $office_id = $_GET['office_id'];
        $searchStr = $_GET['searchStr'];
        //$searchStr = $_GET['searchStr'];
        /*
        $uid   = $_GET['uid'];

        $user_account = \app\models\MUserAccount::findOne(['id' => $uid]);
        if (empty($user_account)) return json_encode(['code' => 0]);
        if (
        $user_account->cat    != \app\models\MUserAccount::CAT_CREDIT_CHARGE_MOBILE ||
        $user_account->status != \app\models\MUserAccount::STATUS_CHARGE_REQUEST
        ) {
        return json_encode(['code' => -1]);
        }
        P
        $user_account->delete();
         */

//        $data = MStaff::find()->select('*')->where(['office_id'=>$office_id])->andFilterWhere(['like', 'name', $searchStr])->asArray()->all();
        $data = MUser::find()->select('*')
                             ->orFilterWhere(['like', 'nickname', $searchStr])
                             ->orFilterWhere(['like', 'mobile', $searchStr])
                             ->orFilterWhere(['like', 'create_time', $searchStr])
                             ->andWhere(['belongto' => $office_id])->asArray()->all();

        return json_encode(['code' => 0, 'data' => $data]);
    }

    /*end of 会员中心 新版 powered by ratchet */

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/show517huodong:gh_03a74ac96138
    public function actionShow517huodong() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('show517huodong', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    /*
    1: 漏话提醒
    2: 开机提醒
    3: 炫铃
    4: 联通秘书
    5: 视频PPTV定向流量
    6: 10元微信定向流量
    7: 10元短彩包
    8. 20元短彩包
    9. 30元短彩包

    18607271289 炫铃  漏话提醒    WO+视频PPTV定向流量       20元短彩包
    18607271213 炫铃  漏话提醒        10元微信定向流量   20元短彩包
    18607271126 炫铃  漏话提醒        10元微信定向流量   20元短彩包
    18671091119 炫铃  漏话提醒    WO+视频PPTV定向流量   10元微信定向流量   20元短彩包
    18607277170 炫铃  漏话提醒        10元微信定向流量   20元短彩包

    0-0-0-0-0-0-0-0-0
    1-1-1-1-1-1-1-1-1 //全选
     */

    public function getZZYWCatsByMobiles($mobiles) {
        $mobleCats = [
            '18607271289' => '1-0-1-0-1-0-0-1-0',
            '18607271213' => '1-0-1-0-0-1-0-1-0',
            '18607271126' => '1-0-1-0-0-1-0-1-0',
            '18671091119' => '1-0-1-0-1-1-0-1-0',
            '18607277170' => '1-0-1-0-0-1-0-1-0',
            '13545296480' => '1-1-1-1-0-1-0-1-0',
        ];
        $cats = [];
        foreach ($mobiles as $mobile) {
            foreach ($mobleCats as $mob => $mobleCat) {
                if ($mobile == $mob) {
                    $cats[] = $mobleCat;
                }
            }
        }
        //return ['702', '703'];
        return $cats;
    }

    //增值业务
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/zzyw:gh_03a74ac96138:kind=5:cid=1000
    public function actionZzyw() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $kind = $_GET['kind'];

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if (empty($user->openidBindMobiles)) {
            Yii::$app->getSession()->set('RETURN_URL', Url::to());
            return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        $cats = $this->getZZYWCatsByMobiles($user->getBindMobileNumbers());
        if (empty($cats)) {
            return $this->render('lyhzxyhhint', ['gh_id' => $gh_id, 'openid' => $openid]);
        }

        U::W("$$$$##################################");
        U::W($cats);
        return $this->render('zzyw', ['cid' => $_GET['cid'], 'gh_id' => $gh_id, 'openid' => $openid, 'kind' => $kind, 'cats' => $cats]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/4gzuhetaocan:gh_03a74ac96138
    public function action4gzuhetaocan() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('4gzuhetaocan', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/shuang4gshuangbaizhao:gh_03a74ac96138
    /*
    public function actionShuang4gshuangbaizhao()
    {
    $this->layout ='wapy';

    $gh_id = U::getSessionParam('gh_id');
    $openid = U::getSessionParam('openid');
    Yii::$app->wx->setGhId($gh_id);
    return $this->render('shuang4gshuangbaizhao', ['gh_id'=>$gh_id, 'openid'=>$openid]);
    }
     */

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wlmshop:gh_03a74ac96138
    public function actionWlmshop() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('wlmshop', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/shuxinyw:gh_03a74ac96138
    public function actionShuxinyw() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('shuxinyw', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/lyjhxj:gh_03a74ac96138
    public function actionLyjhxj() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('lyjhxj', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showdouble12info:gh_03a74ac96138
    public function actionShowdouble12info() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showdouble12info', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    public function actionDouble12() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('double12', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showdoubledaninfo:gh_03a74ac96138
    public function actionShowdoubledaninfo() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showdoubledaninfo', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    public function actionDoubledan() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('doubledan', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/showdoubledanmiaoshaninfo:gh_03a74ac96138
    public function actionShowdoubledanmiaoshainfo() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('showdoubledanmiaoshainfo', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/fuwuslideshow:gh_03a74ac96138
    public function actionFuwuslideshow() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        //$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        //$item = MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$_GET['cid']]);
        return $this->render('fuwuslideshow', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    public function actionDoubledanmiaosha() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('doubledanmiaosha', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/winmobilefee:gh_03a74ac96138:pid=oKgUduNHzUQlGRIDAghiY7ywSeWk:mobile=12345678900
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/winmobilefee:gh_03a74ac96138
    public function actionWinmobilefee() {
        $this->layout = 'wapz';
        $gh_id = U::getSessionParam('gh_id');
        $openid_fan = U::getSessionParam('openid');
        $openid = $_GET['pid'];
        $mobile = empty($_GET['mobile']) ? '' : $_GET['mobile'];

        Yii::$app->wx->setGhId($gh_id);
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $user_fan = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid_fan]);

        $user_fans = MWinMobileFee::find()->where("gh_id = :gh_id AND openid = :openid AND mobile = :mobile", [':gh_id' => $gh_id, ':openid' => $openid, ':mobile' => $mobile])->orderBy(['id' => SORT_ASC])->limit(12)->all();
        //U::W($user_fans);
        U::W('HHB' . count($user_fans));

        $winmobilefee = new \app\models\MWinMobileFee;
        //$user_founder = new \app\models\MWinMobileNum;
        U::W(['gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $mobile]);
        $user_founder = MWinMobileNum::findOne(['gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $mobile]);

        if ($user_founder === null) {
            U::W('no founder!!!!!!!!!!!');
        }

        if ($user === null) {
            $user = new MUser;
            $subscribed = false;
        } else if ($user->subscribe) {
            $subscribed = true;
        } else {
            $subscribed = false;
        }

        $winmobilefee->gh_id = $gh_id;
        $winmobilefee->openid = $openid;

        $winmobilefee->openid_fan = $openid_fan;
        $winmobilefee->create_time = date('Y-m-d H:i:s');

        if ($user_founder === null) {
            $user_founder = new MWinMobileNum;
            $canJoin = true;
        } else if ($user_founder->finished == 0) {
            $canJoin = false;
        } else {
            $canJoin = true;
        }

        //我要助力
        if (Yii::$app->request->isPost) {
            if ((!$user->subscribe) || (!$user_fan->subscribe)) {
                return $this->render('need_subscribe');
            }

            if (isset($_POST['help'])) {
                if ($user_founder->finished == 1) {
                    return $this->redirect(["wap/winmobilefee", 'gh_id' => $gh_id, 'pid' => $openid, 'mobile' => $mobile]);
                }

                foreach ($user_fans as $key => $v) {
                    //U::W($user_fans);
                    U::W("$v->openid_fan == $user->openid");

                    if ($v->openid_fan == $user_fan->openid) {
                        U::W("xxxxxxxxxxxxxxxxxxx");
                        //return $this->redirect(["wap/winmobilefee", 'gh_id'=>$gh_id, 'pid'=>$openid]);
                    }
                }

                $winmobilefee->load(Yii::$app->request->post());
                $winmobilefee->mobile = $user_founder->mobile;
                U::W('999999......');
                U::W($user_founder);
                U::W('aaaaa......' . $user_founder->mobile);

                if ($winmobilefee->save()) {

                    //Yii::$app->session->setFlash('success','助力成功');
                    U::W("助力成功");

                    if (count($user_fans) >= 11) {
                        // insert order
                        //
                        //$this->redirect([]);

                        $user_founder->finished = 1;
                        $user_founder->save();
                    }

                } else {
                    U::W([$_GET, $_POST, $winmobilefee->getErrors()]);
                    //Yii::$app->session->setFlash('success','助力失败！');
                }

                return $this->redirect(["wap/winmobilefee", 'gh_id' => $gh_id, 'pid' => $openid, 'mobile' => $mobile]);
            } else if (isset($_POST['join'])) {

                Yii::$app->wx->setGhId($gh_id);
                $pid = $openid_fan;
                $user_founder->setScenario('join');

                $user_founder->load(Yii::$app->request->post());
                $user_founder->gh_id = $gh_id;
                $user_founder->openid = $openid;
                $user_founder->finished = 0;
                $user_founder->create_time = date('Y-m-d H:i:s');

                $ar = MWinMobileNum::find()->where("gh_id = :gh_id AND mobile = :mobile", [':gh_id' => $gh_id, ':mobile' => $user_founder->mobile])->one();
                if ($ar !== null) {
                    U::W([$_GET, $_POST, $ar->getErrors()]);
                    Yii::$app->session->setFlash('success', '手机号码已参加!');
                    return $this->refresh();
                }

                if ($user_founder->save()) {
                    U::W("join ok");
                } else {
                    U::W([$_GET, $_POST, $winmobilefee->getErrors()]);
                }

                return $this->redirect(["wap/winmobilefee", 'gh_id' => $gh_id, 'pid' => $pid, 'mobile' => $user_founder->mobile]);

            }
        }

        $user_fans = MWinMobileFee::find()->where("gh_id = :gh_id AND openid = :openid AND mobile = :mobile", [':gh_id' => $gh_id, ':openid' => $openid, ':mobile' => $mobile])->orderBy(['id' => SORT_ASC])->limit(12)->all();

        return $this->render('winmobilefee', ['user' => $user, 'user_founder' => $user_founder, 'user_fan' => $user_fan, 'user_fans' => $user_fans, 'subscribed' => $subscribed, 'canJoin' => $canJoin]);
    }

    public function actionAddbindmobile($gh_id, $openid) {
        $this->layout = 'wap';
        $model = new OpenidBindMobile();
        $model->gh_id = $gh_id;
        $model->openid = $openid;
        $model->setScenario('bind_mobile');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //非自营厅渠道新增会员时，+积分100
            $user = MUser::findOne(['openid' => $openid]);
            $office = MOffice::findOne(['office_id' => $user->belongto]);

            if(!empty($office))
            {
                if($office->is_selfOperated == 0)
                {
                    //wx_office_score_event 增加一条记录
                    $offce_score_event = new MOfficeScoreEvent;
                    $offce_score_event->gh_id = $gh_id;
                    $offce_score_event->openid = $openid;
                    $offce_score_event->office_id = $user->belongto;
                    $offce_score_event->cat = MOfficeScoreEvent::CAT_ADD_NEW_MEMBER;
                    $offce_score_event->create_time = date('y-m-d h:i:s',time());
                    $offce_score_event->score = MOfficeScoreEvent::CAT_ADD_NEW_MEMBER_SCORE;
                    $offce_score_event->memo = '新增会员';
                    $offce_score_event->save(false);

                    //wx_office表中对应渠道score 加100分
                    $office->score = $office->score + 100;
                    $office->save(false);
                }   
            }


            Yii::$app->wx->setGhId($gh_id);
            $url = Url::to(['hyzx1', 'gh_id' => $gh_id, 'openid' => $openid], true);
            Yii::$app->wx->WxTemplateSend(Wechat::getTemplateBindSuccessNotify($openid, $url, "{$model->user->nickname}，您的手机号码已成功绑定襄阳联通官方微信营业厅", "您已成为襄阳联通的会员，可随时查询话费余额，办理业务，参与更多专享优惠！", $model->mobile, date('Y-m-d')));
            $url = Yii::$app->getSession()->get('RETURN_URL');
            if (!empty($url)) {
                return $this->redirect($url);
            } else {
                Yii::$app->session->setFlash('success', '恭喜您，会员注册成功！');
                return $this->refresh();
            }
        }

        $searchModel = new OpenidBindMobileSearch();
        $searchModel->gh_id = $gh_id;
        $searchModel->openid = $openid;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('addbindmobile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    public function actionDeletebindmobile($id) {
        if (($model = OpenidBindMobile::findOne($id)) !== null) {
            $model->delete();
        }
        return $this->redirect(['addbindmobile', 'gh_id' => $model->gh_id, 'openid' => $model->openid]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/aboutheatmap:gh_03a74ac96138
    public function actionAboutheatmap() {
        $this->layout = 'wap';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        return $this->render('aboutheatmap', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/heatmap:gh_03a74ac96138
    public function actionHeatmap() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

/*
if (empty($model->openidBindMobiles)) {
Yii::$app->getSession()->set('RETURN_URL', Url::to());
return $this->redirect(['addbindmobile', 'gh_id'=>$gh_id, 'openid'=>$openid]);
}
 */

/*
$model = new OpenidBindMobile();
$model->gh_id = $gh_id;
$model->openid = $openid;
$model->setScenario('bind_mobile');
if ($model->load(Yii::$app->request->post()) && $model->save()) {
Yii::$app->wx->setGhId($gh_id);
$url = Url::to(['hyzx', 'gh_id'=>$gh_id, 'openid'=>$openid], true);
Yii::$app->wx->WxTemplateSend(Wechat::getTemplateBindSuccessNotify($openid, $url, "{$model->user->nickname}，您的手机号码已成功绑定襄阳联通官方微信营业厅", "您已成为襄阳联通的会员，可随时查询话费余额，办理业务，参与更多专享优惠！", $model->mobile, date('Y-m-d')));
$url = Yii::$app->getSession()->get('RETURN_URL');
if (!empty($url)) {
return $this->redirect($url);
} else {
Yii::$app->session->setFlash('success','绑定成功');
return $this->refresh();
}
}

$searchModel = new OpenidBindMobileSearch();
$searchModel->gh_id = $gh_id;
$searchModel->openid = $openid;
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

return $this->render('addbindmobile', [
'searchModel' => $searchModel,
'dataProvider' => $dataProvider,
'model' => $model,
]);
 */
        $rows = HeatMap::find()->where(['gh_id' => $gh_id, 'status' => 0])->asArray()->all();
        $points = [];
        foreach ($rows as $row) {
//          $point = ['lng'=>$row['lon'], 'lat'=>$row['lat'], 'count'=>90];
            //          $point = ['lng'=>$row['lon'], 'lat'=>$row['lat'], 'count'=>rand(10,100)];
            $point = ['lng' => $row['lon'], 'lat' => $row['lat'], 'count' => 30 + 2 * $row['speed_down']];
            $points[] = $point;
        }
        U::W($points);
        return $this->render('heatmap.php', ['points' => $points]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/4granking:gh_03a74ac96138
    public function action4granking() {
        $this->layout = 'wap';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
/*
if (empty($model->openidBindMobiles)) {
Yii::$app->getSession()->set('RETURN_URL', Url::to());
return $this->redirect(['addbindmobile', 'gh_id'=>$gh_id, 'openid'=>$openid]);
}
 */
        $myPoints = HeatMap::find()->where(['gh_id' => $gh_id, 'openid' => $openid, 'status' => 0])->orderBy(['speed_down' => SORT_DESC])->all();
        if (!empty($myPoints)) {
            $myPoint = $myPoints[0];
            $myRank = $myPoint->getMySpeedDownRank();
        } else {
            $myRank = 0;
        }
        $totalCount = HeatMap::find()->where(['gh_id' => $gh_id, 'status' => 0])->count();

        return $this->render('4granking', ['gh_id' => $gh_id, 'openid' => $openid]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/submitspeed:gh_03a74ac96138
    public function actionSubmitspeed() {
        $this->layout = 'wap';
        //$this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);
        $model = new HeatMap;
        return $this->render('submitspeed', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $user, 'model' => $model, 'jssdk' => $jssdk]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/jssdksample:gh_03a74ac96138
    public function actionJssdksample() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        $myPoints = HeatMap::find()->where(['gh_id' => $gh_id, 'openid' => $openid, 'status' => 0])->orderBy(['heat_map_id' => SORT_DESC])->all();
        if (!empty($myPoints)) {
            $myPoint = $myPoints[0];
        } else {
            $myPoint = null;
        }

        return $this->render('jssdksample', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'jssdk' => $jssdk, 'myPoint' => $myPoint]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/jssdksample:gh_03a74ac96138
    public function actionJssdksampleok() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);
/*
$myPoints = HeatMap::find()->where(['gh_id'=>$gh_id, 'openid'=>$openid, 'status'=>0])->orderBy(['heat_map_id' => SORT_DESC])->all();
if (!empty($myPoints)) {
$myPoint = $myPoints[0];
} else {
$myPoint = null;
}
 */
        return $this->render('jssdksampleok', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'jssdk' => $jssdk]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/4gspeedpic:gh_03a74ac96138
    public function action4gspeedpic() {
        //$this->layout = 'wap';
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        Yii::$app->wx->setGhId($gh_id);
        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        $myPoints = HeatMap::find()->where(['gh_id' => $gh_id, 'openid' => $openid, 'status' => 0])->orderBy(['heat_map_id' => SORT_DESC])->all();
        if (!empty($myPoints)) {
            $myPoint = $myPoints[0];
        } else {
            $myPoint = null;
        }

        return $this->render('4gspeedpic', ['gh_id' => $gh_id, 'openid' => $openid, 'user' => $model, 'jssdk' => $jssdk, 'myPoint' => $myPoint]);
    }

    public function actionHandlespeed() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $lon = empty($_GET['lon']) ? 0 : $_GET['lon'];
        $lat = empty($_GET['lat']) ? 0 : $_GET['lat'];
        $speed_up = empty($_GET['speed_up']) ? 0 : $_GET['speed_up'];
        $speed_down = empty($_GET['speed_down']) ? 0 : $_GET['speed_down'];
        $speed_delay = empty($_GET['speed_delay']) ? 0 : $_GET['speed_delay'];
        $media_id = empty($_GET['serverId']) ? 0 : $_GET['serverId'];
        $is_4g = empty($_GET['status']) ? 0 : $_GET['status'];
        //$is_4g = 1;
        if (empty($media_id)) {
            U::W([$_GET]);
            return json_encode(['code' => 1]);
        }
        $model = new HeatMap;
        $model->gh_id = $gh_id;
        $model->openid = $openid;
        $model->lon = $lon;
        $model->lat = $lat;
        $model->speed_up = $speed_up;
        $model->speed_down = $speed_down;
        $model->speed_delay = $speed_delay;
        $model->media_id = $media_id;
        $model->pic_url = "{$gh_id}_{$media_id}.jpg";
        $log_file_path = $model->getPicFile();
        if ((!file_exists($log_file_path)) || $model->getPicFileSize() == 0 || $model->getPicFileSize() == 47) {
            Yii::$app->wx->setGhId($gh_id);
            Yii::$app->wx->WxMediaDownload($model->media_id, $log_file_path);
        }
        $model->save(false);
        return json_encode(['code' => 0]);
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/nativetest:gh_03a74ac96138
    public function actionNativetest() {
        require_once "../vendor/wxpay/lib/WxPay.Api.php";
        require_once "../vendor/wxpay/example/WxPay.NativePay.php";
        require_once "../vendor/wxpay/example/log.php";
        return $this->render('native');
    }

    // http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/nativetest1:gh_03a74ac96138
    public function actionNativetest1() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $notify = new NativePay();
        $url = $notify->GetPrePayUrl("123456789");
        U::W($url);
        return $url;
    }

}

class NativeNotifyCallBack extends WxPayNotify {
    public function unifiedorder($openId, $product_id) {
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        //donot support ?r=xxx?
        //$payNotifyUrl = "http://wosotech.com/wx/web/index.php?r=wap/paynotify";
        $payNotifyUrl = "http://wosotech.com/wx/web/wxpaynotify.php";
        $input->SetNotify_url($payNotifyUrl);
        //$input->SetNotify_url(urlencode($payNotifyUrl));
        //$input->SetNotify_url("http://wosotech.com/wx/models/wxpay/wxpay_sdk/example/notify.php");
        $input->SetTrade_type("NATIVE");
        $input->SetOpenid($openId);
        $input->SetProduct_id($product_id);
        $result = WxPayApi::unifiedOrder($input);
        return $result;
    }

    public function NotifyProcess($data, &$msg) {
        //Log::DEBUG("call back:" . json_encode($data));
        U::W([__METHOD__, $data, $msg]);
        /*
        $data => Array
        (
        [appid] => wx79c2bf0249ede62a
        [is_subscribe] => Y
        [mch_id] => 1220047701
        [nonce_str] => bfegWC2eAXolkxj8
        [openid] => oSHFKs9_gq4Ve6sHdQ86mJh1U3ZQ
        [product_id] => 123456789
        [sign] => 6D81DBD2229DC244D9E94E6BD24EF5B3
        )
         */

        if (!array_key_exists("openid", $data) ||
            !array_key_exists("product_id", $data)) {
            $msg = "回调数据异常";
            return false;
        }

        $openid = $data["openid"];
        $product_id = $data["product_id"];

        $result = $this->unifiedorder($openid, $product_id);
        if (!array_key_exists("appid", $result) ||
            !array_key_exists("mch_id", $result) ||
            !array_key_exists("prepay_id", $result)) {
            $msg = "统一下单失败";
            return false;
        }

        $this->SetData("appid", $result["appid"]);
        $this->SetData("mch_id", $result["mch_id"]);
        $this->SetData("nonce_str", WxPayApi::getNonceStr());
        $this->SetData("prepay_id", $result["prepay_id"]);
        $this->SetData("result_code", "SUCCESS");
        $this->SetData("err_code_des", "OK");
        return true;

    }
}

/*这
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
//                    'searchModel' => $searchModel
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
U::W($arr['OpenId']);    //AppId, IsSubscribe


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

//        $sql = "SELECT * FROM `wx_g2048` ORDER BY `score` ASC ";


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
//$req_id = date('Ymdhis');

//http://127.0.0.1/wx/web/index.php?r=wap/testpay&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE
public function actionTestpay()
{
$this->layout = 'wapy';

$oid = '53df310d139ae';
$model = MOrder::findOne($oid);
if (\Yii::$app->request->isPost)
{
$this->layout = false;
$model->setAttributes($_POST['MOrder'], false);
//U::W($model->getAttributes());
$alipay_config = Alipay::getAlipayConfig();
$format = "xml";
$v = "2.0";
$req_id = uniqid();

//$notify_url = "http://wosotech.com/wx/models/alipay/wap/notify_url.php";
//$call_back_url = "http://wosotech.com/wx/models/alipay/wap/call_back_url.php";
//$merchant_url = "http://wosotech.com/wx/models/alipay/wap/merchant_url.php";

$notify_url = "http://wosotech.com/wx/web/alipaynotify.php";
$call_back_url = "http://wosotech.com/wx/web/alipaycallback.php";
$merchant_url = "http://wosotech.com/wx/web/alipaymerchant.php";

$seller_email = 'wosotech@126.com';
$out_trade_no = $model->oid;
$subject = $model->detail;

$model->feesum = 0.01;
$total_fee = $model->feesum;
$req_data = '<direct_trade_create_req><notify_url>'.$notify_url.'</notify_url><call_back_url>'.$call_back_url.'</call_back_url><seller_account_name>'.$seller_email.'</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>'.$subject.'</subject><total_fee>'.$total_fee.'</total_fee><merchant_url>'.$merchant_url.'</merchant_url></direct_trade_create_req>';
$para_token = array(
"service" => "alipay.wap.trade.create.direct",
"partner" => trim($alipay_config['partner']),
"sec_id" => trim($alipay_config['sign_type']),
"format"    => $format,
"v"    => $v,
"req_id"    => $req_id,
"req_data"    => $req_data,
"_input_charset"    => trim(strtolower($alipay_config['input_charset']))
);
U::W($para_token);
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestHttp($para_token);
//U::W($html_text);
$html_text = urldecode($html_text);
$arr = $alipaySubmit->parseResponse($html_text);
if(!empty($arr['res_error']))
{
$msg =  print_r($arr['res_error_arr'], true);
return $this->render('alipay_msg', ['msg' => $msg]);
}
U::W($arr);

$request_token = $arr['request_token'];
$req_data = '<auth_and_execute_req><request_token>'.$request_token.'</request_token></auth_and_execute_req>';
$parameter = array(
"service" => "alipay.wap.auth.authAndExecute",
"partner" => trim($alipay_config['partner']),
"sec_id" => trim($alipay_config['sign_type']),
"format"    => $format,
"v"    => $v,
"req_id"    => $req_id,
"req_data"    => $req_data,
"_input_charset"    => trim(strtolower($alipay_config['input_charset']))
);
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', 'OK');
return $this->render('alipay_submit', ['msg' => $html_text]);
}
return $this->render('testpay', ['model' => $model]);
}

public function actionOauth2cb()
{
if (Yii::$app->wx->localTest)
{
$openid = MGh::GH_XIANGYANGUNICOM_OPENID_HBHE;
//list($route, $gh_id) = explode(':', $_GET['state']);
$arr = explode(':', $_GET['state']);
$route = $arr[0];
$gh_id = $arr[1];
unset($arr[0], $arr[1]);
$r[] = $route;
foreach($arr as $str)
{
list($key, $val) = explode('=', $str);
$r[$key] = $val;
}
Yii::$app->session['gh_id'] = $gh_id;
Yii::$app->session['openid'] = $openid;
$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
//if ($user !== null)
//    Yii::$app->user->login($user);
//return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
//return $this->redirect([$route]);
return $this->redirect($r);
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

$arr = explode(':', $_GET['state']);
$route = $arr[0];
$gh_id = $arr[1];
unset($arr[0], $arr[1]);
$r[] = $route;
foreach($arr as $str)
{
list($key, $val) = explode('=', $str);
$r[$key] = $val;
}

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
//    Yii::$app->user->login($user);
//else
//    U::W("not found, $openid");
//return $this->redirect([$route, 'gh_id'=>$gh_id, 'openid'=>$openid]);
return $this->redirect($r);
}


//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardwo:gh_1ad98f5481f3
public function actionCardwo()
{
$this->layout ='wapy';
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');
Yii::$app->wx->setGhId($gh_id);

return $this->render('card', ['cid'=>MItem::ITEM_CAT_CARD_WO, 'gh_id'=>$gh_id, 'openid'=>$openid]);
}

//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardxiaoyuan:gh_1ad98f5481f3
//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardxiaoyuan:gh_03a74ac96138
public function actionCardxiaoyuan()
{
$this->layout ='wapy';
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');
Yii::$app->wx->setGhId($gh_id);

return $this->render('card', ['cid'=>MItem::ITEM_CAT_CARD_XIAOYUAN, 'gh_id'=>$gh_id, 'openid'=>$openid]);
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


//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/woke:gh_03a74ac96138
public function actionWoke()
{
$this->layout = 'wapy';
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');

$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
if ($user === null)
throw new NotFoundHttpException('user does not exists');
$model = MChannel::find()->where("gh_id = :gh_id AND openid = :openid", [':gh_id'=>$gh_id, ':openid'=>$openid])->one();
if ($model !== null)
{
return $this->redirect(['wokelist']);
}

if (Yii::$app->request->isPost)
{
$model = new MChannel;
$model->gh_id = $gh_id;
$model->openid = $openid;
$model->title = $user->nickname.'-'.$openid;
$model->status = MChannel::STATUS_OK;
$model->cat = MChannel::CAT_SOCIAL;
if ($model->save())
{
if ($model->status == MChannel::STATUS_OK)
{
$qr = $model->getQrImageUrl();
U::W($qr);
}
return $this->redirect(['wokelist']);
}
else
{
U::W($model->getErrors());
}
}

return $this->render('woke', ['gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$user]);
}

if (0)
{
$_GET["cid"] = MItem::ITEM_CAT_DIY;
}


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

Yii::$app->wx->setParameter("body", 'itemdesc');
Yii::$app->wx->setParameter("out_trade_no", Wechat::generateOutTradeNo());
Yii::$app->wx->setParameter("total_fee", "1");
Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");

//        $s = Yii::$app->sm->S('15527210477', 'hello, world', '', null, true);
//        U::W($s->resp);


 */

/*
Yii::$app->wx->clearGh();
Yii::$app->wx->setGhId(MGh::GH_WOSO);
//        $url = Yii::$app->wx->create_native_url($order->oid);
$url = Yii::$app->wx->create_native_url_v3($order->oid);
Yii::$app->wx->clearGh();
Yii::$app->wx->setGhId($gh_id);
 */
/*
U::W('before NativePay');
$notify = new NativePay();
$url = $notify->GetPrePayUrl("123456789");
U::W('after NativePay='.$url);
 */
/*
public function GetJsApiParameters($UnifiedOrderResult)
{
if(!array_key_exists("appid", $UnifiedOrderResult)
|| !array_key_exists("prepay_id", $UnifiedOrderResult)
|| $UnifiedOrderResult['prepay_id'] == "")
{
U::W(['appid or prepay_id not exists', $UnifiedOrderResult]);
throw new \Exception("para error");
}
$jsapi = new WxPayJsApiPay();
$jsapi->SetAppid($UnifiedOrderResult["appid"]);
$timeStamp = (string)time();
$jsapi->SetTimeStamp($timeStamp);
$jsapi->SetNonceStr(WxPayApi::getNonceStr());
$jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
$jsapi->SetSignType("MD5");
$jsapi->SetPaySign($jsapi->MakeSign());
$parameters = json_encode($jsapi->GetValues());
return $parameters;
}


$detail = $order->detail;
$input = new WxPayUnifiedOrder();
$input->SetBody($detail);
//$input->SetAttach("test");
$input->SetOut_trade_no($order->oid);
$input->SetTotal_fee("{$order->feesum}");
if ($openid == MGh::GH_XIANGYANGUNICOM_OPENID_KZENG || $openid == MGh::GH_XIANGYANGUNICOM_OPENID_HBHE) {
$input->SetTotal_fee("1");
}
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 3600));
//$input->SetGoods_tag("test");
$input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openid);
$unifiedOrder = WxPayApi::unifiedOrder($input);
U::W($unifiedOrder);

$jsApiParameters = $this->GetJsApiParameters($unifiedOrder);
U::W($jsApiParameters);
 */
/*
public function actionOrdertuikuan($oid, $ismanager)
{
$order = MOrder::findOne(['oid'=>$oid]);
$status = $ismanager ? MOrder::STATUS_SELLER_REFUND_CLOSED : MOrder::STATUS_BUYER_REFUND_CLOSED;
$order->refund($status);
return $this->redirect(['order', 'gh_id'=>$order->gh_id, 'openid'=>$order->openid]);
}

public function actionChangeofficeorderstatus()
{
$oid = $_GET['oid'];
$status = $_GET['status'];
$staff_id = $_GET['staff_id'];
$order = MOrder::findOne(['oid'=>$oid]);
$order->status = $status;
$order->save(false);
return $this->redirect(['officeorderdetail', 'office_id'=>$order->office_id, 'staff_id'=>$staff_id, 'oid'=>$order->oid]);
}

public function actionOrderchangestatusajax()
{
$oid = $_GET['oid'];
$status = $_GET['status'];
$order = MOrder::findOne(['oid'=>$oid]);
$order->status = $status;
return json_encode(['code' => 0]);
}
 */
