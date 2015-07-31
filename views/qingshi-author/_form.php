<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MQingshiAuthor;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mqingshi-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--
    <//?= $form->field($model, 'gh_id')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'author_openid')->textInput(['maxlength' => 255]) ?>
    -->


    <?php
        echo "<img width=48 src=".$model->user->headimgurl.">";
        echo $model->user->nickname."<br>";
        echo $model->create_time;
    ?>

    <!--
    <//?= $form->field($model, 'p1')->textInput(['maxlength' => 64]) ?>

    <//?= $form->field($model, 'p2')->textInput(['maxlength' => 64]) ?>

    <//?= $form->field($model, 'p3')->textInput(['maxlength' => 64]) ?>
    -->

    <?php
        echo "<h2>情诗内容</h2><hr>";
        echo "<h3>".$model->p1."</h3>";
        echo "<h3>".$model->p2."</h3>";
        echo "<h3>".$model->p3."</h3>";
    ?>

    <br> <br>
    <!--
    <//?= $form->field($model, 'create_time')->textInput() ?>
    -->

    <!--
    <//?= $form->field($model, 'status')->textInput() ?>
    -->

    <?= $form->field($model, 'status')->dropDownList(MQingshiAuthor::getQingshiStatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
