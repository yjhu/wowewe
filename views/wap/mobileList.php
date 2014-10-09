<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;

?>
    
<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
    color: #aaaaaa;
    text-decoration: line-through;
    }
</style>

<div data-role="page" id="page1" data-theme="c">

	<div data-role="header">
    	<h1>特惠手机</h1>
    </div>

    <div data-role="content">
        
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">

         <a data-ajax=false href="">
          
         </a>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711407153411.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c6577d0148c6c54ae50042&menuId=000300010001">
                <img style='padding-top:20px' src="../web/images/item/huawei-3c-120x120.jpg">
                <h2>华为荣耀3C</h2>
                <p>千元机之王 四核1.6GHz极速处理器</p>
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
                <p>惊爆价: ￥999</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711407153411.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c6577d0148c6c54ae50042&menuId=000300010001">
                <img style='padding-top:20px' src="../web/images/item/huawei-honor6-120x120.jpg">
                <h2>华为荣耀6</h2>
                <p>全球首款八核4G CAT6手机 顶级品质5.0英寸全高清屏 八核1.7GHz极速处理器</p>
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
                <p>惊爆价: ￥2199</p>
           
            </a>
        </li>

        <?php foreach($models as $model) { ?>
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid],true) ?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                    <h2><?= $model->title ?></h2>
                    <p><?= $model->title_hint ?></p>
                    <p class='line'>原价: ￥<?= $model->old_price/100 ?></p>
                    <p>惊爆价: ￥<?= $model->price/100 ?></p>
                </a>
            </li>
        <?php } ?>
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

<?php
/*
 *
 *
 */
?>
