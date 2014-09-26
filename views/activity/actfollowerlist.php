<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '活动参与名单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mactivity-index">

    <!--<h1><//?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<!--
    <p>
        <//?= Html::a('创建活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gh_id',
            'openid',
            'create_time',
            'act_id',
 
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
