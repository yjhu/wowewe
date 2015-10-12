<?php

namespace app\controllers;
use app\models\JSSDK;
use app\models\MOffice;
use app\models\MOrder;
use app\models\MStaff;
use app\models\MUser;
use app\models\Messagebox;
use app\models\MGoods;
use app\models\MMobnum;
use app\models\MHelpdoc;


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


    //http://wosotech.com/wx/web/index.php?r=wapx/messagebox&gh_id=gh_03a74ac96138
    public function actionMessagebox() {
        $this->layout = false;
 
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();


        $model = MStaff::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        if ($model === null) {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffsearch', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        if (empty($model->office_id)) {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);
            return $this->redirect(['staffbind', 'gh_id' => $gh_id, 'openid' => $openid, 'mobile' => $model->mobile]);
        }

        $messageboxs = Messagebox::find()->where(['receiver' => $model->office_id])->orderBy(['msg_id' => SORT_DESC])->all();

        return $this->render('messagebox', ['gh_id' => $gh_id, 'openid' => $openid, 'messageboxs' => $messageboxs ]);
    }


    public function actionSms()
    {
        $this->layout = false;
        return $this->render('sms');
    }

    public function actionMessageboxdetail() {
        $this->layout = false;
 
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);

        $gh = Yii::$app->wx->getGh();

        $msg_id = $_GET['msg_id'];

        $messagebox = Messagebox::findOne(['msg_id' => $msg_id]);
        return $this->render('messageboxdetail', ['gh_id' => $gh_id, 'openid' => $openid, 'messagebox' => $messagebox ]);
    }



    // http://wosotech.com/wx/web/index.php?r=wapx/shoujiguishudi&gh_id=gh_03a74ac96138
    public function actionShoujiguishudi() {
        $this->layout = false;
 
        return $this->render('shoujiguishudi');
    }


    //only demo show 
    //http://wosotech.com/wx/web/index.php?r=wapx/demoshow1&gh_id=gh_03a74ac96138
    public function actionDemoshow1() {
        $this->layout = false;
 
        return $this->render('demoshow1');
    }


