<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MStaff;
use app\models\MOffice;

$this->title = '营业厅推广成绩排行';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
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
    ]); ?>

</div>

<?php
/*


*/