<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->manager_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->manager_id], [
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
            'manager_id',
            'name',
            'mobile',
        ],
    ]) ?>

</div>
