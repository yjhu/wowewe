<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\U;
use app\models\WxException;

use app\models\MUser;
use app\models\MContact;
use app\models\MOffice;

class CbwapController extends Controller
{
	public $enableCsrfValidation = false;
	
	public function actionIndex()
	{		
		U::W($_GET);
		echo 'abc';
		return;
	}
	
	
}

/*

*/

