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
        <?php if ($kind == MItem::ITEM_KIND_FLOW_CARD): ?>
            <h1>流量包</h1>
        <?php elseif ($kind == 3): ?>
            <h1>上网卡优惠 8折</h1>
        <?php else: ?>
            <h1>单卡产品</h1>
        <?php endif; ?>
    </div>

    <div data-role="content">
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">
        <!-- 流量包 -->
        <?php if($kind == MItem::ITEM_KIND_FLOW_CARD) {?>

             <?php foreach($models as $model) 
             	{ if($model->cid==702 || $model->cid==703 || $model->cid==704 || $model->cid==902 || $model->cid==903 || $model->cid==904) 
             		
             		{
             ?>
		                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/card', 'cid'=>$model->cid],true) ?>">
		                        <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
		                        <h2><?= $model->title ?></h2>
		                        <p><?= $model->title_hint ?></p>
		          				<!--
		                        <p class='line'>原价: ￥<//?= $model->old_price/100 ?></p>
		                        -->
		                        <!--
		                        <p>双11活动价: ￥<//?= $model->price/100 ?></p>
		                        -->

		                        <!--
		                        <p>惊爆价: ￥<//?= $model->price/100 ?></p>
		                        -->

		                         <p>价格: ￥<?= $model->old_price/100 ?></p>
		                    </a>
		                </li>
            <?php
             		}
             	}
             ?>

        <?php } ?>
          
        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>
</div> <!-- page1 end -->

<?php
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '流量包';
	$desc = '流量包优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
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
