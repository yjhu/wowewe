<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MGoods */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '商品', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgoods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->goods_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->goods_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],

        'template' => '<tr><th width=20%>{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'goods_id',
            'title',
            'descript',
            'price',
            'price_hint',
            'price_old',
            'price_old_hint',
            //'list_img_url:url',
            [
                'label' => '商品小图',
                'value' => '<img src=' . $model->list_img_url . '>',
                'format'=> 'html',
            ],
            //'body_img_url:url',
            
            [
                'label' => '商品大图',
                /*
                'value' => function($model){
                    $len = 0;
                    $imgHtml = "";
                    $imgs = explode(";",$model->body_img_url);
                    foreach ($imgs as $img) {
                        $len++;
                        if(sizeof($imgs) == $len) break; //分号分割后，数组最后一项为空，剔除
                        $imgHtml = $imgHtml . '<img src=' . $img . '>';
                    }
                    return $imgHtml;
                },
                */
                'value' => $model->getViewGoodsPics($model),
                'format'=> 'html',
            ],

            'quantity',
            'office_ctrl',
            'package_ctrl',
            'detail_ctrl',
            'pics_ctrl',
            //'detail:ntext',
            [
                'attribute' => 'detail',
                'format'=> 'html',
            ],
        ],
    ]) ?>

</div>
