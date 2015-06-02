<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$orders = $dataProvider->getModels();

use app\models\MOrder;
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
                订单列表<?= count($orders) ?>
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <input type="datetime-local">
            <ul class="table-view">
                <?php foreach ($orders as $order) { ?>
                    <li class="table-view-cell media">
  
                        <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['client-order', 
                            'office_id' =>  $order->office_id, 
                            'oid'       =>  $order->oid,
                            'staff_id'  =>  $wx_user->staff->staff_id,
                            'gh_id'     =>  $wx_user->gh_id,
                            'openid'    =>  $wx_user->openid,
                            'backwards' =>  true,
                            ],true) ?>">

                            <img class="media-object pull-left" src="<?php echo $order->item->pic_url . '-120x120.jpg' ?>" width="80" height="80">

                            <div class="media-body">
                                <p><span class="orderitem">订单编号</span>&nbsp;&nbsp;<?= $order->oid ?></p>
                                <p><span class="orderitem">下单时间</span>&nbsp;&nbsp;<?= $order->create_time ?></p>
                                <p><span class="orderitem">商品名称</span>&nbsp;&nbsp;<?= $order->title ?></p>
                                <p><span class="orderitem">商品价格</span>&nbsp;&nbsp;￥<?= ($order->feesum) / 100 ?>元</p>
                                <p><span class="orderitem">支付方式</span>&nbsp;&nbsp;
                                    <?= MOrder::getOrderPayKindOption($order->pay_kind) ?>
                                </p>

                                <p><span class="orderitem">订单状态</span>&nbsp;&nbsp;
                                    <?php
                                    //需处理的状态
                                    if ($order->status == MOrder::STATUS_PAID ||
                                            $order->status == MOrder::STATUS_SUBMITTED ||
                                            $order->status == MOrder::STATUS_FULFILLED) {
                                        $csstagbegin = "<span class='badge  badge-primary'>";
                                        $csstagend = "</span>";
                                    } else if ($order->status == MOrder::STATUS_SUCCEEDED ||
                                            $order->status == MOrder::STATUS_SYSTEM_SUCCEEDED) {
                                        $csstagbegin = "<span class='badge  badge-positive'>";
                                        $csstagend = "</span>";
                                    } else {
                                        $csstagbegin = "";
                                        $csstagend = "";
                                    }
                                    ?>

                                    <?= $csstagbegin ?>
                                    <?php echo MOrder::getOrderStatusName($order->status) ?>
                                    <?= $csstagend ?>
                                </p>

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
