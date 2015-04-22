<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use app\models\MStaff;

use app\models\MUser;

$this->title = '粉丝管理';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
		<?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php 

	use kartik\dynagrid\DynaGrid;
	use kartik\grid\GridView;
	$columns = [
		//['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
		//'id',

			[
				//'attribute' => 'nickname',
				'label' => '头像',
				'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
					$nickname = $model->nickname;
					$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
					return "$headimgurl";
				},
				'headerOptions' => array('style'=>'width:10%;'),	
			],


			[
				'attribute' => 'nickname',
				'label' => '微信昵称',
				'format'=>'html',
                'value'=>function ($model, $key, $index, $column) { 
					$nickname = $model->nickname;
					$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
					return "$nickname";
				},
				'headerOptions' => array('style'=>'width:10%;'),	
			],

			[
				'label' => '绑定手机号',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
                    if (empty($model->user)) {
                        return '-';
                    }
                    $mobiles = $model->user->getBindMobileNumbers();
                    return empty($mobiles) ? '-' : implode(',', $mobiles); 
                 },
				'headerOptions' => array('style'=>'width:10%;'),	
			],



		[
			'attribute'=>'create_time',
			'filterType'=>GridView::FILTER_DATE,
			//'filterType'=>GridView::FILTER_RANGE,
			'format'=>'raw',
			//'width'=>'270px',
			'filterWidgetOptions'=>[
				'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
				'attribute2'=>'create_time_2',
				'pluginOptions'=>[
					'format'=>'yyyy-mm-dd',
					'language'=>'zh-CN',
				]
			],
			'headerOptions' => array('style'=>'width:25%;'),	
		],

		/*
		[
			'attribute' => 'is_liantongstaff',
			'value'=>function ($model, $key, $index, $column) { return empty($model->is_liantongstaff)?'否':'是'; },
			'filter'=> ['0'=>'否', '1'=>'是'],
		],
		*/


		[
			'attribute' => 'nickname',
			'label' => '粉丝来源',
			'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
				$nickname = $model->nickname;

	            $staff = MStaff::findOne(['gh_id'=>$model->gh_id, 'scene_id'=>$model->scene_pid]);
	            if($staff->cat == 0) //内部员工
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                //$row['scene_pid_office'] = empty($staff->office->title) ? '' : $staff->office->title;
	                //$row['scene_pid_cat'] = '内部员工';
	            }
	            else
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                //$row['scene_pid_office'] = '-';
	                //$row['scene_pid_cat'] = '-';
	            }

				//$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
				return $row['scene_pid_name'];
			},
			'headerOptions' => array('style'=>'width:25%;'),	
		],	


		/*
		[
			'attribute' => 'nickname',
			'label' => '粉丝来源所属部门',
			'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
				$nickname = $model->nickname;

	            $staff = MStaff::findOne(['gh_id'=>$model->gh_id, 'scene_id'=>$model->scene_pid]);
	            if($staff->cat == 0) //内部员工
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                $row['scene_pid_office'] = empty($staff->office->title) ? '' : $staff->office->title;
	                $row['scene_pid_cat'] = '内部员工';
	            }
	            else
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                $row['scene_pid_office'] = '-';
	                $row['scene_pid_cat'] = '-';
	            }

				//$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
				return $row['scene_pid_office'];
			},
			'headerOptions' => array('style'=>'width:15%;'),	
		],	

		[
			'attribute' => 'nickname',
			'label' => '粉丝来源类别',
			'format'=>'html',
            'value'=>function ($model, $key, $index, $column) { 
				$nickname = $model->nickname;

	            $staff = MStaff::findOne(['gh_id'=>$model->gh_id, 'scene_id'=>$model->scene_pid]);
	            if($staff->cat == 0) //内部员工
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                $row['scene_pid_office'] = empty($staff->office->title) ? '' : $staff->office->title;
	                $row['scene_pid_cat'] = '内部员工';
	            }
	            else
	            {
	                $row['scene_pid_name'] = empty($staff->name) ? '' : $staff->name;
	                $row['scene_pid_office'] = '-';
	                $row['scene_pid_cat'] = '-';
	            }

				//$headimgurl = empty($model->headimgurl) ? '' : Html::img(app\models\U::getUserHeadimgurl($model->headimgurl, 46), ['style'=>'width:46px;']);
				return $row['scene_pid_cat'];
			},
			'headerOptions' => array('style'=>'width:10%;'),	
		],	
		*/

		/*
		[
			'attribute' => 'scene_id',
			'value'=>function ($model, $key, $index, $column) { return empty($model->scene_id)?'':$model->scene_id; },
		],
		*/

/*
		[
			'attribute'=>'create_time',
			'filterType'=>GridView::FILTER_DATE_RANGE,
			'format'=>'raw',
			'width'=>'170px',
			'filterWidgetOptions'=>[
				'convertFormat'=>true,
				'pluginOptions'=>[
					//'timePicker'=>true,
					//'timePickerIncrement'=>15,
					//'format'=>'Y-m-d h:i A'
					'separator'=>' : ',
					//'locale'=>'zh-CN',
					'format'=>'Y-m-d'
				]
			],
		],
		[
			'class'=>'kartik\grid\BooleanColumn',
			'attribute'=>'status', 
			'vAlign'=>'middle',
		],
		[
			'class'=>'kartik\grid\ActionColumn',
			'dropdown'=>false,
			'order'=>DynaGrid::ORDER_FIX_RIGHT
		],
		['class'=>'kartik\grid\CheckboxColumn',  'order'=>DynaGrid::ORDER_FIX_RIGHT],
*/

		/*
		[
			'class' => 'yii\grid\ActionColumn',
		]
		*/


	];
		
	echo DynaGrid::widget([
		'columns'=>$columns,
		'storage'=>DynaGrid::TYPE_COOKIE,
		//'theme'=>'panel-danger',
		//'theme'=>'panel-primary',
		'theme'=>'panel-default',
		'gridOptions'=>[
			'dataProvider'=>$dataProvider,
			'filterModel'=>$searchModel,
			'bordered'=>false,
			'panel'=>['heading'=>'<h3 class="panel-title">粉丝列表</h3>'],
			'export'=>['options'=>['class' => 'btn btn-success']],
		],

		'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
	]);
/*
    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'options' => ['class' => 'table-responsive'],
	'tableOptions' => ['class' => 'table table-striped'],
        
        'columns' => [
            'id',            
            'openid',            
			'nickname', 
			'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
*/
?>


</div>

<?php
/*
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'options' => ['class' => 'table-responsive'],
	'tableOptions' => ['class' => 'table table-striped'],
        
        'columns' => [
            'id',            
            'openid',            
			'nickname', 
			'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

*/

