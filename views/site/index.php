<?php
/**
 * @var yii\web\View $this
 */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->params['title'];
?>

<div class="row">
    <div class="jumbotron">

		<?php if (Yii::$app->user->isGuest): ?>
	        <h1>欢迎您</h1>
	        <p class="lead">访问襄阳联通官方微信管理后台</p>
		<?php else: ?>
	        <h1><?php echo $username; ?></h1>
		    <p class="lead">您已成功登录襄阳联通官方微信管理后台！</p>	
		<?php endif; ?>

		<?php if (!empty($office)): ?>
	        <p><a class="btn btn-lg btn-success" href="#">了解更多详细，请扫下方营业厅二维码</a></p>
			<?php echo Html::img($office->getQrImageUrl(), ['class'=>'img-responsive center-block']); ?>
		<?php endif; ?>

    </div>

</div>


<!--
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
-->


