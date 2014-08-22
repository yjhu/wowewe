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
		//Yii::$app->wx->setGhId($gh_id);
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
			//U::W($model->getAttributes());
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


	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wapx/officeorder:gh_1ad98f5481f3
	//http://127.0.0.1/wx/web/index.php?r=wap/oauth2cb&state=wapx/officeorder:gh_03a74ac96138
	public function actionOfficeorder()
	{		
		$this->layout = 'wapx';
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');

		$user = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
	
		return $this->render('officeorder', ['user'=>$user]);
	}


}




/*
	http://127.0.0.1/wx/web/index.php?r=wapx/staffhome&gh_id=gh_1ad98f5481f3&openid=1

		if (empty($model->office_id) || empty($model->mobile) || empty($model->name))
		{
			$ar = MStaff::findOne(['mobile'=>$mobile]);
			if ($ar !== null)
			{
				$model->office_id = $ar->office_id;
				$model->name = $ar->name;
				$model->mobile = $mobile;			
			}		
		}
		//if ($model->load(Yii::$app->request->get())) 		
		
*/		

