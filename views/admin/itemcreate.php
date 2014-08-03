<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Item';
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['itemlist']];
$this->params['breadcrumbs'][] = '增加';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'gh_id')->textInput(['maxlength' => 32]) ?>

		<?= $form->field($model, 'cid')->textInput(['maxlength' => 10, 'placeholder'=>'商品分类']) ?>

		<?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'price_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'title_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pkg_name')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pkg_name_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pic_url')->textInput(['maxlength' => 128, 'placeholder'=>'商品图片地址']) ?>

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