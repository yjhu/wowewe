<?php

/*
	http://hoyatech.net/wx/web/index.php	
	http://hoyatech.net/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3		//woso
	http://hoyatech.net/wx/web/index.php?r=msg&gh_id=gh_78539d18fdcc		//hoya	
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
use app\models\MyWechat;

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

}

/*
	public function actionIndex($gh_id)
	{
		return Yii::$app->wx->run($gh_id);
	}

*/
