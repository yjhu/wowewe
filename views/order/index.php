<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

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

    <?php 
		$columns = [
            'oid',   
			[
				'label' => '营业厅',
				'attribute' => 'office.title',
				'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
				'filter'=> false,
				'headerOptions' => array('style'=>'width:80px;'),			
			],
			[
				'label' => '微信昵称',
				'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'filter'=> false,
				'headerOptions' => array('style'=>'width:80px;'),			
			],
			[
				'attribute' => 'detail',
				'headerOptions' => array('style'=>'width:100px;'),			
			],

			//[
			//	'attribute' => 'cid',
			//	'value'=>function ($model, $key, $index, $column) { return MItem::getItemCatName($model->cid); },
			//	'filter'=> MItem::getItemCatName(),
			//],

			[
				'attribute' => 'feesum',
				'value'=>function ($model, $key, $index, $column) { return "￥".sprintf("%0.2f",$model->feesum/100); },
			],
/*
			[
				'label' => '卡号',
				'attribute' => 'select_mobnum',
				'headerOptions' => array('style'=>'width:80px;'),			
			],
*/
			[
				'attribute'=>'create_time',
				'filterType'=>GridView::FILTER_DATE,
				//'filterType'=>GridView::FILTER_RANGE,
				'format'=>'raw',
				'width'=>'250px',
				'filterWidgetOptions'=>[
					'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
					'separator'=>'至',
					'attribute2'=>'create_time_2',
					'pluginOptions'=>[
						'format'=>'yyyy-mm-dd',
						'language'=>'zh-CN',
					]
				],
			],

/*	
			[
				'attribute'=>'create_time',
				'filterType'=>GridView::FILTER_DATE_RANGE,
				'format'=>'raw',
				'width'=>'170px',
				'filterWidgetOptions'=>[
					'convertFormat'=>true,
					'pluginOptions'=>[
						//'timePicker'=>true,
						//'timePickerIncrement'=>15,
						//'format'=>'Y-m-d h:i A'
						'separator'=>' : ',
						//'locale'=>'zh-CN',
						'format'=>'Y-m-d'
					]
				],
			],
*/
			[
				'label' => '买家身份信息',
				'value'=>function ($model, $key, $index, $column) { return "{$model->username}, {$model->userid}, {$model->usermobile}"; },
				'headerOptions' => array('style'=>'width:120px;'),			
			],
			[
				'label' => '留言',
				'attribute' => 'memo',		
			],
			[
				'label' => '备注',
				'attribute' => 'memo_reply',		
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
			//[
			//	'label' => '开通',
			//	'attribute' => 'kaitong',	
			//],

			[
				'label' => '用户',
				'value'=>function ($model, $key, $index, $column) {  
					if(!empty($model->user))
					{
						if($model->user->bindMobileIsInside('wx_vip'))
							return '老';
						else
							return '新';
					}

					return '--';
				},
				//'filter'=> false,
				//'headerOptions' => array('style'=>'width:80px;'),			
			],
/*            
			[
				'attribute' => 'wlgs',
				'value'=>function ($model, $key, $index, $column) { return MOrder::getOrderWuliugongsiName($model->wlgs); },
				//'filter'=> MOrder::getOrderWuliugongsiOption(),
				'headerOptions' => array('style'=>'width:60px;'),			
			],			
			[
				'label' => '物流单号',
				'attribute' => 'wldh',	
			],
*/
/*
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {chat}',
			],
*/
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{view} {update} {chat}',
				'buttons' => [
					'chat' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-comment"></span>', $url, [
							//'title' => Yii::t('yii', 'Chat'),
							'title' => Yii::t('yii', '发送消息给用户'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					},
/*
					'refund' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-off"></span>', $url, [
							'title' => Yii::t('yii', 'Refund'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					}
*/
				],
			],

	/*
			[
				'class'=>'kartik\grid\BooleanColumn',
				'attribute'=>'status', 
				'vAlign'=>'middle',
			],
			[
				'class'=>'kartik\grid\ActionColumn',
				'dropdown'=>false,
				'order'=>DynaGrid::ORDER_FIX_RIGHT
			],
	*/
	];

/*		
	echo DynaGrid::widget([
		'columns'=>$columns,
		'storage'=>DynaGrid::TYPE_COOKIE,
		//'storage'=>DynaGrid::TYPE_SESSION,		
		//'theme'=>'panel-danger',
		//'theme'=>'panel-primary',
		'theme'=>'panel-default',
		'gridOptions'=>[
			'dataProvider'=>$dataProvider,
			'filterModel'=>$searchModel,
			'bordered'=>false,
			'export'=>false,
			'panel'=>['heading'=>'<h3 class="panel-title">订单列表</h3>'],
			'export'=>['options'=>['class' => 'btn btn-success']],
		],
		'options'=>['id'=>'dynagrid-order'] // a unique identifier is important
	]);
*/

	echo GridView::widget([
		'dataProvider'=> $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $columns,
		'bordered'=>false,
		'export'=>false,
		'pager'=>[
			'firstPageLabel'=>true,
			'lastPageLabel'=>true,
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title">订单列表</h3>',
			//'type'=>'success',
			'type'=>'default',			
//			'before'=>Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', ['orderdownload'], ['class' => 'btn btn-success']),
			'before'=>Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', Url::to().'&orderdownload=1', ['class' => 'btn btn-success']),
			//'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
	]);
	?>

</div>

<?php
/*
//            'openid',    
//			'nickname',
//			'title',

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


		echo GridView::widget([
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
				'label' => '留言',
				'attribute' => 'memo',		
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
    ]); 

    <p>
		<?php echo Html::a('下载 <span class="glyphicon glyphicon-arrow-down"></span>', ['orderdownload'], ['class' => 'btn btn-success']) ?>
    </p>


*/