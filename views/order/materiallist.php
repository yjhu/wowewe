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

$this->title = '素材管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//'nickname',
        	[
				'label' => 'ID',
				'attribute' => 'media_id',	
			],
			[
				'label' => '标题',
				'value'=>function ($model, $key, $index, $column) { 
                    if ($column->grid->dataProvider->type == 'news') {
                        //return json_encode($model['content']['news_item'], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                        $artiles = $model['content']['news_item'];
                        return $artiles[0]['title'];
                    }
                    else {
                        return $model['name'];
                    }
				},
			],
			[
				'label' => '编辑时间',
				'attribute' => 'update_time',
				'value'=>function ($model, $key, $index, $column) { 
                    return date("Y-m-d H:i:s", $model['update_time']);
				},
			],

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{meterialupdate} {meterialdelete}',
				'buttons' => [
					'meterialupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},
					'meterialdelete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => Yii::t('yii', 'Delete'),
							'data-confirm' => Yii::t('yii', '确认要删除?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					}
				],
			],

        ],
    ]); ?>

</div>
