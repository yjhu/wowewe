<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MItem;

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
            <h1>上网卡有惠</h1>
    </div>

    <div data-role="content">
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">
        
        <!-- 链接到网厅 -->
        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/xxx-120x120.jpg">
                <h2>本地60元流量月卡</h2>
                <p>每月本地60元包5G</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/xxx-120x120.jpg">
                <h2>45G包年流量套餐</h2>
                <p>45G省内流量+5G国内流量</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/xxx-120x120.jpg">
                <h2>96G包年流量套餐</h2>
                <p>90G省内流量+6G国内流</p>
                <p>&nbsp;</p>
            </a>
        </li>


        <!-- 链接到本地订单 -->
        <?php if($kind == MItem::ITEM_KIND_INTERNET_CARD) {?>
            <!--
            <//?//php foreach($models as $model) { if($model->cid==708 || $model->cid==709 || $model->cid==710|| $model->cid==711|| $model->cid==712|| $model->cid==713) {?>
            -->
             <?php foreach($models as $model) { if($model->cid==700 || $model->cid==701) {?>
                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/card', 'cid'=>$model->cid],true) ?>">
                        <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                        <h2><?= $model->title ?></h2>
                        <p><?= $model->title_hint ?></p>
          
                        <p class='line'>原价: ￥<?= $model->old_price/100 ?></p>
                        <!--
                        <p>双11活动价: ￥<//?= $model->price/100 ?></p>
                        -->
                        <p>惊爆价: ￥<?= $model->price/100 ?></p>
                    </a>
                </li>
            <?php } } ?>
        <?php } else {?>
            <?php foreach($models as $model) { ?>
                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/card', 'cid'=>$model->cid],true) ?>">
                        <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                        <h2><?= $model->title ?></h2>
                        <p><?= $model->title_hint ?></p>
          
                        <p class='line'>原价: ￥<?= $model->old_price/100 ?></p>
                  
                        <p>惊爆价: ￥<?= $model->price/100 ?></p>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>


        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
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
       <li><a data-ajax="false" href="http://wap.10010.com/t/businessTransact/query3gFlow.htm?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c215960148c4e5b725006e&menuId=000300010001">
                <img style='padding-top:20px' src="../web/images/item/liuliangbao-120x120.jpg">
                <h2>3G国内流量包</h2>
                <p>流量在手, 别无所求！</p>
                <p>&nbsp;</p>
            </a>
        </li>
 *
 */
?>
