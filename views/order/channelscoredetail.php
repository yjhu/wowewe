<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;


$this->title = '渠道推广明细';
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
        'columns' => [
			[
				'label' => '关注时间',
				'attribute' => 'create_time',
				//'headerOptions' => array('style'=>'width:50%;'),	
			],

/*
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
			[
				'attribute' => 'FromUserName',
			],
			[
				'attribute' => 'MsgType',
			],
			[
				'attribute' => 'Content',
			],
			[
				'attribute' => 'Event',
			],
			[
				'attribute' => 'EventKey',
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
*/
