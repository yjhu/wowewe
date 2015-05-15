<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MSceneDetail;
?>
    
<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

    .activity {
        color: red;
        font-size:14px;
        font-weight: bolder;
    } 

</style>

<div data-role="page" id="page1" data-theme="c">

	<div data-role="header">
    	<h1>双4G双百兆手机</h1>
    </div>

    <div data-role="content">
        
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" data-filter="true" data-filter-placeholder="搜索..." class="ui-nodisc-icon ui-alt-icon">
        

        <!--  /*5.1 手机直降*/ -->
        <?php foreach($models as $model) { 
            if(
                $model->cid==864 ||
                $model->cid==865 ||
                $model->cid==866 ||
                $model->cid==867 ||
                $model->cid==868 ||
                $model->cid==869 ||
                $model->cid==877
                )  
        { ?>
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid],true) ?>">
                    <img style='padding-top:10px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                    <h2><?= $model->title ?></h2>
                    <p><?= $model->title_hint ?></p>
                    <!--
                    <p class='line'>原价: ￥<//?= round($model->old_price/100) ?></p>
                    <p>惊爆价: ￥<//?= round($model->price/100) ?></p>
                    -->
                    <p>价格: ￥<?= round($model->price/100) ?></p>
                </a>
            </li>
        <?php } } ?>



        <!--  /*4g手机疯狂直降*/ -->
        <?php foreach($models as $model) { 
            if(
                $model->cid==859 ||
                $model->cid==860 ||
                /*$model->cid==861 ||  iphone6 16g*/
                $model->cid==862 ||
                $model->cid==863 
                )  
        { ?>
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid],true) ?>">
                    <img style='padding-top:10px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                    <h2><?= $model->title ?></h2>
                    <p><?= $model->title_hint ?></p>
                    <!--
                    <p class='line'>原价: ￥<//?= round($model->old_price/100) ?></p>
                    <p>惊爆价: ￥<//?= round($model->price/100) ?></p>
                    -->
                    <p>价格: ￥<?= round($model->price/100) ?></p>
                </a>
            </li>
        <?php } } ?>


        <?php foreach($models as $model) { 
            if($model->cid==850 || 
                $model->cid==851 ||
                /*$model->cid==852 ||*/
                $model->cid==853 ||
                $model->cid==854 ||
                $model->cid==855 ||
                $model->cid==856 ||
                $model->cid==857 ||
                $model->cid==858 
                )  
        { ?>
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid],true) ?>">
                    <img style='padding-top:10px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                    <h2><?= $model->title ?></h2>
                    <p><?= $model->title_hint ?></p>
                    <!--
                    <p class='line'>原价: ￥<//?= round($model->old_price/100) ?></p>
                    <p>惊爆价: ￥<//?= round($model->price/100) ?></p>
                    -->
                    <p>价格: ￥<?= round($model->price/100) ?></p>
                </a>
            </li>
        <?php } } ?>

        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->

<?php
	$src = MSceneDetail::SRC_ID_SHARE_FRIEND;
	$wid = implode('_', [U::getWid($gh_id, $openid), $src]);
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	//$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid().":wid={$wid}");
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '双4G双百兆手机';
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
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid, 'price'=>$model->price, 'title_hint'=>$model->title_hint],true) ?>">

 */
