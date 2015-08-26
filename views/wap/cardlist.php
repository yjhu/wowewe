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
        <?php if ($kind == 4): ?>
            <h1>5折流量包</h1>
        <?php elseif ($kind == 3): ?>
            <h1>上网卡优惠</h1>
        <?php else: ?>
            <h1>单卡产品</h1>
        <?php endif; ?>
    </div>

    <div data-role="content">
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">
        
        <!-- 双十一活动 -->

        <?php if($kind == MItem::ITEM_KIND_CARD) {?>
            <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711403121719.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d40ab930009">
                    <img style='padding-top:20px' src="../web/images/item/4Gliuliangbao-120x120.jpg">
                    <h2>4G全国套餐</h2>
                    <p>让您用得起 用得放心的套餐!</p>
                    <p>&nbsp;</p>
                </a>
            </li>

            <li><a data-ajax="false" href="http://www.10010.com/goodsdetail/711405149472.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d3a26690005&menuId=000300010001">
                    <img style='padding-top:20px' src="../web/images/item/ziyoutaocan-120x120.jpg">
                    <h2>4G组合套餐</h2>
                    <p>自由选择, 随意组合!</p>
                    <p>&nbsp;</p>
                </a>
            </li>
        <?php } ?>


        <?php if($kind == MItem::ITEM_KIND_INTERNET_CARD) {?>
            <!--
            <//?//php foreach($models as $model) { if($model->cid==708 || $model->cid==709 || $model->cid==710|| $model->cid==711|| $model->cid==712|| $model->cid==713) {?>
            -->

            <!-- 100元本地5G流量卡
            || $model->cid==711
            -->
             <?php foreach($models as $model) { if($model->cid==700 || $model->cid==701 || 
                $model->cid==715 || $model->cid==716 || $model->cid==717 || $model->cid==718 || $model->cid==719 || $model->cid==720 ||
                $model->cid==718 || $model->cid==717) 
            {?>
                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/card', 'cid'=>$model->cid],true) ?>">
                        <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg?v2' ?>">
                        <h2><?= $model->title ?></h2>
                        <p><?= $model->title_hint ?></p>
          
                        <!--
                        <//?php if(($model->cid != 718) || ($model->cid != 719)) { ?>  
                        <p class='line'>原价: ￥<//?= $model->old_price/100 ?></p>
                        <//?php } ?>
                        -->

                        <?php if($model->old_price != 0){ ?>
                            <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <?php } ?>

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
                        <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg?v2' ?>">
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
