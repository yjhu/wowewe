<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MMarketingServiceCenterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mmarketing Service Centers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mmarketing-service-center-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mmarketing Service Center', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'region_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
