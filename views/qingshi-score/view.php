<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiScore */

$this->title = $model->score_id;
$this->params['breadcrumbs'][] = ['label' => 'Mqingshi Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqingshi-score-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->score_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->score_id], [
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
            'score_id',
            'author_openid',
            'score',
            'status',
        ],
    ]) ?>

</div>
