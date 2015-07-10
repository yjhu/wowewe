<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MessageboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messageboxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagebox-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Messagebox', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'msg_id',
            'title',
            //'content:ntext',
            'author',
            'receiver_type',
            'receiver',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
