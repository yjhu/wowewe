<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignDetail */

$this->title = 'Update Moffice Campaign Detail: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="moffice-campaign-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
