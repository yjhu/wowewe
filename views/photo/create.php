<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MPhoto */

$this->title = Yii::t('backend', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Photo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mphoto-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
