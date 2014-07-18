<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\MItem $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mitem-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'num_iid')->textInput(['maxlength' => 20]) ?>

		<?= $form->field($model, 'user_id')->textInput(['maxlength' => 20]) ?>

		<?= $form->field($model, 'cid')->textInput() ?>

		<?= $form->field($model, 'x_status')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

		<?= $form->field($model, 'pic_url')->textInput(['maxlength' => 128]) ?>

		<?= $form->field($model, 'seller_cids')->textInput(['maxlength' => 96]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
