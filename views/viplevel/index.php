<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViplevelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Viplevels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viplevel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Viplevel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vip_level_id',
            'title',
            'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
