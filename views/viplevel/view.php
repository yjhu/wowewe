<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Viplevel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Viplevels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viplevel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vip_level_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vip_level_id], [
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
            'vip_level_id',
            'title',
            'sort_order',
        ],
    ]) ?>

</div>
