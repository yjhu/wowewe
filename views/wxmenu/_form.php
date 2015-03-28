<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MWxMenu;

use vova07\fileapi\Widget;

$type = Html::getInputId($model,'type');
$is_sub_button = Html::getInputId($model,'is_sub_button');
$isNewRecord = $model->isNewRecord ? 1 : 0;
$js=<<<EOD

	var isNewRecord = "$isNewRecord";
	if (isNewRecord == '0') {
		$(".is_sub_button").hide();
	}
	$("#$type").change( function()
	{
		$(".click, .view").hide();
		var type = $("#$type").val();
		if (type == 'click' || type == 'location_select')
		{
		   $(".click").show();
		}
		else if (type == 'view')
		{
		   $(".view").show();
		}
	}).change();

	$("#$is_sub_button").change( function()
	{
		$(".leaf").hide();
		var is_sub_button = $("#$is_sub_button").val();
		if (is_sub_button == '0')
		{
		   $(".leaf").show();
		}
	}).change();

EOD;
$this->registerJs($js, yii\web\View::POS_READY);

?>

<div class="mwx-menu-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

	<div class="is_sub_button">
	<?= $form->field($model, 'is_sub_button')->dropDownList(MWxMenu::getSubButtonOptionName())->label('是否是目录菜单'); ?>
	</div>

	<div class="leaf">
		<?= $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(MWxMenu::getSubModels($gh->gh_id),'wx_menu_id','name'))->label('父菜单'); ?>

		<?= $form->field($model, 'type')->dropDownList(MWxMenu::getMenuTypeOptionName()) ?>

		<div class="click">
		<?= $form->field($model, 'keyword')->textInput(['maxlength' => 128]) ?>
		</div>

		<div class="view">
		<?= $form->field($model, 'url')->textInput(['maxlength' => 512]) ?>
		</div>

    </div>

	<?= $form->field($model, 'sort_order')->textInput(['maxlength' => 10]) ?>

	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
 * 	<?= $form->field($model, 'parent_id')->textInput(['maxlength' => 10]) ?>

 */
