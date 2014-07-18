<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MItem $model
 */

$this->title = 'Update Mitem: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->num_iid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mitem-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
