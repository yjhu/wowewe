<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
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
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
  
    <style type="text/css">
      .orderitem{
          color:#aaaaaa;
          font-size: 11pt;
      }
    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       营业厅订单详情
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <br>
    <p><?= $office->title ?> &nbsp;&nbsp;<?= $staff->name." ".$staff->mobile ?></p>

      <img width=100% height=240 class="media-object pull-left" src="<?= $order->item->pic_url ?>">


        <span>
          <ul class="table-view">

            <li class="table-view-cell table-view-divider">订单信息</li>

            <li class="table-view-cell"><span class="orderitem">订单编号</span>&nbsp;&nbsp; <?= $order->oid ?></li>
            <li class="table-view-cell"><span class="orderitem">商品名称</span>&nbsp;&nbsp; <?= $order->title ?></li>

            <li class="table-view-cell"><span class="orderitem">商品价格</span>&nbsp;&nbsp; ￥<?= ($order->feesum)/100 ?>元</li>

            <li class="table-view-cell"><span class="orderitem">支付方式</span>&nbsp;&nbsp; 
            <?= MOrder::getOrderPayKindOption($order->pay_kind) ?></li>



            <li class="table-view-cell"><span class="orderitem">订单状态</span>&nbsp;&nbsp; 


            <?php echo MOrder::getOrderStatusName($order->status) ?>
            <?php 
              if ($order->status == MOrder::STATUS_PAID || ($oder->status == MOrder::STATUS_SUBMITTED && $order->pay_kind == MOrder::PAY_KIND_CASH)) {
                echo "办理成功";  //订单状态改为 MOrder::STATUS_FULFILLED
              } else if ($oder->status == MOrder::STATUS_FULFILLED && $staff->isSelfOperatedOfficeDirector()) {
                if ($order->pay_kind == MOrder::PAY_KIND_CASH)
                  echo "撤销办理"; //订单状态改为 MOrder::STATUS_SELLER_ROLLBACK_CLOSED
                else
                  echo "撤销办理并退款"; //订单状态改为 MOrder::STATUS_SELLER_REFUND_CLOSED
              }

            ?>


            </li>

            <li class="table-view-cell"><span class="orderitem">下单时间</span>&nbsp;&nbsp; <?= $order->create_time ?></li>
            <li class="table-view-cell"><span class="orderitem">订单详情</span>&nbsp;&nbsp; <?= $order->detail ?></li>

            <li class="table-view-cell table-view-divider">用户信息</li>
            <li class="table-view-cell"><span class="orderitem">用户姓名</span>&nbsp;&nbsp; <?= $order->username ?></li>
            <li class="table-view-cell"><span class="orderitem">联系电话</span>&nbsp;&nbsp; <?= $order->usermobile ?></li>
            <li class="table-view-cell"><span class="orderitem">身份证号</span>&nbsp;&nbsp; <?= $order->改为 ?></li>


            <li class="table-view-cell table-view-divider">收货地址</li>
            <li class="table-view-cell"><?= !empty($order->address) ? $order->address : "" ?></li>

          </ul>
        </span>

 &nbsp;<br>&nbsp;<br>&nbsp;<br>
    </div>



  </body>

</html>