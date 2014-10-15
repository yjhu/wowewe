<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

use app\models\U;
use app\models\MChannel;
use app\models\MOffice;

$this->title = '公众号列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php echo Html::a('新增公众号', ['ghcreate'], ['class' => 'btn btn-success']) ?>
    </p>

	<?php \yii\widgets\Pjax::begin([
		'timeout' => 10000,
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
			[
				'label' => '公众号Id',
				'attribute' => 'gh_id',
				'headerOptions' => array('style'=>'width:100px;'),	
			],
			[
				'attribute' => 'appid',
			],
			[
				'attribute' => 'appsecret',
			],
			[
				'attribute' => 'token',
			],
			[
				'attribute' => 'partnerid',
			],
			[
				'attribute' => 'partnerkey',
			],
			[
				'attribute' => 'wxname',
			],
			[
				'attribute' => 'nickname',
                'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
					if ($model->gh_id === Yii::$app->user->identity->gh_id)
						return "<p class=\"text-danger\">{$model->nickname}</p>";
						//return "<p class=\"bg-primary\">{$model->nickname}</p>";
					else
						return $model->nickname;
				},
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'template' => '{ghupdate} {ghdelete} {ghdoorback}',
				'buttons' => [
					'ghupdate' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
							'title' => Yii::t('yii', 'Update'),
							'data-pjax' => '0',
						]);
					},
/*
					'ghdelete' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
							'title' => Yii::t('yii', 'Delete'),
//							'data-confirm' => Yii::t('yii', '确认要删除此?'),
							'data-method' => 'post',
							'data-pjax' => '0',
							//'data-pjax' => '1',
						]);
					}
*/
					'ghdoorback' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-screenshot"></span>', $url, [
							'title' => Yii::t('yii', 'Doorback'),
							'data-pjax' => '0',
						]);
					},


				],
			],

        ],
    ]); ?>

	<?php \yii\widgets\Pjax::end(); ?>
</div>

<?php
/*
*/

