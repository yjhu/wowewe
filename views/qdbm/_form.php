<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MQdbm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqdbm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gsyf')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'qdmc')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'qdbm')->textInput(['maxlength' => 64]) ?>

	<!--
    <//?= $form->field($model, 'blank')->textInput(['maxlength' => 64]) ?>
    -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
