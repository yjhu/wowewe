<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOrder;

$this->title = '修改订单' . $model->oid;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->oid, 'url' => ['view', 'id' => $model->oid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'oid')->textInput(['maxlength' => 10, 'readonly'=>true]) ?>

		<?= $form->field($model, 'detail')->textInput(['maxlength' => 24, 'readonly'=>true]) ?>

		<?= $form->field($model, 'feesum')->textInput(['maxlength' => 32, 'readonly'=>true, 'value'=>sprintf("%0.2f",$model->feesum/100)]) ?>

		<?= $form->field($model, 'memo')->textInput(['readonly'=>true]) ?>

		<?= $form->field($model, 'select_mobnum')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'memo_reply')->textInput(['maxlength' => 100]) ?>

		<?= $form->field($model, 'status')->dropDownList(MOrder::getOrderStatusOptionForOffice()) ?>

		<?= $form->field($model, 'wlgs')->dropDownList(MOrder::getOrderWuliugongsiOption()) ?>

		<?= $form->field($model, 'wldh')->textInput(['maxlength' => 100]) ?>


		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
    <h1><?= Html::encode($this->title) ?></h1>
		<?= $form->field($model, 'select_mobnum')->textInput(['maxlength' => 24, 'readonly'=>true]) ?>

*/