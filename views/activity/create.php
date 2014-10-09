<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MActivity */

$this->title = '创建活动';
$this->params['breadcrumbs'][] = ['label' => '活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mactivity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
