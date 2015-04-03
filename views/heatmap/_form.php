<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HeatMap */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heat-map-form">

    <div style="margin-bottom:20px;">
    <?php echo Html::a(Html::img(Url::to($model->getImageUrl()), ['width'=>'120']), $model->getImageUrl()); ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(['0'=>'有效', '1'=>'无效']) ?>

    <?= $form->field($model, 'speed_up')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'speed_down')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'speed_delay')->textInput(['maxlength' => 32]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', '修改'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
    <?= $form->field($model, 'gh_id')->textInput(['maxlength' => 32]) ?>

    
    <?= $form->field($model, 'openid')->textInput(['maxlength' => 32]) ?>    
    <?= $form->field($model, 'status')->dropDownList(['0'=>有效, '1'=>无效]) ?>
    <?= $form->field($model, 'media_id')->textInput(['maxlength' => 32]) ?>
    <?= $form->field($model, 'pic_url')->textInput(['maxlength' => 32]) ?>

*/