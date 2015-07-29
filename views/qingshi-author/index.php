<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MQingshiAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mqingshi Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqingshi-author-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mqingshi Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gh_id',
            'author_openid',
            'p1',
            'p2',
            // 'p3',
            // 'create_time',
            // 'ststus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
