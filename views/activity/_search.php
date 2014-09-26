<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mactivity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gh_id') ?>

    <?= $form->field($model, 'start_time') ?>

    <?= $form->field($model, 'end_time') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'descr') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'iids') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
