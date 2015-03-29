<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MUserAccount */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Muser Account',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Muser Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="muser-account-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
