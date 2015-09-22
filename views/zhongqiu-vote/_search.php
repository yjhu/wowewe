<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuVoteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzhongqiu-vote-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'qingshi_vote_id') ?>

    <?= $form->field($model, 'author_openid') ?>

    <?= $form->field($model, 'vote_openid') ?>

    <?= $form->field($model, 'vote_score') ?>

    <?= $form->field($model, 'vote_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
