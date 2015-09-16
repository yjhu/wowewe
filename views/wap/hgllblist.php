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
        <h1>惠购流量包</h1>
    </div>

    <div data-role="content">
        <!--<ul data-role="listview" data-inset="true">-->


        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">

            <?php 
                foreach($models as $model) { 
                if($model->cid==90010) {
            ?>
                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/hgllb', 'cid'=>$model->cid],true) ?>">
                        <img style='padding-top:10px' src="<?php echo $model->pic_url.'-120x120.jpg?v2' ?>">
                        <h2><?= $model->title ?></h2>
                        <p><?= $model->title_hint ?></p>
          
                        <?php if($model->old_price != 0){ ?>
                            <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <?php } ?>

                          <p>价格: ￥<?= $model->price/100 ?> &nbsp;&nbsp;<?= $model->price_hint; ?></p>
                    </a>
                </li>
            <?php   
                    }
                }
             ?>



             <?php 
                foreach($models as $model) { 
                if($model->cid==90000 || 
                    $model->cid==90001 || 
                    $model->cid==90002 ||
                    $model->cid==90003 || 
                    $model->cid==90004 || 
                    $model->cid==90005 ||
                    $model->cid==90008 ||
                    $model->cid==90009
                    ) {
            ?>
                <li><a data-ajax="false" href="<?php echo  Url::to(['wap/hgllb', 'cid'=>$model->cid],true) ?>">
                        <img style='padding-top:10px' src="<?php echo $model->pic_url.'-120x120.jpg?v2' ?>">
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
                        <p>价格: ￥<?= $model->price/100 ?> &nbsp;&nbsp;<?= $model->price_hint; ?></p>
                    </a>
                </li>
            <?php   
                    }
                }
             ?>


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
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/hgllblist:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '惠购流量包';
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
