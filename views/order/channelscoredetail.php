<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\U;
use app\models\MStaff;
use app\models\MOffice;


$this->title = '累计推广成绩明细';
$this->params['breadcrumbs'][] =  ['label'=>'渠道管理', 'url'=>['channellist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],  

		'bordered'=>false,		
        'columns' => [
			[
				'label' => '关注时间',
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

			[
				'attribute' => 'FromUserName',
				'label' => '微信昵称',
				'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
					$nickname = empty($model->user->nickname) ? $model->FromUserName : $model->user->nickname; 
					$headimgurl = empty($model->user->headimgurl) ? '' : Html::img(U::getUserHeadimgurl($model->user->headimgurl, 46), ['style'=>'width:46px;']);
					return "$headimgurl $nickname";
				},
				'headerOptions' => array('style'=>'width:30%;'),	
			],
			[
				'attribute' => 'FromUserName',
				'label' => '微信Id',
			],
			[
				'filter'=> false,
				'attribute' => 'Event',
				'label' => false,
                'value'=>function ($model, $key, $index, $column) { return $model->Event == 'unsubscribe' ? '取消关注' : '关注'; },
				'headerOptions' => array('style'=>'width:30%;'),	

			],
        ],
    ]); ?>

</div>

<?php
/*
			[
				'attribute' => 'EventKeyCRC',
			],


    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

			//['class' => yii\grid\CheckboxColumn::className()],
			[
				'label' => '员工编号',
				'attribute' => 'staff_id',
				'headerOptions' => array('style'=>'width:100px;'),			
			],

			[
				'label' => '用户昵称',
				'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'filter'=> false,
			],


			[
				'label' => false,
				'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
					return empty($model->user->headimgurl) ? '' : Html::img(U::getUserHeadimgurl($model->user->headimgurl, 46), ['style'=>'width:46px;']); 
				},
			],

			[
				'attribute' => 'EventKey',
			],
			[
				'attribute' => 'MsgType',
			],
			[
				'attribute' => 'Content',
			],
			[
				'label' => false,
				'attribute' => 'headimgurl',
				//'format'=>'image',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
						$headimgurl = Html::img(U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
						return $headimgurl;
					},
			],
			[
				'label' => '昵称',
				'attribute' => 'nickname',
			],
*/

