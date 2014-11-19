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
use app\models\MOffice;
use app\models\MGh;
use app\models\MChannel;
use app\models\MOrder;
use app\models\MItem;
use app\models\MMobnum;
use app\models\MDisk;
use app\models\MG2048;
use app\models\MPkg;
use app\models\MSceneDetail;

use app\models\Alipay;
use app\models\AlipaySubmit;

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
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/luck:gh_1ad98f5481f3:cid=11:oid=12
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
              return $this->redirect($r);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/nativepackage
    public function actionNativepackage()
    {        
        U::W([__METHOD__, $GLOBALS]);    
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
        $detail = $model->detail;
        Yii::$app->wx->setParameter("body", $detail);
        Yii::$app->wx->setParameter("out_trade_no", $model->oid);
        Yii::$app->wx->setParameter("total_fee",  "{$model->feesum}");
        //Yii::$app->wx->setParameter("total_fee",  "1");
        Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");        
        $xmlStr = Yii::$app->wx->create_native_package();
        if (Yii::$app->wx->debug)
            U::W($xmlStr);
        return $xmlStr;
        
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/paynotify
    public function actionPaynotify()
    {        
        U::W(['actionPaynotify', $_GET,$_POST]);
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
        if ($_GET['trade_state'] == 0)
            $order ->status = MOrder::STATUS_OK;
        else
        {
            U::W(['status error', __METHOD__, $_GET, $_POST]);
        }

        $order ->notify_id = $_GET['notify_id'];
        $order ->partner = $_GET['partner'];
        $order ->time_end = $_GET['time_end'];
        $order ->total_fee = $_GET['total_fee'];
        $order ->trade_state = $_GET['trade_state'];
        $order ->transaction_id = $_GET['transaction_id'];
        $order ->appid_recv = $arr['AppId'];
        $order ->openid_recv = $arr['OpenId'];        
        $order ->issubscribe_recv = $arr['IsSubscribe'];
        $order->pay_kind = MOrder::PAY_KIND_WECHAT;        
        $order->save(false);
        if ($_GET['trade_state'] == 0    )
        {
            Yii::$app->wx->clearGh();        
            Yii::$app->wx->setAppId($arr['AppId']);
            $arr = Yii::$app->wx->WxPayDeliverNotify($arr['OpenId'], $_GET['transaction_id'], $_GET["out_trade_no"]);
            //U::W($arr);
            try
            {        
                Yii::$app->wx->clearGh();
                Yii::$app->wx->setGhId($order->gh_id);
                $arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$order->openid,'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice(true)]]);                    
                //U::W($arr);        
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
            $lucy_msg = U::getMobileLuck($model->mobile);
            $lucy_msg['Mobile'] = $model->mobile;
            $result = $this->renderPartial('luck_result', ['loca'=>$loca, 'lucy_msg'=>$lucy_msg]);
        }        
         return $this->render('luck', ['model' => $model, 'result'=>$result, 'lucy_msg'=>$lucy_msg, 'subscribed'=>$subscribed, 'username'=>$username]);
    }    

    //http://127.0.0.1/wx/web/index.php?r=wap/iphone6sub&cat=0
    //http://wosotech.com/wx/web/index.php?r=wap/oauth2cb&state=wap/cardlist:gh_03a74ac96138
    //http://wosotech.com/wx/web/index.php?r=wap/iphone6sub&cat=1
    public function actionIphone6sub()
    {
        $cat = isset($_GET['cat']) ? $_GET['cat'] : 0;
        $this->layout = 'wap';
        $model = new \app\models\MIphone6Sub;
        $cat = Yii::$app->request->get('cat', 0);    
        $model->cat = $cat;
        if ($model->load(Yii::$app->request->post())) 
        {
            if (!$model->save())
            {
                U::W([$_GET, $_POST, $model->getErrors()]);
                Yii::$app->session->setFlash('success','此身份证号码已存在!');                
            }
            else
                Yii::$app->session->setFlash('success','预订信息提交成功，请您敬侯佳音节！');
            return $this->refresh();
        }        
        $n = \app\models\MIphone6Sub::find()->where(['cat'=>$cat])->count();                                
         return $this->render('iphone6sub', ['model' => $model, 'n'=>$n+999]);
    }    

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/g2048:gh_03a74ac96138
    public function actionG2048()
    {
        $this->layout = 'wapy';
        //$this->layout =false;
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
        //$this->layout = false;
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
        $this->layout = 'wapy';
        //$this->layout =false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');        
        $ar = new \app\models\MSuggest;
        $ar->gh_id = $gh_id;
        $ar->openid = $openid;        
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);        
        $subscribed = ($model !== null && $model->subscribe) ? true : false;
        if ($ar->load(Yii::$app->request->post())) 
        {
            if ($subscribed)
            {                
                $ar->nickname = $model->nickname;
                $ar->headimgurl = $model->headimgurl;                
                if (!$ar->save(true)) 
                {
                    U::W($ar->getErrors());
                }    
            }    
            else
            {
                U::W("openid=$openid is not subscribed");
            }
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
        foreach($rows as &$row)
        {
            $create_time= strtotime($row['create_time']);
            $d = time()  - $create_time;
            $d_days = round($d/86400);
            $d_hours = round($d/3600);
            $d_minutes = round($d/60);
            if($d_days>0 && $d_days<4){
                $row['create_time_new'] = $d_days."天前";
            }else if($d_days<=0 && $d_hours>0){
                $row['create_time_new'] = $d_hours."小时前";
            }else if($d_hours<=0 && $d_minutes>0){
                $row['create_time_new'] = $d_minutes."分钟前";
            }else{
                $row['create_time_new'] = $row['create_time'];
            }
        }
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
U::W("HELLO, {$wid}");        
        if (!empty($wid))
        {
             list($scene_id, $scene_src_id) = explode('_', $wid);
U::W("FINE, {$scene_id}, {$scene_src_id}");                     
             $order->scene_id = $scene_id;             
             $order->scene_src_id = $scene_src_id;
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
        
        return json_encode(['oid'=>$order->oid, 'status'=>0, 'pay_url'=>$url]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=mobileNum&currentPage=1&cid=10&feeSum=1
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=diskRestCnt&cid=10
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=orderview&oid=53de91f9d3773
    //http://127.0.0.1/wx/web/index.php?r=wap/ajaxdata&cat=g2048Save&bigNum=1&best=2&score=100
    public function actionAjaxdata($cat)
    {
        //if (!Yii::$app->request->isAjax)
        //    return;
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
                $plan = $_GET["pkgPlan"] =='null' ? '' : $_GET["pkgPlan"];

                //$data = MPkg::find()->select('*')->where(
                //    "gh_id=:gh_id AND cid=:cid AND pkg3g4g=:pkg3g4g AND period=:period AND monthprice=:monthprice AND plan=:plan", 
                //    [':gh_id'=>$gh_id, ':cid'=>$cid, ':pkg3g4g'=>$pkg3g4g, ':period'=>$period, ':monthprice'=>$monthprice, ':plan'=>$plan])->asArray()->one();    


                $data = MPkg::find()->select('*')->where(
                    "gh_id=:gh_id AND cid=:cid AND pkg3g4g=:pkg3g4g AND period=:period AND monthprice=:monthprice", 
                    [':gh_id'=>$gh_id, ':cid'=>$cid, ':pkg3g4g'=>$pkg3g4g, ':period'=>$period, ':monthprice'=>$monthprice])->asArray()->one();    


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

                $wl_url = "http://www.kuaidi100.com/query?type=".$wl_url_1."&postid=".$wl_url_2;
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
                $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
               
                $model = new \app\models\MSceneDetail;
                $model->gh_id = $gh_id;
                $model->openid = $openid;
                $model->scene_id = $user->scene_id;
                $model->scene_amt = (-1)*$_GET['ljtx'];
                $model->memo = $_GET['memo'];
                $model->czhm = $_GET['czhm'];
                
                if (!$model->save(false))
                {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code'=>1, 'errmsg'=>'save score to db error']);
                }        
              
                $user->scene_balance = $user->scene_balance - abs($model->scene_amt);
                if (!$user->save(false))
                {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code'=>1, 'errmsg'=>'save score to db error']);
                }        
              
                $data['ljtx'] = abs($model->scene_amt);
                break;

            case 'wokeqdyl':
                $gh_id = U::getSessionParam('gh_id');
                $openid = U::getSessionParam('openid'); 
                U::W("----------wokeqdyl-----------");
                U::W($openid);                   
                Yii::$app->wx->setGhId($gh_id);
                $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
                U::W("$$$$$$$$$$$$$$$$$$$$$$$$$");
                U::W($user);
               
                $model = new \app\models\MSceneDetail;
                $model->gh_id = $gh_id;
                $model->openid = $openid;
                $model->scene_id = $user->scene_id;

                $money_max = 8; //每日签到有礼，8个沃点封顶；
                if($user->sign_money == 0)   //第1次签到;
                {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = 1;
                }
                else if(strtotime(date("Y-m-d"))-strtotime($user->sign_time)<1)//签到只能一天一次
                {
                    //$user->sign_time = date("Y-m-d");
                    //$user->sign_money = 1;
                    $data['sign_money'] = 'marked';
                    break;
                }
                else if((strtotime(date("Y-m-d"))-strtotime($user->sign_time))/86400 > 1)//超过一天未签到，
                {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = 1;
                }
                else
                {
                    $user->sign_time = date("Y-m-d");
                    $user->sign_money = (2*$user->sign_money>$money_max)?$money_max:2*$user->sign_money;

                }

                $model->scene_amt = $user->sign_money;

                $model->memo = $_GET['memo'];
                $model->cat = MSceneDetail::CAT_SIGN;
                
                if (!$model->save(false))
                {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code'=>1, 'errmsg'=>'save score to db error']);
                }        
              
                //$user->scene_balance = $user->scene_balance + abs($model->scene_amt);

                if (!$user->save(false))
                {
                    U::W([__METHOD__, $model->getErrors()]);
                    return json_encode(['code'=>1, 'errmsg'=>'save score to db error']);
                }        
             
                $data['sign_money'] = $user->sign_money;
                break;

            default:
                U::W(['invalid data cat', $cat, __METHOD__,$_GET]);
                return;
        }        
        U::W([$data]);
        U::W(json_encode($data));
        return json_encode($data);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/mobilelist:gh_03a74ac96138
    public function actionMobilelist()
    {
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $models = MItem::find()->where(['kind'=>MItem::ITEM_KIND_MOBILE])->orderBy(['price'=>SORT_DESC])->all();
        $query = new \yii\db\Query();
        $query->select('*')->from(\app\models\MActivity::tableName())->where(['status'=>1])->orderBy(['id' => SORT_DESC])->all();   
        $rows = $query->createCommand()->queryAll();
        foreach($models as &$model)
        {
            foreach($rows as &$row)
            {
                $ids = explode(",", $row['iids']); 
                if (in_array($model['iid'], $ids)) 
                {
                   $model['price']=($model['price']*$row['discount'])/10;
                   $model['title_hint']="<span class='activity'>限时促销!</span>&nbsp;&nbsp;".$model['title_hint'];
                }
            }
        }
        return $this->render('mobilelist', ['gh_id'=>$gh_id, 'openid'=>$openid, 'models'=>$models]);
    }

    public function actionMobilelistxxx()
    {
        $this->layout ='wapy';
//        $gh_id = U::getSessionParam('gh_id');
//        $openid = U::getSessionParam('openid');

        $gh_id = MGh::GH_XIANGYANGUNICOM;
        $openid = MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;
        
        Yii::$app->wx->setGhId($gh_id);
        $models = MItem::find()->where(['kind'=>MItem::ITEM_KIND_MOBILE])->orderBy(['price'=>SORT_DESC])->all();
        $query = new \yii\db\Query();
        $query->select('*')->from(\app\models\MActivity::tableName())->where(['status'=>1])->orderBy(['id' => SORT_DESC])->all();   
        $rows = $query->createCommand()->queryAll();
        foreach($models as &$model)
        {
            foreach($rows as &$row)
            {
                $ids = explode(",", $row['iids']); 
                if (in_array($model['iid'], $ids)) 
                {
                   $model['price']=($model['price']*$row['discount'])/10;
                   $model['title_hint']="<span class='activity'>限时促销!</span>&nbsp;&nbsp;".$model['title_hint'];
                }
            }
        }
        return $this->render('mobilelist', ['gh_id'=>$gh_id, 'openid'=>$openid, 'models'=>$models]);
    }

    public function actionMobile()
    {
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        $item = MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$_GET['cid']]);
        return $this->render('mobile', ['cid'=>$_GET['cid'], 'gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$user, 'item'=>$item]);
    }

     //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/cardlist:gh_03a74ac96138
    public function actionCardlist()
    {
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $kind=$_GET['kind'];
        $models = MItem::find()->where(['kind'=>$kind])->orderBy(['price'=>SORT_DESC])->all();
        return $this->render('cardlist', ['gh_id'=>$gh_id, 'openid'=>$openid, 'models'=>$models,'kind'=>$kind]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/card:gh_03a74ac96138
    public function actionCard()
    {
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('card', ['cid'=>$_GET['cid'], 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/disk:gh_03a74ac96138
    public function actionDisk()
    {
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
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
        $this->layout ='wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        return $this->render('goodnumber', ['cid'=>MItem::ITEM_CAT_GOODNUMBER, 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_1ad98f5481f3
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/order:gh_03a74ac96138
    public function actionOrder()
    {        
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);    
        return $this->render('order', ['user'=>$user, 'gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/nearestoffice:gh_03a74ac96138
    public function actionNearestoffice()
    {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');        
        return $this->render('nearestoffice',['gh_id'=>$gh_id, 'openid'=>$openid]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/woke:gh_03a74ac96138
    public function actionWoke()
    {        
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');        
        //$openid = \app\models\MGh::GH_XIANGYANGUNICOM_OPENID_KZENG;
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null)
            throw new NotFoundHttpException('user does not exists');
            
//        return $this->render('woke', ['gh_id'=>$gh_id, 'openid'=>$openid, 'model'=>$model]);
        
        if ((!empty($model->scene_id)) && (!empty($model->mobile)))
            return $this->redirect(['wokelist']);    
            
        if (Yii::$app->request->isPost) 
        {
            $model->load(Yii::$app->request->post());
            if ($model->save(true,['mobile']))
            {
                $qr = $model->getQrImageUrl();
                return $this->redirect(['wokelist']);            
            }
            else
            {
                U::W($model->getErrors());
            }
        }        
        return $this->render('woke', ['gh_id'=>$gh_id, 'openid'=>$openid, 'model'=>$model]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/wokelist:gh_03a74ac96138:openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE
    public function actionWokelist()
    {           
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        $model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
       
        $scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt<0 ORDER BY create_time DESC',[':gh_id'=>$gh_id, ':scene_id'=>$model->scene_id])->all();
        
        //可提现沃点
        $ktxwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=1 ORDER BY create_time DESC',[':gh_id'=>$gh_id, ':scene_id'=>$model->scene_id])->all();
        
        //预期沃点
        $yqwd_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status=0',[':gh_id'=>$gh_id, ':scene_id'=>$model->scene_id])->all();

        //预期沃点 包含粉丝取消关注
        $yqwd_fans_qx_scenes = MSceneDetail::find()->where('gh_id=:gh_id AND scene_id=:scene_id AND scene_amt>0 AND status<>1 ORDER BY create_time DESC',[':gh_id'=>$gh_id, ':scene_id'=>$model->scene_id])->all();
        

        U::W(count($yqwd_fans_qx_scenes));
        return $this->render('wokelist', ['gh_id'=>$gh_id, 'openid'=>$openid, 'user'=>$model, 'scenes'=>$scenes, 'ktxwd_scenes'=>$ktxwd_scenes, 'yqwd_scenes'=>$yqwd_scenes, 'yqwd_fans_qx_scenes'=>$yqwd_fans_qx_scenes]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wap/orderinfo:gh_03a74ac96138
    public function actionOrderinfo($oid)
    {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');        

        $model = MOrder::findOne($oid);        
        if (\Yii::$app->request->isPost) 
        {
            if (isset($_POST['paykind']))
                $_POST['MOrder']['pay_kind'] = $_POST['paykind']; 
            $model->setAttributes($_POST['MOrder'], false);

            $model->save(false);
            if ($model->pay_kind == MOrder::PAY_KIND_CASH) 
            {
                return $this->redirect(['wap/order']);    
            }
                
            if ($model->pay_kind == MOrder::PAY_KIND_ALIWAP) 
            {
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
                //U::W($para_token);
                $alipaySubmit = new AlipaySubmit($alipay_config);
                $html_text = $alipaySubmit->buildRequestHttp($para_token);
                //U::W($html_text);
                $html_text = urldecode($html_text);
                $arr = $alipaySubmit->parseResponse($html_text);
                if(!empty($arr['res_error'])) 
                {
                    U::W($arr);
                    $msg =  print_r($arr['res_error_arr'], true);
                    return $this->render('alipay_msg', ['msg' => $msg]);                
                }
                //U::W($arr);
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
        }    
        //$office = MOffice::findOne($model->office_id);
        $item = MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$model->cid]);
        //$item = MItem::findOne($model->cid);
        return $this->render('orderinfo',['gh_id'=>$gh_id, 'openid'=>$openid, 'model' => $model, 'item' => $item]);
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
*/

