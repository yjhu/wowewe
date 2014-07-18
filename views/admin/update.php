<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MUser $model
 */

$this->title = 'Update user: ' . $model->id;
/*
$this->params['breadcrumbs'][] = ['label' => 'Musers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
*/
?>
<div class="muser-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
        'model' => $model,
	]); ?>

</div>
