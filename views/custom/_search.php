<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustomSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'custom_id') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'is_vip') ?>

    <?= $form->field($model, 'office_id') ?>

    <?php // echo $form->field($model, 'vip_level_id') ?>

    <?php // echo $form->field($model, 'vip_join_time') ?>

    <?php // echo $form->field($model, 'vip_start_time') ?>

    <?php // echo $form->field($model, 'vip_end_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
