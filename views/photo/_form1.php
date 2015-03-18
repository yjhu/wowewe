<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\MPhoto;

?>

<div class="mstudent-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'des')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => 128]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

