<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\MUser $model
 */

$this->title = $model->oid;
$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-view">

<!--
    <h1>订单号：<?= Html::encode($this->title) ?></h1>
-->
    <p>
        <?= Html::a('修改订单', ['update', 'id' => $model->oid], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'oid',            
            'detail',            
			'feesum',            
         [   
             'attribute' => 'status',
             'value' => $model->statusName,
         ],

			'create_time',
		],
    ]) ?>

</div>

<?php
/*
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->oid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->oid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

*/