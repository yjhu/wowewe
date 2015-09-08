<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = '新增产品';
$this->params['breadcrumbs'][] = ['label' => '产品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
