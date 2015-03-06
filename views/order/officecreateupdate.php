<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOffice;
use app\models\MStaff;

$this->title = $model->isNewRecord ? '新增' : '修改'.'营业厅';
$this->params['breadcrumbs'][] = ['label' => '营业厅管理', 'url' => ['officelist']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? '新增' : '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'address')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'manager')->textInput(['maxlength' => 16]) ?>

		<?= $form->field($model, 'mobile')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'lon')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'lat')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'visable')->dropDownList(['1'=>'显示', '0'=>'隐藏']) ?>

		<?= $form->field($model, 'pswd')->textInput(['maxlength' => 24]) ?>

        <?php if ($model->isNewRecord): ?>
		    <?= $form->field($model, 'need_scene_id')->dropDownList(['0'=>'否', '1'=>'是'])->label('部门自已是否也需要推广码') ?>
        <?php endif; ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '增加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
		<?= $form->field($model, 'office_id')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'office_id')->dropDownList(MOffice::getOfficeNameOptionAll(Yii::$app->user->identity->gh_id, false, false)) ?>


		<?= $form->field($model, 'status')->dropDownList(MOrder::getOrderStatusOptionForOffice()) ?>

    <h1><?= Html::encode($this->title) ?></h1>

*/