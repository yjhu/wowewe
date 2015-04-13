<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Lookup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lookups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lookup-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->lookup_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->lookup_id], [
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
            'lookup_id',
            'cat',
            'name',
            'cat_val',
            'sort_order',
        ],
    ]) ?>

</div>
