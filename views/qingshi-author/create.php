<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MQingshiAuthor */

$this->title = 'Create Mqingshi Author';
$this->params['breadcrumbs'][] = ['label' => 'Mqingshi Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqingshi-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
