<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MItemSearch $searchModel
 */

$this->title = 'Mitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitem-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('Create MItem', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'num_iid',
			'user_id',
			'title',
			'pic_url:url',
			'price',
			'cid',
			'seller_cids',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>
