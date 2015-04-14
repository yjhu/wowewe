<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Viplevel */

$this->title = 'Create Viplevel';
$this->params['breadcrumbs'][] = ['label' => 'Viplevels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viplevel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
