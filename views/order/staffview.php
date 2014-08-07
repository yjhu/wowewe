<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->staff_id;
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['stafflist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-view">

    <p>
        <?= Html::a('修改', ['staffupdate', 'id' => $model->staff_id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'staff_id',            
			'name',            
			[   
				'attribute' => 'mobile',
//				'value' => "￥".sprintf("%0.2f",$model->feesum/100),
			],
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