<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HeatMap */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Heat Map',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Heat Maps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heat-map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
