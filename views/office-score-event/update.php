<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MOfficeScoreEvent */

$this->title = '渠道优惠券兑换管理 ' ;
$this->params['breadcrumbs'][] = ['label' => '渠道优惠券兑换管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="moffice-score-event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
