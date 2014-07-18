<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\MItemSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="mitem-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'num_iid') ?>

		<?= $form->field($model, 'user_id') ?>

		<?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'pic_url') ?>

		<?= $form->field($model, 'price') ?>

		<?php // echo $form->field($model, 'cid') ?>

		<?php // echo $form->field($model, 'seller_cids') ?>

		<?php // echo $form->field($model, 'x_status') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
