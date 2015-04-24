<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\\MAccessLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '粉丝关注日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maccess-log-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
//        'filterModel' => false,
        
        'columns' => [
            
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            
//            'FromUserName',         
                'user.nickname',
/*
               [
                    'label' => '微信昵称',
                    'value'=>function ($model, $key, $index, $column) { return $model->user->nickname; },
               ],
*/            
            'create_time',
            
               [
                    'attribute' => 'Event',
//                    'value'=>function ($model, $key, $index, $column) {  \app\models\U::W($model); return $model->Event == 'subscribe' ? '关注' : '取消关注'; },
                    'value'=>function ($model, $key, $index, $column) {  \app\models\U::W($model); return $model->Event == 'subscribe' ? '关注' : '取消关注'; },
               ],

            'scene_pid',
            
//          'staff.name',
//            'staff.name',

               [
                    'label' => '推荐者姓名',
                    'value'=>function ($model, $key, $index, $column) { return $model->staff->name; },
               ],

           // 'ToUserName',
            
            // 'CreateTime',
            
            // 'MsgId',
            
            // 'MsgType',
            
            // 'Content',
            
            // 'Event',
            

             'EventKey',
            
            // 'EventKeyCRC',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
