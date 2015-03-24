<?php

use yii\helpers\Html;

use kartik\dynagrid\DynaGrid;
use kartik\grid\GridView;

//use yii\grid\GridView;
use yii\helpers\Url;
use app\models\MStaff;
use app\models\MOffice;

use app\models\U;
use app\models\MChannel;
use kartik\widgets\DatePicker;


$this->params['breadcrumbs'][] = ['label' => '渠道列表', 'url' => ['officelist']];
//$this->params['breadcrumbs'][] = ['label' => $model->staff_id, 'url' => ['staffview', 'id' => $model->staff_id]];
$this->title = '按时间范围成绩排行';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

<ul class="nav nav-tabs">

	<?php $currentDate = date("Y-m-d"); ?>
	<li>
	<?php echo Html::a("今天", ['officetopbyrange', 'cur_date'=>$currentDate], []) ?>
	</li>
 
	<?php $currentDate = date("Y-m-d",strtotime("-1 day")); ?>
	<li>
	<?php echo Html::a("昨天", ['officetopbyrange', 'cur_date'=>$currentDate], []) ?>
	</li>

	<?php $currentDate = date("Y-m-d",strtotime("-2 day")); ?>
	<li>
	<?php echo Html::a("前天", ['officetopbyrange', 'cur_date'=>$currentDate], []) ?>
	</li>

	<?php $currentMonth = date("n"); ?>
	<li <?php echo $month == $currentMonth ? 'class="active"' : ''; ?>>
	<?php echo Html::a("{$currentMonth}月", ['officetopbymonth', 'month'=>$currentMonth], []) ?>
	</li>

	<?php $currentMonth = date("n", strtotime('-1 month', time())); ?>
	<li <?php echo $month == $currentMonth ? 'class="active"' : ''; ?>>
	<?php echo Html::a("{$currentMonth}月", ['officetopbymonth', 'month'=>$currentMonth], []) ?>
	</li>

	<?php $currentMonth = date("n", strtotime('-2 month', time())); ?>
	<li <?php echo $month == $currentMonth ? 'class="active"' : ''; ?>>
	<?php echo Html::a("{$currentMonth}月", ['officetopbymonth', 'month'=>$currentMonth], []) ?>
	</li>

	<li>
	<?php echo Html::a("按时间范围成绩排行", ['officetopbyrange'], []) ?>
	</li>

</ul>

    <p>
		<br />

		<?php //echo Html::a('渠道列表', ['channellist'], ['class' => 'btn btn-success']) ?>

		<?php
/*
		use kartik\daterange\DateRangePicker;
		echo DateRangePicker::widget([
		//    'model'=>$model,
		//    'attribute'=>'datetime_range',
				'name'=>'date_range',
				'id'=>'id_date_range',
				'language'=>'zh',
				'convertFormat'=>true,
				'pluginOptions'=>[
				'timePicker'=>false,
				//        'timePickerIncrement'=>30,
				//        'format'=>'Y-m-d h:i A'
				'format'=>'Y-m-d',
				'separator'=>'_'
			]
		]);
*/			
		?>
	</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//		'filterSelector'=>'#id_date_start, #id_date_end',
		'filterModel' => $filter,	
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
/*
			[
				'label' => '渠道编号',
				'attribute' => 'id',
				'headerOptions' => array('style'=>'width:15%;'),	
				'filter'=> true,
				'visible' => false,
			],
			[
				'label' => '渠道名称',
				'attribute' => 'title',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			[
				'label' => '渠道推广数量',
				'attribute' => 'cnt_sum',
				'headerOptions' => array('style'=>'width:20%;'),	
			],
*/
			[
				'label' => '部门编号',
				'attribute' => 'office_id',
				'headerOptions' => array('style'=>'width:15%;'),	
			],
			[
				'label' => '部门名称',
				'attribute' => 'title',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			[
				'label' => '部门推广人数',
				'attribute' => 'cnt_office',
				'headerOptions' => array('style'=>'width:20%;'),	
			],
			[
				'label' => '部门员工推广人数',
				'attribute' => 'cnt_staffs',
				'headerOptions' => array('style'=>'width:20%;'),	
			],
			[
				'label' => '合计推广人数',
				'attribute' => 'cnt_sum',
				'headerOptions' => array('style'=>'width:20%;'),	
			],

        ],

		'bordered'=>false,
		'export'=>false,
		'panel' => [
			//'heading'=>"<h3 class=\"panel-title\">渠道{$month}月成绩排行</h3>",
			'heading'=>"<h3 class=\"panel-title\">&nbsp;</h3>",
			'type'=>'default',			
			'before'=>Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', Url::to().'&download=1', ['class' => 'btn btn-success']),
			//'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],

    ]); ?>

</div>

<?php
/*

			[
				'label' => '渠道类别',
				'attribute' => 'cat',
				'value'=>function ($model, $key, $index, $column) { return MChannel::getCatOptionName($model['cat']); },
				'filter'=> MChannel::getCatOptionName(),
				'headerOptions' => array('style'=>'width:25%;'),	
			],

<!-- Tab panes -->
<!--
<div class="tab-content">
  <div class="tab-pane active" id="home">.aaaa.</div>
  <div class="tab-pane" id="profile">..bbb.</div>
  <div class="tab-pane" id="messages">..cccc.</div>
  <div class="tab-pane" id="settings">..ddd.</div>
</div>
-->
    <?php

echo yii\bootstrap\Tabs::widget([
    'items' => [
        [
            'label' => '<a href="http://baidu.com">One</a>',
			'encode'=>false,
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => '<a href="http://baidu.com">One</a>',
			'encode'=>false,
            'content' => 'Anim pariatur cliche...',
        ],
        [
            'label' => '1111',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => [],
            'options' => ['id' => 'myveryownID'],
        ],
    ],
]); 

?>

    <p>
		<?php echo Html::a('渠道列表', ['channellist'], ['class' => 'btn btn-success']) ?>
    	<?php $currentMonth = date("n"); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['officetopbymonth', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    	<?php $currentMonth = date("n", strtotime('-1 month', time())); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['officetopbymonth', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    	<?php $currentMonth = date("n", strtotime('-2 month', time())); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['officetopbymonth', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    </p>

*/
