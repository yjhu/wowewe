<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MMarketingRegion */

$this->title = 'Create Mmarketing Region';
$this->params['breadcrumbs'][] = ['label' => 'Mmarketing Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mmarketing-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
