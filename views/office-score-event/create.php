<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOfficeScoreEvent */

$this->title = 'Create Moffice Score Event';
$this->params['breadcrumbs'][] = ['label' => 'Moffice Score Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-score-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
