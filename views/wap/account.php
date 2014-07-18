<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\MUser $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="muser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'手机号码'])->label('') ?>

   
    <div class="form-group">
        <?= Html::submitButton('绑定手机号码', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
    <?= $form->field($model, 'password_raw')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 32]) ?>
    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>


*/




