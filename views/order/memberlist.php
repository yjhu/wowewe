<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MItem;
use app\models\MOrder;
use app\models\MSceneDetail;
use app\models\MUser;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '会员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//'nickname',
        	[
				'label' => 'ID',
				'attribute' => 'id',	
			],
			[
				'label' => '时间',
				'attribute' => 'create_time',	
			],
			[
				'label' => '提现沃点',
				'attribute' => 'scene_amt',	
			],
			[
				'label' => '充值手机号',
				'attribute' => 'czhm',	
			],
			[
				'label' => '类型',
				'attribute' => 'memo',
			],
			[
				'label' => '提现状态审核',
				'attribute' => 'status',	
				'value'=>function ($model, $key, $index, $column) { return MSceneDetail::getSceneDetailStatusName($model->status); },
				'filter'=> MSceneDetail::getSceneDetailStatusOption(),			
			],			
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{memberupdate}',
				'buttons' => [
					'memberupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},
				],
			],
        ],
    ]); ?>

</div>
