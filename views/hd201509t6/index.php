<?php
use app\models\U;
use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MHd201509t6;
use app\models\MQdbm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MHd201509t6Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '中秋送话费活动';
$this->params['breadcrumbs'][] = $this->title;
?>

<link href="./php-emoji/emoji.css" rel="stylesheet">

<?php
  include('../models/utils/emoji.php');
?>

<div class="mhd201509t6-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
        <//?= Html::a('Create Mhd201509t6', ['create'], ['class' => 'btn btn-success']) ?>
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

            //'hd201509t6_id',
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
            'yfzx',
            'fsc',
            //'tcnx',
            [
                'attribute' => 'tcnx',
                'label' => '套餐类型',
                'value'=>function ($model, $key, $index, $column) { return MHd201509t6::gethd201509t6TcnxOption($model->tcnx); },
                'filter'=> MHd201509t6::gethd201509t6TcnxOption(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],
            
            'hbme',
            'create_time',
            //'status',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value'=>function ($model, $key, $index, $column) { return MHd201509t6::gethd201509t6StatusOption($model->status); },
                'filter'=> MHd201509t6::gethd201509t6StatusOption(),
                'headerOptions' => array('style'=>'width:80px;'),           
            ],
            'qdbm',
            [
                'label' => '归属营服',
                'value'=>function ($model, $key, $index, $column) { 

                    $qdbm = strtolower(trim($model->qdbm));
                    $qd = MQdbm::findOne(['qdbm' => $qdbm]);

                    if(empty($qd))
                        return "--";
                    else
                        return $qd->gsyf;
                },
                'headerOptions' => array('style'=>'width:120px;'),           
            ],  

            [
                'label' => '渠道名称',
                'value'=>function ($model, $key, $index, $column) { 

                    $qdbm = strtolower(trim($model->qdbm));
                    $qd = MQdbm::findOne(['qdbm' => $qdbm]);

                    if(empty($qd))
                        return "--";
                    else
                        return $qd->qdmc;
                },
                'headerOptions' => array('style'=>'width:120px;'),           
            ],            

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
