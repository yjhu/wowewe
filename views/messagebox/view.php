<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '消息中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagebox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['修改', 'id' => $model->msg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['删除', 'id' => $model->msg_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条消息，确定?',
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
