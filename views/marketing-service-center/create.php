<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MMarketingServiceCenter */

$this->title = 'Create Mmarketing Service Center';
$this->params['breadcrumbs'][] = ['label' => 'Mmarketing Service Centers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mmarketing-service-center-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
