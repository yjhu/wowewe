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
use app\models\MGh;
use app\models\MOrder;
use app\models\MItem;
use app\models\MMobnum;
use app\models\MStaff;
use app\models\MOffice;

class WapxController extends Controller
{
    public function behaviors()
    {
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

    public function init()
    {
        //U::W(['init....', $_GET,$_POST, $GLOBALS]);
        //U::W(['init....', $_GET,$_POST]);
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

    //http://127.0.0.1/wx/web/index.php?r=wapx/staffsearch&gh_id=gh_03a74ac96138&openid=oKgUduNHzUQlGRIDAghiY7ywSeWk&owner=1
    public function actionStaffsearch($gh_id, $openid)
    {        
        if (Yii::$app->request->isAjax)
            U::W('is ajax....');
        if (isset($_GET['owner']))
        {
            Yii::$app->session['owner'] = 1;
        }
        $this->layout = 'wapx';
        //Yii::$app->wx->setGhId($gh_id);

        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($user !== null && $user->is_liantongstaff == 0) {
            $user->is_liantongstaff = 1;
            $user->save(false);
        }
        
        $model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null)
        {
            $model = new MStaff;        
            $model->gh_id = $gh_id;
            $model->openid = $openid;            
        }        
        
        else if (empty($model->office_id) || empty($model->mobile) || empty($model->name))
        {
            U::W('need fill more information');
        }
        else
        {
            return $this->redirect(['staffhome', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
        
        if ($model->load(Yii::$app->request->post())) 
        {        
            return $this->redirect(['staffbind', 'gh_id'=>$gh_id, 'openid'=>$openid, 'mobile'=>$model->mobile]);
        }
        return $this->render('staffsearch', ['model' => $model]);
    }

    public function actionStaffbind($gh_id, $openid)
    {        
        if (Yii::$app->request->isAjax)
            U::W('is ajax....');
        $this->layout = 'wapx';
        $mobile = $_GET['mobile'];
        $model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null)
        {
            $model = MStaff::findOne(['mobile'=>$mobile]);
            if ($model === null)
            {
                $model = new MStaff;                    
            }
            $model->gh_id = $gh_id;
            $model->openid = $openid;
            $model->mobile = $mobile;
        }
        if ($model->load(Yii::$app->request->post())) 
        {        
            if ($model->save())            
            {
                return $this->redirect(['staffhome', 'gh_id'=>$gh_id, 'openid'=>$openid]);                            
            }
            else
                U::W($model->getErrors());
        }         
        return $this->render('staffbind', ['model' => $model]);
    }

    public function actionStaffhome($gh_id, $openid)
    {        

        $this->layout = 'wapx';
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        $model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null) 
        {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
        if (empty($model->office_id))
        {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffbind', 'gh_id'=>$gh_id, 'openid'=>$openid, 'mobile'=>$model->mobile]);                
        }
        $office = MOffice::findOne($model->office_id);
        if ($office === null)
        {
            U::W(['Invalid office.', __METHOD__, $gh_id, $openid]);
        }
        if (Yii::$app->request->post('Unbind') !== null)
        {
            //$n = MStaff::updateAll(['openid' => ''], 'gh_id = :gh_id AND openid = :openid', [':gh_id'=>$gh_id, ':openid'=>$openid]);
            $n = MStaff::deleteAll('gh_id = :gh_id AND openid = :openid', [':gh_id'=>$gh_id, ':openid'=>$openid]);
            U::W("Unbind $n");    
            return $this->redirect(['staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid]);    
        }
        
        return $this->render('staffhome', ['model' => $model, 'office'=>$office, 'user'=>$user]);
    }

    public function actionOfficeqr($gh_id, $openid)
    {        
        $this->layout = false;
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        $model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null) 
        {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
        if (empty($model->office_id))
        {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffbind', 'gh_id'=>$gh_id, 'openid'=>$openid, 'mobile'=>$model->mobile]);                
        }
        $office = MOffice::findOne($model->office_id);
        return $this->render('officeqr', ['model' => $model, 'office'=>$office, 'user'=>$user]);
    }



    //http://127.0.0.1/wx/web/index.php?r=wapx/officeorder&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE
    public function actionOfficeorder($gh_id, $openid)
    {        
        $this->layout = 'wapx';
        $user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        $model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
        if ($model === null) 
        {
            U::W(['Invalid openid.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffsearch', 'gh_id'=>$gh_id, 'openid'=>$openid]);
        }
        if (empty($model->office_id))
        {
            U::W(['Invalid office_id.', __METHOD__, $gh_id, $openid]);    
            return $this->redirect(['staffbind', 'gh_id'=>$gh_id, 'openid'=>$openid, 'mobile'=>$model->mobile]);                
        }
        $office = MOffice::findOne($model->office_id);
        return $this->render('officeorder', ['model' => $model, 'office'=>$office, 'user'=>$user]);

    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/nearestmap&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&office_id=1&lon=114.361676377&lat=30.5824773524
    public function actionNearestmap($gh_id, $openid, $office_id, $lon, $lat)
    {        
        $this->layout = false;
        $office = MOffice::findOne($office_id);
        return $this->render('nearestmap', ['office' => $office, 'lon_begin'=>$lon, 'lat_begin'=>$lat, 'lon_end'=>$office->lon, 'lat_end'=>$office->lat]);
    }

    //http://127.0.0.1/wx/web/index.php?r=wapx/officeposition&gh_id=gh_03a74ac96138&office_id=18
    //http://wosotech.com/wx/web/index.php?r=wapx/officeposition&gh_id=gh_03a74ac96138&office_id=18
    public function actionOfficeposition($gh_id, $office_id, $openid=null)
    {        
        $this->layout = false;
        $office = MOffice::findOne($office_id);
        $lon = 0;
        $lat = 0;
        return $this->render('officeposition', ['office' => $office, 'lon_begin'=>$lon, 'lat_begin'=>$lat, 'lon_end'=>$office->lon, 'lat_end'=>$office->lat]);        
    }


    //http://localhost/wx/web/index.php?r=wapx/clientemployeelist&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&outlet_id=777
    public function actionClientemployeelist($gh_id, $openid,$outlet_id)
    {
        $this->layout = false;    
        $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]);

        $outlet_id = $_GET['outlet_id'];
        $outlet = \app\models\ClientOutlet::findOne(['outlet_id' => $outlet_id]);
        return $this->render('client-employee-list', ['wx_user' => $wx_user, 'gh_id' => $gh_id, 'openid' => $openid, 'outlet' => $outlet]);
    }

    //http://localhost/wx/web/index.php?r=wapx/client-employee&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&employee_id=647
    public function actionClientEmployee($gh_id, $openid, $employee_id, $backwards = true, $pop = false)
    {
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
            'employee'=> $employee, 
            'backwards' => $backwards,
        ]);

    }
    
    //http://localhost/wx/web/index.php?r=wapx/client-outlet&gh_id=gh_03a74ac96138&openid=oKgUduJJFo9ocN8qO9k2N5xrKoGE&outlet_id=777
    public function actionClientOutlet($gh_id, $openid, $outlet_id, $backwards = true, $pop = false)
    {
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
            'outlet'=> $outlet, 
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
        $agent   = \app\models\ClientAgent::findOne(['agent_id' => $agent_id]);
        
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
        $organization   = \app\models\ClientOrganization::findOne(['organization_id' => $organization_id]);
        
        $this->layout = false;
        return $this->render('client-organization', ['wx_user' => $wx_user, 'organization' => $organization, 'backwards' => $backwards]);
    }


    public function actionWapxajax($funcname, $params) {
        \app\models\U::W('wapx/wapxajax');
        \app\models\U::W($funcname, $params);
        $params = json_decode($params, true);
        \app\models\U::W($funcname, $params);
        return call_user_func_array($funcname, $params);
    }




}
