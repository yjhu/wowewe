<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MQdbm */

$this->title = '渠道编码';
$this->params['breadcrumbs'][] = ['label' => '渠道编码', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqdbm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->qdbm_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->qdbm_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除该渠道编码，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'qdbm_id',
            'gsyf',
            'qdmc',
            'qdbm',
            //'blank',
        ],
    ]) ?>

</div>
