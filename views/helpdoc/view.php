<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MHelpdoc */

$this->title = '帮助中心';
$this->params['breadcrumbs'][] = ['label' => '帮助中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhelpdoc-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->helpdoc_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->helpdoc_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条帮助文档, 确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'helpdoc_id',
            'title',
            //'content:ntext',
            [
                'attribute' => 'content',
                'format'=> 'html',
            ],
            'sort',
            'visual',
            'relate',
        ],
    ]) ?>

</div>
