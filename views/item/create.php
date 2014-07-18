<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MItem $model
 */

$this->title = 'Create Mitem';
$this->params['breadcrumbs'][] = ['label' => 'Mitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitem-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
