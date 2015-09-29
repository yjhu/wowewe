<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MQdbmSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqdbm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'qdbm_id') ?>

    <?= $form->field($model, 'gsyf') ?>

    <?= $form->field($model, 'qdmc') ?>

    <?= $form->field($model, 'qdbm') ?>

    <?= $form->field($model, 'blank') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
