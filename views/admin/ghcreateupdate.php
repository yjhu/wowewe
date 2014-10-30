<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MGh;

$this->title = $model->isNewRecord ? '新增' : '修改'.'渠道';
$this->params['breadcrumbs'][] = ['label' => '公众号管理', 'url' => ['channellist']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? '新增' : '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'gh_id')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'appid')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'appsecret')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'token')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'partnerid')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'partnerkey')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'wxname')->textInput(['maxlength' => 24]) ?>

		<?= $form->field($model, 'nickname')->textInput(['maxlength' => 24]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '增加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>

<?php
/*
*/