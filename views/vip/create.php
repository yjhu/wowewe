<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vip */

$this->title = 'Create Vip';
$this->params['breadcrumbs'][] = ['label' => 'Vips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
