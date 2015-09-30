<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MHd201509t6 */

$this->title = '中秋国庆送话费活动';
$this->params['breadcrumbs'][] = ['label' => '中秋国庆送话费活动', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hd201509t6_id, 'url' => ['view', 'id' => $model->hd201509t6_id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mhd201509t6-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
