<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
				//'brandLabel' => Html::img($asset->baseUrl . '/logo.png'),
                'brandLabel' => '襄阳联通官方微信',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => '首页', 'url' => ['/site/index']],
                    //['label' => '关于', 'url' => ['/site/about']],
					//['label' => '管理', 'url' => ['/admin/index'], 'visible'=>Yii::$app->user->isAdmin],	
					[
						'label' => '营业厅',
						'visible' => Yii::$app->user->isOffice,
						'items' => [
							['label' => '订单管理','url' => ['/order/index'],'linkOptions' => ['data-method' => 'post']],
							['label' => '员工管理','url' => ['/order/stafflist'],'linkOptions' => ['data-method' => 'post']],
							['label' => '员工推广成绩排行','url' => ['/order/stafftop'],'linkOptions' => ['data-method' => 'post'], 'visible' => Yii::$app->user->isAdmin],
						]
					],					
					[
						'label' => '管理',
						//'visible' => Yii::$app->user->isAdmin,
						'visible' => Yii::$app->user->isRoot,
						'items' => [
							['label' => '商品管理','url' => ['/admin/itemlist'],'linkOptions' => ['data-method' => 'post']],
							['label' => '订单管理','url' => ['/admin/trade'],'linkOptions' => ['data-method' => 'post']],
							'<li class="divider"></li>',
							['label' => '用户管理','url' => ['/admin/index'],'linkOptions' => ['data-method' => 'post']],
							['label' => '消息管理','url' => ['/admin/msg'],'linkOptions' => ['data-method' => 'post']],
							['label' => '素材管理','url' => ['/admin/media'],'linkOptions' => ['data-method' => 'post']],
						]
					],
                    Yii::$app->user->isGuest ?
					['label' => '登录', 'url' => ['/site/login']]:
					[
						'label' => '<span class="glyphicon glyphicon-user"></span> ' . Html::encode(Yii::$app->user->identity->username),
						'items' => [
							['label' => '修改设置','url' => ['/site/profile'],'linkOptions' => ['data-method' => 'post']],
							'<li class="divider"></li>',
							['label' => '退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
						]
					],
                    ['label' => '建议', 'url' => ['/site/contact']],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

	<?php if (!\app\models\Wechat::supportWeixinPay()): ?>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; 襄阳联通 <?= date('Y') ?></p>
            <p class="pull-right"><?php //echo Yii::powered() ?></p>
        </div>
    </footer>
	<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


<?php 
/*
<p class="pull-left">&copy; <?= Yii::$app->params['companyName']; ?> <?= date('Y') ?></p>
					[
						'label' => '<span class="glyphicon glyphicon-user"></span> ' . Html::encode(Yii::$app->user->identity->username),
						'items' => [
							['label' => '<span class="glyphicon glyphicon-pencil"></span> 编辑个人信息','url' => ['/post/create'],'linkOptions' => ['data-method' => 'post']],
							'<li class="divider"></li>',
							//'<li class="dropdown-header">Dropdown Header</li>',							
							['label' => '<span class="glyphicon glyphicon-usd"></span> 我的积分','url' => ['/post/create'],'linkOptions' => ['data-method' => 'post']],
							['label' => '<span class="glyphicon glyphicon-heart-empty"></span> 会员特权','url' => ['/post/create'],'linkOptions' => ['data-method' => 'post']],
							['label' => '<span class="glyphicon glyphicon-off"></span> 退出','url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
							//['label' => 'Signup', 'url' => ['/site/signup']]						
						]
					],

//'<li class="dropdown-header">Dropdown Header</li>',							
//['label' => '<span class="glyphicon glyphicon-usd"></span> 我的积分','url' => ['/post/create'],'linkOptions' => ['data-method' => 'post']],
//['label' => '<span class="glyphicon glyphicon-heart-empty"></span> 会员特权','url' => ['/post/create'],'linkOptions' => ['data-method' => 'post']],

*/

