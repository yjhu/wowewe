<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="openid-bind-mobile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gh_id')->textInput(['maxlength' => 32]) ?>

    
    <?= $form->field($model, 'openid')->textInput(['maxlength' => 32]) ?>

    
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 32]) ?>

    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Bind Mobile') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
