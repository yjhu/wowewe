<?php

namespace app\controllers;
use app\models\JSSDK;
use app\models\MOffice;
use app\models\MOrder;
use app\models\MStaff;
use app\models\MUser;
use app\models\U;
use Yii;
use yii\web\Controller;

class WapxController extends Controller {
    public function behaviors() {
        return [
//            'access' => [
            //                'class' => AccessControl::className(),
            //                'only' => ['logout'],
            //                'rules' => [
            //                    [
            //                        'actions' => ['logout'],
            //                        'allow' => true,
            //                        'roles' => ['@'],
            //                    ],
            //                ],
            //            ],
            //            'verbs' => [
            //                'class' => VerbFilter::className(),
            //                'actions' => [
            //                    'logout' => ['post'],
            //                ],
            //            ],
        ];
    }

    public function init() {
        //U::W(['init....', $_GET,$_POST, $GLOBALS]);
        //U::W(['init....', $_GET,$_POST]);
    }

    public function beforeAction($action) {
        return true;
    }

    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/staffsearch&gh_id=gh_03a74ac96138&openid=oKgUduNHzUQlGRIDAghiY7ywSeWk&owner=1
    public function actionStaffsearch($gh_id, $openid) {
        if (Yii::$app->request->isAjax) {
            U::W('is ajax....');
        }

        if (isset($_GET['owner'])) {
            Yii::$app->session['owner'] = 1;
        }
        $this->layout = 'wapx';
        //Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($user !== null && $user->is_liantongstaff == 0) {
            $user->is_liantongstaff = 1;
            $user->save(false);
        }

