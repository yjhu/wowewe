<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use app\models\SmCaptcha;

/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */
/* @var $form ActiveForm */
?>

     <?php
          $this->registerJs(
             '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
             yii\web\View::POS_READY
          );
     ?>

<div class="mp-openidbindmobile-create">

    <br />

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success flash-success">
			<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php else: ?>
	<?php endif; ?>

    <?php //$form = ActiveForm::begin(); ?>

		<?php $form = ActiveForm::begin([
			'id' => "form_id",
			'enableClientScript'=>false,
			//'method' => 'get',
			//'options'=>['class'=>'ui-corner-all'],
			//'action' => ['wapx/staffscore'],
			'method' => 'post',
/*
			'options'=>['class'=>'ui-corner-all', 'data' => ['ajax'=>'false']],
			'fieldConfig' => [
				//'labelOptions' => ['class' => 'control-label col-sm-3'],
				//'inputOptions' => ['class' => 'form-control'],
				//'template' => "{label}\n<div class='col-sm-9'>{input}</div>\n{hint}\n{error}",
				'options' => ['class' => 'ui-field-contain'],
				'inputOptions' => [],
				'labelOptions' => [],
			]               
*/
		]); ?>

		<?= $form->field($model, 'mobile')->input('tel', ['maxlength' => 11, 'placeholder'=>'输入手机号'])->label('手机号:') ?>

		<?php echo $form->field($model, 'verifyCode')->label('短信验证码')->widget(SmCaptcha::className(), [
			'template' => '{input}<label></label>{button}',	
			'buttonLabel' => '免费获取验证码',
		]) ?>

    
        <div class="form-group">
            <?= Html::submitButton('绑定手机号', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mp-openidbindmobile-create -->

<?php
/*
    <h1><?= '绑定手机号' ?></h1>

        <?= $form->field($model, 'gh_id') ?>
        <?= $form->field($model, 'openid') ?>
*/
