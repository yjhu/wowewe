<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScorer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moffice-campaign-scorer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'department')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
