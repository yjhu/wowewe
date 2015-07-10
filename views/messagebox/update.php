<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */

$this->title = '消息中心 修改: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '消息中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->msg_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="messagebox-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
