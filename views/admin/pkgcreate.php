<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Item';
$this->params['breadcrumbs'][] = ['label' => '套餐管理', 'url' => ['pkglist']];
$this->params['breadcrumbs'][] = '增加';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'gh_id')->textInput(['maxlength' => 32]) ?>

		<?= $form->field($model, 'cid')->textInput(['maxlength' => 10, 'placeholder'=>'商品分类']) ?>

		<?= $form->field($model, 'pkg3g4g')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'monthprice')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'period')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'plan')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pkg_price')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'prom_price')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'yck')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'income_return')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'month_return')->textInput(['maxlength' => 128]) ?>	

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