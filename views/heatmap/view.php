<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HeatMap */

$this->title = $model->heat_map_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Heat Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heat-map-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->heat_map_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->heat_map_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'heat_map_id',
            'gh_id',
            'openid',
            'lon',
            'lat',
            'speed_up',
            'speed_down',
            'speed_delay',
            'media_id',
            'pic_url:url',
            'status',
        ],
    ]) ?>

</div>
