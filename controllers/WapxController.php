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

	//http://127.0.0.1/wx/web/index.php?r=wapx/staff&gh_id=gh_1ad98f5481f3&openid=1
	public function actionStaff()
	{		
//return $this->redirect(['staffscore']);

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
			$model = new MStaff;		
//			$model->gh_id = $gh_id;
			$model->gh_id = '111';
			$model->openid = $openid;			
		}		
		if ($model->load(Yii::$app->request->post())) 
		{		
			if ($model->save(false))
			{
				return $this->redirect(['staffscore']);							
			}
			else
				U::W($model->getErrors());
		} 
		
		return $this->render('staff', ['model' => $model]);
	}

	//http://127.0.0.1/wx/web/index.php?r=wapx/staffscore&gh_id=gh_1ad98f5481f3&openid=1
	public function actionStaffscore()
	{		
		//$this->layout = 'wapx';
		$this->layout = false;
		//$gh_id = U::getSessionParam('gh_id');
		//$openid = U::getSessionParam('openid');
		//Yii::$app->wx->setGhId($gh_id);
		return $this->render('staffscore');
	}

}




/*
*/

