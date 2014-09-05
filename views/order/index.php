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
				'label' => '营业厅',
				'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
				'filter'=> false,
				'headerOptions' => array('style'=>'width:80px;'),			
			],
			[
				'label' => '买家微信昵称',
				'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'filter'=> false,
				'headerOptions' => array('style'=>'width:80px;'),			

			],
			[
				'attribute' => 'detail',
				'headerOptions' => array('style'=>'width:100px;'),			
			],
			[
				'attribute' => 'cid',
				'value'=>function ($model, $key, $index, $column) { return MItem::getItemCatName($model->cid); },
				'filter'=> MItem::getItemCatName(),
			],
			[
				'attribute' => 'feesum',
				'value'=>function ($model, $key, $index, $column) { return "￥".sprintf("%0.2f",$model->feesum/100); },
			],
			[
				'label' => '卡号',
				'attribute' => 'select_mobnum',
				'headerOptions' => array('style'=>'width:80px;'),			
			],
			[
				'attribute' => 'create_time',
				'filter'=> false,
			],
			[
				'label' => '买家身份信息',
				'value'=>function ($model, $key, $index, $column) { return "{$model->username}, {$model->userid}, {$model->usermobile}"; },
				'headerOptions' => array('style'=>'width:120px;'),			
			],
			[
				'attribute' => 'status',
				'value'=>function ($model, $key, $index, $column) { return $model->statusName; },
				'filter'=> MOrder::getOrderStatusName(),
			],
			[
				'attribute' => 'pay_kind',
				'label' => '付款方式',
				'value'=>function ($model, $key, $index, $column) { return MOrder::getOrderPayKindOption($model->pay_kind); },
				'filter'=> MOrder::getOrderPayKindOption(),
				'headerOptions' => array('style'=>'width:60px;'),			
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