<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\HeatMapSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heat-map-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'heat_map_id') ?>

    <?= $form->field($model, 'gh_id') ?>

    <?= $form->field($model, 'openid') ?>

    <?= $form->field($model, 'lon') ?>

    <?= $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'speed_up') ?>

    <?php // echo $form->field($model, 'speed_down') ?>

    <?php // echo $form->field($model, 'speed_delay') ?>

    <?php // echo $form->field($model, 'media_id') ?>

    <?php // echo $form->field($model, 'pic_url') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
