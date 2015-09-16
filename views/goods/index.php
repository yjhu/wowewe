<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\MGoods;
use app\models\MGoodsSearch;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\U;


$this->title = '商品';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mgoods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增商品', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'goods_id',
            [
                'attribute' => 'goods_id',
                'label' => '商品编号',
                'headerOptions' => array('style'=>'width:50px;'),
            ],

            'title',
            //'goods_kind',
            [
                'attribute' => 'goods_kind',
                'label' => '分类',
                'value'=>function ($model, $key, $index, $column) { 
                        return MGoods::getGoodsKindOption($model->goods_kind); 
                 },
                'filter'=> MGoods::getGoodsKindOption(),
                'headerOptions' => array('style'=>'width:120px;'),
            ],
            //'descript',
            //'price',
            [
                'attribute' => 'price',
                'headerOptions' => array('style'=>'width:80px;'),
            ],

            //'price_hint',
            //'price_old',
            [
                'attribute' => 'price_old',
                'headerOptions' => array('style'=>'width:80px;'),
            ],            
            // 'price_old_hint',
            // 'detail:ntext',
            // 'list_img_url:url',
            [
                'attribute' => 'list_img_url',
                'label' => '小图',
                'format' => 'html',
                'value' => function($model, $key, $index, $column){
                        return '<img src=' . $model->list_img_url .' width=64px height=64px>';
                },  
                'headerOptions' => array('style'=>'width:80px;'),        
            ],

            // 'body_img_url:url',
            [
                'attribute' => 'body_img_url',
                'label' => '大图',
                'format' => 'html',
                'value' => function($model, $key, $index, $column){
                        $len = 0;
                        $imgHtml = "";
                        $imgs = explode(";",$model->body_img_url);
                        foreach ($imgs as $img) {
                            $len++;
                            if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
                            $imgHtml = $imgHtml . '<img src=' . $img . ' width=45px height=45px>';
                        }
                        return $imgHtml;
                },    
                'headerOptions' => array('style'=>'width:160px;'),      
            ],


            // 'quantity',
            // 'office_ctrl',
            // 'package_ctrl',
            //'detail_ctrl',
            [
                'attribute' => 'detail_ctrl',
                'label' => '显示详情',
                'value'=>function ($model, $key, $index, $column) { 
                        return MGoods::getDetailCtrlOption($model->detail_ctrl); 
                 },
                'filter'=> MGoods::getDetailCtrlOption(),
                'headerOptions' => array('style'=>'width:90px;'),
            ],
            // 'pics_ctrl',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>