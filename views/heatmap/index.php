<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\HeatMapSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Heat Maps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heat-map-index">
    <p>
        <?php echo Html::a('下载 <span class="glyphicon glyphicon-arrow-down"></span>', ['heatmapsdownload'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            
//            'heat_map_id',
            
//            'gh_id',
            
//            'openid',
      
		   [
				'label' => '微信昵称',
				'value'=>function ($model, $key, $index, $column) { 
                    return empty($model->user) ? '' : $model->user->nickname;
                 },
           ],

		   [
				'label' => '手机号',
				'value'=>function ($model, $key, $index, $column) { 
                    if (empty($model->user)) {
                        return '';
                    }
                    $mobiles = $model->user->getBindMobileNumbers();
                    return empty($mobiles) ? '' : implode(',', $mobiles); 
                 },
		   ],

            'lon',
            
            'lat',
            
            'speed_up',
            
            'speed_down',
            
//            'speed_delay',
            
//            'media_id',            
//            'pic_url:url',
  
		   [
				'label' => '图片大小',
				'value'=>function ($model, $key, $index, $column) { return $model->getPicFileSize(); },
		   ],

			[
				'label' => '图片',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
//					return Html::img($model->getImageUrl(), ['width'=>'64']);
    				return Html::a(Html::img(Url::to($model->getImageUrl()), ['width'=>'75']), $model->getImageUrl());
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
