<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
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
      <a data-ignore="push" class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre()"></a>
      <h1 class="title">
       营业厅订单
      </h1>

    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <br>
        <p><?= $office->title ?> &nbsp;&nbsp;<?= $staff->name." ".$staff->mobile ?></p>

       <ul class="table-view">
   
          <?php foreach($orders as $order) {  ?>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['officeorderdetail', 'office_id'=>$office->office_id, 'staff_id'=>$staff->staff_id, 'oid'=>$order->oid],true) ?>">

                <img class="media-object pull-left" src="<?php echo $order->item->pic_url.'-120x120.jpg' ?>" width="80" height="80">
               
                <div class="media-body">
                  <p><span class="orderitem">订单编号</span>&nbsp;&nbsp;<?= $order->oid ?></p>
                  <p><span class="orderitem">下单时间</span>&nbsp;&nbsp;<?= $order->create_time ?></p>
                  <p><span class="orderitem">商品名称</span>&nbsp;&nbsp;<?= $order->title ?></p>
                  <p><span class="orderitem">商品价格</span>&nbsp;&nbsp;￥<?= ($order->feesum)/100 ?>元</p>
                  <p><span class="orderitem">支付方式</span>&nbsp;&nbsp;
                    <?= MOrder::getOrderPayKindOption($order->pay_kind) ?>
                  </p>

                  <p><span class="orderitem">订单状态</span>&nbsp;&nbsp;
                    <?php 
                      //需处理的状态
                      if($order->status == MOrder::STATUS_PAID || 
                        $order->status == MOrder::STATUS_SUBMITTED ||
                        $order->status == MOrder::STATUS_FULFILLED)
                        {
                              $csstagbegin = "<span class='badge  badge-primary'>";
                              $csstagend = "</span>";
                        }
                        else if($order->status == MOrder::STATUS_SUCCEEDED || 
                              $order->status == MOrder::STATUS_SYSTEM_SUCCEEDED)
                        {
                              $csstagbegin = "<span class='badge  badge-positive'>";
                              $csstagend = "</span>";
                        }
                        else
                        {
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
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 

    </div>


    <script type="text/javascript">
        function back2pre()
        {
          //alert("back!");
          location.href = "<?php echo Url::to(['hyzx3', 'gh_id'=>$staff->gh_id, 'openid'=>$staff->openid]) ?>";
        }
    </script>
  </body>
</html>