<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MQingshiScore;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiScore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqingshi-score-form">

    <?php $form = ActiveForm::begin(); ?>

	<!--
    <//?= $form->field($model, 'author_openid')->textInput() ?>

    <//?= $form->field($model, 'score')->textInput() ?>
    -->

    <?php
        echo "<img width=128 src=".$model->user->headimgurl.">";
        echo '<h1>'.$model->user->nickname."</h1><br>";
        echo '<h1>'.$model->score."票</h1>";
    ?>

 	<br> <br>

    <?= $form->field($model, 'status')->dropDownList(MQingshiScore::getQingshiScoreStatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
