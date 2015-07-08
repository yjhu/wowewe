<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UnicomFaq */

$this->title = '创建新的常见问题及回答';
$this->params['breadcrumbs'][] = ['label' => '客户常见问题', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unicom-faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
