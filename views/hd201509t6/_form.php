<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use  app\models\MHd201509t6;
/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t6 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mhd201509t6-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--
    <//?= $form->field($model, 'gh_id')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'openid')->textInput(['maxlength' => 255]) ?>

    <//?= $form->field($model, 'mobile')->textInput(['maxlength' => 16]) ?>

    <//?= $form->field($model, 'yfzx')->textInput(['maxlength' => 128]) ?>

    <//?= $form->field($model, 'fsc')->textInput(['maxlength' => 128]) ?>

    <//?= $form->field($model, 'tcnx')->textInput() ?>

    <//?= $form->field($model, 'hbme')->textInput() ?>

    <//?= $form->field($model, 'create_time')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?>

    <//?= $form->field($model, 'qdbm')->textInput(['maxlength' => 32]) ?>
    -->


    <?= $form->field($model, 'qdbm')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'status')->dropDownList(MHd201509t6::gethd201509t6StatusOption()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
