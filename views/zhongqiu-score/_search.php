<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuScoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzhongqiu-score-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'score_id') ?>

    <?= $form->field($model, 'author_openid') ?>

    <?= $form->field($model, 'score') ?>

    <?= $form->field($model, 'create_time') ?>

    <?= $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
