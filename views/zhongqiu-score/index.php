<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MZhongqiuScoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mzhongqiu Scores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzhongqiu-score-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mzhongqiu Score', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'score_id',
            'author_openid',
            'score',
            'create_time',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
