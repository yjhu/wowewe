<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MUserSearch $searchModel
 */

$this->title = 'Musers';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-index">

	<h1><?php //echo Html::encode($this->title) ?></h1>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
		<?php echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	'options' => ['class' => 'table-responsive'],
	'tableOptions' => ['class' => 'table table-striped'],
        
        'columns' => [
/*
			[
				//'id'=>'chk',
				'class'=>'yii\grid\CheckBoxColumn',
			],
*/
            'id',            
            'openid',            
			'nickname', 
			'email:email',
/*
			'role',
			'status',
			'create_time',
			'update_time',
*/
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
