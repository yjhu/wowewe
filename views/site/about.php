<?php
use yii\helpers\Html;
use yii\helpers\Url;

//$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
$this->title = Yii::$app->params['title'];
?>
<div class="site-about">
    <h1>关于我们</h1>

    <p>
        <?php //echo Yii::$app->params['companyName']; ?>襄阳联通官方微信运营商，现诚邀各级代理商共同发展，共创未来！
    </p>

	<?php echo Html::img(Url::to('images/earth.jpg'), ['width'=>'550', 'class'=>'img-responsive']); ?>

</div>
