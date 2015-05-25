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
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
            <?php } ?>

            <a href="#outletMenuItems">
                <h1 class="title"><span class="badge badge-positive">门店</span>&nbsp;<?= $outlet->title ?></h1>
               <span class="icon icon-caret pull-right"></span>    
            </a>        
        </header>

        <div id="outletMenuItems" class="popover">
          <!--
          <header class="bar bar-nav">
            <h1 class="title">Popover title</h1>
          </header>
          -->
          <ul class="table-view">
            <li class="table-view-cell">订单管理</li>
            <li class="table-view-cell">员工管理</li>
            <li class="table-view-cell">粉丝管理</li>
            <li class="table-view-cell">用户管理</li>
          </ul>
        </div>

        <div class="content">            
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">门店管理归属</li>                
                <li class="table-view-cell">                        
                    <?= $outlet->supervisionOrganization->title ?>
                </li>
                <li class="table-view-cell table-view-divider">门店地址及电话</li>                
                <li class="table-view-cell">                        
                    地址：<?= $outlet->address ?>
                </li>
                <li class="table-view-cell">                        
                    电话：<?= $outlet->telephone ?>
                </li>
            </ul>
            
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">所属员工列表</li>                
                <?php foreach ($outlet->employees as $employee) { ?> 
                    <li class="table-view-cell media">
                        <a  data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                                'client-employee', 
                                'gh_id' => $wx_user->gh_id, 
                                'openid' => $wx_user->openid, 
                                'employee_id' => $employee->employee_id,
                                'backwards' => 1,
                            ]) ?>">
                            <?php if (!empty($employee->wechat) && !empty($employee->wechat->headimgurl)) { ?>
                            <span class="media-object pull-left"><img style="width:48px;" src="<?= $employee->wechat->headimgurl ?>"></span>
                            <?php } else { ?>
                            <span style="width:48px;" class="media-object pull-left icon icon-person"></span>
                            <?php } ?>
                            <div class="media-body">
                                <?= $employee->name ?><p><?= implode("<br>", $employee->mobiles) ?></p>
                                <p><span class="badge badge-positive pull-right"><?= $employee->getOutletPosition($outlet->outlet_id) ?></span></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php foreach ($outlet->agents as $agent) { ?> 
                    <li class="table-view-cell media">
                        <a  data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                                'client-agent', 
                                'gh_id' => $wx_user->gh_id, 
                                'openid' => $wx_user->openid, 
                                'agent_id' => $agent->agent_id,
                                'backwards' => 1,
                            ]) ?>">
                            <?php if (!empty($agent->wechat) && !empty($agent->wechat->headimgurl)) { ?>
                            <span class="media-object pull-left"><img style="width:48px;" src="<?= $agent->wechat->headimgurl ?>"></span>
                            <?php } else { ?>
                            <span style="width:48px;" class="media-object pull-left icon icon-person"></span>
                            <?php } ?>
                            <div class="media-body">
                                <?= $agent->name ?><p><?= implode("<br>", $agent->mobiles) ?></p>
                                <p><span class="badge badge-positive pull-right"><?= $agent->getOutletPosition($outlet->outlet_id) ?></span></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>     
            </ul>
            <div>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
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

