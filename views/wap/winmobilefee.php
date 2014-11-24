<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');
$this->title = '拼人品抢流量';
?>

<style type="text/css" media="screen">
	.foot{
		color:#aaa;
		font-size:10pt;
	}

	.myHeadIcon
	{
		border-radius: 50%; 
	}

	.we{
		color:#aaa;
		font-size:12pt;
	}
</style>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<!--
			<//?//= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'请输入手机号码', 'class'=>'form-control input-lg'])->label(false); ?>
			-->
			<?php echo Html::img(Url::to('images/winmobilefee.jpg'), ['class'=>'img-responsive']); ?>

			<br>
			<center>
			<span class="we">
			<!--<//?php echo $user->nickname ?>-->
			我和我的小伙伴们
			<br>
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'48',"class"=>"myHeadIcon"]); ?>
			<br>

			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<br>
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			<?php echo Html::img(Url::to('images/woke/0.jpg'), ['width'=>'36',"class"=>"myHeadIcon"]); ?>&nbsp;
			</span>
			</center>

			<br><br>
			<div class="form-group">

				<?= Html::button('立即分享，让小伙们为我助力 !', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'share']) ?>
				<?= Html::button('我要参加', ['class' => 'btn btn-danger btn-block btn-lg', 'name' => 'join']) ?>
				<?= Html::submitButton('助 ta 一臂之力', ['class' => 'btn btn-info btn-block btn-lg', 'name' => 'help']) ?>
				<br>
				<center>
				<span class="foot">
				资源有限，先到先得！<a href="#">活动规则详情>>></a>
				<br>
				@襄阳联通
				</span>
				<center>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<?php 
	$show = empty($lucy_msg) ? false : true;
	yii\bootstrap\Modal::begin([
		//'header' => '<h2>拼人品抢流量</h2>',
		'options' => [
			//'style' => 'opacity:0.9;color:#ffffff;bgcolor:#000000;width:90%;',
           'style' => 'opacity:0.9;',
		],
        'header' => Html::img(Url::to('images/share.png'), ['class'=>'img-responsive']),   
		'footer' => "&copy; <span style='color:#d71920'>襄阳联通</span> ".date('Y'),
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
<div id="result">
<!--
<//?php echo $result; ?>
-->
</div>

<?php yii\bootstrap\Modal::end(); ?>


<?php 
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/luck:'.Yii::$app->wx->getGhid());

	$myImg = Url::to('images/magic_blue.jpg');
	$title = '拼人品抢流量';
	$desc = '拼人品抢流量';
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