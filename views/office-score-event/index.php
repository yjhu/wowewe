<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MOfficeScoreEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Moffice Score Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-score-event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Moffice Score Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gh_id',
            'openid',
            'office_id',
            'cat',
            // 'create_time',
            // 'score',
            // 'memo',
            // 'code',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
