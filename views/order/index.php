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

$this->title = '订单管理';
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
			//['class' => yii\grid\CheckboxColumn::className()],
            'oid',   
			[
				'label' => '用户昵称',
				'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'filter'=> false,
			],
			[
				'attribute' => 'detail',
				'headerOptions' => array('style'=>'width:200px;'),			
			],
			[
				'attribute' => 'cid',
				'value'=>function ($model, $key, $index, $column) { return MItem::getItemCatName($model->cid); },
				'filter'=> MItem::getItemCatName(),
			],
			[
				'attribute' => 'feesum',
				'format' => 'double',
				//'label' => 'Name',
				//'value'=>function ($model, $key, $index, $column) { return "￥".$model->feesum/100; },
				'value'=>function ($model, $key, $index, $column) { return $model->feesum/100; },
			],
			[
				'attribute' => 'create_time',
				'filter'=> false,
			],

			[
				'attribute' => 'status',
				//'value'=>function ($model, $key, $index, $column) { return MOrder::getOrderStatusName($model->status); },
				'value'=>function ($model, $key, $index, $column) { return $model->statusName; },
				'filter'=> MOrder::getOrderStatusName(),
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update}',
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