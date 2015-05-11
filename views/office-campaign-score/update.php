<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScore */

$this->title = 'Update Moffice Campaign Score: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="moffice-campaign-score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
