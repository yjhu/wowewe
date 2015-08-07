<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MQingshiAuthor;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MQingshiAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '三行情诗投票';
$this->params['breadcrumbs'][] = $this->title;
?>
<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>

<div class="mqingshi-author-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Mqingshi Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <p>
        <?= Html::a('投票排行', ['qingshi-score/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'gh_id',
            //'author_openid',
            [
                'label' => '微信昵称',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 

                    $user = $model->user; return empty($user) ? '' : "<img width=48 src=".$model->user->headimgurl."><br>".emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)); 

                },
                'filter'=> false,
                'headerOptions' => array('style'=>'width:90px;'),           
            ],
            'p1',
            'p2',
            'p3',
            [
                'attribute' => 'create_time',
                'headerOptions' => array('style'=>'width:90px;'),           
            ],

            [
                'attribute' => 'status',
                'label' => '状态',
                'value'=>function ($model, $key, $index, $column) { return MQingshiAuthor::getQingshiStatusOption($model->status); },
                'filter'=> MQingshiAuthor::getQingshiStatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],

           // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {delete}',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
             
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '确认要删除?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
              

                ],
            ],




        ],
    ]); ?>

</div>
