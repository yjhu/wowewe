<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MHd201509t4Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mhd201509t4s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t4-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mhd201509t4', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hd201509t4_id',
            'gh_id',
            'openid',
            'mobile',
            'score',
            // 'create_time',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
