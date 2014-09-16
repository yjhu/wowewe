<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');

$this->title = \app\models\MIphone6Sub::getCatName($model->cat).' 预订';
//$this->params['breadcrumbs'][] = $this->title;
?>

	<?php
		$this->registerJs(
		   '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		   yii\web\View::POS_READY
		);
	?>

	<h3><?php echo Html::encode($this->title) ?><!--，祝您好运！--> <br>已有<span style="font-size:48px;color:#ff0000;"><?= $n ?></span>人预订</h3>  

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success flash-success">
			<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php else: ?>
	<?php endif; ?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<?= $form->field($model, 'user_name')->textInput(['maxlength' => 10, 'placeholder'=>'输入姓名', 'class'=>'form-control input-lg'])->label(false); ?>
			<?= $form->field($model, 'user_contact')->textInput(['maxlength' => 128, 'placeholder'=>'输入联系地址及手机号码', 'class'=>'form-control input-lg'])->label(false); ?>
			<?= $form->field($model, 'user_id')->textInput(['maxlength' => 18, 'placeholder'=>'输入身份证号码', 'class'=>'form-control input-lg'])->label(false); ?>
			<div class="form-group">
				<?= Html::submitButton('我要预订', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'contact-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<hr />
<?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive']); ?>


<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

	if (!$subscribed)
		echo Html::img(Url::to('images/wx-tuiguang1.png'), ['class'=>'img-responsive']); 


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


*/