<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignScore */

$this->title = 'Create Moffice Campaign Score';
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
