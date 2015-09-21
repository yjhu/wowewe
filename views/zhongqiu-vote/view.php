<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuVote */

$this->title = $model->qingshi_vote_id;
$this->params['breadcrumbs'][] = ['label' => 'Mzhongqiu Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzhongqiu-vote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->qingshi_vote_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->qingshi_vote_id], [
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
            'qingshi_vote_id',
            'author_openid',
            'vote_openid',
            'vote_score',
            'vote_time',
        ],
    ]) ?>

</div>
