<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MQdbm */

$this->title = '修改渠道编码: ' . ' ' . $model->qdbm_id;
$this->params['breadcrumbs'][] = ['label' => '渠道编码', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qdbm_id, 'url' => ['view', 'id' => $model->qdbm_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mqdbm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
