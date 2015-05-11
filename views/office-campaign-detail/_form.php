<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moffice-campaign-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'office_id')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'pic_category')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
