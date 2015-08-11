<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\U;
use app\models\MUserAccount;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MUserAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户账户管理');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-account-index">

	<!--
    <p>
        <//?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['class' => 'table-responsive'],
		'tableOptions' => ['class' => 'table table-striped'],        
        'columns' => [
//            'id',
            
//            'gh_id',
            
//            'openid',
   
			[
				'label' => false,
				'format'=>'html',
				'value'=>function ($model, $key, $index, $column) { 
                        if (empty($model->user->headimgurl))
                            return '';
						$headimgurl = Html::img(U::getUserHeadimgurl($model->user->headimgurl, 46), ['style'=>'width:46px;']);
						return $headimgurl;
					},
			],
			[
				'label' => '微信昵称',
				'value'=>function ($model, $key, $index, $column) {  
						return empty($model->user->nickname) ? '' : $model->user->nickname;
					},
			],
            
            'create_time',
            
            //'amount',
          
            
			[
				'attribute' => 'amount',
				'value'=>function ($model, $key, $index, $column) {  
						return $model->getAmountInfo();
					},
			],            

           //'status',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value'=>function ($model, $key, $index, $column) { return MUserAccount::getStatusDesc($model->status); },
                'filter'=> MUserAccount::getStatusDesc(),
                'headerOptions' => array('style'=>'width:120px;'),           
            ],
            
//            'memo',
            
//            'cat',
       
			[
				'attribute' => 'cat',
                'value'=>function ($model, $key, $index, $column) { return MUserAccount::getCatOptionName($model->cat); },
                'filter'=> MUserAccount::getCatOptionName(),
			],            
			[
				'attribute' => 'memo',
                'value'=>function ($model, $key, $index, $column) { 
                    return $model->getMemoInfo();
                 },
			],            

            'scene_id',
            
           // 'oid',
  
            'charge_mobile',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],

        ],
    ]); ?>

</div>

<?php
/*
    <h2>
        账户余额: <?= $user->getUserAccountBalanceInfo(); ?>
    </h2>


*/