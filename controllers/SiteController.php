<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\models\LoginForm;
use app\models\ContactForm;

use app\models\U;
use app\models\WxException;

use app\models\MUser;
use app\models\MContact;
use app\models\MOffice;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    
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
                    'logout' => ['get', 'post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => '\app\models\MyErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            
            'smcaptcha' => [
                'class' => 'app\models\SmCaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? '12345' : null,
            ],    
            
        ];
    }

    public function init()
    {
        //U::W(['init....', $_GET,$_POST]);
    }

    public function actionIndex()
    {        
        $office = null;
        if (!\Yii::$app->user->isGuest) 
        {
/*        
            if (is_numeric(Yii::$app->user->identity->openid))
            {
                $office = MOffice::findOne(Yii::$app->user->identity->openid);
                $username = $office->title;
            }
            else
*/            
                $office = Yii::$app->user->identity;
                $username = $office->username;
        }
        else
        {
            $username = '';
        }
        return $this->render('index', ['username'=>$username, 'office'=>$office]);
    }
    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            return $this->goBack();
        } 
        else 
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new MContact();
        if ($model->load(Yii::$app->request->post())) 
        {
            if ($model->save())
            {
                Yii::$app->session->setFlash('success','感谢您的反馈，我们会尽快回复您！');                
                return $this->refresh();
            }
        } 
        else 
        {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionContactOld()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) 
        {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        } 
        else 
        {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        $user = MOffice::findOne(Yii::$app->user->id);
//        if (is_numeric(Yii::$app->user->identity->openid))
//            $office = MOffice::findOne(Yii::$app->user->identity->openid);
        
        if ($user->load(Yii::$app->request->post())) 
        {
            if ($user->save(false, ['pswd']))
            {
                Yii::$app->session->setFlash('success','设置成功！');                
                return $this->refresh();
            }
            else
            U::W($user->getErrors());
        } 
        return $this->render('profile', [
            'model' => $user,
        ]);
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
    [nickname] => 何华斌
    [sex] => 1
    [language] => zh_CN
    [city] => 武汉
    [province] => 湖北
    [country] => 中国
    [headimgurl] => http://wx.qlogo.cn/mmopen/KBRNPfvbbrVbucASwD74Dric6NSCnVDycQNgicHwpYdFT74jhT7T6t6jT62zcOTtmumN7ia8QRtbRmvFRuzXPrBGqTQ22XuFk4w/0
    [subscribe_time] => 1402976898
)

*/

