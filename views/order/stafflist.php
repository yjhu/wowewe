<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = '员工管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--
    <p>
		<?php // echo Html::a('新增员工', ['staffcreate'], ['class' => 'btn btn-success']) ?>
    </p>
	-->

	<?php 
/*    \yii\widgets\Pjax::begin([
		'timeout' => 10000,
	]); 
*/
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [

			[
				'attribute' => 'name',
				//'headerOptions' => array('style'=>'width:10%;'),	
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
	
					if($model->is_manager)
						return (empty($model->name) ? '' : $model->name)."&nbsp;&nbsp;<img src='/wx/web/images/wxmpres/man_blue.png' title='营业厅主管'>"; 
					else
						return (empty($model->name) ? '' : $model->name); 
				},
				'headerOptions' => array('style'=>'width:10%;'),
			],

			[
				'label' => '部门编号',
				'attribute' => 'office_id',
				'headerOptions' => array('style'=>'width:100px;'),	
				'filter'=> false,				
				'visible'=>false,
			],

			[
				'label' => '部门名称',
				'attribute' => 'office_id',
				//'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'value'=>function ($model, $key, $index, $column) { return empty($model->office->title) ? '' : $model->office->title; },
				'filter'=> MOffice::getOfficeNameOptionAll($searchModel->gh_id,false,false),
				'headerOptions' => array('style'=>'width:20%;'),		
				//'visible'=>Yii::$app->user->identity->openid == 'admin',
				'visible'=>Yii::$app->user->getIsAdmin(),
			],

			[
				'attribute' => 'mobile',
				'headerOptions' => array('style'=>'width:10%;'),	
			],


			[
				'label' => '微信信息',
				//'attribute' => 'wxinfo',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					//return ''; 

					$mobiles = $model->user->getBindMobileNumbers();
					$mobile = empty($mobiles) ? '无' : $mobiles[0];

					if(empty($model->openid))
					{
						//$wxbind_info = "微信未绑定";
						return "<img width=48 src='/wx/web/images/wxmpres/headimg-blank.png' title='微信未绑定'>";
					}
					else
					{
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
				'headerOptions' => array('style'=>'width:24%;'),
			],

			[
				'attribute' => 'scene_id',
				'visible'=>false,
			],

			[
				'attribute' => 'cat',
                'value'=>function ($model, $key, $index, $column) { return MStaff::getStaffCatOptionName($model->cat); },
                'filter'=> MStaff::getStaffCatOptionName(),
                'visible'=>false,
			],


			[
				'label' => '二维码',
                'format'=>'raw',
				'value'=>function ($model, $key, $index, $column) { 
						//return Html::img($model->getQrImageUrl(), ['width'=>'32'])."<a class='/wx/imges/wxmpres/download_gary.png'>下载</a>";
						//return "<a href='index.php?r=order/downloadqr&qrurl=".$model->getQrImageUrl()."'><img src='/wx/web/images/wxmpres/download_gary.png'></a>";
                        //return "<a href='index.php?r=order/downloadqr&qrurl=".$model->getQrImageUrl()."'><img src='/wx/web/images/wxmpres/download_gary.png'></a>";
                        return Html::a(Html::img(Url::to(Yii::$app->getRequest()->baseUrl.'/images/wxmpres/download_gary.png')), ['downloadqr', 'staff_id'=>$model->staff_id], ['target'=>'_blank']);
				},
				'filter'=> false,
				'headerOptions' => array('style'=>'width:8%;'),
			],

			[
				'label' => '推广成绩',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
				
					if($model->score == 0)
						return $model->score; 
					else
						return "<a href='#'>".$model->score."</a>"; 
				},
				'filter'=> false,
				'headerOptions' => array('style'=>'width:10%;'),
			],


			/*
			[
				'label' => '是否主管',
				'attribute' => 'is_manager',
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
						$icon = empty($model->is_manager) ? 'minus' : 'ok';
						$title = empty($model->is_manager) ? '设为主管' : '取消主管';
						return Html::a("<span class=\"glyphicon glyphicon-{$icon}\"></span>", ['stafftogglemanager', 'id' => $model->staff_id], [
							'title' => $title,
							'data-method' => 'post',
							'data-pjax' => '0',
						]);
					},
				'filter'=> ['0'=>'否', '1'=>'是'],
//				'visible'=>Yii::$app->user->getIsAdmin(),
			],
			*/

			/*
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{staffupdate} {staffismanager} {staffdelete}',
				'buttons' => [
					'staffupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},
					'staffdelete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
						//return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(), [
							'title' => Yii::t('yii', 'Delete'),
							'data-confirm' => Yii::t('yii', '确认要删除此名员工?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					}
				],
			],
			*/


        ],
    ]); ?>

	<?php /*
    \yii\widgets\Pjax::end(); 
    */
    ?>
</div>

<?php
/*
//            'openid',    
//			'nickname',
//			'title',

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

			//['class' => yii\grid\CheckboxColumn::className()],
			[
				'label' => '员工编号',
				'attribute' => 'staff_id',
				'headerOptions' => array('style'=>'width:100px;'),			
			],

			[
				'label' => '用户昵称',
				'value'=>function ($model, $key, $index, $column) { $user = $model->user; return empty($user) ? '' : $user->nickname; },
				'filter'=> false,
			],
*/
