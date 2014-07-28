<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

//$this->title = '用户吐槽';
//$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		
		<h3>吐槽专区</h3>
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

*/