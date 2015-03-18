<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MPhoto */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Mphoto',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Mphotos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->photo_id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="mphoto-update">

    <?= $this->render('_form1', [
        'model' => $model,
    ]) ?>

</div>
