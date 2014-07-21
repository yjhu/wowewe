<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = '手机运程预测';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h3><?php echo Html::encode($this->title) ?>，祝您好运！</h3>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
		//'layout' => 'horizontal',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 11, 'placeholder'=>'手机号码'])->label(false); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11 col-sm-11">
            <?= Html::submitButton('马上测算手机运程！', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<div id="result">
<?php echo $result; ?>
</div>

<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

*/