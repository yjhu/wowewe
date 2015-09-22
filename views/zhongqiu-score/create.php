<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MZhongqiuScore */

$this->title = 'Create Mzhongqiu Score';
$this->params['breadcrumbs'][] = ['label' => 'Mzhongqiu Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mzhongqiu-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
