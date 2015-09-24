<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeScoreEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moffice-score-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gh_id')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'openid')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'office_id')->textInput() ?>

    <?= $form->field($model, 'cat')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
