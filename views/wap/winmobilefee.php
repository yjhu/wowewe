<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');
$this->title = '拼人品 抢流量';
?>

<style type="text/css">
	.foot{
		color:#aaa;
		font-size:10pt;
	}

	.myHeadIcon
	{
		/* border-radius: 50%; */
	}

	.we{
		line-height:120%;
		color:#aaa;
		font-size:12pt;
	}

/* Sticky Footer */

</style>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<?php echo Html::img(Url::to('images/winmobilefee.jpg'), ['class'=>'img-responsive']); ?>

			<div class="table-responsive">
			<table width="100%" class="table" border="0">
				<tbody>
					<tr>
						<td width=20%>
						<img class="myHeadIcon" src="<?php echo $user->headimgurl; ?>" width="72">
						</td>
						<td>
							<span class="we">
							<?= $user->nickname; ?>
							<?php
								$str = $user_founder->mobile;
								echo substr_replace($str,'*****',3,5);
							?>
							<br>
							已在襄阳联通抢到
							<font color=red>
							<?= count($user_fans)*300 ?>兆</font>流量
							</span>
						</td>
					</tr>
				</tbody>
			</table>
			</div>

			<span class="we">
			<?php if ($user->openid == $user_fan->openid): ?>
				我的<a href="#" id="actFriends">小伙伴们</a>
			<?php else: ?>
				Ta的<a href="#" id="actFriends">小伙伴们</a>
			<?php endif; ?>		
			</span>

			<div class="table-responsive">
			<table width="100%" class="table">
				<tbody border=0>
					<tr>
						<td width=100%>
						
							<?php $key=0; foreach ($user_fans as $key => $user_fan) {?>
								<img class="myHeadIcon" src="<?php echo $user_fan->userFan->headimgurl; ?>" width="36">&nbsp;&nbsp;
								<?php if($key==5) echo "<br><br>"; ?>
							<?php } ?>

							<?php for($n=0;$n<(12-count($user_fans));$n++) {?>
								<?php echo Html::img(Url::to('images/blank36.jpg'), ['class'=>'myHeadIcon', 'width'=>'36']); ?>&nbsp;&nbsp;
								<?php 
									if((count($user_fans)+$n)==5) 
										echo "<br><br>"; 
								?>
							<?php } ?>

						</td>
					</tr>
				</tbody>
			</table>
			</div>

			<div class="form-group">

				<?php if ($user->openid == $user_fan->openid): ?>
					<?= Html::button('立即分享，让小伙们为我助力 !', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'share', 'id' => 'shareBtn']) ?>
				<?php else: ?>
					<?= Html::button('立即分享，让小伙们为Ta助力 !', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'share', 'id' => 'shareBtn']) ?>
				<?php endif; ?>		

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
				
				<!--
				<br>
				<center>
				<span class="foot">
				资源有限，先到先得！<a href="#" id="actInfo">活动规则详情>>></a>
				<br>
				@襄阳联通
				</span>
				<center>
				-->
			</div>
		<?php ActiveForm::end(); ?>
	</div>

</div>
<br>
<br>

<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="row">
    	<div class="col-md-4"><a class="navbar-brand" href="#" id="actJoin">我要参加</a></div>
		<div class="col-md-4"><a class="navbar-brand" href="#">@襄阳联通</a></div>
		<div class="col-md-4"><a class="navbar-brand" href="#" id="actInfo">活动规则</a></div>
	</div>

</nav>

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
	$show = false;
	yii\bootstrap\Modal::begin([
		
		'header' => '<h2>给我助力的小伙伴</h2>',
		'options' => [
			'id' => 'sharePop3',
			//'style' => 'opacity:0.9;color:#ffffff;bgcolor:#000000;width:90%;',
           'style' => 'opacity:0.95;',
		], 
		//'footer' => "&copy; <span style='color:#d71920'>襄阳联通</span> ".date('Y'),
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
<div class="table-responsive">
<table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>头像</th>
            <th>昵称</th>
            <th>助力时间</th>
          </tr>
        </thead>
        <tbody>
		<?php foreach ($user_fans as $key => $user_fan) {?>
			<tr>
			<td><?= $key+1 ?></td>
			<td><img class="myHeadIcon" src="<?php echo $user_fan->userFan->headimgurl; ?>" width="32"></td>
			<td><?= $user_fan->userFan->nickname ?></td>
			<td><?= $user_fan->create_time ?></td>
			</tr>
		<?php } ?>
        </tbody>
      </table>
</div>
<?php yii\bootstrap\Modal::end(); ?>



<?php 
	$show = false;
	yii\bootstrap\Modal::begin([
		
		'header' => '<h2>我要参加</h2>',
		'options' => [
			'id' => 'sharePop4',
           'style' => 'opacity:0.95;',
		], 
		//'footer' => "&copy; <span style='color:#d71920'>襄阳联通</span> ".date('Y'),
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

<?php $form = ActiveForm::begin(['id' => 'contact-form1']); ?>
<div class="form-group1">

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
<?php endif; ?>

</div>
<?php ActiveForm::end(); ?>

<?php yii\bootstrap\Modal::end(); ?>



<?php 
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/winmobilefee:'.Yii::$app->wx->getGhid().':pid='.$user->openid);

	$myImg = Url::to('images/magic_yellow.jpg', true);
	$title = '拼人品, 抢流量';
	$desc = '拼人品, 抢流量';

	$title = "{$user->nickname}正在拼人品抢流量";
	$title = "拼人品抢流量，3600兆流量免费抢！";
	$desc = "亲，{$user->nickname} 正在襄阳联通拼人品抢流量，请帮ta一把，拼起ta的人品";
?>

<script>
var user_fans="<?= count($user_fans); ?>";

jQuery(document).ready(function() {
	
	$("#shareBtn").click(function() {
		$('#sharePop').modal('show');
	});

	$("#actInfo").click(function() {
		$('#sharePop2').modal('show');
	});

	$("#actFriends").click(function() {
		$('#sharePop3').modal('show');
	});

	$("#actJoin").click(function() {
		$('#sharePop4').modal('show');
	});

	if(user_fans == 12) /*max fans*/
	{
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			//data: $("form#productForm").serialize()+"&cid="+cid+"&pkg3g4g="+pkg3g4g+"&pkgPeriod="+pkgPeriod+"&pkgMonthprice="+pkgMonthprice+"&pkgPlan="+pkgPlan+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid+"&address="+address+"&wid="+wid,
			data: "&cardType="+null+"&cid="+714+"&pkg3g4g="+null+"&pkgPeriod="+null+"&pkgMonthprice="+null+"&pkgPlan="+null+"&feeSum="+null+"&office="+null+"&selectNum="+null+"&username="+null+"&usermobile="+null+"&userid="+null+"&address="+null+"&wid=1_1",
			success:function(json_data){

				}
		});
		/*end of ajax*/
	}

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



<?php
/*
  

*/