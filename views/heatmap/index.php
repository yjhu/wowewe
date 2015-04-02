<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HeatMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Heat Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heat-map-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            
            'heat_map_id',
            
            'gh_id',
            
            'openid',
            
            'lon',
            
            'lat',
            
            'speed_up',
            
            'speed_down',
            
            'speed_delay',
            

//            'pic_url:url',
  
			[
				'label' => '图片',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					return Html::img($model->getImageUrl(), ['width'=>'64']);
				},
				'filter'=> false,
			],
            
            'status',

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
            ]
        ],
    ]); ?>

</div>
