<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuVote */

$this->title = 'Update Mzhongqiu Vote: ' . ' ' . $model->qingshi_vote_id;
$this->params['breadcrumbs'][] = ['label' => 'Mzhongqiu Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qingshi_vote_id, 'url' => ['view', 'id' => $model->qingshi_vote_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mzhongqiu-vote-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
