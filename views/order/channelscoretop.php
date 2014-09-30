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



$this->title = '渠道成绩排行';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    	<?php $currentMonth = date("n"); ?>
		
		<?php echo Html::a('渠道管理', ['channellist'], ['class' => 'btn btn-success']) ?>
		
		<?php echo Html::a('渠道成绩排行', ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo Html::a('渠道8月份成绩排行', ['channelscoretop','month'=>8], ['class' => 'btn btn-info']) ?>
	<?php echo Html::a('渠道9月份成绩排行', ['channelscoretop','month'=>9], ['class' => 'btn btn-info']) ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
			[
				'label' => '渠道编号',
				'attribute' => 'id',
				'headerOptions' => array('style'=>'width:15%;'),	
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

        ],

		'bordered'=>false,
		'export'=>false,
		'panel' => [
			'heading'=>'<h3 class="panel-title">渠道成绩排行</h3>',
			'type'=>'default',			
			'before'=>Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', Url::to().'&channelscoretopdownload=1', ['class' => 'btn btn-success']),
			//'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],

    ]); ?>

</div>

<?php
/*


*/