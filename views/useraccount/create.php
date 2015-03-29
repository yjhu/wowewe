<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MUserAccount */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Muser Account',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Muser Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-account-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
