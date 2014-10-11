<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\MActivity;

/* @var $this yii\web\View */
/* @var $model app\models\MActivity */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mactivity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'start_time',
            'end_time',
            'title',
            'descr',
            //'status',
            [
                'attribute' => 'status',
                //'value'=>function ($model, $key, $index, $column) { return ($model->status == 1) ? '有效' : '无效'; },
                'value' => MActivity::getStatusOptionName($model->status),
            ],

            'iids',
        ],
    ]) ?>

</div>
