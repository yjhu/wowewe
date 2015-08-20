<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t2 */

$this->title = $model->hd201509t2_id;
$this->params['breadcrumbs'][] = ['label' => 'Mhd201509t2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t2-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->hd201509t2_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->hd201509t2_id], [
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
            'hd201509t2_id',
            'gh_id',
            'openid',
            'mobile',
            'create_time',
            'status',
        ],
    ]) ?>

</div>
