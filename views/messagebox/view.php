<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Messageboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagebox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->msg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->msg_id], [
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
            'msg_id',
            'title',
            'content:ntext',
            'author',
            'receiver_type',
            'receiver',
        ],
    ]) ?>

</div>
