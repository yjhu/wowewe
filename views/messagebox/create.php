<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Messagebox */

$this->title = 'Create Messagebox';
$this->params['breadcrumbs'][] = ['label' => 'Messageboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messagebox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
