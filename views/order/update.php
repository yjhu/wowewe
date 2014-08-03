<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update user: ' . $model->oid;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oid, 'url' => ['view', 'id' => $model->oid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'oid')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'detail')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'feesum')->textInput(['maxlength' => 32]) ?>

		<?= $form->field($model, 'status')->textInput(['maxlength' => 32]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
    <h1><?= Html::encode($this->title) ?></h1>

*/