<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Viplevel */

$this->title = 'Update Viplevel: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Viplevels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->vip_level_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="viplevel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
