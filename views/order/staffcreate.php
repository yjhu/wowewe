<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOffice;
use app\models\MStaff;

$this->title = '增加员工';
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['stafflist']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? '新增' : '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'office_id')->dropDownList(MOffice::getOfficeNameOptionAll(Yii::$app->user->identity->gh_id, false, false)) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'mobile')->textInput(['maxlength' => 24]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '增加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
		<?= $form->field($model, 'office_id')->textInput(['maxlength' => 10]) ?>


		<?= $form->field($model, 'status')->dropDownList(MOrder::getOrderStatusOptionForOffice()) ?>

    <h1><?= Html::encode($this->title) ?></h1>

*/