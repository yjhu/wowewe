<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MHelpdoc;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MHelpdocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '帮助中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mhelpdoc-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增帮助文档', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'helpdoc_id',
            'title',
            //'content:ntext',
            //'sort',
            //'visual',
            [
                'attribute' => 'visual',
                'label' => '是否显示',
                'value'=>function ($model, $key, $index, $column) { 
                        return MHelpdoc::getVisualOption($model->visual); 
                 },
                'filter'=> MHelpdoc::getVisualOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],

            
            // 'relate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
