<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '员工推广详单';
$this->params['breadcrumbs'][] =  ['label'=>'员工推广成绩排行', 'url'=>['stafftop']]; //Html::a("aaa", ['stafftop']);
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
			[
				'label' => '关注时间',
				'attribute' => 'create_time',
//				'headerOptions' => array('style'=>'width:50%;'),	
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
