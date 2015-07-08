<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnicomFaq */

$this->title = '更新客户常见问题及答案' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '客户常见问题', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="unicom-faq-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
