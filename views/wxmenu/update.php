<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MWxMenu */

$this->title = Yii::t('backend', 'Update Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Wechat Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mwx-menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'gh'=>$gh,
    ]) ?>

</div>
