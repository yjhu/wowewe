<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HeatMap */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Heat Map',
]) . ' ' . $model->heat_map_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Heat Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="heat-map-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
