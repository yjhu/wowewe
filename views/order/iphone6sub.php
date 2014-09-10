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

$this->title = 'iPhone6 预订';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <p>
		<?php //echo Html::a('下载 <span class="glyphicon glyphicon-arrow-down"></span>', ['iphone6subdownload'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
            'id',
/*
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
*/
			[
				'attribute' => 'user_name',
				'headerOptions' => array('style'=>'width:200px;'),
			],
			[
				'attribute' => 'user_contact',
				'headerOptions' => array('style'=>'width:400px;'),
			],
			[
				'attribute' => 'user_id',
			],
			[
				'attribute' => 'create_time',
			],

/*
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
*/
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{iphone6delete}',
				'buttons' => [
					'iphone6delete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
						//return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(), [
							'title' => Yii::t('yii', 'Delete'),
							'data-confirm' => Yii::t('yii', '确认要删除此预订用户?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
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