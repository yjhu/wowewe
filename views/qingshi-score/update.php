<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiScore */

//$this->title = '投票获奖状态修改';
$this->title = '投票获奖状态 ' . ' ' . $model->score_id;
$this->params['breadcrumbs'][] = ['label' => '投票情况', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->score_id, 'url' => ['view', 'id' => $model->score_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mqingshi-score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
