<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>襄阳联通</title>

        <!-- Sets initial viewport load and disables zooming  -->
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Include the compiled Ratchet CSS -->
        <link href="./ratchet/dist/css/ratchet.css" rel="stylesheet">
        <link href="./php-emoji/emoji.css" rel="stylesheet">    
    </head>
    <body>
        <header class="bar bar-nav">
            <?php if ($backwards) { ?>
                <button class="btn btn-link btn-nav pull-left">
                    <span class="icon icon-left-nav"></span>
                </button>
            <?php } ?>
            <h1 class="title"><span class="badge badge-positive">部门</span>&nbsp;<?= $organization->title ?></hi>            
        </header>
        <div class="content">
            <?php
                $direct_superior_organizations = $organization->getDirectSuperiorOrganizations();
                if (false)
                if (!empty($direct_superior_organizations)) {
            ?>
                <ul class="table-view">
                    <li class="table-view-cell table-view-divider">部门所属</li>
                    <?php foreach($direct_superior_organizations as $direct_superior_organization) { ?>
                    <li class="table-view-cell">
                        <?php \app\models\U::W('------yjhu--------------'); ?>
                        <?php \app\models\U::W($direct_superior_organization); ?>
                        
                        <?= !empty($direct_superior_organization) ? $direct_superior_organization->title : '' ?>
                    </li>
                    <?php } ?>
                </ul>
            <?php             
                } 
                
                $direct_subordinate_organizations = $organization->getDirectSubordinateOrganizations();
                if (false)
                if (!empty($direct_subordinate_organizations)) {
            ?>
                    <ul class="table-view">
                        <li class="table-view-cell table-view-divider">下属部门列表</li>
                        <?php foreach ($direct_subordinate_organizations as $direct_subordinate_organization) { ?> 
                            <li class="table-view-cell media">
                                <a class="navigate-right" href="<?= \yii\helpers\Url::to('wapx/client-orgnization', [
                                        'gh_id' => $wx_user->gh_id, 
                                        'openid' => $wx_user->openid, 
                                        'organizatoin_id' => $direct_subordinate_organization->organization_id,
                                        'backwards' => 1,
                                    ]) ?>">
                                    <span class="media-object pull-left icon icon-home"></span>
                                    <div class="media-body">
                                        <?= $direct_subordinate_organization->title ?>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
            <?php 
            
                } 
            
                $employees = $organization->employees;
                if (!empty($employees)) {
            ?>
                    <ul class="table-view">
                        <li class="table-view-cell table-view-divider">所属员工列表</li>
                        <?php foreach ($employees as $employee) { ?> 
                            <li class="table-view-cell media">
                                <a class="navigate-right" href="<?= \yii\helpers\Url::to('wapx/client-employee', [
                                        'gh_id' => $wx_user->gh_id, 
                                        'openid' => $wx_user->openid, 
                                        'employee_id' => $employee->employee_id,
                                        'backwards' => 1,
                                    ]) ?>">
                                    <?php if (!empty($employee->wechat)) { ?>
                                    <span class="media-object pull-left"><img src="<?= $employee->wechat->headimageurl ?>"></span>
                                    <?php } else { ?>
                                    <span class="media-object pull-left icon icon-person"></span>
                                    <?php } ?>
                                    <div class="media-body">
                                        <?= $employee->name ?>&nbsp;<?= implode(",", $employee->mobiles) ?>
                                        <span class="badge badge-positive"><?= $employee->getOrganizationPosition($organization->organization_id) ?></span>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
            <?php } ?>
        </div>
        <div class="bar bar-standard bar-footer">
            <div class="content" style="font-size: 10px;color:#ccc;">
                <center>
                    <span><img style='width:18px;' src="<?= $wx_user->headimgurl ?>"/>&nbsp;&nbsp;</span>
                    <span><?= emoji_unified_to_html(emoji_softbank_to_unified($wx_user->nickname)) ?>&nbsp;</span>
                    <span><?= $wx_user->getBindMobileNumbersStr() ?></span>
                    <br>
                    <span><?= $client->title_abbrev ?>&copy;<?= date('Y') ?></span>
                </center>
            </div>
        </div>
        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    </body>
</html>

