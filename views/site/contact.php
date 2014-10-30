<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\ContactForm $model
 */
//$this->title = 'Contact';
//$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::$app->params['title'];
?>
<div class="site-contact">
    <h1><?php //echo Html::encode($this->title) ?></h1>
	<?php
		$this->registerJs(
		   '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		   yii\web\View::POS_READY
		);
	?>

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success flash-success">
			<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php else: ?>
	    <p>如您有任何意见或建议，请给我们留言，谢谢！</p>
	<?php endif; ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'detail')->textArea(['rows' => 4]) ?>
				<?= $form->field($model, 'email')->textInput(); ?>
                <?= $form->field($model, 'verifyCode')->label('验证码')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>

<?php
/*
    use kartik\daterange\DateRangePicker;
    $form = \kartik\widgets\ActiveForm::begin();

    // DateRangePicker with ActiveForm and model. Check the `required` model validation for
    // the attribute. This also features configuration of Bootstrap input group addon.
    echo $form->field($model, 'detail', [
    'addon'=>['prepend'=>['content'=>'<i class="glyphicon glyphicon-calendar"></i>']],
    'options'=>['class'=>'drp-container form-group']
    ])->widget(DateRangePicker::classname(), [
    'useWithAddon'=>true
    ]);

    // DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
    echo '<label class="control-label">Date Range</label>';
    echo '<div class="drp-container">';
    echo DateRangePicker::widget([
    'name'=>'date_range_2',
    'presetDropdown'=>true,
    'hideInput'=>true
    ]);
    echo '</div>';
     
    // Date and Time picker with time increment of 15 minutes and without any input group addons.
    echo DateRangePicker::widget([
    'name'=>'date_range_3',
    'convertFormat'=>true,
    'pluginOptions'=>[
    'timePicker'=>true,
    'timePickerIncrement'=>15,
    'format'=>'Y-m-d h:i A'
    ]
    ]);
     \kartik\widgets\ActiveForm::end();
*/
 ?>


        </div>
    </div>


</div>

<?php
	 /*
    // DateRangePicker without ActiveForm and with an initial default value, a custom date,
    // format and a custom separator. Auto conversion of date format from PHP DateTime to
    // Moment.js DateTime is set to <code>true</code>. Custom addon markup on the right and
    // make the picker open in the direction right to left.
    echo '<label class="control-label">Date Range</label>';
    echo '<div class="input-group drp-container">';
    echo DateRangePicker::widget([
//    'name'=>'date_range_1',
    'model'=>$model,
    'attribute'=>'detail',
    'value'=>'01-Jan-14 to 20-Feb-14',
    'convertFormat'=>true,
    'useWithAddon'=>true,
    'pluginOptions'=>[
    'format'=>'d-M-y',
    'separator'=>' to ',
    'opens'=>'left'
    ]
    ]);
    echo '</div>';



<?php echo yii\helpers\Html::textArea('html_code', '', array('encode'=>false, 'id'=>'textarea_id','rows'=>6, 'cols'=>50)); ?>
<script src="//cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('html_code', {
		//toolbar: 'Basic',
		//uiColor: '#9AB8F3',
		removePlugins: 'elementspath',
		//protectedSource:[/<protected>[\s\S]*<\/protected>/g],
		//fillEmptyBlocks: false,
		//allowedContent: 'img[alt,!src]{width,height}'
		//allowedContent: 'a[!href]; ul;'
		allowedContent: true
	});
</script>

*/


