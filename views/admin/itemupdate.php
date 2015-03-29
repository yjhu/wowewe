<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Item: ' . $model->iid;
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['itemlist']];
$this->params['breadcrumbs'][] = ['label' => $model->iid, 'url' => ['itemview', 'iid' => $model->iid]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'old_price')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'price_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'title_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pkg_name')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pkg_name_hint')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'pic_url')->textInput(['maxlength' => 128]) ?>
		<?= $form->field($model, 'pic_urls')->textInput(['maxlength' => 512]) ?>

		<?= $form->field($model, 'detail')->textArea() ?>

		<?= $form->field($model, 'scene_percent')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'ctrl_mobnumber')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'ctrl_userinfo')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'ctrl_office')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'ctrl_package')->textInput(['maxlength' => 10]) ?>
		<?= $form->field($model, 'ctrl_address')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'ctrl_supportpay')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'ctrl_pkg_3g4g')->textInput(['maxlength' => 128]) ?>
		<?= $form->field($model, 'ctrl_pkg_period')->textInput(['maxlength' => 128]) ?>
		<?= $form->field($model, 'ctrl_pkg_monthprice')->textInput(['maxlength' => 128]) ?>
		<?= $form->field($model, 'ctrl_pkg_plan')->textInput(['maxlength' => 128]) ?>
		
		<?= $form->field($model, 'ctrl_picurls')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'ctrl_soldout')->textInput(['maxlength' => 128]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
    <h1><?= Html::encode($this->title) ?></h1>
<?
    echo \kartik\widgets\StarRating::widget([
    'name' => 'rating',
    'pluginOptions' => ['size' => 'lg']
    ]);
?>


*/