<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MWxMenu;

$this->title = Yii::t('backend', 'Wechat Menu');
$this->params['breadcrumbs'][] = $this->title;
?>

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


	<div class="mwx-menu-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Create Wechat Menu'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('backend', 'Save Menu From Wechat'), ['export'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('backend', 'Import Menu From Wechat'), ['import'], ['class' => 'btn btn-success']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            
			[
				'label' => '菜单ID',
				'attribute'=>'wx_menu_id',
			],
			[
				'label' => '标题',
				'attribute'=>'name',
				'value'=>function ($model, $key, $index, $column) { return $model->parent_id == 0 ? $model->name : "----".$model->name; },
                'headerOptions' => array('style'=>'width:240px;'),              
			],

			[
				'label' => '菜单类型',
				'attribute' => 'type',
				'value'=>function ($model, $key, $index, $column) { return MWxMenu::getMenuTypeOptionName($model->type); },
				'filter'=> MWxMenu::getMenuTypeOptionName(),
			],

			[
				'label' => '关键字',
				'attribute'=>'keyword',
			],

//			'url:url',
            
			[
				'label' => '链接地址',
				'attribute'=>'url',
			],

			[
				'label' => '是否包括子菜单',
				'attribute'=>'is_sub_button',
				'value'=>function ($model, $key, $index, $column) { return $model->is_sub_button ? '是' : ''; },
			],

			[
				'label' => '父菜单ID',
				'attribute'=>'parent_id',
			],

			'sort_order',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],

        ],
    ]); ?>

</div>

<?php
/*
        <? Html::a(Yii::t('backend', 'Get Menu From Wechat'), ['import'], ['class' => 'btn btn-success']) ?>

*/