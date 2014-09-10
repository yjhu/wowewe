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

use app\models\Alipay;

class AlipaymerchantController extends Controller
{
	public $enableCsrfValidation = false;
	
	public function actionIndex()
	{		
		$this->layout = false;
		return $this->redirect(['wap/order']);	
	}
		
}

/*
		Alipay::logResult([__METHOD__,$_GET,$_POST]);		
		return 'Alipaymerchant error';		

*/

