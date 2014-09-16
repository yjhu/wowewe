<?php

use yii\helpers\Html;
//use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = 'Musers';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php 

	use kartik\dynagrid\DynaGrid;
	use kartik\grid\GridView;
	$columns = [
		//['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
		'id',
		'nickname',
		[
			'attribute'=>'create_time',
			'filterType'=>GridView::FILTER_DATE,
			//'filterType'=>GridView::FILTER_RANGE,
			'format'=>'raw',
			'width'=>'270px',
			'filterWidgetOptions'=>[
				'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
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
			'class'=>'kartik\grid\BooleanColumn',
			'attribute'=>'status', 
			'vAlign'=>'middle',
		],
		[
			'class'=>'kartik\grid\ActionColumn',
			'dropdown'=>false,
			'order'=>DynaGrid::ORDER_FIX_RIGHT
		],
		['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
	];
		
	echo DynaGrid::widget([
		'columns'=>$columns,
		'storage'=>DynaGrid::TYPE_COOKIE,
		//'theme'=>'panel-danger',
		//'theme'=>'panel-primary',
		'theme'=>'panel-default',
		'gridOptions'=>[
			'dataProvider'=>$dataProvider,
			'filterModel'=>$searchModel,
			'bordered'=>false,
			'panel'=>['heading'=>'<h3 class="panel-title">用户列表</h3>'],
			'export'=>['options'=>['class' => 'btn btn-success']],
		],
		'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
	]);
/*
    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'options' => ['class' => 'table-responsive'],
	'tableOptions' => ['class' => 'table table-striped'],
        
        'columns' => [
            'id',            
            'openid',            
			'nickname', 
			'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
*/
?>


</div>

<?php
/*
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'options' => ['class' => 'table-responsive'],
	'tableOptions' => ['class' => 'table table-striped'],
        
        'columns' => [
            'id',            
            'openid',            
			'nickname', 
			'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

*/

