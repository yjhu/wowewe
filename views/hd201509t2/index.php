<?php

use yii\helpers\Html;
use yii\grid\GridView;


use app\models\MHd201509t2;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MHd201509t2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '充话费送话费活动';
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>


<div class="mhd201509t2-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--
    <p>
        <//?= Html::a('Create Mhd201509t2', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'hd201509t2_id',
            //'gh_id',
            //'openid',

            [
                'label' => '微信昵称',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 

                    $user = $model->user; return empty($user) ? '' : "<img width=48 src=".$model->user->headimgurl."><br>".emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)); 

                },
                'filter'=> false,
                'headerOptions' => array('style'=>'width:90px;'),           
            ],
            'mobile',
            'yfzx',
            'fsc',
            'create_time',
            //'status',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value'=>function ($model, $key, $index, $column) { return MHd201509t2::getHd201509t2StatusOption($model->status); },
                'filter'=> MHd201509t2::getHd201509t2StatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],


            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
