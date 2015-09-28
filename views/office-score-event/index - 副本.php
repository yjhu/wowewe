<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MOfficeScoreEvent;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MOfficeScoreEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Moffice Score Events';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = "渠道优惠券兑换管理";
?>
<div class="moffice-score-event-index">

    <h1>渠道优惠券兑换管理</h1>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Moffice Score Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'gh_id',
            //'openid',
            //'office_id',
            [
                //'attribute' => 'office_id',
                'label' => '渠道名称',
                'value'=>function ($model, $key, $index, $column) {
                    //return MHd201509t6::gethd201509t6StatusOption($model->status); 
                    $office = app\models\MOffice::findOne(["office_id" => $model->office_id]);

                    if(empty($office))
                        return "--";
                    else
                        return $office->title;

                },
                //'filter'=> MHd201509t6::gethd201509t6StatusOption(),
                'headerOptions' => array('style'=>'width:220px;'),           
            ],

            //'cat',
            'create_time',
            'score',
            'memo',
            'code',
            //'status',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value'=>function ($model, $key, $index, $column) { 
                    return MOfficeScoreEvent::getOseStatusOption($model->status); },
                'filter'=> MOfficeScoreEvent::getOseStatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],

            //['class' => 'yii\grid\ActionColumn'],
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
            
                ],
            ],

        ],
    ]); ?>

</div>
