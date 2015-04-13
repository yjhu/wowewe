<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vipmanager */

$this->title = 'Create Vipmanager';
$this->params['breadcrumbs'][] = ['label' => 'Vipmanagers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vipmanager-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
