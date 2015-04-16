<?php
/*
ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);

require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';
*/
//模式一
/**
 * 流程：
 * 1、组装包含支付信息的url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
 * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
 * 5、支付完成之后，微信服务器会通知支付成功
 * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */
//$notify = new NativePay();
//$url1 = $notify->GetPrePayUrl("123456789");

//模式二
/**
 * 流程：
 * 1、调用统一下单，取得code_url，生成二维码
 * 2、用户扫描二维码，进行支付
 * 3、支付完成之后，微信服务器会通知支付成功
 * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
 */

/*
$input = new WxPayUnifiedOrder();
$input->SetBody("test");
$input->SetAttach("test");
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
$input->SetTotal_fee("1");
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("test");
//$input->SetNotify_url("http://wosotech.com/wx/vendor/wxpay/example/notify.php");
$input->SetNotify_url("http://wosotech.com/wx/web/wxpaynotify.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id("123456789");
$result = $notify->GetPayUrl($input);
$url2 = $result["code_url"];
*/
?>

<!--
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>微信支付样例-Native</title>

</head>
<body>
-->
    <script type="text/javascript">
                function jsApiCall()
                {
                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',
                        <?php echo $jsApiParameters; ?>,
                        function(res){
                            WeixinJSBridge.log(res.err_msg);
                            alert(res.err_code+res.err_desc+res.err_msg);
                        }
                    );
                }

                function callpay()
                {
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                        }
                    }else{
                        jsApiCall();
                    }
                }



                function jsApiCall_x()
                {
                    WeixinJSBridge.invoke(
                        'getBrandWCPayRequest',
                        <?php echo $jsApiParameters; ?>,
                        function(res){
                            WeixinJSBridge.log(res.err_msg);
                            alert(res.err_code+res.err_desc+res.err_msg);
                        }
                    );
                }

                function callpay_x()
                {
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', jsApiCall_x, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', jsApiCall_x); 
                            document.attachEvent('onWeixinJSBridgeReady', jsApiCall_x);
                        }
                    }else{
                        jsApiCall_x();
                    }
                }



	</script>

	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式一</div><br/>
    <?php echo $url1; ?><br/>
<a href="<?php echo $url1; ?>"> click me to pay </a>
	<img alt="模式一扫码支付" src="http://wosotech.com/wx/vendor/wxpay/example/qrcode.php?data=<?php echo urlencode($url1);?>" style="width:150px;height:150px;"/>
	<br/><br/><br/>

	<div style="margin-left: 10px;color:#556B2F;font-size:30px;font-weight: bolder;">扫描支付模式2</div><br/>
    <?php echo $url2; ?><br/>
<a href="<?php echo $url2; ?>"> click me to pay 2 </a>
	<img alt="模式2扫码支付" src="http://wosotech.com/wx/vendor/wxpay/example/qrcode.php?data=<?php echo urlencode($url2);?>" style="width:150px;height:150px;"/>
	<br/><br/><br/>
    

<a href="#" class="ui-shadow ui-btn ui-corner-all" id="btn-pay-weixin" style="background-color: #44B549" onclick="callpay()" >立即支付</a>


<br/>
<br/><br/><br/>
<a href="#" class="ui-shadow ui-btn ui-corner-all" id="btn-pay-weixin_x" style="background-color: #44B549" onclick="callpay_x()" >test</a>

<!--

</body>
</html>
-->