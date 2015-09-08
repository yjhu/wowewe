<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '产品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->goods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->goods_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,

        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'goods_id',
            'title',
            'descript',
            'price',
            'price_hint',
            'price_old',
            'price_old_hint',
            'detail:ntext',
            'list_img_url:url',
            'body_img_url:url',
            'quantity',
            'office_ctrl',
            'package_ctrl',
            'detail_ctrl',
            'pics_ctrl',
        ],
    ]) ?>

</div>
