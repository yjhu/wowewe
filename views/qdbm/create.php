<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MQdbm */

$this->title = '新建渠道编码';
$this->params['breadcrumbs'][] = ['label' => '渠道编码', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mqdbm-create">

	<?php if (Yii::$app->session->hasFlash('msg')): ?>
		<div class="alert alert-danger flash-danger">
			<?php echo Yii::$app->session->getFlash('msg'); ?>
		</div>
	<?php else: ?>
	<?php endif; ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
