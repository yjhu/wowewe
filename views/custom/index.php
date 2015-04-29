<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\MOffice;
use app\models\Openidbindmobile;

use app\models\U;

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
		<?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>

		<?php echo Html::a("非营业厅VIP会员绑定列表", ['vipbind', 'in_office'=>0], ['class' => 'btn btn-success']) ?>
    </p>

<!--
<button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">点我弹出/隐藏弹出框</button>
-->


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-striped'],   
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'custom_id',

            [
                'attribute' => 'mobile',
                //'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
                    return $model->mobile;
                },
                'headerOptions' => array('style'=>'width:10%;'),    
            ],

            //'name',
            [
                'attribute' => 'name',
                'format'=>'raw',

                'value'=>function ($model, $key, $index, $column) {

                    //VIP级别   加入时间    开始时间    结束时间
                    $cusername = $model->name; 
                    $level = \app\models\VipLevel::items($model->vip_level_id);
                    $vip_join_time =  $model->isVip() ? $model->getVipJoinTime() : '' ;
                    $vip_start_time = $model->isVip() ? $model->getVipStartTime() : '' ;
                    $vip_end_time = $model->isVip() ? $model->getVipEndTime() : '' ;

                    $customlist = "VIP级别 ".$level."<br>加入时间 ".$vip_join_time."<br>开始时间 ".$vip_start_time."<br>结束时间 ".$vip_end_time;

                    //return $model->name."&nbsp;<a style='float:right' tabindex='0' class='btn btn-info glyphicon glyphicon-th-list' role='button' data-trigger='focus' title='".$cusername."' data-toggle='popover' data-placement='right' data-content='".$customlist."'></a>";
                    return $model->name;

                },
                'headerOptions' => array('style'=>'width:10%;'),    
            ],


            //'is_vip',

            [
                'label' => '微信信息',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 

//                    if(empty($model->openid))
                    if(empty($model->user))
                    {
                        //$wxbind_info = "微信未绑定";
                        return "<img width=48 src='/wx/web/images/wxmpres/headimg-nowx-blank.png' title='微信未绑定'>";
                    }
                    else
                    {
                        $mobiles = $model->user->getBindMobileNumbers();
                        $mobile = empty($mobiles) ? '无' : $mobiles[0];

                        if(empty($model->user->headimgurl))
                            return "<img style='float:left;' width=48 src='/wx/web/images/wxmpres/headimg-blank.png'>&nbsp;&nbsp;<span style='color:#aaa'>昵称 ".$model->user->nickname.
                            "<br>&nbsp;&nbsp;地区 ".$model->user->country."&nbsp;".$model->user->province."&nbsp;".$model->user->city.
                            "<br>&nbsp;&nbsp;绑定手机 ".$mobile."</span>";
                        else
                            return "<img style='float:left;' width=48 src=".$model->user->headimgurl.">&nbsp;&nbsp;<span style='color:#aaa'>昵称 ".$model->user->nickname.
                            "<br>&nbsp;&nbsp;地区 ".$model->user->country."&nbsp;".$model->user->province."&nbsp;".$model->user->city.
                            "<br>&nbsp;&nbsp;绑定手机 ".$mobile."</span>";
                    }

                },
                'attribute'=>'is_bind',
                'filter'=> ['1'=>'绑定', '0'=>'未绑定'],
                'headerOptions' => array('style'=>'width:20%;'),
            ],

            [
                'label' => '关注时间',
                'attribute'=>'subscribe_time_start',
                'value'=>function ($model, $key, $index, $column) { 
                    return empty($model->openidBindMobile->user) ? '' : $model->openidBindMobile->user->create_time;
                },
                'filterType'=>\kartik\grid\GridView::FILTER_DATE,
                'format'=>'raw',
                'filterWidgetOptions'=>[
                    'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
                    'attribute2'=>'subscribe_time_end',
                    'pluginOptions'=>[
                        'format'=>'yyyy-mm-dd',
                        'language'=>'zh-CN',
                    ]
                ],
                'headerOptions' => array('style'=>'width:35%;'),	
            ],

            [
                'label' => '部门名称',
                'attribute' => 'office_id',
                //'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
                'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
                //'filter'=> MOffice::getOfficeNameOptionSimple2('gh_03a74ac96138',false,false),
                'filter'=> \yii\helpers\ArrayHelper::merge(['0'=>'非营业厅'], MOffice::getOfficeNameOptionSimple2('gh_03a74ac96138',false,false)),
                //'headerOptions' => array('style'=>'width:200px;'),      
                //'visible'=>Yii::$app->user->identity->openid == 'admin',
                'visible'=>Yii::$app->user->getIsAdmin(),
                'headerOptions' => array('style'=>'width:15%;'),    
            ],            


            [
                'attribute' => 'is_vip',
                //'label' => '',
                'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
                    return $model->isVip() ? "是" : "否";
                },
    			'filter'=> ['0'=>'否', '1'=>'是'],
                'headerOptions' => array('style'=>'width:5%;'),    
            ],


            //'vip_level_id',
            [
                'attribute' => 'vip_level_id',
                'value'=>function ($model, $key, $index, $column) { return \app\models\VipLevel::items($model->vip_level_id); },
                'filter'=> \app\models\VipLevel::items(),
                'headerOptions' => array('style'=>'width:10%;'),    
            ],            

            [
                'attribute' => 'vip_join_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->getVipJoinTime() : '' ; },
                'headerOptions' => array('style'=>'width:10%;'),    
            ],            
            [
                'attribute' => 'vip_start_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->getVipStartTime() : '' ; },
                'headerOptions' => array('style'=>'width:10%;'),    
            ],            
            [
                'attribute' => 'vip_end_time',
                'value'=>function ($model, $key, $index, $column) { return $model->isVip() ? $model->getVipEndTime() : '' ; },
                'headerOptions' => array('style'=>'width:10%;'),    
            ],
      

            /*
            [
                //'attribute' => 'vip_bind',
                'label' => '是否绑定',
                'value'=>function ($model, $key, $index, $column) { return empty($model->openidBindMobile) ? '否' : '是';},
                //'filter'=> \app\models\VipLevel::items(),
            ],
            */       

/*
            [
                'label' => '微信昵称',
                'value'=>function ($model, $key, $index, $column) { return empty($model->openidBindMobile->user->nickname) ? '' : $model->openidBindMobile->user->nickname;},
            ],       

*/

/*
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
*/
        ],
    ]); ?>

</div>
<script type="text/javascript">

    $(function () {
      $('[data-toggle="popover"]').popover({html : true })
      //alert('hi');
    })

</script>