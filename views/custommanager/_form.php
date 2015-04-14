<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Custommanager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custommanager-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'custom_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'manager_id')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
