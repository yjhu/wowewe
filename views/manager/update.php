<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */

$this->title = 'Update Manager: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->manager_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manager-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
