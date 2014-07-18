<?php

/*
	http://hoyatech.net/wx/web/index.php	
	http://hoyatech.net/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3		//woso
	http://hoyatech.net/wx/web/index.php?r=msg&gh_id=gh_78539d18fdcc		//hoya	
	http://127.0.0.1/wx/web/index.php?r=msg&gh_id=gh_1ad98f5481f3			//woso
	http://127.0.0.1/wx/web/index.php?r=msg&gh_id=gh_78539d18fdcc			//hoya
*/

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

use app\models\U;
use app\models\WxException;
use app\models\MUser;
use app\models\MyWechat;

class MsgController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionIndex($gh_id)
	{
		return Yii::$app->wx->run($gh_id);
	}
}

