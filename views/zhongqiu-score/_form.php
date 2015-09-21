<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuScore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzhongqiu-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_openid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
