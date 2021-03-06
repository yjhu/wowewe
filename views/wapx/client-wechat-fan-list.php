<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$wechats = $dataProvider->getModels();
$current_page = $dataProvider->pagination->page;
$page_count = $dataProvider->pagination->pageCount;
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
                发展用户列表(第<?= $current_page + 1 ?>/<?= $page_count ?>页)
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <br>
            <input type="search" id="searchStr" placeholder="按客户昵称或手机号码进行搜索">
            <ul class="table-view">
                <?php if ($page_count > 1) { ?>
                    <li class="table-view-cell">
                        <?php if ($current_page > 0) { ?>
                            <div class="pull-left"><a data-ignore="push" class="btn btn-link" href="<?=
                                \yii\helpers\Url::to([
                                    'client-wechat-fan-list',
                                    'gh_id' => $wx_user->gh_id,
                                    'openid' => $wx_user->openid,
                                    'backwards' => true,
                                    'ClientWechatFanSearch' => [
                                        'gh_id' => $wx_user->gh_id,
                                        'office_id' => $searchModel->office_id,
                                        'page' => ($current_page - 1),
                                    ],
                                ]);
                                ?>"><span class="icon icon-left-nav"></span>上一页</a></div>
                                                  <?php } ?>
                            <?php if ($current_page < $page_count - 1) { ?>
                            <div class="pull-right"><a data-ignore="push" class="btn btn-link" href="<?=
                                \yii\helpers\Url::to([
                                    'client-wechat-fan-list',
                                    'gh_id' => $wx_user->gh_id,
                                    'openid' => $wx_user->openid,
                                    'backwards' => true,
                                    'ClientWechatFanSearch' => [
                                        'gh_id' => $wx_user->gh_id,
                                        'office_id' => $searchModel->office_id,
                                        'page' => ($current_page + 1),
                                    ],
                                ]);
                                ?>">下一页<span class="icon icon-right-nav"></span></a></div>
                    <?php } ?>
                    </li>
                <?php } ?>
                <?php foreach ($wechats as $wechat) { ?>
                    <li class="table-view-cell media">
                        <?php if (!empty($wechat->customer)) { ?>
                        <a data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                            'client-customer',
                            'gh_id'         => $wx_user->gh_id,
                            'openid'        => $wx_user->openid,
                            'customer_id'   => $wechat->customer->custom_id,
                            'backwards'     => true,
                        ]); ?>">
                        <?php } else { ?>
                        <a data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                            'client-wechat-fan',
                            'gh_id'         => $wx_user->gh_id,
                            'openid'        => $wx_user->openid,
                            'wechat_id'     => $wechat->id,
                            'backwards'     => true,
                        ]); ?>">
                        <?php } ?>
                            <img class="media-object pull-left" src="<?php echo $wechat->getHeadImgUrl(); ?>" width="80" height="80">

                            <div class="media-body">
                                <?= emoji_unified_to_html(emoji_softbank_to_unified($wechat->nickname)) ?>
                                <p><?= $wechat->create_time ?></p>
                                <?php foreach($wechat->openidBindMobiles as $openidBindMobile ) { ?>
                                <p>
                                    <?= $openidBindMobile->mobile ?>
                                </p>
                                <p>
                                    <?= $openidBindMobile->getCarrier(); ?>&nbsp;
                                    <?= $openidBindMobile->getProvince(); ?>&nbsp;
                                    <?= $openidBindMobile->getCity(); ?>&nbsp;
                                </p>
                                <?php } ?>
                                <?php if (!empty($wechat->customer)) { ?>
                                <p><span class="badge badge-primary">维系客户</span></p>
                                <?php } else { ?>
                                <p><span class="badge badge-positive">发展客户</span></p>
                                <?php } ?>
                            </div> 
                        </a>
                    </li>
                <?php } ?>
                <?php if ($page_count > 1) { ?>
                    <li class="table-view-cell">
                        <?php if ($current_page > 0) { ?>
                            <div class="pull-left"><a data-ignore="push" class="btn btn-link" href="<?=
                                \yii\helpers\Url::to([
                                    'client-wechat-fan-list',
                                    'gh_id' => $wx_user->gh_id,
                                    'openid' => $wx_user->openid,
                                    'backwards' => true,
                                    'ClientWechatFanSearch' => [
                                        'gh_id' => $wx_user->gh_id,
                                        'office_id' => $searchModel->office_id,
                                        'page' => ($current_page - 1),
                                    ],
                                ]);
                                ?>"><span class="icon icon-left-nav"></span>上一页</a></div>
                                                  <?php } ?>
                            <?php if ($current_page < $page_count - 1) { ?>
                            <div class="pull-right"><a data-ignore="push" class="btn btn-link" href="<?=
                                \yii\helpers\Url::to([
                                    'client-wechat-fan-list',
                                    'gh_id' => $wx_user->gh_id,
                                    'openid' => $wx_user->openid,
                                    'backwards' => true,
                                    'ClientWechatFanSearch' => [
                                        'gh_id' => $wx_user->gh_id,
                                        'office_id' => $searchModel->office_id,
                                        'page' => ($current_page + 1),
                                    ],
                                ]);
                                ?>">下一页<span class="icon icon-right-nav"></span></a></div>
                    <?php } ?>
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
        <script>
            $(document).ready(function () {
                'use strict';
//                alert('document ready');
                $('#searchStr').keydown(function (e) {
                    if (e.keyCode === 13) {
//                        alert('keydown');
                        var search_str = $('#searchStr').val();
                        var url = "<?= \yii\helpers\Url::to([
                            'client-wechat-fan-list',
                            'gh_id' => $wx_user->gh_id,
                            'openid' => $wx_user->openid,
                            'backwards' => true,
                            'ClientWechatFanSearch' => [
                                'gh_id' => $wx_user->gh_id,
                                'office_id' => $searchModel->office_id,
                            ],
                        ]);
                        ?>";
                        url += encodeURI("&ClientWechatFanSearch[searchStr]=" + search_str);
//                        alert(url);
                        location.href = url;
                    }
                });
            });
        </script>
    </body>
</html>
