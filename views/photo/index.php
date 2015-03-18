<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = Yii::t('backend', 'Photo');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mphoto-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
            'photo_id',
            'title',
            'des',
            'tags',
		   [
			'label' => Yii::t('backend', 'Picture'),
			'format'=>'html',
				'value'=>function ($model, $key, $index, $column) {
					 //return Html::a(Html::img(Url::to($model->getPicUrl()), ['width'=>'75']), $model->getPicUrl());
					if ($model->isVedio()) {
						$url = Yii::$app->getRequest()->baseUrl.'/img/videoplay.png';
						return Html::a(Html::img(Url::to($url), ['width'=>'32']), $model->getPicUrl());
					}
					else {
//						return Html::a(Html::img(Url::to($model->getPicUrl(100, 100)), ['width'=>'75']), $model->getPicUrl());
						return Html::a(Html::img(Url::to($model->getPicUrl()), ['width'=>'75']), $model->getPicUrl());
					}
				},
		   ],

		   [
				'attribute' => 'pic_url',
				'value'=>function ($model, $key, $index, $column) { return Url::to($model->getPicUrl()); },
		   ],
/*
		   'size:shortsize',
			[
				'label' => '所有者',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					return count($model->photoOwners).' '.Html::a('<span>详情</span>', ['photoowner/index', 'photo_id'=>$model->photo_id]);
				},
			],
*/
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
