<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuVote */

$this->title = 'Create Mzhongqiu Vote';
$this->params['breadcrumbs'][] = ['label' => 'Mzhongqiu Votes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzhongqiu-vote-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
