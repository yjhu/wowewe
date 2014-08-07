<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MStaff;
use app\models\MOffice;

$this->title = '修改' . $model->staff_id;
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['stafflist']];
$this->params['breadcrumbs'][] = ['label' => $model->staff_id, 'url' => ['staffview', 'id' => $model->staff_id]];
$this->params['breadcrumbs'][] = $model->isNewRecord ? '新增' : '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'office_id')->dropDownList(MOffice::getOfficeNameOptionAll(Yii::$app->user->identity->gh_id, false, false)) ?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'mobile')->textInput(['maxlength' => 24]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
    <h1><?= Html::encode($this->title) ?></h1>
		<?= $form->field($model, 'status')->dropDownList(MOrder::getOrderStatusOptionForOffice()) ?>
		<?= $form->field($model, 'office_id')->textInput(['maxlength' => 24]) ?>

*/