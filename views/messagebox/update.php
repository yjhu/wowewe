<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */

$this->title = 'Update Messagebox: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Messageboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->msg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="messagebox-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
