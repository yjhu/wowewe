<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t4 */

//$this->title = 'Update Mhd201509t4: ' . ' ' . $model->hd201509t4_id;
$this->title = '捐献积分献爱心活动';
$this->params['breadcrumbs'][] = ['label' => '捐献积分献爱心活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hd201509t4_id, 'url' => ['view', 'id' => $model->hd201509t4_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mhd201509t4-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
