<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MUser $model
 */

$this->title = 'Create user';
//$this->params['breadcrumbs'][] = ['label' => 'Musers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muser-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
        'model' => $model,
	]); ?>

</div>
