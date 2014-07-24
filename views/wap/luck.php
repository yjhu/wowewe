<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');

$this->title = '靓号运程';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<h3><?php echo Html::encode($this->title) ?>，祝您好运！</h3>
		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<?= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'请输入手机号码', 'class'=>'form-control input-lg'])->label(false); ?>

			<div class="form-group">
				<?= Html::submitButton('马上查看靓号运程！', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'contact-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<?php 
	$show = empty($lucy_msg) ? false : true;
	yii\bootstrap\Modal::begin([
		//'header' => '<h2>靓号运程</h2>',
		'options' => [
			//'style' => 'opacity:0.9;color:#ffffff;bgcolor:#000000;width:90%;',
                                                            'style' => 'opacity:0.9;',
		],
		//'header' => Html::img(Url::to('images/earth.jpg'), ['width'=>'200']),
                                        'header' => Html::img(Url::to('images/share.png'), ['class'=>'img-responsive']),   
                                        //'header' => Html::img(Url::to('images/share.png'), ['width'=>'300']),
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
<div id="result"><?php echo $result; ?></div>
<?php yii\bootstrap\Modal::end(); ?>

<br><br>

<?php 
$appid = Yii::$app->wx->gh['appid'];
$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/luck:'.Yii::$app->wx->getGhid());
if (empty($lucy_msg))
{
	$myImg = Url::to('images/magic_blue.jpg');
	$title = '靓号运程';
	$desc = '靓号运程，准的很，不信你试试！';
}
else
{
	if($lucy_msg['JX']=="吉")
		$myImg = Url::to('images/magic_yellow.jpg', true);
	else if($lucy_msg['JX']=="凶") 
		$myImg = Url::to('images/magic_black.jpg', true);
	else if($lucy_msg['JX']=="吉带凶") 
		$myImg = Url::to('images/magic_blue.jpg', true);
	else  
		$myImg = Url::to('images/magic_blue.jpg', true);
	$title = "{$username}的手机运程:{$lucy_msg['JX']}";
	$desc = "{$lucy_msg['JXDetail']};{$lucy_msg['GXDetail']}";
}
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
/*                       
		if (typeof argv.shareTo!='undefined') 
		{
			switch(argv.shareTo) {
				case 'friend':
				//发送给朋友
				alert(argv.scene); //friend
				break;
				case 'timeline':
				//发送给朋友
				break;
				case 'weibo':
				//发送到微博
				alert(argv.url);
				break;
				case 'favorite':
				//收藏
				alert(argv.scene);//favorite
				break;
				case 'connector':
				//分享到第三方应用
				alert(argv.scene);//connector
				break;
				default：
			}
		}
*/                         
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
	if (!$subscribed)
		echo Html::img(Url::to('images/wx-tuiguang1.png'), ['class'=>'img-responsive']); 
?>


<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>



<div class="site-login">
    <h3><?php echo Html::encode($this->title) ?>，祝您好运！</h3>
	   
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
		//'layout' => 'horizontal',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'手机号码'])->label(false); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 col-sm-11">
            <?= Html::submitButton('马上测算手机运程！', ['class' => 'btn btn-primary btn-success btn-block btn-lg', 'name' => 'login-button']) ?>
        </div>
    </div>
    
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">

		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		  Launch demo modal
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			  </div>
			  <div class="modal-body">
				body ...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>

	</div>
</div>

*/