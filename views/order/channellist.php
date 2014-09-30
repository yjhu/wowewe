<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

use app\models\U;
use app\models\MChannel;
use app\models\MOffice;

$this->title = '渠道管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    	<?php $currentMonth = date("n"); ?>
		<?php echo Html::a('新增渠道', ['channelcreate'], ['class' => 'btn btn-success']) ?>
		<?php echo Html::a('渠道成绩排行', ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    </p>

	<?php \yii\widgets\Pjax::begin([
		'timeout' => 10000,
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			[
				'label' => '渠道编号',
				'attribute' => 'id',
				'headerOptions' => array('style'=>'width:100px;'),	
				//'filter'=> false,				
			],
			[
				'label' => '渠道名称',
				'attribute' => 'title',
			],
			[
				'attribute' => 'mobile',
			],
			[
				'label' => '微信号',
				'value'=>function ($model, $key, $index, $column) { return empty($model->user->nickname) ? '[微信未绑定]' : $model->user->nickname; },
				'filter'=> false,
			],
			[
				'label' => '推广成绩',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
//					if ($model->score == 0)						
//						return $model->score; 
					return $model->score.' '.Html::a('<span>明细</span>', ['channelscoredetail', 'ToUserName'=>$model->gh_id, 'scene_pid'=>$model->scene_id], [
						'title' => '推广成绩',
						'target' => '_blank',
					]);
				},
				'filter'=> false,
			],
			[
				'label' => '推广二维码',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 

/*
					return Html::a('<span class="glyphicon glyphicon-qrcode"></span>', $model->getQrImageUrl(), [
						'title' => '查看推广二维码',
						'target' => '_blank',
					]);
*/
					return Html::img($model->getQrImageUrl(), ['width'=>'64']);
				},
				'filter'=> false,
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{channelupdate} {channeldelete}',
				'buttons' => [
					'channelupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},
					'channeldelete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => Yii::t('yii', 'Delete'),
							'data-confirm' => Yii::t('yii', '确认要删除此渠道?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					}
				],
			],

        ],
    ]); ?>

	<?php \yii\widgets\Pjax::end(); ?>
</div>

<?php
/*

*/
