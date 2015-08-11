<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MUserAccount;

/* @var $this yii\web\View */
/* @var $model app\models\MUserAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="muser-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'cat')->dropDownList(MUserAccount::getCatOptionName()) ?>

    <?= $form->field($model, 'charge_mobile')->textInput(['maxlength' => 32]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', '新建') : Yii::t('app', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
    <?= $form->field($model, 'gh_id')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'openid')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'scene_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'oid')->textInput(['maxlength' => 32]) ?>


*/
