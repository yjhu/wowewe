<?php
use yii\helpers\Html;
use yii\helpers\Url;
//$this->title = $name;
?>

<div class="site-error">

	<?php if ($code == 9000): ?>
		<h2>请先关注襄阳联通官方微信</h2>
		<?php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive center-block']); ?>
	<?php else: ?>
		<h2>出错啦！</h2>
		<div class="error">
			<?php echo $message.' '.Html::a("返回", Yii::$app->getRequest()->getReferrer()); ?>
		</div>
	<?php endif; ?>

</div>




<?php
/*
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>

*/