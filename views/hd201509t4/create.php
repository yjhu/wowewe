<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t4 */

$this->title = 'Create Mhd201509t4';
$this->params['breadcrumbs'][] = ['label' => 'Mhd201509t4s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t4-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
