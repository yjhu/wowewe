<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '单图文列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marticle-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            
            'article_id',
            
            'photo_id',
  
		   [
			'label' => '',
            'attribute' => 'photo_id',
			'format'=>'html',
				'value'=>function ($model, $key, $index, $column) {
						return Html::a(Html::img(Url::to($model->photo->getPicUrl()), ['width'=>'75']), $model->photo->getPicUrl());
				},
		   ],
            
            'title',
            
            'author',
            
            'digest',
            
            [
                'label' => '内容',
                'attribute' => 'content',
                'format'=>'html',                      
	    ],
            
            'content_source_url:url',
            
            'show_cover_pic',
            
            'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
