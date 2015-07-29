<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientOutlet */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Client Outlet',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Outlets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->outlet_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="client-outlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
