<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOrder;

$this->title = '订单' . $model->oid;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oid, 'url' => ['view', 'id' => $model->oid]];
$this->params['breadcrumbs'][] = '发送消息';
?>

<?php $this->registerJs('$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");', yii\web\View::POS_READY); ?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success flash-success">
        <?php echo Yii::$app->session->getFlash('success'); ?>
  </div>
<?php endif; ?>

<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'oid')->textInput(['maxlength' => 10, 'readonly'=>true]) ?>

		<?= $form->field($model, 'detail')->textInput(['maxlength' => 24, 'readonly'=>true]) ?>

		<?= $form->field($model, 'feesum')->textInput(['maxlength' => 32, 'readonly'=>true, 'value'=>sprintf("%0.2f",$model->feesum/100)]) ?>

		<?= $form->field($model, 'memo')->textInput(['readonly'=>true]) ?>

		<?= $form->field($model, 'select_mobnum')->textInput(['maxlength' => 24, 'readonly'=>true]) ?>

		<?= $form->field($model, 'memo_reply')->textArea(['rows' => 3, 'maxlength' => 128])->label('消息内容') ?>

		<div class="form-group">
			<?= Html::submitButton('通过微信给此用户发送消息', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
    <h1><?= Html::encode($this->title) ?></h1>
		<?= $form->field($model, 'select_mobnum')->textInput(['maxlength' => 24, 'readonly'=>true]) ?>

*/