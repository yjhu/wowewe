<?php

/*
	http://wosotech.com/wx/web/index.php	
	http://wosotech.com/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3		//woso
	http://wosotech.com/wx/web/index.php?r=msg&gh_id=gh_78539d18fdcc		//hoya	
	http://wosotech.com/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3
	http://127.0.0.1/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3			//woso
	http://127.0.0.1/wx/web/index.php?r=msg&gh_id=gh_78539d18fdcc			//hoya
	http://127.0.0.1/wx/web/index.php?r=msg&gh_id=gh_03a74ac96138			//xiangyangunicom
	
*/

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

use app\models\U;
use app\models\WxException;
use app\models\MGh;
use app\models\MUser;
use app\models\Wechat;

class MsgController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionIndex($gh_id)
	{
		$wxConfig = require(__DIR__ . '/../config/wx.php');
		switch ($gh_id) 
		{
			case MGh::GH_XIANGYANGUNICOM:
				$wxConfig['class'] = 'app\models\WechatXiangYangUnicom';
				break;
				
			default:
				$wxConfig['class'] = 'app\models\WechatWoso';
				break;
		}
		$wechat = \Yii::createObject($wxConfig);		
		return $wechat->run($gh_id);	
	}

	public function afterAction($action, $result)
	{
		U::W("{$this->id}/{$this->action->id}:".Yii::getLogger()->getElapsedTime());
		return parent::afterAction($action, $result);
	}

	//http://wosotech.com/wx/web/index.php?r=msg/valid&token=HY09uB1h
	//http://127.0.0.1/wx/web/index.php?r=msg/valid&token=HY09uB1h
	public function actionValid($token)
	{
		if (0)
		{
			$_GET['signature'] = '228c2744ce651fb61cceb461c48fa03c608c1299';
			$_GET['echostr'] = '6372428126615300095';
			$_GET['timestamp'] = '1402529705';
			$_GET['nonce'] = '1023195716';
		}
		if (Wechat::checkSignature($token))
		{
			U::W(['Invalid Signature in actionValid()', $_GET]);
		}
		die($_GET['echostr']);
	}
}

