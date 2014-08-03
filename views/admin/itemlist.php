<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MItem;
use app\models\MOrder;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '商品管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			[
				'attribute' => 'cid',
				'value'=>function ($model, $key, $index, $column) { return MItem::getItemCatName($model->cid); },
				'filter'=> MItem::getItemCatName(),
			],
			'price', 
			'price_hint',
			[
				'attribute' => 'title',
			],
			'title_hint',
			'pkg_name', 'pkg_name_hint',
			'pic_url',
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{itemupdate}',
				'buttons' => [
					'itemupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					}
				],
			],
        ],
    ]); ?>

</div>

<?php
/*
//            'openid',    
//			'nickname',
//			'title',

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


*/