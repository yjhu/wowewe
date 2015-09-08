<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = '修改产品: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '产品', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->goods_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mgoods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
