<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\MStaff;
use app\models\MOffice;
use app\models\HeatMap;


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
                'label' => '粉丝来源',
                'value'=>function ($model, $key, $index, $column) { 
                    if (empty($model->user->scene_pid)) {
                        return '';
                    }
                    $staff = MStaff::findOne(['gh_id'=>$model->gh_id, 'scene_id'=>$model->user->scene_pid]);
                    if (empty($staff)) {
                        return '';
                    }
                    if($staff->cat == 0) //内部员工
                    {
                        return empty($staff->name) ? '' : $staff->name.'-'.$staff->office->title.'-'.'内部员工';
                    }
                    else
                    {
                        return empty($staff->name) ? '' : $staff->name;
                    }
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
            'create_time',
            
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
            
            //'status',
         
            /*
            [
                'attribute' => 'status',
                'value'=>function ($model, $key, $index, $column) { return HeatMap::getStatusOptionName($model->status); },
                'filter'=> HeatMap::getStatusOptionName(),
            ],
            */
         
            [
                'label' => '是否有效',
                'attribute' => 'status',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
                        $icon = empty($model->status) ? 'ok' : 'remove';
                        $title = empty($model->status) ? '有效' : '无效';
                        return Html::a("<span class=\"glyphicon glyphicon-{$icon}\"></span>", ['heatmapstatus', 'heat_map_id' => $model->heat_map_id], [
                            'title' => $title,
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    },
                'filter'=> ['0'=>'有效', '1'=>'无效'],
//              'visible'=>Yii::$app->user->getIsAdmin(),
            ],

            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
            ]
        ],
    ]); ?>

</div>
