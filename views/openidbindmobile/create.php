<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OpenidBindMobile */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Openid Bind Mobile',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Openid Bind Mobiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="openid-bind-mobile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
