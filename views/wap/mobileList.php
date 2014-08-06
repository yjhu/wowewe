<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

	use app\assets\JqmAsset;
	JqmAsset::register($this);

    use app\models\U;
    use app\models\MOffice;

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<?php 
/*
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/css/themes/default/jquery.mobile-1.4.3.min.css');
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/css/jqm-demos.css');
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.js');
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/js/index.js');
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.mobile-1.4.3.min.js');
*/
	?>

<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

    <div data-role="page" id="page1" data-theme="e">
        <div data-role="header">
            <h1 id="title">
             特惠手机
            </h1>
        </div>
        <div data-role="content">
            <ul data-role="listview" data-inset="true">
                <li><a data-ajax="false" href=" <?php echo  Url::to(['wap/mobile', 'cid'=>12],true) ?>">
                        <img src="../web/images/item/iphone4s.jpg">
                        <h2>苹果 Apple iPhone4S 8G 联通版</h2>
                        <p>经典苹果机型：800w背照式镜头 Siri语音控制功能 双核A5处理器 </p></a>
                </li>
                <li><a data-ajax="false" href=" <?php echo  Url::to(['wap/mobile', 'cid'=>14],true) ?>">
                        <img src="../web/images/item/htc-d516w.jpg">
                        <h2>HTC D516W 联通版</h2>
                        <p>智能手机性价比之王：5英寸QHD屏+四核1.2G处理器+联通3G双卡双待超长待机+1GRAM+4GROM+安卓4.3系统</p></a>
                </li>
                <li><a data-ajax="false" href=" <?php echo  Url::to(['wap/mobile', 'cid'=>13],true) ?>">
                        <img src="../web/images/item/coolpad-k1.jpg">
                        <h2>酷派 Coolpad K1 (7620L）联通版</h2>
                        <p>首款千元下4G智能手机：5.5英寸全贴合IPS高清大屏+8.1mm时尚纤薄机身+四核高通1.2G处理器+800万摄像头+联通4G/GSM双卡双待超长待机+1GRAM+4GROM+安卓4.3系统</p></a>
                </li>
            </ul>
        </div>

        <div data-role="footer">
            <h4>&copy; 襄阳联通 2014</h4>
        </div>
    </div> <!-- page1 end -->

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>


<script>

</script>	
<?php

?>
