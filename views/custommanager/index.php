<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustommanagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Custommanagers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custommanager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Custommanager', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'custom_manager_id',
            'custom_id',
            'manager_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
