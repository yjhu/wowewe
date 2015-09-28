<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\MOfficeScoreEvent;
use app\models\MOffice;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeScoreEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="moffice-score-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--
    <//?= $form->field($model, 'gh_id')->textInput(['maxlength' => 64]) ?>

    <//?= $form->field($model, 'openid')->textInput(['maxlength' => 64]) ?>


    <//?= $form->field($model, 'office_id')->textInput() ?>
  

    <//?= $form->field($model, 'cat')->textInput() ?>
  -->

    <!--

    <//?= $form->field($model, 'create_time')->textInput() ?>

    <//?= $form->field($model, 'score')->textInput() ?>

    <//?= $form->field($model, 'memo')->textInput(['maxlength' => 128]) ?>

    <//?= $form->field($model, 'code')->textInput(['maxlength' => 64]) ?>
    -->

    <!--
    <//?= $form->field($model, 'status')->textInput() ?>
    -->

    <br><br>

    <?php
       $office = MOffice::findOne(["office_id" => $model->office_id]);
       if(empty($office))
            $title = "--";
        else
            $title = $office->title;


        echo "<h1>渠道名称: ".$title."</h1>";

        echo "<h3>代金卷: ".MOfficeScoreEvent::getCatNameOption($model->cat)."</h3>";

        echo "<h3>减积分: ".$model->score."</h3>";
        echo "<h3>时间: ".$model->create_time."</h3>";
    ?>

    <br>

    <?= $form->field($model, 'status')->dropDownList(MOfficeScoreEvent::getOseStatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
