<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeScoreEvent */

$this->title = "渠道优惠券兑换管理";
$this->params['breadcrumbs'][] = ['label' => '渠道优惠券兑换管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = "渠道优惠券兑换管理";
?>
<div class="moffice-score-event-view">

    <h1>渠道优惠券兑换管理</h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <!--
        <//?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        -->
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'gh_id',
            //'openid',
            //'office_id',
            [
                'label' => '渠道名称',
                'value' => $model->getOfficeName($model),
                'format'=> 'html',
            ],
            //'cat',
            'create_time',
            'score',
            'memo',
            'code',
            //'status',
            [
                'label' => '审核状态',
                'value' => $model->getStatusName($model),
                'format'=> 'html',
            ],
        ],
    ]) ?>

</div>
