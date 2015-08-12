<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ClientEmployee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '员工详情', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$employee = $model;
?>
<div class="client-employee-view">
    <div class="row">
        <div class="col-md-4">
            <div class="portlet light">
                <div class="employee-profile">
                    <div class="employee-avatar">
                        <?php if (!empty($employee->wechat) && !empty($employee->wechat->headImgUrl)) { ?>
                        <img class="avatar" alt="" src="<?= $employee->wechat->headImgUrl; ?>"/>
                        <?php } else { ?>
                        <img class="avatar" alt="" src="/wx/web/images/wxmpres/headimg-blank.png"/>
                        <?php } ?> 
                    </div>
                    <div class="employee-detail">
                        <span class="name"><?= $employee->name; ?></span>
                    </div>
                    <div class="employee-wechat">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            
        </div>
    </div>
</div>
<?php
$this->registerCss('
    .employee-avatar {
        text-align: center;
    }
    
    .employee-avatar img {
        float: none;
        margin: 0 auto;
        width: 70%;
        height: 70%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }
    
    .employee-profile .employee-detail {
        margin-top: 20px;
        text-align: center;
    } 
    .employee-profile .employee-detail .name {
        color: #5a7391;
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 7px;
    }

');
