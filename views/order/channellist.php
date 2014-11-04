<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

use app\models\U;
use app\models\MChannel;
use app\models\MOffice;

$this->title = '渠道列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php echo Html::a('新增渠道', ['channelcreate'], ['class' => 'btn btn-success']) ?>
    	<?php $currentMonth = date("n"); ?>
		<?php echo Html::a("渠道每月成绩排行", ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>

		<?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', Url::to().'&channelscoretopsumdownload=1', ['class' => 'btn btn-success']) ?>

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
				'filter'=> false,				
				'visible' => false,
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
/*
			[
				'label' => '累计推广成绩',
				'attribute' => 'score',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					//if ($model->score == 0)						
					//	return $model->score; 
					return $model->score.' '.Html::a('<span>明细</span>', ['channelscoredetail', 'gh_id'=>$model->gh_id, 'scene_pid'=>$model->scene_id], [
						'title' => '推广成绩',
						'target' => '_blank',
					]);
				},
				'filter'=> false,
			],
*/
			[
				'label' => '累计推广成绩',
				'attribute' => 'score',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					return count($model->fans).' '.Html::a('<span>明细</span>', ['channelscoredetail', 'gh_id'=>$model->gh_id, 'scene_pid'=>$model->scene_id], [
						'title' => '推广成绩',
						'target' => '_blank',
					]);
				},
				'filter'=> false,
			],

/*
			[
				'label' => '累计推广成绩',
				'attribute' => 'fansCount',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					return $model->fansCount.' '.Html::a('<span>明细</span>', ['channelscoredetail', 'gh_id'=>$model->gh_id, 'scene_pid'=>$model->scene_id], [
						'title' => '推广成绩',
						'target' => '_blank',
					]);
				},
				'filter'=> false,
			],
*/
			[
				'label' => '推广二维码',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
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
					return Html::a('<span class="glyphicon glyphicon-qrcode"></span>', $model->getQrImageUrl(), [
						'title' => '查看推广二维码',
						'target' => '_blank',
					]);

    <p>
		<?php echo Html::a('新增渠道', ['channelcreate'], ['class' => 'btn btn-success']) ?>
    	<?php $currentMonth = date("n"); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    	<?php $currentMonth = date("n", strtotime('-1 month', time())); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    	<?php $currentMonth = date("n", strtotime('-2 month', time())); ?>
		<?php echo Html::a("渠道{$currentMonth}月成绩排行", ['channelscoretop', 'month'=>$currentMonth], ['class' => 'btn btn-info']) ?>
    </p>

			[
				'attribute' => 'cat',
				'value'=>function ($model, $key, $index, $column) { return MChannel::getCatOptionName($model->cat); },
				'filter'=> MChannel::getCatOptionName(),
			],
			[
				'attribute' => 'status',
				'value'=>function ($model, $key, $index, $column) { return MChannel::getStatusOptionName($model->status); },
				'filter'=> MChannel::getStatusOptionName(),
			],

*/

