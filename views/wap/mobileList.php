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
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    
    <style type="text/CSS">

        .ui-header .ui-title, .ui-footer .ui-title {
            margin-right: 0 !important; margin-left: 0 !important;
        }
    </style>

	<?php $this->head() ?>

</head>

<body>
<?php $this->beginBody() ?>

    <div data-role="page" id="page1" data-theme="c">

		<?php echo $this->render('header1', ['menuId'=>'menu1','title' => "特惠手机"]); ?>

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

        <div data-role="footer" data-position="fixed">
            <h4>&copy; 襄阳联通 2014</h4>
        </div>
        <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
    </div> <!-- page1 end -->

	<?php
		$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
		$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
		$appid = Yii::$app->wx->gh['appid'];
		$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
		$myImg = Url::to("$assetsPath/share-icon.jpg", true);
		$title = '特惠手机';
		$desc = '多款热销机型，优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
	?>

	<script>
		var dataForWeixin={
			appId:"<?php echo $appid; ?>",
			MsgImg:"<?php echo $myImg; ?>",
			TLImg:"<?php echo $myImg; ?>",
			url:"<?php echo $url; ?>",
			title:"<?php echo $title; ?>",
			desc:"<?php echo $desc; ?>",
			fakeid:"",
			prepare:function(argv) {	},
			callback:function(res){	 }
		};
	</script>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>



<?php
/*
 *
 *
 */
?>
