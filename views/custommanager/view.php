<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Custommanager */

$this->title = $model->custom_manager_id;
$this->params['breadcrumbs'][] = ['label' => 'Custommanagers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custommanager-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->custom_manager_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->custom_manager_id], [
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
            'custom_manager_id',
            'custom_id',
            'manager_id',
        ],
    ]) ?>

</div>
