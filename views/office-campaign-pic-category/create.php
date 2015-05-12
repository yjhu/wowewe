<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MOfficeCampaignPicCategory */

$this->title = 'Create Moffice Campaign Pic Category';
$this->params['breadcrumbs'][] = ['label' => 'Moffice Campaign Pic Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moffice-campaign-pic-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
