<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\MItem $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitem-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Update', ['update', 'id' => $model->num_iid], ['class' => 'btn btn-primary']) ?>
		<?php echo Html::a('Delete', ['delete', 'id' => $model->num_iid], [
			'class' => 'btn btn-danger',
			'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
			'data-method' => 'post',
		]); ?>
	</p>

	<?php echo DetailView::widget([
		'model' => $model,
		'attributes' => [
			'num_iid',
			'user_id',
			'title',
			'pic_url:url',
			'price',
			'cid',
			'seller_cids',
			'x_status',
		],
	]); ?>

</div>
