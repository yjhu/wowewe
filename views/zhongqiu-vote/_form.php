<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuVote */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mzhongqiu-vote-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'author_openid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'vote_openid')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'vote_score')->textInput() ?>

    <?= $form->field($model, 'vote_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
