<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Openid Bind Mobile',
]) . ' ' . $model->openid_bind_mobile_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Openid Bind Mobiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->openid_bind_mobile_id, 'url' => ['view', 'id' => $model->openid_bind_mobile_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="openid-bind-mobile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