//http://wosotech.com/wx/web/index.php?r=wapx/game-ball&gh_id=gh_03a74ac96138
//https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/game-ball:gh_03a74ac96138#wechat_redirect
    public function actionGameBall() {
        $this->layout = false;
 
        //$gh_id = U::getSessionParam('gh_id');
        $gh_id = 'gh_03a74ac96138';

        $openid = U::getSessionParam('openid');
        $wx_user = \app\models\MUser::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
        ]);
        if (empty($wx_user) || $wx_user->subscribe === 0) {
            return $this->render('need_subscribe');
        }


        return $this->render('game-ball', [
            'observer' => $wx_user,
        ]);
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
    
    //https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/newfan-rewarding:gh_03a74ac96138#wechat_redirect
    public function actionNewfanRewarding() {
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
        
        $newfan_reward = \app\models\NewfanReward::findOne([
            'newfan_ghid' => $gh_id,
            'newfan_openid' => $openid,
        ]);
        if (empty($newfan_reward)) {
            if (empty($wx_user->openidBindMobiles)) {
                $url = \yii\helpers\Url::to();
                \Yii::$app->getSession()->set('RETURN_URL', $url);
                return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
            }
            $newfan_reward = new \app\models\NewfanReward;
            $newfan_reward->newfan_ghid = $gh_id;
            $newfan_reward->newfan_openid = $openid;
            $newfan_reward->save(false);
        }
        
        return $this->render('newfan-rewarding', [
            'newfan' => $wx_user,
            'rewarding' => $newfan_reward,
        ]);
    }

    //http://wosotech.com/wx/web/index.php?r=wapx/qingliangyixia&gh_id=gh_03a74ac96138
    public function actionQingliangyixia() {
        $this->layout = 'wapy';
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        //$model = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        //if (empty($model->openidBindMobiles)) {
        //    Yii::$app->getSession()->set('RETURN_URL', Url::to());
        //    return $this->redirect(['addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        //}

        return $this->render('qingliangyixia', ['gh_id' => $gh_id, 'openid' => $openid]);
    }






    //http://wosotech.com/wx/web/index.php?r=wapx/qingshi-author&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/qingshi-author:gh_03a74ac96138#wechat_redirect
    public function actionQingshiAuthor() {
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

        $qingshi_author = \app\models\MQingshiAuthor::findOne([
            'gh_id' => $gh_id,
            'author_openid' => $openid,
        ]);

        if (empty($qingshi_author)) {
            if (empty($wx_user->openidBindMobiles)) {
                $url = \yii\helpers\Url::to();
                \Yii::$app->getSession()->set('RETURN_URL', $url);
                return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
            } else {
                $qingshi_author = new \app\models\MQingshiAuthor;
                $qingshi_author->gh_id = $gh_id;
                $qingshi_author->author_openid = $openid;
                $qingshi_author->save(false);
            }
        }
       
        return $this->render('qingshi', [
            'observer' => $wx_user,
            'qingshi_author' => $qingshi_author,
        ]);
    }


    public function actionQingshiVote() {
        $this->layout = false;
        $id = $_GET["id"];

        //$gh_id = U::getSessionParam('gh_id');
        $gh_id = 'gh_03a74ac96138';
        $openid = U::getSessionParam('openid');
        $wx_user = \app\models\MUser::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
        ]);
        if (empty($wx_user) || $wx_user->subscribe === 0) {
            return $this->render('need_subscribe');
        }

        $qingshi_author = \app\models\MQingshiAuthor::findOne([
            'id' => $id,
        ]);

        return $this->render('qingshi-vote', [
            'observer' => $wx_user,
            'qingshi_author' => $qingshi_author,
        ]);
    }

    //201509 话费充值活动
    //http://wosotech.com/wx/web/index.php?r=wapx/hd201509t2&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t2:gh_03a74ac96138#wechat_redirect
    public function actionHd201509t2() {
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

        $bindMobiles = \app\models\OpenidBindMobile::findOne([
                'gh_id' => $gh_id,
                'openid' => $openid,
            ]);

        if (empty($bindMobiles)) 
        {
            $url = \yii\helpers\Url::to();
            \Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        } 

        $hd201509t1 = \app\models\MHd201509t1::findOne([
            'mobile' => $bindMobiles->mobile,
        ]);

        if(empty($hd201509t1))
        {
            //不在能充值的用户表中， 不符合充值条件，显示对不起页面
            return $this->render('hd201509t2_1');
        }    

        $hd201509t2 = \app\models\MHd201509t2::findOne([
            'mobile' => $hd201509t1->mobile,
        ]);

        if(empty($hd201509t2))
        {
            $hd201509t2 = new \app\models\MHd201509t2;
            $hd201509t2->gh_id = $gh_id;
            $hd201509t2->openid = $openid;
            $hd201509t2->mobile = $bindMobiles->mobile;
            $hd201509t2->status = 0;
            $hd201509t2->yfzx = $hd201509t1->yfzx;
            $hd201509t2->fsc = $hd201509t1->fsc;
            $hd201509t2->save(false);
        }

        return $this->render('hd201509t2', [
            'observer' => $wx_user,
            'hd201509t2' => $hd201509t2,
        ]);
    }


    //201509 捐献积分献爱心活动
    //http://wosotech.com/wx/web/index.php?r=wapx/hd201509t3&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t3:gh_03a74ac96138#wechat_redirect
    public function actionHd201509t3() {
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
        //是否会员
        $bindMobiles = \app\models\OpenidBindMobile::findOne([
                'gh_id' => $gh_id,
                'openid' => $openid,
            ]);
        if (empty($bindMobiles)) 
        {
            $url = \yii\helpers\Url::to();
            \Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        } 

        //是否在可捐献积分名单中
        $hd201509t3 = \app\models\MHd201509t3::findOne([
                'mobile' => $bindMobiles->mobile,
            ]);
        if (empty($hd201509t3)) 
        {
            //return $this->render('hd201509t3_1', [
            //    'observer' => $wx_user,
            //    ]);
            //flag 0 不在名单中，不符合捐献活动条件； 1 符合
            return $this->render('hd201509t3', [
                'observer' => $wx_user,
                'hd201509t3' => $hd201509t3,
                'flag' => 0,
            ]);
        }
        else
        {
            return $this->render('hd201509t3', [
                'observer' => $wx_user,
                'hd201509t3' => $hd201509t3,
                'flag' => 1,
            ]);
        }

    }
    

    //201509 捐献积分兑换列表页 
    //http://wosotech.com/wx/web/index.php?r=wapx/jfdhlist&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/jfdhlist:gh_03a74ac96138#wechat_redirect
    public function actionJfdhlist() {
        $this->layout = false;
        return $this->render('jfdhlist');
    }

    //新商品列表20150909
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wapx/goodslist:gh_03a74ac96138
    //https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/goodslist:gh_03a74ac96138:goods_kind=1#wechat_redirect
    public function actionGoodslist() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $goods_kind = $_GET['goods_kind'];
        $goods = MGoods::find()->where(['goods_kind' => $goods_kind])->all();

        return $this->render('goodslist', ['gh_id' => $gh_id, 'openid' => $openid, 'goods' => $goods, 'goods_kind' => $goods_kind]);
    }

    public function actionGoods() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        //$user = MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);
        $goods_id = $_GET['goods_id'];
        $good = MGoods::findOne(['goods_id' => $goods_id]);

        $goods_kind = $_GET['goods_kind'];

        return $this->render('goods', ['gh_id' => $gh_id, 'openid' => $openid, 'good' => $good, 'goods_kind' => $goods_kind]);
    }


    //帮助中心列表20151006
    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wapx/helpdoclist:gh_03a74ac96138
    //https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/helpdoclist:gh_03a74ac96138#wechat_redirect
    public function actionHelpdoclist() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $helpdocs = MHelpdoc::find()->where(['visual' => 1])->orderBy(['sort' => SORT_DESC])->all();

        return $this->render('helpdoclist', ['gh_id' => $gh_id, 'openid' => $openid, 'helpdocs' => $helpdocs ]);
    }

    public function actionHelpdoc() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');

        $helpdoc_id = $_GET['helpdoc_id'];
        $helpdoc = MHelpdoc::findOne(['helpdoc_id' => $helpdoc_id]);
        $helpdoc->sort = $helpdoc->sort + 1;
        $helpdoc->save(false);

        return $this->render('helpdoc', ['gh_id' => $gh_id, 'openid' => $openid, 'helpdoc' => $helpdoc ]);
    }




    //http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wapx/goodssave:gh_1ad98f5481f3
    public function actionGoodssave() {
        $this->layout = false;
        $gh_id = U::getSessionParam('gh_id');
        $openid = U::getSessionParam('openid');
        Yii::$app->wx->setGhId($gh_id);
        $order = new MOrder;
        $order->oid = MOrder::generateOid();
        $order->gh_id = $gh_id;
        $order->openid = $openid;
        $order->cid = $_GET["cid"];

        $good = MGoods::findOne(['goods_id' => $order->cid]);

        $order->title =  $good->title;
        //利用该字段做一个标记，在myorder 页面中兼容老的商品表item。
        $order->attr = 'goods';

        $order->val_pkg_3g4g = isset($_GET['pkg3g4g']) ? $_GET['pkg3g4g'] : '';
        $order->val_pkg_period = isset($_GET['pkgPeriod']) ? $_GET['pkgPeriod'] : 0;
        $order->val_pkg_monthprice = isset($_GET['pkgMonthprice']) ? $_GET['pkgMonthprice'] : 0;
        $order->val_pkg_plan = isset($_GET['pkgPlan']) ? $_GET['pkgPlan'] : '';
        //$order->feesum = $_GET['feeSum'] * 100;
        $order->feesum = $_GET['feeSum'] * 100;
        $order->office_id = (isset($_GET['office']) && $_GET['office'] != MOrder::NO_CHOICE) ? $_GET['office'] : 0;
  
        $order->userid = (isset($_GET['userid']) && $_GET['userid'] != MOrder::NO_CHOICE) ? $_GET['userid'] : '';
        $order->username = (isset($_GET['username']) && $_GET['username'] != MOrder::NO_CHOICE) ? $_GET['username'] : '';
        $order->usermobile = (isset($_GET['usermobile']) && $_GET['usermobile'] != MOrder::NO_CHOICE) ? $_GET['usermobile'] : '';
        //$order->pay_kind = isset($_GET['pay_kind']) ? $_GET['pay_kind'] : MOrder::PAY_KIND_CASH;
        $order->address = (isset($_GET['address']) && $_GET['address'] != MOrder::NO_CHOICE) ? $_GET['address'] : '';
        $order->kaitong = (isset($_GET['kaitong']) && $_GET['kaitong'] != MOrder::NO_CHOICE) ? $_GET['kaitong'] : '';

        $order->memo = (isset($_GET['memo']) && $_GET['memo'] != MOrder::NO_CHOICE) ? $_GET['memo'] : '';

        $order->detail = $order->getDetailStr();

        /*
        if ($_GET['selectNum'] != MOrder::NO_CHOICE) {
            $order->select_mobnum = $_GET['selectNum'];
            $mobnum = MMobnum::findOne($_GET['selectNum']);
            if ($mobnum === null || $mobnum->status != MMobnum::STATUS_UNUSED) {
                return json_encode(['status' => 1, 'errmsg' => $mobnum === null ? "mobile doest not exist" : "mobile locked!"]);
            }
        } else {
            $order->select_mobnum = '';
        }
        */
        $order->select_mobnum = '';

        /*
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
        */

        if ($order->save(false)) {

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


    //2015-9-18 中秋抢ipone6s活动 类似投票，积攒 活动， 基于七夕投票活动代码修改而成
 // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/zhongqiu-vote:gh_03a74ac96138#wechat_redirect
    public function actionZhongqiuVote() {

        /*
      $this->layout = false;
        $id = $_GET["id"];

        //$gh_id = U::getSessionParam('gh_id');
        $gh_id = 'gh_03a74ac96138';
        $openid = U::getSessionParam('openid');
        $wx_user = \app\models\MUser::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
        ]);
        if (empty($wx_user) || $wx_user->subscribe === 0) {
            return $this->render('need_subscribe');
        }

        $qingshi_author = \app\models\MQingshiAuthor::findOne([
            'id' => $id,
        ]);

        return $this->render('qingshi-vote', [
            'observer' => $wx_user,
            'qingshi_author' => $qingshi_author,
        ]);

        */
        $this->layout = false;
      
        //$gh_id = U::getSessionParam('gh_id');
        $gh_id = 'gh_03a74ac96138';
        $openid = U::getSessionParam('openid');

        $wx_user = \app\models\MUser::findOne([
            'gh_id' => $gh_id,
            'openid' => $openid,
        ]);
        if (empty($wx_user) || $wx_user->subscribe === 0) {
            return $this->render('need_subscribe');
        }


        if (empty($wx_user->openidBindMobiles)) {
            $url = \yii\helpers\Url::to();
            \Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        }

        if(isset($_GET["id"]))
        {
            $id = $_GET["id"];
            $zhongqiu_score = \app\models\MZhongqiuScore::findOne([
                'author_openid' => $id,
            ]);
        }
        else
        {
            $zhongqiu_score = \app\models\MZhongqiuScore::findOne([
                'author_openid' => $openid,
            ]);
        }


        if (empty($zhongqiu_score)) {
            $zhongqiu_score = new \app\models\MZhongqiuScore;
            $zhongqiu_score->author_openid = $openid;
            $zhongqiu_score->score = 0;
            $zhongqiu_score->save(false);
        }

        return $this->render('zhongqiu-vote', [
            'observer' => $wx_user,
            'zhongqiu_score' => $zhongqiu_score,
        ]);
    }




    //201509 中秋送话费活动
    //http://wosotech.com/wx/web/index.php?r=wapx/hd201509t6&gh_id=gh_03a74ac96138
    // https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t6:gh_03a74ac96138#wechat_redirect
    public function actionHd201509t6() {
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

        $bindMobiles = \app\models\OpenidBindMobile::findOne([
                'gh_id' => $gh_id,
                'openid' => $openid,
            ]);

        if (empty($bindMobiles)) 
        {
            $url = \yii\helpers\Url::to();
            \Yii::$app->getSession()->set('RETURN_URL', $url);
            return $this->redirect(['wap/addbindmobile', 'gh_id' => $gh_id, 'openid' => $openid]);
        } 

        $hd201509t5 = \app\models\MHd201509t5::findOne([
            'mobile' => $bindMobiles->mobile,
        ]);

        if(empty($hd201509t5))
        {
            //不在能充值的用户表中，表明是新用户
            $tcnx_flag = 0;
            $yfzx = "";
            $fsc = "";
        }
        else
        {
            if($hd201509t5->tcnx == 1)//76元套餐以下
                $tcnx_flag = 1;
            else
                $tcnx_flag = 2;

            $yfzx = $hd201509t5->yfzx;
            $fsc = $hd201509t5->fsc;
        }

        $hd201509t6 = \app\models\MHd201509t6::findOne([
            'mobile' => $bindMobiles->mobile,
        ]);

        if(empty($hd201509t6))
        {
            $hd201509t6 = new \app\models\MHd201509t6;
            $hd201509t6->gh_id = $gh_id;
            $hd201509t6->openid = $openid;
            $hd201509t6->mobile = $bindMobiles->mobile;
            $hd201509t6->status = 0;
            $hd201509t6->yfzx = $yfzx;
            $hd201509t6->fsc = $fsc;
            $hd201509t6->tcnx = $tcnx_flag;
            $hd201509t6->hbme = 0;
            $hd201509t6->save(false);
        }

        return $this->render('hd201509t6', [
            'observer' => $wx_user,
            'hd201509t6' => $hd201509t6,
        ]);
    }

    //微平台活动结束 提示页面
    public function actionGameover() {
        $this->layout = false;
        return $this->render('gameover');
    }


    //短信注册页面
    //http://wosotech.com/wx/web/index.php?r=wapx/sm-qr
    public function actionSmQr($mobile) {
        $this->layout = false;
        $model = \app\models\SceneidMobile::getModelByMobile($mobile);
        return $this->render('sm-qr',['qr_url' => $model->qr_url, "mobile" => $mobile]);
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
    
    public function actionMetronic($office_id = 0) {
        $this->layout = 'metronic';
        
        if (\Yii::$app->user->isAdmin) {
            if (0 !== $office_id) {
                $office = \app\models\MOffice::findOne(['office_id' => $office_id]);
            } else {
                $office = null;
            }
        } else if (\Yii::$app->user->isOffice) {
            $office = \Yii::$app->user->identity;
        }
        return $this->render('blank', ['target_office' => $office]);
    }
}
