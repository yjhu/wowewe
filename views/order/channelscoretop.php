<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
		<?php echo Html::a('渠道管理', ['channellist'], ['class' => 'btn btn-success']) ?>
		<?php echo Html::a('渠道成绩排行', ['channelscoretop'], ['class' => 'btn btn-info']) ?>
    </p>

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
    ]); ?>

</div>

<?php
/*


*/