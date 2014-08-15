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
use app\models\MDisk;
use app\models\MStaff;

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

	//http://127.0.0.1/wx/web/index.php?r=wapx/staffsearch
	public function actionStaffsearch()
	{		
		if (Yii::$app->request->isAjax)
			U::W('is ajax....');
		$this->layout = 'wapx';
		//$this->layout = false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		//Yii::$app->wx->setGhId($gh_id);
		$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model === null)
		{
			U::W("not found openid=$openid");
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
			return $this->redirect(['staffhome']);
		}
		
		if ($model->load(Yii::$app->request->post())) 
		{		
			return $this->redirect(['staffbind', 'mobile'=>$model->mobile]);
		}
		return $this->render('staffsearch', ['model' => $model]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wapx/staffbind&mobile=123
	public function actionStaffbind()
	{		
		if (Yii::$app->request->isAjax)
			U::W('is ajax....');
		$this->layout = 'wapx';
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		$mobile = $_GET['mobile'];
		//Yii::$app->wx->setGhId($gh_id);
		$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model === null)
		{
			$model = new MStaff;		
			$model->gh_id = $gh_id;
			$model->openid = $openid;
			$model->mobile = $mobile;
		}
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
		if ($model->load(Yii::$app->request->post())) 
		{		
		U::W($model->getAttributes());
			//if ($model->save(false))
			if ($model->save(false))
			{
				U::W('save ok ...');
				return $this->redirect(['staffhome']);							
			}
			else
				U::W($model->getErrors());
		} 
		
		return $this->render('staffbind', ['model' => $model]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wapx/staffhome
	public function actionStaffhome()
	{		
		$this->layout = 'wapx';
		//$this->layout = false;
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		//Yii::$app->wx->setGhId($gh_id);
		$model = MStaff::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		
		return $this->render('staffhome', ['model' => $model]);
	}

}




/*
	http://127.0.0.1/wx/web/index.php?r=wapx/staffhome&gh_id=gh_1ad98f5481f3&openid=1

*/

