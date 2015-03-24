<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\SmCaptcha;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<style>

</style>


<div data-role="page" id="woke" data-theme="c">

	<?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '会员俱乐部']); ?>

	<div role="main" class="ui-content">
	
		<?php $form = ActiveForm::begin([
			'id' => "{$basename}_form",
			'enableClientScript'=>false,
			//'method' => 'get',
			//'options'=>['class'=>'ui-corner-all'],
			//'action' => ['wapx/staffscore'],
			'method' => 'post',
			'options'=>['class'=>'ui-corner-all', 'data' => ['ajax'=>'false']],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
		]); ?>

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'data' => ['clear-btn'=>'true'], 'placeholder'=>'输入手机号'])->label('手机号:') ?>

		<?php echo $form->field($model, 'verifyCode')->label('短信验证码')->widget(SmCaptcha::className(), [
			'template' => '{input}<label></label>{button}',	
			'buttonLabel' => '免费获取验证码',
		]) ?>

		<div class="ui-field-contain">
			<button type="submit" class="ui-shadow ui-btn ui-corner-all">立即绑定</button>
		</div>

		<?php ActiveForm::end(); ?>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2015</h4>
	</div>

</div>




<script>

</script>

<?php
/*
		<?php //echo $form->field($model, 'verifyCode')->input('tel', ['maxlength' => 11, 'data' => ['clear-btn'=>'true'], 'placeholder'=>'短信验证码'])->label('短信验证码:') ?>

		<?php //$this->widget('ext.SmCaptcha.ESmCaptcha', array('model'=>$model,'buttonLabel'=>'免费获取验证码','buttonType'=>'button','buttonOptions'=>array('style'=>'margin-left:5px;'))); ?>


	//		'template' => '<div class="row"><div class="col-lg-6">{input}</div><div class="col-lg-3">{image}</div></div>',
	//		'template' => '<div class="row">{input}{image}</div>',
	//		'template' => '{input}<div style="clear:both;">{image}</div>',

*/