<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VipmanagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vipmanagers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vipmanager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vipmanager', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vipmamnager_id',
            'vip_id',
            'manager_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
