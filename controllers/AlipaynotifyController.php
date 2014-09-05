<?php

namespace app\controllers;

use \DOMDocument;
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

class AlipaynotifyController extends Controller
{
	public $enableCsrfValidation = false;

	//http://127.0.0.01/wx/web/alipaynotify.php?sign=a&notify_data=<notify><payment_type>1</payment_type><subject>title</subject><trade_no>2014090203200260</trade_no><buyer_email>tiger_wangyan@163.com</buyer_email><gmt_create>2014-09-02 20:48:32</gmt_create><notify_type>trade_status_sync</notify_type><quantity>1</quantity><out_trade_no>20140902204658</out_trade_no><notify_time>2014-09-02 20:48:43</notify_time><seller_id>2088512154429274</seller_id><trade_status>TRADE_SUCCESS</trade_status><is_total_fee_adjust>N</is_total_fee_adjust><total_fee>0.01</total_fee><gmt_payment>2014-09-02 20:48:43</gmt_payment><seller_email>wosotech@126.com</seller_email><price>0.01</price><buyer_id>2088002275139603</buyer_id><notify_id>10cfd9d2e9471e10e658d7ed55cb32d45c</notify_id><use_coupon>N</use_coupon></notify>
	public function actionIndex()
	{		
		U::W([__METHOD__,$_GET,$_POST]);
		$this->layout = false;
		$alipay_config = Alipay::getAlipayConfig();
		$alipayNotify = new AlipayNotify($alipay_config);
		$verify_result = $alipayNotify->verifyNotify();		
		if(!$verify_result)
		{
			Alipay::logResult(['Alipaynotify sign error', __METHOD__,$_GET,$_POST]);
			return "fail";
		}

		if ($alipay_config['sign_type'] == 'MD5') 
			$respObject = @simplexml_load_string($_POST['notify_data']);
		else if ($alipay_config['sign_type'] == '0001') 
			$respObject = @simplexml_load_string($alipayNotify->decrypt($_POST['notify_data']));
		else
			Alipay::logResult(['Alipaynotify sign_type error', __METHOD__,$_GET,$_POST]);
		$arr = json_decode(json_encode($respObject), true);
		U::W($arr);
		$oid = $arr['out_trade_no'];
		$model = MOrder::findOne($oid);
		if ($model === null)
		{
			U::W(['Invalid oid', $_GET, $_POST, $arr]);
			return "success";
		}
		$model->pay_kind = MOrder::PAY_KIND_ALIWAP;
		$model->aliwap_trade_no = $arr['trade_no'];
		$model->aliwap_total_fee = $arr['total_fee'];
		$model->aliwap_trade_status = $arr['trade_status'];
		$model->aliwap_buyer_email = $arr['buyer_email'];
		$model->aliwap_quantity = $arr['quantity'];
		$model->aliwap_gmt_payment = $arr['gmt_payment'];
		if($arr['trade_status'] == 'TRADE_FINISHED' || $arr['trade_status'] == 'TRADE_SUCCESS')
		{
			$model->status = MOrder::STATUS_OK;
		}
		else
		{
			U::W(['trade_status is not TRADE_FINISHED', $_GET, $_POST, $arr]);
		}
		if (!$model->save(false))
			U::W(['save db error', $_GET, $_POST, $arr, $model->getErrors()]);
		return "success";
	}
	
	
}

/*
Array
(
    [service] => alipay.wap.trade.create.direct
    [sign] => 19b59db112d8885af90f7d0716fe2c18
    [sec_id] => MD5
    [v] => 1.0
    [notify_data] => <notify><payment_type>1</payment_type><subject>??</subject><trade_no>2014090203200260</trade_no><buyer_email>tiger_wangyan@163.com</buyer_email><gmt_create>2014-09-02 20:48:32</gmt_create><notify_type>trade_status_sync</notify_type><quantity>1</quantity><out_trade_no>20140902204658</out_trade_no><notify_time>2014-09-02 20:48:43</notify_time><seller_id>2088512154429274</seller_id><trade_status>TRADE_SUCCESS</trade_status><is_total_fee_adjust>N</is_total_fee_adjust><total_fee>0.01</total_fee><gmt_payment>2014-09-02 20:48:43</gmt_payment><seller_email>wosotech@126.com</seller_email><price>0.01</price><buyer_id>2088002275139603</buyer_id><notify_id>10cfd9d2e9471e10e658d7ed55cb32d45c</notify_id><use_coupon>N</use_coupon></notify>
)

2014-09-04 16:41:27,Array
(
    [payment_type] => 1
    [subject] => title
    [trade_no] => 2014090203200260
    [buyer_email] => tiger_wangyan@163.com
    [gmt_create] => 2014-09-02 20:48:32
    [notify_type] => trade_status_sync
    [quantity] => 1
    [out_trade_no] => 20140902204658
    [notify_time] => 2014-09-02 20:48:43
    [seller_id] => 2088512154429274
    [trade_status] => TRADE_SUCCESS
    [is_total_fee_adjust] => N
    [total_fee] => 0.01
    [gmt_payment] => 2014-09-02 20:48:43
    [seller_email] => wosotech@126.com
    [price] => 0.01
    [buyer_id] => 2088002275139603
    [notify_id] => 10cfd9d2e9471e10e658d7ed55cb32d45c
    [use_coupon] => N
    
)


		//$respArr = json_decode(json_encode($respObject), true);						
		//$arr = $respArr['notify'];

		$doc = new DOMDocument();	
		if ($alipay_config['sign_type'] == 'MD5') {
			$doc->loadXML($_POST['notify_data']);
		}

		if ($alipay_config['sign_type'] == '0001') {
			$doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
		}

		if(!empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue)) 
		{
			$oid = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
			$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
			$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
			if($trade_status == 'TRADE_SUCCESS' || $trade_status == 'TRADE_FINISHED')
			{
				U::W("DOMDocument,$oid, $trade_no, $trade_status");
			}
		}

*/

