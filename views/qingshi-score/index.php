<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MQingshiScore;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MQingshiScoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '三行情诗投票情况';
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>

<div class="mqingshi-score-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Mqingshi Score', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->
    <p>
        <?= Html::a('情诗审核', ['qingshi-author/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'score_id',
           [
                'attribute' => 'score_id',
                'headerOptions' => array('style'=>'width:90px;'),           
            ],

           // 'author_openid',
           [
                'label' => '微信昵称',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 

                    $user = $model->user; return empty($user) ? '' : "<img width=48 src=".$model->user->headimgurl.">&nbsp;&nbsp;".emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)); 

                },
                'filter'=> false,
                'headerOptions' => array('style'=>'width:450px;'),           
            ],

            'create_time',

            'score',
            [
                'attribute' => 'status',
                'label' => '是否领奖',
                'value'=>function ($model, $key, $index, $column) { return MQingshiScore::getQingshiScoreStatusOption($model->status); },
                'filter'=> MQingshiScore::getQingshiScoreStatusOption(),
                'headerOptions' => array('style'=>'width:80px;'),           
            ],
            
            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {delete}',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
                    /*
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '确认要删除?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                    */

                ],
            ],


        ],
    ]); ?>

</div>
