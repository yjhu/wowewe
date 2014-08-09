<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MStaff;
use app\models\MOffice;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '员工推广成绩排行表';
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
				'label' => '姓名',
				'attribute' => 'name',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			[
				'label' => '推广成绩',
				'attribute' => 'score',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			[
				'label' => '所在部门编号',
				'attribute' => 'office_id',
				'headerOptions' => array('style'=>'width:25%;'),	
			],
			[
				'label' => '部门名称',
				'attribute' => 'title',
//				'headerOptions' => array('style'=>'width:200px;'),	
				'headerOptions' => array('style'=>'width:25%;'),	
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