<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t6Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mhd201509t6-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'hd201509t6_id') ?>

    <?= $form->field($model, 'gh_id') ?>

    <?= $form->field($model, 'openid') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'yfzx') ?>

    <?php // echo $form->field($model, 'fsc') ?>

    <?php // echo $form->field($model, 'tcnx') ?>

    <?php // echo $form->field($model, 'hbme') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'qdbm') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
