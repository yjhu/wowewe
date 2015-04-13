<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LookupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lookup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'lookup_id') ?>

    <?= $form->field($model, 'cat') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cat_val') ?>

    <?= $form->field($model, 'sort_order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
