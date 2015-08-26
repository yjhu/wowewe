<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClientEmployee */

$this->title = '新增员工';
$this->params['breadcrumbs'][] = ['label' => '员工管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-employee-create">

    <div class="col-md-6 col-xs-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject">
                        <i class="fa fa-user-plus"></i>
                        新增员工
                    </span>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>

    

</div>
