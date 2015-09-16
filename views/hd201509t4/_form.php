<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MHd201509t4;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t4 */
/* @var $form yii\widgets\ActiveForm */
?>


<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>


<div class="mhd201509t4-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
        echo "<img width=81 src=".$model->user->headimgurl.">";
        echo "<h3>".emoji_unified_to_html(emoji_softbank_to_unified($model->user->nickname))."</h3><br>";
       
    ?>


    <?php
        echo "<h3>捐献积分: ".$model->score."</h3>";
        echo "<h3>手机号码: ".$model->mobile."</h3>";
        echo "<h3>捐献时间: ".$model->create_time."</h3>";
    ?>


    <!--
    <//?= $form->field($model, 'gh_id')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'openid')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'mobile')->textInput(['maxlength' => 16]) ?>

    <//?= $form->field($model, 'score')->textInput() ?>

    <//?= $form->field($model, 'create_time')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?>
    -->



    <br> <br>

    <?= $form->field($model, 'status')->dropDownList(MHd201509t4::gethd201509t4StatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
