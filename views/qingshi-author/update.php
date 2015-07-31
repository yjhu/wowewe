<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MQingshiAuthor */

//$this->title = 'Update Mqingshi Author: ' . ' ' . $model->id;
$this->title = '审核';

$this->params['breadcrumbs'][] = ['label' => '三行情诗投票', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '审核';
?>
<div class="mqingshi-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    

</div>
