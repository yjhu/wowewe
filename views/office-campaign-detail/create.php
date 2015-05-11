<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignDetail */

$this->title = 'Create Moffice Campaign Detail';
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
