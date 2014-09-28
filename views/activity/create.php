<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MActivity */

$this->title = 'Create Mactivity';
$this->params['breadcrumbs'][] = ['label' => 'Mactivities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mactivity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
