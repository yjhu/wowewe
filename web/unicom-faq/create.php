<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UnicomFaq */

$this->title = Yii::t('app', 'Create Unicom Faq');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unicom Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unicom-faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
