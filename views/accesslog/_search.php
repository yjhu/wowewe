<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\\MAccessLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maccess-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'scene_pid') ?>

    <?= $form->field($model, 'ToUserName') ?>

    <?= $form->field($model, 'FromUserName') ?>

    <?php // echo $form->field($model, 'CreateTime') ?>

    <?php // echo $form->field($model, 'MsgId') ?>

    <?php // echo $form->field($model, 'MsgType') ?>

    <?php // echo $form->field($model, 'Content') ?>

    <?php // echo $form->field($model, 'Event') ?>

    <?php // echo $form->field($model, 'EventKey') ?>

    <?php // echo $form->field($model, 'EventKeyCRC') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
