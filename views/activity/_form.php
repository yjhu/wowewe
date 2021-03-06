<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mactivity-form">

    <?php $form = ActiveForm::begin(); ?>

  	<?= $form->field($model, 'gh_id')->hiddenInput(['value'=>Yii::$app->user->getGhid()])->label(false) ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'end_time')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 128]) ?>

    <?= $form->field($model, 'descr')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'iids')->textInput(['maxlength' => 256]) ?>

	<?= $form->field($model, 'status')->dropDownList(['1'=>'有效', '0'=>'无效']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
