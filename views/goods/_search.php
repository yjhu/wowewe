<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MGoodSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgoods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'goods_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'descript') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'price_hint') ?>

    <?php // echo $form->field($model, 'price_old') ?>

    <?php // echo $form->field($model, 'price_old_hint') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'list_img_url') ?>

    <?php // echo $form->field($model, 'body_img_url1') ?>

    <?php // echo $form->field($model, 'body_img_url2') ?>

    <?php // echo $form->field($model, 'body_img_url3') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'office_ctrl') ?>

    <?php // echo $form->field($model, 'package_ctrl') ?>

    <?php // echo $form->field($model, 'detail_ctrl') ?>

    <?php // echo $form->field($model, 'pics_ctrl') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
