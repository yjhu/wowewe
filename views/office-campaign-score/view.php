<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScore */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-score-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'office_campaign_id',
            'staff_id',
            'score',
            'created_time',
        ],
    ]) ?>

</div>
