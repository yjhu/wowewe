<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t6 */

$this->title = $model->hd201509t6_id;
$this->params['breadcrumbs'][] = ['label' => 'Mhd201509t6s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t6-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hd201509t6_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hd201509t6_id], [
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
            'hd201509t6_id',
            'gh_id',
            'openid',
            'mobile',
            'yfzx',
            'fsc',
            'tcnx',
            'hbme',
            'create_time',
            'status',
            'qdbm',
        ],
    ]) ?>

</div>
