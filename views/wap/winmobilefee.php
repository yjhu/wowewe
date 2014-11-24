<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');
$this->title = '拼人品 抢流量';
?>

<style type="text/css" media="screen">
	.foot{
		color:#aaa;
		font-size:10pt;
	}

	.myHeadIcon
	{
		/* border-radius: 50%; */
	}

	.we{
		line-height:280%;
		color:#aaa;
		font-size:12pt;
	}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<?php echo Html::img(Url::to('images/winmobilefee.jpg'), ['class'=>'img-responsive']); ?>

			<center>
			<span class="we">
			<!--<//?php echo $user->nickname ?>-->

			<?php if ($user->openid == $user_fan->openid): ?>
				我和我的小伙伴们
			<?php else: ?>
				Ta和Ta的小伙伴们
			<?php endif; ?>		
			<br>
  			<img class="myHeadIcon" src="<?php echo $user->headimgurl; ?>" width="48">
			<br>

			<?php foreach ($user_fans as $key => $user_fan) {?>
		
				&nbsp;<img class="myHeadIcon" src="<?php echo $user_fan->userFan->headimgurl; ?>" width="36">
				<?php if($key==5) echo "<br>"; ?>
			<?php } ?>
			</span>
			</center>

			<br><br>
			<div class="form-group">

				<?= Html::button('立即分享，让小伙们为我助力 !', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'share', 'id' => 'shareBtn']) ?>
		
				<?php if (count($user_fans) >= 12): ?>
					<center>
					<h1><font color=red>恭喜你！</font><h1>
					<h4>你已经攒足人品，可领一份流量大奖 。</h4>
					<br>
					</center>

				<?php else: ?>

					<?php if($canJoin) {?>
					<br>
						<?= $form->field($user_founder, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'仅限襄阳联通3G号码', 'class'=>'form-control input-lg'])->label(false); ?>
						<?= Html::submitButton('填写手机号，马上参加！', ['class' => 'btn btn-danger btn-block btn-lg', 'name' => 'join']) ?>
					<?php } ?>

					<?= Html::submitButton('助 Ta 一臂之力', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'help']) ?>
					
				<?php endif; ?>

				<br>
				<center>
				<span class="foot">
				资源有限，先到先得！<a href="#" id="actInfo">活动规则详情>>></a>
				<br>
				@襄阳联通
				</span>
				<center>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<?php 
	$show = false;
	yii\bootstrap\Modal::begin([
		
		//'header' => '<h2>拼人品抢流量</h2>',
		'options' => [
			'id' => 'sharePop',
			//'style' => 'opacity:0.9;color:#ffffff;bgcolor:#000000;width:90%;',
           'style' => 'opacity:0.8;',
		],
        'header' => Html::img(Url::to('images/share.png'), ['class'=>'img-responsive']),   
		//'footer' => "&copy; <span style='color:#d71920'>襄阳联通</span> ".date('Y'),
		//'size' => 'modal-lg',
		'size' => 'modal-sm',
		//'toggleButton' => ['label' => 'click me'],
		'clientOptions' => [
			'show' => $show,
		],
		'closeButton' => [
			//'label' => '&times;',
            'label' => '',
		]
	]);
?>

<?php yii\bootstrap\Modal::end(); ?>



<?php 
	$show = false;
	yii\bootstrap\Modal::begin([
		
		'header' => '<h2>活动规则详情</h2>',
		'options' => [
			'id' => 'sharePop2',
			//'style' => 'opacity:0.9;color:#ffffff;bgcolor:#000000;width:90%;',
           'style' => 'opacity:0.9;',
		], 
		'footer' => "&copy; <span style='color:#d71920'>襄阳联通</span> ".date('Y'),
		//'size' => 'modal-lg',
		'size' => 'modal-sm',
		'clientOptions' => [
			'show' => false
		],
		'closeButton' => [
			'label' => '&times;',
            //'label' => '',
		]
	]);
?>
<div id="result">
活动规则详情活动规则详情活动规则详情活动规则详情活动规则详情活动规则详情
</div>
<?php yii\bootstrap\Modal::end(); ?>




<?php 
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/winmobilefee:'.Yii::$app->wx->getGhid());

	$myImg = Url::to('images/icon_res_download_collect.png');
	$title = '拼人品, 抢流量';
	$desc = '拼人品, 抢流量';
?>

<script>

jQuery(document).ready(function() {
	
	$("#shareBtn").click(function() {
		$('#sharePop').modal('show');
	});

	$("#actInfo").click(function() {
		$('#sharePop2').modal('show');
	});


});


var dataForWeixin={
	appId:"<?php echo $appid; ?>",
	MsgImg:"<?php echo $myImg; ?>",
	TLImg:"<?php echo $myImg; ?>",
	url:"<?php echo $url; ?>",
	title:"<?php echo $title; ?>",
	desc:"<?php echo $desc; ?>",
	fakeid:"",
	prepare:function(argv)
	{                        
	},

	callback:function(res)
	{
		//发送给好友或应用
		if (res.err_msg=='send_app_msg:confirm') {
			//todo:func1();
			///alert(res.err_desc);
		}
		if (res.err_msg=='send_app_msg:cancel') {
		}
		//分享到朋友圈
		if (res.err_msg=='share_timeline:confirm') {
		}
		if (res.err_msg=='share_timeline:cancel') {
		}
		//分享到微博
		if (res.err_msg=='share_weibo:confirm') {
		}
		if (res.err_msg=='share_weibo:cancel') {
		}
		//收藏或分享到应用
		if (res.err_msg=='send_app_msg:ok') {
		}   	
	}
};
</script>

<!--
<//?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive']); ?>
-->

<?php
/*
  

*/