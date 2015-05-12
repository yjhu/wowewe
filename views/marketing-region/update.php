<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MMarketingRegion */

$this->title = 'Update Mmarketing Region: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mmarketing Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mmarketing-region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
