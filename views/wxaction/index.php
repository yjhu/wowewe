<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\MWxAction;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\MWxActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Wechat Actions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mwx-action-index">

    <p>
        <?= Html::a(Yii::t('backend', 'Create Wechat Action'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        
		'columns' => [
            
			'wx_action_id',
            
            [
                'attribute' => 'keyword',
                'value'=>function ($model, $key, $index, $column) { return $model->getKeywordAlias(); },
            ],
            
            [
                'attribute' => 'type',
                'value'=>function ($model, $key, $index, $column) { return MWxAction::getActionTypeOptionName($model->type); },
                'filter'=> MWxAction::getActionTypeOptionName(),
            ],

			'action:ntext',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],

        ],
    ]); ?>

</div>
