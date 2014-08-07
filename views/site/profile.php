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
$this->title = '修改设置';
$this->params['breadcrumbs'][] = $this->title;
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
	<?php endif; ?>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
				<?= $form->field($model, 'password')->textInput(); ?>
                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
