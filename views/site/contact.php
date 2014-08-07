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
                <?= $form->field($model, 'detail')->textArea(['rows' => 6]) ?>
				<?= $form->field($model, 'email')->textInput(); ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
