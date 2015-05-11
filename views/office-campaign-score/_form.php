<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moffice-campaign-score-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'office_campaign_id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'staff_id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
