<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuScore */

$this->title = 'Update Mzhongqiu Score: ' . ' ' . $model->score_id;
$this->params['breadcrumbs'][] = ['label' => 'Mzhongqiu Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->score_id, 'url' => ['view', 'id' => $model->score_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mzhongqiu-score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
