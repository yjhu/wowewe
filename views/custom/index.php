<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MOffice;


/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Custom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'custom_id',
            'mobile',
            'name',
            //'is_vip',

            [
                'attribute' => 'is_vip',
                //'label' => '',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
                    $is_vip = $model->is_vip;
                    return ($is_vip==1)?"是":"否";
                },
                //'headerOptions' => array('style'=>'width:20%;'),    
            ],

            /*
            //'office_id',
            [
                    'attribute' => 'office_id',
                    //'label' => '',
                    'format'=>'html',
                    'value'=>function ($model, $key, $index, $column) { 

                    return $model->office->title;
                },
                //'headerOptions' => array('style'=>'width:20%;'),    
            ],
            */


            [
                'label' => '部门名称',
                'attribute' => 'office_id',
                //'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
                'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
                'filter'=> MOffice::getOfficeNameOptionAll('gh_03a74ac96138',false,false),
                'headerOptions' => array('style'=>'width:200px;'),      
                //'visible'=>Yii::$app->user->identity->openid == 'admin',
                'visible'=>Yii::$app->user->getIsAdmin(),
            ],            

            'vip_level_id',
            'vip_join_time',
            'vip_start_time',
            'vip_end_time',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

        ],
    ]); ?>

</div>
