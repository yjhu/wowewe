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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <?= Html::encode($this->title) ?>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
                        <a href="javascript:;" class="remove" data-original-title="" title="">
								</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php \yii\widgets\Pjax::begin([
		'timeout' => 10000,
	]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $filter,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
//			[
//				'label' => '部门编号',
//				'attribute' => 'office_id',
//				'headerOptions' => array('style'=>'width:8%;'),	
//			],
			[
				'label' => '部门名称',
				'attribute' => 'office_title',
				'headerOptions' => array('style'=>'width:25%;'),	
			],			

			[
				'label' => '存量用户',
				'attribute' => 'custom_count',
				'headerOptions' => array('style'=>'width:20%;'),	
			],
			
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

	
</div>

	
