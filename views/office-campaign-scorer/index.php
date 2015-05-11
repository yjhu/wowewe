<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MOfficeCampaignScorerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Moffice Campaign Scorers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-scorer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Moffice Campaign Scorer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'department',
            'position',
            'mobile',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
