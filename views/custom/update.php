<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Custom */

$this->title = '客户管理: ' . ' ' . $model->mobile;
$this->params['breadcrumbs'][] = ['label' => '客户管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mobile, 'url' => ['view', 'id' => $model->custom_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="custom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
