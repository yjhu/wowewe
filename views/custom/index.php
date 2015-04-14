<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Custom', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'custom_id',
            'mobile',
            'name',
            'is_vip',
            'office_id',
            // 'vip_level_id',
            // 'vip_join_time',
            // 'vip_start_time',
            // 'vip_end_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
