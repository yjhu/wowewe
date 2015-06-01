<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$customers = $dataProvider->getModels();
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
                存量用户列表(第<?= $current_page + 1; ?>/<?=  $page_count; ?>页)
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <ul class="table-view">
                <li class="table-view-cell">
                    <?php  if ($current_page > 0) { ?>
                    <div class="pull-left"><a data-ignore="push" class="btn btn-link" href="<?= \yii\helpers\Url::to([
                        'client-customer-list',
                        'gh_id'     => $wx_user->gh_id,
                        'openid'    => $wx_user->openid,
                        'backwards' => true,
                        'ClientCustomerSearch' => [
                            'gh_id'         => $wx_user->gh_id,
                            'office_id'     => $searchModel->office_id,  
                            'page'          => $current_page - 1,
                        ],
                        
                    ]); ?>"><span class="icon icon-left-nav"></span>上一页</a></div>
                    <?php } ?>
                    <?php  if ($current_page < $page_count - 1) { ?>
                    <div class="pull-right"><a data-ignore="push" class="btn btn-link" href="<?= \yii\helpers\Url::to([
                        'client-customer-list',
                        'gh_id'     => $wx_user->gh_id,
                        'openid'    => $wx_user->openid,
                        'backwards' => true,
                        'ClientCustomerSearch' => [
                            'gh_id'         => $wx_user->gh_id,
                            'office_id'     => $searchModel->office_id,
                            'page'          => $current_page + 1,
                        ],                        
                    ]); ?>">下一页<span class="icon icon-right-nav"></span></a></div>
                    <?php } ?>
                </li>
                <?php 
                foreach ($customers as $customer) { 
                    $wechat = $customer->user;
                ?>
                    <li class="table-view-cell media">
                        <a data-ignore="push" class="navigate-right">

                            <img class="media-object pull-left" src="<?php echo $wechat->getHeadImgUrl(); ?>" width="80" height="80">

                            <div class="media-body">
                                <p><?= emoji_unified_to_html(emoji_softbank_to_unified($wechat->nickname)) ?></p>
                                <p><?= $wechat->create_time ?></p>
                                <?php foreach($wechat->openidBindMobiles as $openidBindMobile ) { ?>
                                <p>
                                    <?= $openidBindMobile->mobile ?>&nbsp;
                                    <?= $openidBindMobile->getCarrier(); ?>&nbsp;
                                    <?= $openidBindMobile->getProvince(); ?>&nbsp;
                                    <?= $openidBindMobile->getCity(); ?>&nbsp;
                                </p>
                                <?php } ?>
                            </div> 
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
