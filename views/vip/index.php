<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vip_id',
            //'name',
            'mobile',
            'cat_val',
            /*
            [
                'label' => '客户经理',
                'value'=>function ($model, $key, $index, $column) 
                { 
                    return $model->vipmanager->manager->name; 
                },
            ],

            [
                'label' => '客户经理电话',
                'value'=>function ($model, $key, $index, $column) 
                { 
                    return $model->vipmanager->manager->mobile; 
                },
            ],
            */

            'join_time',
            'start_time',
            // 'end_time',
            // 'cat_val',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
