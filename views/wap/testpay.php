<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\U;
?>

    
<div data-role="page" id="page1" data-theme="c">

    <?php echo $this->render('../wap/header1', ['menuId'=>'menu1','title' => 'Buy']); ?>
 
    <div data-role="content">
        <?php $form = ActiveForm::begin(['id' => 'contact-form','class'=>'ui-field-contain']); ?>
             <?= $form->field($model, 'oid')->textinput(['maxlength' => '64', 'placeholder'=>'oid'])->label(false); ?>
             <?= $form->field($model, 'detail')->textinput(['maxlength' => '64', 'placeholder'=>'detail'])->label(false); ?>
             <?= $form->field($model, 'feesum')->textinput(['maxlength' => '64', 'placeholder'=>'price', 'value'=>sprintf("%0.2f",$model->feesum/100)])->label(false); ?>
            <?= Html::submitButton('Buy', ['class' => 'ui-shadow ui-btn ui-corner-all', 'name' => 'contact-button']) ?>

        <?php ActiveForm::end(); ?>


    </div>


    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
</div> <!-- page1 end -->


<?php
/*

 
 */
