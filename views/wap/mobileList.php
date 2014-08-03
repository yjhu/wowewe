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

    <div data-role="page" id="page1">
        <div data-role="header">
            <h1 id="title">
               优惠终端
            </h1>
        </div>
        <div data-role="content">
            <ul data-role="listview" data-inset="true">
                <li><a href=" <?php echo  Url::to(['wap/mobile', 'cid'=>12],true) ?>">
                        <img src="../web/images/item/iphone4s.jpg">
                        <h2>iPhone4S</h2>
                        <p>iPhone 4S 8G 送3600M流量</p></a>
                </li>
                <li><a href=" <?php echo  Url::to(['wap/mobile', 'cid'=>14],true) ?>">
                        <img src="../web/images/item/htc-d516w.jpg">
                        <h2>HTC516</h2>
                        <p>Hot Chip</p></a>
                </li>
                <li><a href=" <?php echo  Url::to(['wap/mobile', 'cid'=>13],true) ?>">
                        <img src="../web/images/item/coolpad-k1.jpg">
                        <h2>K1 7620L</h2>
                        <p>酷派（Coolpad）K1(7620L) 5.5英寸全贴合IPS高清大屏 8.1mm时尚纤薄机身</p></a>
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
