<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

?>

<div class="mphoto-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'des')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'tags')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'pic_url')->fileInput()->hint('图片建议尺寸：900像素 * 500像素') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => 256]) ?>
    <?= $form->field($model, 'owner_cat')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'owner_id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pic_url')->widget(\trntv\filekit\widget\SingleFileUpload::classname(), [
        'url'=>['avatar-upload', 'category'=>'avatar']
    ]) ?>

    <?= $form->field($model, 'sort_order')->textInput(['maxlength' => 10]) ?>


*/