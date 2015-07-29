<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiAuthor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mqingshi Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqingshi-author-view">

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
            'gh_id',
            'author_openid',
            'p1',
            'p2',
            'p3',
            'create_time',
            'ststus',
        ],
    ]) ?>

</div>