        $model = MStaff::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            $model = new MStaff;
            $model->gh_id = $gh_id;
            $model->openid = $openid;
        } else if (empty($model->office_id) || empty($model->mobile) || empty($model->name)) {
            U::W('need fill more information');
        } else {
            return $this->redirect(['staffhome', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['staffbind', 'gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $model->mobile]);
        }
        return $this->render('staffsearch', ['model' => $model]);
    }

    public function actionStaffbind($gh_id, $openid) {
        if (Yii::$app->request->isAjax) {
            U::W('is ajax....');
        }

        $this->layout = 'wapx';
        $mobile = $_GET['mobile'];
        $model = MStaff::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            $model = MStaff::findOne(['mobile' => $mobile]);
            if ($model === null) {
                $model = new MStaff;
            }
            $model->gh_id = $gh_id;
            $model->openid = $openid;
            $model->mobile = $mobile;
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['staffhome', 'gh_id' => $gh_id, 'openid' => $openid]);
            } else {
                U::W($model->getErrors());
            }

        }
        return $this->render('staffbind', ['model' => $model]);
    }

    public function actionStaffhome($gh_id, $openid) {

        $this->layout = 'wapx';
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $model = MStaff::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffsearch', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        if (empty($model->office_id)) {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffbind', 'gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $model->mobile]);
        }
        $office = MOffice::findOne($model->office_id);
        if ($office === null) {
            U::W(['Invalid office.', __METHOD__, $gh_id, $openid]);
        }
        if (Yii::$app->request->post('Unbind') !== null) {
            //$n = MStaff::updateAll(['openid' => ''], 'gh_id = :gh_id AND openid = :openid', [':gh_id'=>$gh_id, ':openid'=>$openid]);
            $n = MStaff::deleteAll('gh_id = :gh_id AND openid = :openid', [':gh_id' => $gh_id, ':openid' => $openid]);
            U::W("Unbind $n");
            return $this->redirect(['staffsearch', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        return $this->render('staffhome', ['model' => $model, 'office' => $office, 'user' => $user]);
    }

    public function actionOfficeqr($gh_id, $openid) {
        $this->layout = false;
        $user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $model = MStaff::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffsearch', 'gh_id' => $gh_id, 'openid' => $openid]);
        }
        if (empty($model->office_id)) {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffbind', 'gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $model->mobile]);
        }
        $office = MOffice::findOne($model->office_id);
        return $this->render('officeqr', ['model' => $model, 'office' => $office, 'user' => $user]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/nearestmap&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&office_id=1&lon=114.361676377&lat=30.5824773524
    public function actionNearestmap($gh_id, $openid, $office_id, $lon, $lat) {
        $this->layout = false;
        $office = MOffice::findOne($office_id);
        return $this->render('nearestmap', ['office' => $office, 'lon_begin' => $lon, 'lat_begin' => $lat, 'lon_end' => $office->lon, 'lat_end' => $office->lat]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/officeposition&gh_id=gh_03a74ac96138&office_id=18
    //http://wosotech.com/wx/web/index.php?r=wapx/officeposition&gh_id=gh_03a74ac96138&office_id=18
    public function actionOfficeposition($gh_id, $office_id, $openid = null) {
        $this->layout = false;
        $office = MOffice::findOne($office_id);
        $lon = 0;
        $lat = 0;
        return $this->render('officeposition', ['office' => $office, 'lon_begin' => $lon, 'lat_begin' => $lat, 'lon_end' => $office->lon, 'lat_end' => $office->lat]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/wechatzhushou&gh_id=gh_03a74ac96138
    //http://wosotech.com/wx/web/index.php?r=wapx/wechatzhushou&gh_id=gh_03a74ac96138
    public function actionWechatzhushou() {
        $this->layout = false;

        return $this->render('wechat-zhushou');
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/wechatyulexiuxian&gh_id=gh_03a74ac96138
    public function actionWechatyulexiuxian() {
        $this->layout = false;

        return $this->render('wechat-yulexiuxian');
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/wechatzhuanshufuwu&gh_id=gh_03a74ac96138
    public function actionWechatzhuanshufuwu() {
        $this->layout = false;

        return $this->render('wechat-zhuanshufuwu');
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/nearestoutlets&gh_id=gh_03a74ac96138
    public function actionNearestoutlets() {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();
        $jssdk = new JSSDK($gh['appid'], $gh['appsecret']);

        $clientWechat = \app\models\ClientWechat::findOne(['gh_id' => $gh_id]);
        $outlets = \app\models\ClientOutlet::find()->where(['client_id' => $clientWechat->client_id])
        ->where(['<>', 'longitude', 0])->all();

        return $this->render('nearestoutlets', ['gh_id' => $gh_id, 'openid' => $openid, 'outlets' => $outlets, 'jssdk' => $jssdk]);
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/llbthzq&gh_id=gh_03a74ac96138
    public function actionLlbthzq() {
        $this->layout = false;

        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();
     
        return $this->render('llbthzq', ['gh_id' => $gh_id, 'openid' => $openid ]);
    }


    //http://wosotech.com/wx/web/index.php?r=wapx/zhideguangzhu&gh_id=gh_03a74ac96138
    public function actionZhideguangzhu() {
        $this->layout = false;
 
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();
  
        return $this->render('zhideguangzhu', ['gh_id' => $gh_id, 'openid' => $openid ]);
       // return $this->render('zhideguangzhu');
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/yaoyiyao&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138#wechat_redirect
    public function actionYaoyiyao() {
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
        
        $giftbox_id = \Yii::$app->request->get('giftbox_id');
        if (empty($giftbox_id)) {
            $giftbox = \app\models\GiftboxClaimed::findOne([
                'claimer_ghid' => $gh_id,
                'claimer_openid' => $openid,
            ]);
            if (empty($giftbox)) {
                if (empty($wx_user->openidBindMobiles)) {
                    $url = \yii\helpers\Url::to();
                    \Yii::$app->getSession()->set('RETURN_URL', $url);
                    return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
                } else {
                    $giftbox = new \app\models\GiftboxClaimed;
                    $giftbox->claimer_ghid = $gh_id;
                    $giftbox->claimer_openid = $openid;
                    $giftbox->claiming_time = time();
                    $giftbox->status = \app\models\GiftboxClaimed::STATUS_UNDERWAY;
                    $giftbox->save(false);
                    
                    $giftbox_helping = new \app\models\GiftboxHelped;
                    $giftbox_helping->giftbox_id = $giftbox->id;                    
                    $giftbox_helping->helper_ghid = $gh_id;
                    $giftbox_helping->helper_openid = $openid;
                    $giftbox_helping->helping_time = time();
                    $giftbox_helping->save(false);
                }
            }
        } else {
            $giftbox = \app\models\GiftboxClaimed::findOne(['id' => $giftbox_id]);
        }
        return $this->render('yaoyiyao', [
            'observer' => $wx_user,
            'giftbox' => $giftbox,
        ]);
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/qingliangyixia&gh_id=gh_03a74ac96138
    public function actionQingliangyixia() {
        $this->layout = false;
 
        return $this->render('qingliangyixia');
    }




    //http://localhost/wx/web/index.php?r=wapx/clientemployeelist&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&outlet_id=777
    public function actionClientemployeelist($gh_id, $openid, $outlet_id) {
        $this->layout = false;
        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $outlet_id = $_GET['outlet_id'];
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        return $this->render('client-employee-list', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'outlet' => $outlet]);
    }

    //http://localhost/wx/web/index.php?r=wapx/client-employee&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&employee_id=647
    public function actionClientEmployee($gh_id, $openid, $employee_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $employee = \app\models\ClientEmployee::findOne(['employee_id' => $employee_id]);

        $this->layout = false;
        return $this->render('client-employee', [
            'wx_user' => $wx_user,
            'employee' => $employee,
            'backwards' => $backwards,
        ]);

    }

    //http://localhost/wx/web/index.php?r=wapx/client-outlet&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&outlet_id=777
    public function actionClientOutlet($gh_id, $openid, $outlet_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);

        $this->layout = false;
        return $this->render('client-outlet', [
            'wx_user' => $wx_user,
            'outlet' => $outlet,
            'backwards' => $backwards,
        ]);

    }

    public function actionClientOutletEmployeeEdit($gh_id, $openid, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

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

        return $this->render('client-outlet-employee-edit', [
            'wx_user' => $wx_user,
            'entity' => $entity,
            'is_agent' => $is_agent,
            'outlet' => $outlet,
            'backwards' => $backwards,
        ]);
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/client-agent&gh_id=gh_03a74ac96138&openid=oKgUduHLF-HAxvHYIwmm3qjfqNf0&agent_id=1470&backwards=0
    public function actionClientAgent($gh_id, $openid, $agent_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $agent = \app\models\ClientAgent::findOne(['agent_id' => $agent_id]);

        $this->layout = false;
        return $this->render('client-agent', ['wx_user' => $wx_user, 'agent' => $agent, 'backwards' => $backwards]);
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/client-organization&gh_id=gh_03a74ac96138&openid=oKgUduHLF-HAxvHYIwmm3qjfqNf0&organization_id=1&backwards=0
    public function actionClientOrganization($gh_id, $openid, $organization_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $organization = \app\models\ClientOrganization::findOne(['organization_id' => $organization_id]);

        $this->layout = false;
        return $this->render('client-organization', ['wx_user' => $wx_user, 'organization' => $organization, 'backwards' => $backwards]);
    }

    public function actionWapxajax($args) {
        $args = json_decode($args, true);
        return call_user_func_array(array($args['classname'], $args['funcname']), $args['params']);
    }

    public function actionClientOrderList($gh_id, $openid, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $searchModel = new \app\models\ClientOrderSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        $this->layout = false;
        return $this->render('client-order-list', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionClientOrder($gh_id, $openid, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $this->layout = false;

        $office_id = $_GET['office_id'];
        $office = MOffice::findOne(['office_id' => $office_id]);

        $staff_id = $_GET['staff_id'];
        $staff = MStaff::findOne(['staff_id' => $staff_id]);

        $oid = $_GET['oid'];
        $order = MOrder::findOne(['oid' => $oid]);

        return $this->render('client-order', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'office' => $office,
            'staff' => $staff,
            'order' => $order,
        ]);
    }

    public function actionClientWechatFanList($gh_id, $openid, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $searchModel = new \app\models\ClientWechatFanSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        $this->layout = false;
        return $this->render('client-wechat-fan-list', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionClientCustomerList($gh_id, $openid, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $searchModel = new \app\models\ClientCustomerSearch;
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        $this->layout = false;
        return $this->render('client-customer-list', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionClientCustomer($gh_id, $openid, $customer_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $customer = \app\models\Custom::findOne(['custom_id' => $customer_id]);

        $this->layout = false;
        return $this->render('client-customer', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'customer' => $customer,
        ]);
    }

    public function actionClientWechatFan($gh_id, $openid, $wechat_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $wechat = \app\models\MUser::findOne(['id' => $wechat_id]);

        $this->layout = false;
        return $this->render('client-wechat-fan', [
            'wx_user' => $wx_user,
            'backwards' => $backwards,
            'wechat' => $wechat,
        ]);
    }

    public function actionWechatMessaging($gh_id, $openid, $reciever_id, $backwards = true, $pop = false) {
        if (!$backwards) {
            \app\models\utils\BrowserHistory::delete($gh_id, $openid);
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        } else if ($pop) {
            \app\models\utils\BrowserHistory::pop($gh_id, $openid);
        } else {
            \app\models\utils\BrowserHistory::push($gh_id, $openid);
        }

        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $reciever = \app\models\MUser::findOne(['id' => $reciever_id]);

        $this->layout = false;
        return $this->render('wechat-messaging', [
            'wx_user' => $wx_user,
            'reciever' => $reciever,
            'backwards' => $backwards,
        ]);
    }

}
