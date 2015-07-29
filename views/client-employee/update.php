<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientEmployee */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Client Employee',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->employee_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="client-employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
