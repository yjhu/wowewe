<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MHelpdoc */

$this->title = '帮助文档: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '帮助文档', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->helpdoc_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mhelpdoc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
