<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vip */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vip_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vip_id], [
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
            'vip_id',
            'name',
            'mobile',
            'join_time',
            'start_time',
            'end_time',
            'cat_val',
        ],
    ]) ?>

</div>
