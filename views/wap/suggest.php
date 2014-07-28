<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;

//$this->title = '用户吐槽';
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		
		<h3>用户吐槽</h3>
		
		<?php echo $result; ?>



    <?php if (Yii::$app->session->hasFlash('submit_ok')): ?>

<!--
    <div class="alert alert-success">
        感谢您的反馈，我们会尽快回复您！
    </div>
-->
		<?php Alert::begin([
			'options' => [
				'class' => 'alert-success',
			],
		]); ?>
		Say hello...111
		<?php Alert::end(); ?>

    <?php endif; ?>

		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

			<?= $form->field($ar, 'title')->textInput(['maxlength' => 128, 'placeholder'=>'吐槽标题', 'class'=>'form-control input-lg'])->label(false); ?>
	
			<?= $form->field($ar, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'手机号码', 'class'=>'form-control input-lg'])->label(false); ?>

			<?= $form->field($ar, 'detail')->textarea(['maxlength' => 256, 'placeholder'=>'详细内容', 'class'=>'form-control input-lg'])->label(false); ?>
			
				
			<div class="form-group">
				<?= Html::submitButton('我要吐槽', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'contact-button']) ?>
			</div>
		
			
		<?php ActiveForm::end(); ?>
	
	</div>
</div>


<br><br>



<?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive']); ?>


<?php
/*
		<?php Alert::begin([
			'options' => [
				'class' => 'alert-success',
			],
		]); ?>
		Say hello...111
		<?php Alert::end(); ?>

*/