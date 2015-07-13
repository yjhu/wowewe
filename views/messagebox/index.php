<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\Messagebox;
use app\models\MOffice;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '消息中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagebox-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增消息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'msg_id',
            'title',
            'digest',
            
            //'content:ntext',
            'author',

            [
                'attribute' => 'receiver_type',
                'value'=>function ($model, $key, $index, $column) { return Messagebox::getReceiverTypeOptionName($model->receiver_type); },
                'filter'=> Messagebox::getReceiverTypeOptionName(),
                //'visible'=>false,
            ],

            [
                'attribute' => 'receiver',
                'value'=>function ($model, $key, $index, $column) { 
                    $office = MOffice::findOne(['office_id'=>$model->receiver]);
                    if($model->receiver_type == 0) /*经销商*/
                        return '--';
                    else
                        return $office->title;
                },
                //'filter'=> Messagebox::getReceiverTypeOptionName(),
                //'visible'=>false,
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
