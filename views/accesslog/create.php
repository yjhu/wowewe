<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MAccessLog */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Maccess Log',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maccess Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maccess-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
