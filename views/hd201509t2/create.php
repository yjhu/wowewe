<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t2 */

$this->title = 'Create Mhd201509t2';
$this->params['breadcrumbs'][] = ['label' => 'Mhd201509t2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhd201509t2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
