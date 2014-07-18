<?php

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-3 sidebar">
			<?php
				use kartik\widgets\SideNav;
				echo SideNav::widget([
					'type' => SideNav::TYPE_DEFAULT,	
					'heading' => 'Options',
					'items' => [
						[
							'active'=>true,						
							'url' => ['/site/index'],
							'label' => 'Home',
							'icon' => 'home'
						],
						[
							'url' => ['/site/about'],
							'label' => 'About',
							'icon' => 'info-sign',
							'items' => [
								['url' => '#', 'label' => 'Item 1'],
								['url' => '#', 'label' => 'Item 2'],
							],
						],
					],
				]);
			?>							
		</div>

		<div class="col-xs-9">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				'encodeLabels' => false,
				'homeLink' => ['label' => '<i class="glyphicon glyphicon-home"></i> '.Yii::t('yii', 'Home'), 'url' => Yii::$app->homeUrl],
			]) ?>
			<?= $content; ?>
		</div>
	</div>
</div>
<?php $this->endContent(); ?>
