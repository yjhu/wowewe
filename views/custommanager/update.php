<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custommanager */

$this->title = 'Update Custommanager: ' . ' ' . $model->custom_manager_id;
$this->params['breadcrumbs'][] = ['label' => 'Custommanagers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->custom_manager_id, 'url' => ['view', 'id' => $model->custom_manager_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="custommanager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
