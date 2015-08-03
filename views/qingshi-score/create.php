<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MQingshiScore */

$this->title = 'Create Mqingshi Score';
$this->params['breadcrumbs'][] = ['label' => 'Mqingshi Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqingshi-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
