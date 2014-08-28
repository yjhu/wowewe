<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Multi-page template</title>
<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

	<?php
		use app\models\Wechat;
		use app\models\MyWechat;

		Yii::$app->wx->setParameterComm();
		Yii::$app->wx->setParameter("body", urlencode("testjsjsjsjsa"));
		Yii::$app->wx->setParameter("out_trade_no", Wechat::generateOutTradeNo());
		Yii::$app->wx->setParameter("total_fee", "1");
		Yii::$app->wx->setParameter("spbill_create_ip", "127.0.0.1");
	?>

	<script language="javascript">
	function callpay()
	{
		WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo Yii::$app->wx->create_biz_package(); ?>,function(res){
		WeixinJSBridge.log(res.err_msg);
		alert(res.err_code+res.err_desc+res.err_msg);
		if(res.err_msg == 'get_brand_wcpay_request:ok') {
			alert('ok');
		} else {
			alert('启动微信支付失败, 请检查你的支付参数. 详细错误为: ' + res.err_msg);
		}

		});
	}
	</script>
	<button type="button" onclick="callpay()">wx pay test</button>


	<?php

		//test native url begin		
		$productId = '1234';
		$url = Yii::$app->wx->create_native_url($productId);	
		\app\models\U::W("native url={$url}");		
		//$tag = Html::a('click here to native pay', $url);	
		$tag = "<a href=\"{$url}\">click here to native pay</a>";	
		echo $tag;

	?>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<?php
/*
	<link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.3.min.css">
	<link rel="stylesheet" href="../_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../_assets/js/index.js"></script>
	<script src="../js/jquery.mobile-1.4.3.min.js"></script>

	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/css/themes/default/jquery.mobile-1.4.3.min.css');
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/css/jqm-demos.css'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.js'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/js/index.js'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.mobile-1.4.3.min.js'); 
*/

