<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MOffice;
use app\models\Openidbindmobile;



/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
-->
    <p>
		<?php echo Html::a("非营业厅VIP会员绑定列表", ['vipbind', 'in_office'=>0], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'custom_id',
            'mobile',
            'name',
            //'is_vip',

            [
                'attribute' => 'is_vip',
                //'label' => '',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
                    return $model->isVip() ? "是" : "否";
                },
    			'filter'=> ['0'=>'否', '1'=>'是'],
                //'headerOptions' => array('style'=>'width:20%;'),    
            ],

            [
                'label' => '部门名称',
                'attribute' => 'office_id',
                //'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
                'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
                'filter'=> MOffice::getOfficeNameOptionSimple2('gh_03a74ac96138',false,false),
                'headerOptions' => array('style'=>'width:200px;'),      
                //'visible'=>Yii::$app->user->identity->openid == 'admin',
                'visible'=>Yii::$app->user->getIsAdmin(),
            ],            

            //'vip_level_id',
            [
                'attribute' => 'vip_level_id',
                'value'=>function ($model, $key, $index, $column) { return \app\models\VipLevel::items($model->vip_level_id); },
                'filter'=> \app\models\VipLevel::items(),
            ],            

            [
                'attribute' => 'vip_join_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->vip_join_time : '' ; },
            ],            
            [
                'attribute' => 'vip_start_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->vip_start_time : '' ; },
            ],            
            [
                'attribute' => 'vip_end_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->vip_end_time : '' ; },
            ],

            [
                //'attribute' => 'vip_bind',
                'label' => '是否绑定',
                'value'=>function ($model, $key, $index, $column) { return empty(Openidbindmobile::findOne(['mobile'=>$model->mobile])) ? '否':'是' ; },
                //'filter'=> \app\models\VipLevel::items(),
            ],       

//            'vip_join_time',
  //          'vip_start_time',
    //        'vip_end_time',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

        ],
    ]); ?>

</div>
