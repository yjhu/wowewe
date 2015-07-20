<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UnicomFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '客户常见问题';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unicom-faq-index">
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
                        <a href="<?= Url::to(['create']);?>" class="btn btn-success">新增&nbsp;<i class="fa fa-plus"></i></a>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
//                                'contentOptions' => [
//                                    'class' => 'col-md-1',
//                                ],
                            ],

                //            'id',
                            'question',
                            'answer:ntext',

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => [
                                    'class' => 'col-md-1',
                                ],
                            ],
                        ],
                    ]); ?>

                </div>
            </div>
        </div>
    </div>   
</div>
