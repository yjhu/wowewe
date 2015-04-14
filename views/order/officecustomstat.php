<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use app\models\MStaff;
use app\models\MOffice;
use app\models\U;

$this->title = '营业厅用户情况统计';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

	<?php \yii\widgets\Pjax::begin([
		'timeout' => 10000,
	]); ?>

<!--
    <p>
    	<//?php $currentMonth = date("n"); ?>
		<//?php //echo Html::a('新增渠道', ['channelcreate'], ['class' => 'btn btn-success']) ?>
		<//?php echo Html::a('累计推广成绩下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
		<//?php echo Html::a("按时间范围成绩排行", ['officetopbyrange','cur_date'=>date("Y-m-d")], ['class' => 'btn btn-info']) ?>
    </p>
-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'filterModel' => $filter,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
			[
				'label' => '部门编号',
				'attribute' => 'office_id',
				'headerOptions' => array('style'=>'width:8%;'),	
			],
			[
				'label' => '部门名称',
				'attribute' => 'office_title',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			/*
			[
				'label' => '类别',
				'attribute' => 'is_jingxiaoshang',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
						return empty($model['is_jingxiaoshang']) ? '自营厅' : '经销商';
					},
				'filter'=> ['0'=>'自营厅', '1'=>'经销商'],
				'headerOptions' => array('style'=>'width:10%;'),	
			],
			*/

			[
				'label' => '存量用户',
				'attribute' => 'custom_count',
				'headerOptions' => array('style'=>'width:20%;'),	
			],

			/*
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
			*/
        ],
    ]); ?>

</div>

	<?php \yii\widgets\Pjax::end(); ?>

<?php
/*

        //echo Html::a('累计推广成绩下载 <i class="glyphicon glyphicon-arrow-down"></i>', Url::to().'&download=1', ['class' => 'btn btn-success']) 

*/