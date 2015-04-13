<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vipmanager */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vipmanager-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'vip_id')->textInput() ?>

    <?= $form->field($model, 'manager_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
