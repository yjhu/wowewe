<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MZhongqiuVoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mzhongqiu Votes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzhongqiu-vote-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mzhongqiu Vote', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'qingshi_vote_id',
            'author_openid',
            'vote_openid',
            'vote_score',
            'vote_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
