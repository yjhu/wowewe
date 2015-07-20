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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <?= Html::encode($this->title) ?>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
								</a>
                        <a href="javascript:;" class="remove" data-original-title="" title="">
								</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p>
                    <?php echo Html::a('下载 <i class="glyphicon glyphicon-arrow-down"></i>', U::current(['download' => 1]), ['class' => 'btn btn-success', 'data-pjax' => '0',]); ?>
                    </p>
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
//				'filter'=> MOffice::getOfficeNameOptionAll($searchModel->gh_id,false,false),
                'filter'=> MOffice::getOfficeNameOptionSimple2('gh_03a74ac96138',false,false),

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

					if(empty($model->openid))
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
					else {
//                        MStaffSearch[mobile]
						//return "<a href='#'>".$model->score."</a>"; 
                        return Html::a($model->score, ['admin/index', 'MUserSearch[scene_pid]'=>$model->scene_id]);
                    }
				},
				'filter'=> false,
				'headerOptions' => array('style'=>'width:10%;'),
			],

			
        ],
    ]); ?>
                </div>
            </div>
        </div>
    </div>

		

</div>

