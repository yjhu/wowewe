<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

use app\models\U;
use app\models\WxException;

use app\models\MUser;
use app\models\MOffice;

use app\models\MOrder;
use app\models\Alipay;
use app\models\AlipayNotify;

class AlipaycallbackController extends Controller
{
	public $enableCsrfValidation = false;

	//http://wosotech.com/wx/web/alipaycallback.php
	//http://127.0.0.01/wx/web/alipaycallback.php?out_trade_no=54096fafee91e&trade_no=2&result=success&sign=a
	public function actionIndex()
	{		
		U::W([__METHOD__,$_GET,$_POST]);
		//$this->layout = false;
		$this->layout = 'wapy';
		$alipay_config = Alipay::getAlipayConfig();
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if(!$verify_result)
		{
			Alipay::logResult(['Alipaycallback error', __METHOD__,$_GET,$_POST]);
			//return 'Alipaycallback error';
		}
		$result = $_GET['result'];
		if ($result != 'success')
		{
			Alipay::logResult(['Pay error', __METHOD__,$_GET,$_POST]);		
			return 'Pay error';
		}
		$oid = $_GET['out_trade_no'];
		$model = MOrder::findOne($oid);
		if ($model === null)
		{
			U::W(['Invalid oid', $_GET, $_POST]);
			return "Invalid oid";
		}
		$model->pay_kind = MOrder::PAY_KIND_ALIWAP;
		$model->aliwap_trade_no = $_GET['trade_no'];
		$model->status = MOrder::STATUS_OK;
		if (!$model->save(false))
		{
			U::W(['save db error', $_GET, $_POST, $model->getErrors()]);
			return 'system error';	
		}
			
		//return 'Pay OK';
		return $this->render('index',['gh_id'=>$model->gh_id, 'openid'=>$model->openid]);
	}
	
	
}

/*
Array
(
    [out_trade_no] => 20140902204658
    [request_token] => requestToken
    [result] => success
    [trade_no] => 2014090203200260
    [sign] => 9d82966ae8fda48ca3bf090d3fb0307f
    [sign_type] => MD5
)

*/

