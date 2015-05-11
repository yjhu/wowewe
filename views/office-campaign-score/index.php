<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MOfficeCampaignScoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Moffice Campaign Scores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-score-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Moffice Campaign Score', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'office_campaign_id',
            'staff_id',
            'score',
            'created_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
