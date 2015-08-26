<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t2 */

$this->title = 'Update Mhd201509t2: ' . ' ' . $model->hd201509t2_id;
$this->params['breadcrumbs'][] = ['label' => 'Mhd201509t2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hd201509t2_id, 'url' => ['view', 'id' => $model->hd201509t2_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mhd201509t2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
