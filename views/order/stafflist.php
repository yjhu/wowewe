<?php

use yii\helpers\Html;
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

    <p>
		<?php echo Html::a('新增员工', ['staffcreate'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			//['class' => yii\grid\CheckboxColumn::className()],
/*
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
			[
				'attribute' => 'name',
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
				'headerOptions' => array('style'=>'width:200px;'),		
			],
			[
				'attribute' => 'mobile',
			],
			[
				'label' => '推广成绩',
				'value'=>function ($model, $key, $index, $column) { return $model->score.(empty($model->openid)?' [微信未绑定]':''); },
				'filter'=> false,
			],
			[
				'label' => '是否主管',
				'attribute' => 'is_manager',
				'value'=>function ($model, $key, $index, $column) { return empty($model->is_manager)?'':'是'; },
				'filter'=> ['0'=>'否', '1'=>'是'],
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{staffupdate} {staffdelete}',
				'buttons' => [
					'staffupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},

					'staffdelete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => Yii::t('yii', 'Delete'),
							'data-confirm' => Yii::t('yii', '确认要删除此名员工?'),
							'data-method' => 'post',
							'data-pjax' => '0',
						]);
					}
				],
			],

        ],
    ]); ?>

</div>

<?php
/*
//            'openid',    
//			'nickname',
//			'title',

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


*/