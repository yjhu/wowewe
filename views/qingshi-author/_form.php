<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqingshi-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gh_id')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'author_openid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'p1')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'p2')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'p3')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'ststus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
