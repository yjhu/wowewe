<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MActivity;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mactivity-index">

    <!--<h1><//?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-striped'],   
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
             'title',
            //'gh_id',
            'start_time',
            'end_time',
            // 'descr',
            [
                //'label' => '部门名称',
                'attribute' => 'status',
                'value'=>function ($model, $key, $index, $column) { return MActivity::getStatusOptionName($model->status) ; },
                'filter'=> MActivity::getStatusOptionName(),
                'headerOptions' => array('style'=>'width:200px;'),      
                //'visible'=>Yii::$app->user->identity->openid == 'admin',
            ],

            'iids',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
