<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
?>

<?php
include('../models/utils/emoji.php');
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


        <style type="text/css">

            .btn {
                border-radius: 0 ;
            }

            .btn1 {
                border-radius: 2px ;
            }
        </style>

        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>

        <script src="/wx/web/js/jquery.touchSwipe.min.js"></script>
    </head>
    <body>

        <!-- Make sure all your bars are the first things in your <body> -->



        <header class="bar bar-nav">

<?php if ($backwards) { ?>
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
<?php } ?>
            <a data-ignore="push" class="btn btn-link btn-nav pull-right" href="#showQr"><img src="../web/images/woke/qr.png" width=18px></a>
            <h1 class="title">
                <span class="badge badge-positive">员工</span> <?= $employee->name ?> <?= !empty($employee->mobiles) ? $employee->mobiles[0]:'' ?>
            </h1>

        </header>

        <?php
        if (!empty($employee->wechat) && !empty($employee->wechat->headImgUrl)) {
            $wx_nickname = $employee->wechat->nickname;
            $wx_mobile = $employee->wechat->getBindMobileNumbersStr();
            $wx_country = $employee->wechat->country;
            $wx_province = $employee->wechat->province;
            $wx_city = $employee->wechat->city;
        } else {
            $wx_nickname = "";
            $wx_mobile = "";
            $wx_country = "";
            $wx_province = "";
            $wx_city = "";
        }
        ?>


        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">
                    微信信息
                    <span class='pull-right'>
                        <?php if (!empty($employee->wechat)) { ?>
                        <a data-ignore="push" href="<?= \yii\helpers\Url::to([
                            'wechat-messaging',
                            'gh_id'     => $wx_user->gh_id,
                            'openid'    => $wx_user->openid,
                            'reciever_id'   => $employee->wechat->id,
                            'backwards' => true,
                        ]) ?>">
                        <i class='fa fa-weixin' style='height:24px;color:#23c300;'></i>
                        </a>
                        <?php } else { ?>
                        <i class='fa fa-weixin' style='height:24px;color:#cccccc;'></i>
                        <?php } ?>
                    </span>
                </li>                
                    <?php if (!empty($employee->wechat)) { ?>
                        <li class="table-view-cell media">
                            <a data-ignore='push' href='#headImg'>
                                <img class="media-object pull-left" style="width:120px;" src="<?= $employee->wechat->headImgUrl ?>"/>
                            <div class="media-body">
                            <?= emoji_unified_to_html(emoji_softbank_to_unified($wx_nickname)) ?>
                            <p><?= $wx_country ?> <?= $wx_province ?> <?= $wx_city ?></p>
                            <p><?= $wx_mobile ?></p>
                            </div>
                            </a>
                        </li>                    
                    <?php } else { ?>
                    <li class="table-view-cell">
                        <span>未关注或未绑定手机</span>
                    </li>
                    <?php } ?>

            </ul>

            <?php if (!empty($employee->outlets)) { ?>

                <ul class="table-view">
                    <li class="table-view-cell table-view-divider">所属营业厅</li>

                    <?php foreach ($employee->outlets as $outlet) { ?>
                        <li class="table-view-cell media">
                            <a data-ignore="push"  class="navigate-right" href="<?= \yii\helpers\Url::to([
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
                                        <?= $employee->getOutletPosition($outlet->outlet_id) ?>
                                    </span>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php             
                }
                
                $organizations = $employee->organizations;
                if (!empty($organizations)) {
            ?>
                <ul class="table-view">
                    <li class="table-view-cell table-view-divider">所属部门</li>
                    <?php
                    foreach ($organizations as $organization) {
                    ?>

                        <li class="table-view-cell media">
                            <a data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                                'client-organization',
                                'gh_id'             => $wx_user->gh_id,
                                'openid'           => $wx_user->openid,
                                'backwards'         => true,
                                'organization_id'   => $organization->organization_id,
                            ]) ?>">
                                <span class="media-object pull-left"><i class="fa fa-sitemap fa-2x"></i></span>
                                <div class="media-body">
                                        <?= $organization->title ?>
                                    <span class="badge badge-positive pull-right">
    <?= $employee->getOrganizationPosition($organization->organization_id) ?>
                                    </span>
                                    </span>
                                </div>
                            </a>
                        </li>
<?php } ?>


                </ul>
                <?php } ?>

                <br>

            </div>


        </div><!-- end of content -->

        <div id="showQr" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#showQr"></a>
                <h1 class="title">专属推广二维码</h1>
            </header>
            <div class="content">
                <center>
                    <img src="<?= $employee->getPromoter($wx_user->gh_id)->getQrImageUrl() ?>" width="100%">
                    <p><?= $employee->name ?></p>
                    &nbsp;
                </center>
            </div>
        </div>
        
        <div id="headImg" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#headImg"></a>
                <h1 class="title"><?= $employee->name ?></h1>
            </header>
            <div class="content">
                <center>
                    <img src="<?= !empty($employee->wechat) ? $employee->wechat->getHeadImgUrl() : ''; ?>" width="100%">
                </center>
            </div>
        </div>



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

        <script type="text/javascript">

        </script>

    </body>
</html>
