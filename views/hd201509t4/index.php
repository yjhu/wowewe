<?php
use app\models\U;
use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MHd201509t4;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MHd201509t4Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Mhd201509t4s';
$this->title = '捐献积分献爱心活动';
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>


<div class="mhd201509t4-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Mhd201509t4', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <p>
    <?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
    </p>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'hd201509t4_id',
            //'gh_id',
            //'openid',
            [
                'label' => '微信昵称',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 

                    $user = $model->user; return empty($user) ? '' : "<img width=48 src=".$model->user->headimgurl."><br>".emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)); 

                },
                'filter'=> false,
                'headerOptions' => array('style'=>'width:90px;'),           
            ],

            'mobile',
            'score',
            'create_time',
            // 'status',
           [
                'attribute' => 'status',
                'label' => '状态',
                'value'=>function ($model, $key, $index, $column) { return MHd201509t4::gethd201509t4StatusOption($model->status); },
                'filter'=> MHd201509t4::gethd201509t4StatusOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],
            
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                //'template' => '{update} {delete}',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                        ]);
                    },
             
                    /*
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '确认要删除?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ]);
                    }
                    */
            
                ],
            ],

        ],
    ]); ?>

</div>
