<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vipmanager */

$this->title = $model->vipmamnager_id;
$this->params['breadcrumbs'][] = ['label' => 'Vipmanagers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vipmanager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->vipmamnager_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->vipmamnager_id], [
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
            'vipmamnager_id',
            'vip_id',
            'manager_id',
        ],
    ]) ?>

</div>
