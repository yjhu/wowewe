<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\MUser $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="muser-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 24]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => 32]) ?>

<!--
    <//?php
        echo \kartik\widgets\StarRating::widget([
        'name' => 'rating',
        'pluginOptions' => [
            'size' => 'lg',
            'starCaptions'=> [
                '0.5'=> 'Half Star',
                '1'=> 'One Star',
                '1.5'=> 'One & Half Star',
                '2'=> 'Two Stars',
                '2.5'=> 'Two & Half Stars',
                '3'=> 'Three Stars',
                '3.5'=> 'Three & Half Stars',
                '4'=> 'Four Stars',
                '4.5'=> 'Four & Half Stars',
                '5'=> '非常好'
            ],
            'clearCaption' => '还未评价',

        ],
        ]);
    ?>
-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
/*
    <?= $form->field($model, 'password_raw')->textInput(['maxlength' => 16]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 32]) ?>
    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>


*/