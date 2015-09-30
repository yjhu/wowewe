<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t6 */

$this->title = $model->hd201509t6_id;
$this->params['breadcrumbs'][] = ['label' => '中秋国庆送话费活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t6-view">

    <h1>中秋国庆送话费活动</h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->hd201509t6_id], ['class' => 'btn btn-primary']) ?>
       <!--
        <//?= Html::a('Delete', ['delete', 'id' => $model->hd201509t6_id], [
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
            //'hd201509t6_id',
            //'gh_id',
            //'openid',
            'mobile',
            'yfzx',
            'fsc',
            //'tcnx',
            [
                'label' => '套餐类型',
                'value' => $model->getTcnxName($model),
                'format'=> 'html',
            ],
            'hbme',
            'create_time',
            //'status',
            [
                'label' => '是否领取',
                'value' => $model->getStatusName($model),
                'format'=> 'html',
            ],
            'qdbm',
        ],
    ]) ?>

</div>
