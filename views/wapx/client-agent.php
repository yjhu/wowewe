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
            <h1 class="title"><span class="badge badge-positive">代理商</span>&nbsp;<?= $agent->name ?><?= !empty($agent->mobiles) ? $agent->mobiles[0]: '' ?></hi>            
        </header>
        <div class="content">
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">微信信息</li>
                
                    <?php if (!empty($agent->wechat)) { ?>
                    <li class="table-view-cell media">
                            <img class="media-object pull-left" style="width:120px;" src="<?= $agent->wechat->headimgurl ?>"/>
                            <div class="media-body">
                            <?= emoji_unified_to_html(emoji_softbank_to_unified($agent->wechat->nickname)) ?>
                            <p><?= $agent->wechat->country ?> <?= $agent->wechat->province ?> <?= $agent->wechat->city ?></p>
                            <p><?= $agent->wechat->getBindMobileNumbersStr() ?></p>
                            </div>
                    </li>  
                    <?php } else { ?>
                    <li class="table-view-cell">
                    <span>未关注或未绑定手机</span>
                    </li>
                    <?php } ?>
                
            </ul>

            <ul class="table-view">
                <li class="table-view-cell table-view-divider">门店列表</li>
                <?php foreach ($agent->outlets as $outlet) { ?> 
                    <li class="table-view-cell media">
                        <a data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                            'client-outlet',
                            'gh_id'     => $wx_user->gh_id,
                            'openid'    => $wx_user->openid,
                            'outlet_id' => $outlet->outlet_id,
                            'backwards' => true,
                        ]) ?>">
                            <span class="media-object pull-left icon icon-home"></span>
                            <div class="media-body">
                                <?= $outlet->title ?>
                                <span class="badge badge-positive pull-right">
                                    <?= $agent->getOutletPosition($outlet->outlet_id) ?>
                                </span>
                            </div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
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

