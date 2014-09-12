<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?php //echo Html::encode($this->title) ?></h1>

<!--
    <p>Please fill out the following fields to login:</p>
-->

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
		//'layout' => 'horizontal',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => 11, 'placeholder'=>'请输入用户名', 'class'=>'form-control input-lg'])->label(false); ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入密码', 'class'=>'form-control input-lg'])->label(false); ?>

    <div class="form-group">
	    <?= Html::submitButton('登录', ['class' => 'btn btn-success btn-lg', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

<!--
    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
-->




</div>

<?php
/*
    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox(['label'=>'自动登录']); ?>


<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control input-lg" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control input-lg" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success btn-lg">Sign in</button>
    </div>
  </div>
</form>


*/