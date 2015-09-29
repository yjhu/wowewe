<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MQdbmSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '渠道编码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqdbm-index">

    <h1>渠道编码</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建渠道编码', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'qdbm_id',
            'gsyf',
            'qdmc',
            'qdbm',
            //'blank',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
