<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\MGoods;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mgoods-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'goods_kind')->dropDownList(MGoods::getGoodsKindOption()) ?>

    <?= $form->field($model, 'descript')->textInput(['maxlength' => 256]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'price_hint')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'price_old')->textInput() ?>

    <?= $form->field($model, 'price_old_hint')->textInput(['maxlength' => 512]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
    
    <!--
    <//?= $form->field($model, 'list_img_url')->textInput(['maxlength' => 256]) ?>
    -->
    <?= $form->field($model, 'file')->fileInput()->hint('1张产品列表小图，图片建议尺寸：120像素 * 120像素')  ?>

    <!--
    <//?= $form->field($model, 'body_img_url')->textInput(['maxlength' => 512]) ?>
    -->
     <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->hint('最多3张产品展示大图，图片建议尺寸：700像素 * 500像素')  ?>


    <?= $form->field($model, 'quantity')->textInput() ?>

<!--
    <//?= $form->field($model, 'office_ctrl')->textInput() ?>

    <//?= $form->field($model, 'package_ctrl')->textInput() ?>

    <//?= $form->field($model, 'detail_ctrl')->textInput() ?>

    <//?= $form->field($model, 'pics_ctrl')->textInput() ?>
-->

    <?= $form->field($model, 'office_ctrl')->dropDownList(MGoods::getOfficeCtrlOption()) ?>

    <?= $form->field($model, 'package_ctrl')->dropDownList(MGoods::getPackageCtrlOption()) ?>

    <?= $form->field($model, 'detail_ctrl')->dropDownList(MGoods::getDetailCtrlOption()) ?>

    <?= $form->field($model, 'pics_ctrl')->dropDownList(MGoods::getPicsCtrlOption()) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
