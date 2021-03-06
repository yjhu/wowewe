<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
//	use kartik\dynagrid\DynaGrid;

use app\models\MStaff;

use app\models\MUser;
use app\models\MOffice;
use app\models\U;

$this->title = '粉丝管理';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
  include('../models/utils/emoji.php');
?>

<link href="./php-emoji/emoji.css" rel="stylesheet">

<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
		<?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
		<?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
    </p>

<?php 

	$columns = [
		//['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
//		'id',
//        'gh_id',
//        'openid',

        [
            //'attribute' => 'nickname',
            //'label' => '头像',
            'label' => '微信信息',
            'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
                $nicknameStr = $model->nickname;
                $nickname = emoji_unified_to_html($nicknameStr);

                $headimgurl = empty($model->headimgurl) ? 
                "<img style='float:left;' width=48 src='/wx/web/images/wxmpres/headimg-blank.png'>" : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 48), ['style'=>'width:46px;']);
                return "$headimgurl";
            },
            'headerOptions' => array('style'=>'width:5%;'),	
        ],

        [
            'attribute' => 'nickname',
            'label' => '',
            'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
                $nicknameStr = $model->nickname;
                
                /*
                    //function emoji_docomo_to_unified(   $text){ return emoji_convert($text, 'docomo_to_unified'); }
                    //function emoji_kddi_to_unified(     $text){ return emoji_convert($text, 'kddi_to_unified'); }
                    function emoji_softbank_to_unified( $text){ return emoji_convert($text, 'softbank_to_unified'); }
                    //function emoji_google_to_unified(   $text){ return emoji_convert($text, 'google_to_unified'); }
                */

                $nickname = emoji_unified_to_html(emoji_softbank_to_unified($nicknameStr));

                $mobiles = $model->getBindMobileNumbers();
                $mobile = empty($mobiles) ? '无' : implode(',', $mobiles);

                //$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
                return "<span style='color:#aaa'>昵称 ".$nickname.
                "<br>地区 ".$model->country."&nbsp;".$model->province."&nbsp;".$model->city.
                "<br>绑定手机 ".$mobile."</span>";
            },
            'headerOptions' => array('style'=>'width:18%;'),	
        ],

        [
            'label' => '绑定手机号',
            'attribute' => 'mobile',
            'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
                $mobiles = $model->getBindMobileNumbers();
                return empty($mobiles) ? '' : implode(',', $mobiles); 
             },
            'headerOptions' => array('style'=>'width:10%;'),	
        ],

            [
                'label' => '关注时间',
                'attribute'=>'create_time',
                'filterType'=>\kartik\grid\GridView::FILTER_DATE,
                'format'=>'raw',
                'filterWidgetOptions'=>[
                    'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
                    'attribute2'=>'create_time_2',
                    'pluginOptions'=>[
                        'format'=>'yyyy-mm-dd',
                        'language'=>'zh-CN',
                    ]
                ],
                'headerOptions' => array('style'=>'width:35%;'),	
            ],

		/*
		[
			'attribute' => 'is_liantongstaff',
			'value'=>function ($model, $key, $index, $column) { return empty($model->is_liantongstaff)?'否':'是'; },
			'filter'=> ['0'=>'否', '1'=>'是'],
		],
		*/

		[
			'attribute' => 'staff_name',
			'label' => '推广者',
			'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
                if (empty($model->sceneStaff)) {
                    return '';
                }
				$nickname = $model->nickname;
                $staff = $model->sceneStaff;
	            if($staff->cat == 0)
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	            }
	            else
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	            }
				//$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
				return $row['scene_pid_name'];
			},
			'headerOptions' => array('style'=>'width:25%;'),	
		],	

		[
			'attribute' => 'office_id',
			'label' => '推广者所属部门',
			'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
                if (empty($model->sceneStaff->office->title)) {
                    return '';
                }
                return $model->sceneStaff->office->title;
			},
            'filter' => MOffice::getOfficeNameOptionSimple2(Yii::$app->user->getGhid(), false, false),
		],	

	];
		
	echo GridView::widget([
		'columns'=>$columns,
/*
		'storage'=>DynaGrid::TYPE_COOKIE,
		//'theme'=>'panel-danger',
		//'theme'=>'panel-primary',
		'theme'=>'panel-default',
		'gridOptions'=>[
			'dataProvider'=>$dataProvider,
			'filterModel'=>$searchModel,
			'bordered'=>false,
			//'panel'=>['heading'=>'<h3 class="panel-title">粉丝列表</h3>'],
			'panel'=>['heading'=>'<h3 class="panel-title">&nbsp;</h3>'],
//			'export'=>['options'=>['class' => 'btn btn-success']],
			'export'=>false,
		],		
		'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
*/
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'tableOptions' => ['class' => 'table table-striped'],

	]);

?>


</div>

<?php
/*

*/

