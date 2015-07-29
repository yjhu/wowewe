<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientEmployee */

$this->title = Yii::t('app', 'Create Client Employee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
