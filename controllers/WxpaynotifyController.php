<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\U;
use app\models\WxException;
use app\models\Wechat;
use app\models\MUser;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MGh;
use app\models\MChannel;
use app\models\MOrder;
use app\models\MOrderTrail;
use app\models\MItem;
use app\models\MMobnum;
use app\models\MDisk;
use app\models\MG2048;
use app\models\MPkg;
use app\models\MSceneDetail;
use app\models\MWinMobileFee;
use app\models\MWinMobileNum;
use app\models\OpenidBindMobile;
use app\models\search\OpenidBindMobileSearch;

use app\models\Alipay;
use app\models\AlipaySubmit;
use app\models\JSSDK;
use app\models\HeatMap;

require_once __DIR__."/../models/wxpay/WxPayData.php";

use app\models\wxpay\NativePay;
use app\models\wxpay\WxPayNotify;
use app\models\wxpay\WxPayApi;
use app\models\wxpay\WxPayData;
use app\models\wxpay\WxPayUnifiedOrder;
use app\models\wxpay\WxPayOrderQuery;
use app\models\wxpay\WxPayConfig;


class WxpaynotifyController extends Controller
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
        //U::W(['init....', $_GET,$_POST, Yii::$app->request->getUrl()]);
    }

    public function beforeAction($action)
    {
        return true;
    }

    public function afterAction($action, $result)
    {
        U::W("{$this->id}/{$this->action->id}:".Yii::getLogger()->getElapsedTime());
        return parent::afterAction($action, $result);
    }
    
    public function actionIndex()
    {        
        U::W([__METHOD__, $_GET,$_POST]);
        $notify = new PayNotifyCallBack();
        $respXml = $notify->Handle(false);
        return $respXml;                
    }        
}

class PayNotifyCallBack extends WxPayNotify
{
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}

    /*
    data:Array
        (
            [appid] => wx1b122a21f985ea18
            [attach] => test
            [bank_type] => CFT
            [cash_fee] => 1
            [fee_type] => CNY
            [is_subscribe] => Y
            [mch_id] => 1234585602
            [nonce_str] => vwf9z3l6mzuqlg8f60mmztifw0i0dd7i
            [openid] => oKgUduJJFo9ocN8qO9k2N5xrKoGE
            [out_trade_no] => 55309EEB68562
            [result_code] => SUCCESS
            [return_code] => SUCCESS
            [sign] => FF9EC9C253216431B94C02E5D27D1C1B
            [time_end] => 20150417134947
            [total_fee] => 1
            [trade_type] => JSAPI
            [transaction_id] => 1001230398201504170068650671
        )

        // for test
        $data = [];
        $data['appid'] = 'wx1b122a21f985ea18';
        $data['attach'] = 'test';
        $data['bank_type'] = 'CFT';
        $data['cash_fee'] = '1';
        $data['fee_type'] = 'CNY';
        $data['is_subscribe'] = 'Y';
        $data['mch_id'] = '1234585602';
        $data['nonce_str'] = 'vwf9z3l6mzuqlg8f60mmztifw0i0dd7i';
        $data['openid'] = 'oKgUduJJFo9ocN8qO9k2N5xrKoGE';
        $data['out_trade_no'] = '5530864F670CB';
        $data['result_code'] = 'SUCCESS';
        $data['return_code'] = 'SUCCESS';
        $data['sign'] = 'FF9EC9C253216431B94C02E5D27D1C1B';
        $data['time_end'] = '20150417134947';
        $data['total_fee'] = '1';
        $data['trade_type'] = 'JSAPI';
        $data['transaction_id'] = '1001230398201504170068650671';
        
    */    
    public function NotifyProcess($data, &$msg)
    {
        //U::W([__METHOD__, $data, $msg]);	
        $notfiyOutput = array();

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }

        $order = MOrder::findOne($data["out_trade_no"]);
        $status_old = $order->status;        
        $pay_kind_old = $order->pay_kind;                
        $order->status = MOrder::STATUS_PAID;
        $order->partner = $data['mch_id'];
        $order->time_end = $data['time_end'];
        $order->total_fee = $data['total_fee'];
        $order->transaction_id = $data['transaction_id'];        
        $order->appid_recv = $data['appid'];
        $order->openid_recv = $data['openid'];        
        $order->issubscribe_recv = $data['is_subscribe'];
        $order->pay_kind = MOrder::PAY_KIND_WECHAT;        
        if ($order->save(false)) {
            $orderTrail = new MOrderTrail;
            $orderTrail->oid = $order->oid;
            $orderTrail->status_old = $status_old;
            $orderTrail->status_new = $order->status;
            $orderTrail->pay_kind_old = $pay_kind_old;
            $orderTrail->pay_kind_new = $order->pay_kind;            
            $orderTrail->save(false);        
        }

        return true;
    }
}

/*
        if ($data['trade_state'] == 0    )
        {
            Yii::$app->wx->clearGh();        
            Yii::$app->wx->setAppId($arr['AppId']);
            $arr = Yii::$app->wx->WxPayDeliverNotify($arr['OpenId'], $data['transaction_id'], $data["out_trade_no"]);
            //U::W($arr);
            try
            {        
                Yii::$app->wx->clearGh();
                Yii::$app->wx->setGhId($order->gh_id);
                $arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$order->openid,'msgtype'=>'text', 'text'=>['content'=>$order->getWxNotice(true)]]);                    
                //U::W($arr);        
            }
            catch (\Exception $e)
            {
                U::W($e->getCode().':'.$e->getMessage());
            }            
        }
        else
        {
            U::W(['trade_state is not 0', __METHOD__, $data, $_POST]);        
        }
*/        





