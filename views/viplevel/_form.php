<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Viplevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viplevel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vip_level_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
