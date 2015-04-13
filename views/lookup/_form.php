<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lookup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'cat_val')->textInput() ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
