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
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>
      <h1 class="title">
       我的订单详情
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <br>
    <p>
      
    </p>

      <?php if($order->attr == 'goods') { ?>
          <?php
                $imgs = $order->goods->body_img_url;
                $imgUrls = explode(";",$imgs);
          ?>
         <img width=100% height=240 class="media-object pull-left" src="<?= $imgUrls[0] ?>">
      <?php } else { ?>
         <img width=100% height=240 class="media-object pull-left" src="<?= $order->item->pic_url ?>">
      <?php } ?>


        <span>
          <ul class="table-view">

            <li class="table-view-cell table-view-divider">订单信息</li>

            <li class="table-view-cell"><span class="orderitem">订单编号</span>&nbsp;&nbsp; <?= $order->oid ?></li>
            <li class="table-view-cell"><span class="orderitem">商品名称</span>&nbsp;&nbsp; <?= $order->title ?></li>

            <li class="table-view-cell"><span class="orderitem">商品价格</span>&nbsp;&nbsp; ￥<?= ($order->feesum)/100 ?>元</li>

            <li class="table-view-cell"><span class="orderitem">支付方式</span>&nbsp;&nbsp; 
              <?= MOrder::getOrderPayKindOption($order->pay_kind) ?>
            </li>

            <li class="table-view-cell table-view-divider">

                <span class="orderitem">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <?php if ($order->buyerCanPay()) {
                        //echo "<span style='color:blue' class='weixin_pay' myUrl="+n.url+">&nbsp;&nbsp;继续支付</span>";
                        echo "<span class='btn btn-positive' id='weixin_pay' myUrl=".$order->GetOrderJsApiParameters().">继续支付</span>";
                      } ?>
                      &nbsp;&nbsp;
                      <?php if ($order->buyerCanPay()) {
                        echo "<span class='btn' id='xianxia_pay' oid=".$order->oid." status=".MOrder::PAY_KIND_CASH.">线下支付</span>";
                      } ?>
                </span>


            </li>

            <li class="table-view-cell"><span class="orderitem">订单状态</span>&nbsp;&nbsp; 

              <?php echo MOrder::getOrderStatusName($order->status) ?>

              <?php if ($order->buyerCanCancel()) {
                echo "<span class='btn btn-negative' id='qxdd_attr' oid=".$order->oid." status=".MOrder::STATUS_BUYER_CLOSED.">取消订单</span>";
              } ?>

              <?php if ($order->buyerCanRefund()) {
                echo "<span class='btn btn-negative' id='tk_attr' oid=".$order->oid." status=".MOrder::STATUS_BUYER_REFUND_CLOSED.">退款</span>";
              } ?>

              <?php if ($order->buyerCanConfirm()) {
                echo "<span class='btn btn-positive' id='qr_attr' oid=".$order->oid." status=".MOrder::STATUS_SUCCEEDED.">确认<span class='icon icon-check'></span></span>";
              } ?>
            </li>

            <li class="table-view-cell"><span class="orderitem">下单时间</span>&nbsp;&nbsp; <?= $order->create_time ?></li>
            <li class="table-view-cell"><span class="orderitem">订单详情</span>&nbsp;&nbsp; <?= $order->detail ?></li>

            <li class="table-view-cell table-view-divider">用户信息</li>
            <li class="table-view-cell"><span class="orderitem">用户姓名</span>&nbsp;&nbsp; <?= $order->username ?></li>
            <li class="table-view-cell"><span class="orderitem">联系电话</span>&nbsp;&nbsp; <?= $order->usermobile ?></li>
            <li class="table-view-cell"><span class="orderitem">身份证号</span>&nbsp;&nbsp; <?= $order->userid ?></li>


            <li class="table-view-cell table-view-divider">收货地址</li>
            <li class="table-view-cell"><?= !empty($order->address) ? $order->address : "" ?></li>

          </ul>
        </span>

          &nbsp;<br>&nbsp;<br>&nbsp;<br>
    </div>



  <script type="text/javascript">

    var jsApiParameters;

    function jsApiCall()
    {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            jsApiParameters,
            function(res){
                //WeixinJSBridge.log(res.err_msg);
                //alert(res.err_code+res.err_desc+res.err_msg);
                if (res.err_msg == 'get_brand_wcpay_request:ok')
                {
                } 
                else
                {
                }
                window.location.href = "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/myorder' ; ?>";
            }
        );
    }


    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }

    function back2pre()
    {
      //alert("officeorder");
      location.href = "<?php echo Url::to(['myorder'],true) ?>";
    }

    function orderchangestatusajax(oid,status)
    {
          //alert('oid'+oid+'status'+status+'staff_id'+staff_id+'office_id'+office_id);
          $.ajax({
          url: "<?php echo Url::to(['wap/orderchangestatusajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "oid="+oid+"&status="+status,
          success: function(t){
                  var url = "<?php echo Url::to(['myorderdetail'],true) ?>";
                  location.href = url+'&oid='+oid;
            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    }

  $(document).ready(function(){


    $("#qxdd_attr").click(function(){
        //alert("取消订单");
        oid = $(this).attr('oid');
        status = $(this).attr('status');

        if(!confirm("取消订单，确定?"))
          return false;

        orderchangestatusajax(oid,status);
        return false;
    });

    $("#tk_attr").click(function(){
        //alert("退款");
        oid = $(this).attr('oid');
        status = $(this).attr('status');

        if(!confirm("申请退款，确定?"))
          return false;

        orderchangestatusajax(oid,status);
        return false;
    });

    $("#qr_attr").click(function(){
        //alert("确认");
        oid = $(this).attr('oid');
        status = $(this).attr('status');

        if(!confirm("确认订单完成，确定?"))
          return false;

        orderchangestatusajax(oid,status);
        return false;
    });


    $("#qr_attr").click(function(){
        //alert("确认订单");
        oid = $(this).attr('oid');
        status = $(this).attr('status');

        if(!confirm("确认订单完成，确定?"))
          return false;

        orderchangestatusajax(oid,status);
        return false;
    });

    $("#xianxia_pay").click(function(){
        //alert("线下支付");
        //alert("weixin_pay");
        oid = $(this).attr('oid');
        status = $(this).attr('status');

        if(!confirm("我要线下支付，确定?"))
          return false;

        orderchangestatusajax(oid,status);
        return false;
    });

    $("#weixin_pay").click(function(){
        //alert("继续支付");
        //alert("weixin_pay");
        url = $(this).attr('myUrl');
        //alert(url);
        jsApiParameters = JSON.parse(url);
        //alert(jsApiParameters);
        callpay();
        return false;
    });





  });


  </script>


  </body>

</html>