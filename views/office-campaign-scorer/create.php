<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScorer */

$this->title = 'Create Moffice Campaign Scorer';
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Scorers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-scorer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
