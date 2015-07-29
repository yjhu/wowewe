<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientOutlet */

$this->title = Yii::t('app', 'Create Client Outlet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client Outlets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-outlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
