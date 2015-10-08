<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MHelpdoc */

$this->title = '新增帮助文档';
$this->params['breadcrumbs'][] = ['label' => '帮助中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhelpdoc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
