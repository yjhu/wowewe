<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MAccessLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maccess-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'scene_pid')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'ToUserName')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'FromUserName')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'CreateTime')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'MsgId')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'MsgType')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'Content')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'Event')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'EventKey')->textInput(['maxlength' => 1024]) ?>

    <?= $form->field($model, 'EventKeyCRC')->textInput(['maxlength' => 20]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
