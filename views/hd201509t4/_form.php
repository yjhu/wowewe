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
        echo "<img width=48 src=".$model->user->headimgurl.">";
        echo emoji_unified_to_html(emoji_softbank_to_unified($model->user->nickname))."<br>";
        echo $model->create_time;
    ?>


    <!--
    <//?= $form->field($model, 'gh_id')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'openid')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'mobile')->textInput(['maxlength' => 16]) ?>

    <//?= $form->field($model, 'score')->textInput() ?>

    <//?= $form->field($model, 'create_time')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?>
    -->


    <?php
        echo "<h2>手机号码: ".$model->mobile."</h2>";
        echo "<h2>捐献积分: ".$model->score."</h2>";
    ?>


    <br> <br>

    <?= $form->field($model, 'status')->dropDownList(MHd201509t4::gethd201509t4StatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
