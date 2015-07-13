<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= \Yii::$app->language; ?>" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="<?= \Yii::$app->language; ?>" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= \Yii::$app->language; ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="<?= \Yii::$app->charset; ?>"/>
<title>登录襄阳联通微信运营平台</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="./metronic/theme/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/admin/pages/css/login3.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="./metronic/theme/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="./metronic/theme/assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="./metronic/theme/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<img src="./xyunicom.png" alt="" style="height:64px;"/>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
        <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'login-form'],
                'fieldConfig' => [

                ],
            ]); 
        ?>

	<?= $form->field($model, 'username')->textInput(['maxlength' => 36, 'placeholder'=>'请输入用户名', 'class'=>'form-control placeholder-no-fix'])->label(false); ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'请输入密码', 'class'=>'form-control input-lg'])->label(false); ?>

        <div class="form-group">
                <?= Html::submitButton('登录', ['class' => 'btn btn-success btn-lg', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>	
		
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 <?= date('Y'); ?> &copy; 沃手科技
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="./metronic/theme/assets/global/plugins/respond.min.js"></script>
<script src="./metronic/theme/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="./metronic/theme/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="./metronic/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./metronic/theme/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="./metronic/theme/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./metronic/theme/assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
  Layout.init(); // init current layout
  Login.init();
  Demo.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>