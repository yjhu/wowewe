<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

include('../models/utils/emoji.php');

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
                        <div class="name"><?= $employee->name; ?></div>
                        <div class="mobile">
                            <?= implode(',',$employee->mobiles); ?>                                   
                        </div>
                        <div>
                            <?php
                                foreach ($employee->organizations as $organization) {
                                    echo $organization->title . ', '.$employee->getOrganizationPosition($organization->organization_id). '<br>';
                                }
                                foreach ($employee->outlets as $outlet) {
                                    echo $outlet->title . ', '.$employee->getOutletPosition($outlet->outlet_id). '<br>';
                                }
                            ?>                    
                        </div>
                    </div>
                    <?php if (!empty($employee->wechat)) { ?>
                    <div class="employee-wechat">
                        <i class="fa fa-weixin" style="color:#80d63f;"></i>：<?= emoji_unified_to_html(emoji_softbank_to_unified($employee->wechat->nickname)); ?> <br>
                            关注时间：<?= $employee->wechat->create_time; //date('Y年m月d日 H:i:s', $employee->wechat->subscribe_time); ?><br>
                    </div>
                    <?php } ?> 
                </div>
            </div>  
        </div>
        <?php if (!empty($employee->wechat)) { ?>
        <div class="col-md-4">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject">
                            <i class="fa fa-qrcode"></i>
                            推广二维码
                        </span>
                    </div>
                </div>
                <div class="portlet-body" style="text-align: center;">
                    <img style="width:90%" src="<?= $employee->wechat->getQrImageUrl(); ?>" />
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject">
                            <i class="fa fa-list"></i>
                            推广成绩与记录
                        </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row .list-separated promotion-score">
                        <div class="col-md-6">
                            <div class="promotion-number"><?= $employee->wechat->score; ?></div>
                            <div class="promotion-desc">推广粉丝</div>
                        </div>
                        <div class="col-md-6">
                            <div class="promotion-number"><?= $employee->wechat->memberScore; ?></div>
                            <div class="promotion-desc">推广会员</div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="scroller" style="height: 480px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                <ul class="feeds">
                                    <?php
                                        $promotees = $employee->wechat->getPromotees();
                                        foreach ($promotees as $promotee) {
                                    ?>
                                    <li>
                                            <div class="col1">
                                                    <div class="cont">
                                                            <div class="cont-col1">
                                                                    <div>
                                                                        <img style='width:32px;height:32px;' src="<?= $promotee->getHeadImgUrl(); ?>" />    
                                                                    </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                    <div class="desc">
                                                                            <?= emoji_unified_to_html(emoji_softbank_to_unified($promotee->nickname)); ?>
                                                                        <?php 
                                                                            if (!empty($promotee->openidBindMobiles))
                                                                                echo '<span class="badge btn-success">会员</span>';
                                                                        ?>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="col2">
                                                    <div class="date" style='padding:0px;'>
                                                             <?= $promotee->create_time; ?>
                                                    </div>
                                            </div>
                                    </li>
                                    <?php } ?>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?> 
        
    </div>
</div>
<?php
$this->registerCss('
    .employee-avatar {
        text-align: center;
    }
    
    .employee-wechat {
        text-align: center;
    }
    
    .employee-avatar img {
        float: none;
        margin: 0 auto;
        width: 200px;
        height: 200px;
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
        padding-bottom: 20px;
    }
    
    .promotion-number {
        color: #7f90a4;
        font-size: 25px;
        text-align: center;
    }

    .promotion-desc {
        color: #5b9bd1;
        font-size: 11px;
        font-weight: 800;
        text-align: center;
    }
    .promotion-score {
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f4f7;
    }

');
