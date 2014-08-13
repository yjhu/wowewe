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

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionStaff()
	{		
		$this->layout = 'wapx';
		$gh_id = U::getSessionParam('gh_id');
		$openid = U::getSessionParam('openid');
		//Yii::$app->wx->setGhId($gh_id);
		return $this->render('staff');
	}


}




/*
*/

