<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vipmanager */

$this->title = 'Update Vipmanager: ' . ' ' . $model->vipmamnager_id;
$this->params['breadcrumbs'][] = ['label' => 'Vipmanagers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vipmamnager_id, 'url' => ['view', 'id' => $model->vipmamnager_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vipmanager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
