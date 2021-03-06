<?php
use app\models\MSceneDetail;
use app\models\U;
use yii\helpers\Url;
?>

<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

    .jiang {
        color: red;
        font-weight: bolder;
    }

    .activity {
        color: red;
        font-size:14px;
        font-weight: bolder;
    }

</style>

<div data-role="page" id="page1" data-theme="c">

	<div data-role="header">
    	<h1>老用户专享优惠</h1>
    </div>

    <div data-role="content">
        <ul data-role="listview" data-inset="false" data-filter="true" data-filter-placeholder="搜索..." class="ui-nodisc-icon ui-alt-icon">

        <li><a data-ajax="false" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wap/querybymobile1:gh_03a74ac96138#wechat_redirect">
                <img style='padding-top:20px' src="/wx/web/images/womei-hint-120x120.jpg">
                <h2 style="color:red !important;">活动查询入口</h2>
                <p></p>
            </a>
        </li>

        <!-- 4月第4周老用户活动 -->
        <?php if ($flag2 == 1) {
    ?>

            <!--
            <li><a data-ajax="false" href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=208744312&idx=1&sn=c8e1b5a1b8dbbf8f4fa56846e0483714#rd">
                    <img style='padding-top:20px' src="/wx/web/images/womei-hint-120x120.jpg">
                    <h2 style="color:red !important;">老用户微平台四月活动</h2>
                    <p>合约价1000-2000元终端，按网龄年度<br>递增模式优惠，最高优惠200元；<br>合约价2000元以上终端，按网龄年度<br>递增模式优惠，最高优惠300元。</p>
                </a>
            </li>
            -->

            <?php foreach ($models as $model) {
        if ($model->cid == 876) {
            ?>
                <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                        <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg?v5'?>">
                        <h2><?=$model->title?></h2>
                        <p><?=$model->title_hint?></p>
                        
                        <?php if($model->old_price != 0){ ?>
                            <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                            <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                        <?php } ?>

                        <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                    </a>
                </li>
            <?php }}
    ?>

        <?php }
?>


        <?php foreach ($models as $model) {
        //6.18 
        if (
            $model->cid == 311 ||
            $model->cid == 853 ||
            $model->cid == 864 ||
            $model->cid == 865 ||
            $model->cid == 868 ||
            $model->cid == 869 ||
            $model->cid == 879 ||
            $model->cid == 880 ||
            $model->cid == 881 ||
            $model->cid == 882 ||
            $model->cid == 883 ||
            $model->cid == 884 ||
            $model->cid == 886 ||
            $model->cid == 887 ||
            $model->cid == 888 ||
            $model->cid == 889 ||
            $model->cid == 890 ||
            $model->cid == 70000 ||
            $model->cid == 70001 ||
            $model->cid == 70002 ||
            $model->cid == 70003
            ) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg?v5'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
        }
    }


    ?>


        <?php if ($flag1 == 1) {
    ?>


        <?php foreach ($models as $model) {
        if ($model->cid == 874) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
break;}
    }
    ?>

        <?php foreach ($models as $model) {
        if ($model->cid == 873) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
break;}
    }
    ?>


        <?php foreach ($models as $model) {
        if ($model->cid == 870) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
break;}
    }
    ?>

        <?php foreach ($models as $model) {
        if ($model->cid == 871) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
break;}
    }
    ?>

        <?php foreach ($models as $model) {
        if ($model->cid == 872) {
            ?>
            <li><a data-ajax="false" href="<?php echo Url::to(['wap/mobile', 'cid' => $model->cid], true)?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url . '-120x120.jpg'?>">
                    <h2><?=$model->title?></h2>
                    <p><?=$model->title_hint?></p>

                    <?php if($model->old_price != 0){ ?>
                        <p class='line'>原价: ￥<?=round($model->old_price / 100)?></p>
                        <p class='jiang'>直降&#8595;: ￥<?= round($model->old_price / 100)-round($model->price / 100)  ?></p>
                    <?php } ?>

                    <p>老用户专享价: ￥<?=round($model->price / 100)?></p>
                </a>
            </li>
        <?php
break;}
    }
    ?>


        <?php }
?>
        </ul>








        <?php if (($flag1 == 0) && ($flag2 == 0)) {?>
            <center>
            <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
            <h4>

            您不满足条件<br>暂时无法参与该优惠活动
            </h4>

            <h4>
            谢谢关注
            </h4>
            </center>
        <?php }
?>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>
    <?php echo $this->render('menu', ['menuId' => 'menu1', 'gh_id' => $gh_id, 'openid' => $openid]);?>
</div> <!-- page1 end -->

<?php
$src = MSceneDetail::SRC_ID_SHARE_FRIEND;
$wid = implode('_', [U::getWid($gh_id, $openid), $src]);
$this->registerJsFile(Yii::$app->getRequest()->baseUrl . '/js/wechat.js');
$assetsPath = Yii::$app->getRequest()->baseUrl . '/images';
$appid = Yii::$app->wx->gh['appid'];
//$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/lyhzxyh:' . Yii::$app->wx->getGhid() . ":wid={$wid}");
$myImg = Url::to("$assetsPath/share-icon.jpg", true);
$title = '老用户专享优惠';
$desc = '多款热销机型，优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
?>

<script>
	var dataForWeixin={
		appId:"<?php echo $appid;?>",
		MsgImg:"<?php echo $myImg;?>",
		TLImg:"<?php echo $myImg;?>",
		url:"<?php echo $url;?>",
		title:"<?php echo $title;?>",
		desc:"<?php echo $desc;?>",
		fakeid:"",
		prepare:function(argv) {	},
		callback:function(res){	 }
	};
</script>

<?php
/*
<li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid, 'price'=>$model->price, 'title_hint'=>$model->title_hint],true) ?>">

 */
