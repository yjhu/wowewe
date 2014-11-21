<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MSceneDetail;


$this->title = '会员管理: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '会员管理', 'url' => ['memberlist']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="muser-update">

	<div class="muser-form">

		<?php $form = ActiveForm::begin(); ?>
			

		<?= $form->field($model, 'id')->textInput(['maxlength' => 10, 'readonly'=>true]) ?>
	
		<?= $form->field($model, 'status')->dropDownList(MSceneDetail::getSceneDetailStatusOption())->label("提现状态审核"); ?>

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