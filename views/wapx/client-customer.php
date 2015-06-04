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
        <link href="/wx/web/ratchet/dist/css/ratchet.css?v12" rel="stylesheet">
        <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="./php-emoji/emoji.css" rel="stylesheet">

        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    </head>
    <body>
        <!------------------- BEGIN OF HEADER --------------------------------->
        <header class="bar bar-nav">
            <?php if ($backwards) { ?>
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
            <?php } ?>
            <h1 class="title">
                <span class="badge badge-positive">客户</span>&nbsp;<?= $customer->name ?><?= $customer->mobile ?>
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">
                    用户信息
                </li>
                <li class="table-view-cell">
                    <p>姓名：<?= $customer->name ?></p>
                    <p>号码：<?= $customer->mobile ?></p>
                </li>                
                <?php if ($customer->is_vip) { ?>
                <li class="table-view-cell table-view-divider">
                    VIP信息
                </li>
                <li class="table-view-cell">
                    <p>VIP级别：<?= $customer->vipLevel->title ?></p>
                    <p>VIP有效期起：<?= $customer->vip_start_time ?></p>
                    <p>VIP有效期止：<?= $customer->vip_end_time ?></p>
                    <p>入网时间：<?= $customer->vip_join_time ?></p>
                </li>
                <?php } ?>
                
                <li class="table-view-cell table-view-divider">
                    微信信息
                </li>
                <?php if (!empty($customer->wechat)) { ?>
                    <li class="table-view-cell media">
                        <img class="media-object pull-left" style="width:120px;" src="<?= $customer->wechat->headImgUrl ?>"/>
                        <div class="media-body">
                            <?= emoji_unified_to_html(emoji_softbank_to_unified($customer->wechat->nickname)) ?>
                            <p><?= $customer->wechat->country ?> <?= $customer->wechat->province ?> <?= $customer->wechat->city ?></p>
                            <p><?= $customer->wechat->create_time ?></p>
                                <?php foreach($customer->wechat->openidBindMobiles as $openidBindMobile ) { ?>
                                <p>
                                    <?= $openidBindMobile->mobile ?>
                                </p>
                                <p>
                                    <?= $openidBindMobile->getCarrier(); ?>&nbsp;
                                    <?= $openidBindMobile->getProvince(); ?>&nbsp;
                                    <?= $openidBindMobile->getCity(); ?>&nbsp;
                                </p>
                                <?php } ?>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="table-view-cell">未关注或未绑定手机</li>
                <?php } ?>
                <?php if (!empty($customer->manageOutlet)) { ?>
                <li class="table-view-cell table-view-divider">
                    维系归属
                </li>
                <li class="table-view-cell">
                    <a class="navigate-right" data-ignore="push" href="<?= \yii\helpers\Url::to([
                        'client-outlet',
                        'gh_id'     => $wx_user->gh_id,
                        'openid'    => $wx_user->openid,
                        'outlet_id' => $customer->manageOutlet->outlet_id,
                        'backwards' => true,
                    ]) ?>">
                        <span class="icon icon-home"></span><?= $customer->manageOutlet->title ?>
                    </a>
                </li>
                <?php } ?>
                <?php if (!empty($customer->user) && !empty($customer->user->promoteOutlet)) {?>
                <li class="table-view-cell table-view-divider">
                    发展归属
                </li>
                <li class="table-view-cell">
                    <a class="navigate-right" data-ignore="push" href="<?= \yii\helpers\Url::to([
                        'client-outlet',
                        'gh_id'     => $wx_user->gh_id,
                        'openid'    => $wx_user->openid,
                        'outlet_id' => $customer->user->promoteOutlet->outlet_id,
                        'backwards' => true,
                    ]) ?>">
                        <span class="icon icon-home"></span><?= $customer->user->promoteOutlet->title ?>
                    </a>
                </li>
                <?php } ?>
                
            </ul>
            <div>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div>
        </div>
        <!------------------- END OF CONTENT ---------------------------------->

        <!------------------- BEGIN OF FOOTER --------------------------------->
        <div class="bar bar-standard bar-footer">
            <div class="content" style="font-size: 10px;color:#ccc;">
                <center>
                    <span><img style='width:18px;' src="<?= $wx_user->headImgUrl ?>"/>&nbsp;&nbsp;</span>
                    <span><?= emoji_unified_to_html(emoji_softbank_to_unified($wx_user->nickname)) ?>&nbsp;</span>
                    <span><?= $wx_user->getBindMobileNumbersStr() ?></span>

                    <br>
                    <span><?= $client->title_abbrev ?>&copy;<?= date('Y') ?></span>
                </center>
            </div>
        </div>
        <!------------------- END OF FOOTER ----------------------------------->
    </body>
</html>
