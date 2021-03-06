<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
use app\models\MOrder;

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
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="./php-emoji/emoji.css" rel="stylesheet">

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

      <?php if ($backwards) { ?>
          <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
              <span class="icon icon-left-nav"></span>
          </a>
      <?php } ?>

      <h1 class="title">
       门店订单详情
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <br>
    <p>
    <?= $office->title ?> &nbsp;&nbsp;
    <?= $staff->name." ".$staff->mobile ?>
    </p>

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

            <?php if ($order->sellerCanCancel($staff)) {
                echo "<span class='btn btn-negative' id='gbdd_attr' oid=".$order->oid." status=".MOrder::STATUS_SELLER_CLOSED."  staff_id=".$staff->staff_id." office_id=".$office->office_id.">关闭订单</span>";
              } ?>

            <?php if ($order->sellerCanFulfill($staff)) {
               echo "<span class='btn btn-positive' id='blcg_attr' oid=".$order->oid." status=".MOrder::STATUS_FULFILLED."  staff_id=".$staff->staff_id." office_id=".$office->office_id.">办理成功<span class='icon icon-check'></span></span>";
            } ?>

            <?php if ($order->sellerCanRollback($staff)) {
              echo "<span class='btn btn-positive' id='cxbl_attr' oid=".$order->oid." status=".MOrder::STATUS_SELLER_ROLLBACK_CLOSED." staff_id=".$staff->staff_id." office_id=".$office->office_id.">撤销办理</span>";
            } ?>

            <?php if ($order->sellerCanRollbackRefund($staff)) {
               echo "<span class='btn btn-positive' id='cxblbtk_attr' oid=".$order->oid." status=".MOrder::STATUS_SELLER_REFUND_CLOSED." staff_id=".$staff->staff_id." office_id=".$office->office_id.">撤销办理并退款</span>";
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



      <div id="blcg" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#blcg"></a>
          <h1 class="title">办理成功, 确认？</h1>
        </header>

        <div class="content">
            <br>
            <a class="btn btn-block" href="#blcg">否</a>
            <a class="btn btn-positive btn-block" id="handleBlcg">是</a>
        </div>
      </div>


      <div id="cxbl" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#cxbl"></a>
          <h1 class="title">撤销办理, 确认？</h1>
        </header>

        <div class="content">
            <br>
            <a class="btn btn-block" href="#cxbl">否</a>
            <a class="btn btn-positive btn-block" onclick="#">是</a>
        </div>
      </div>



  <script type="text/javascript">

    function orderchangestatusajax(oid,status,staff_id,office_id)
    {
          //alert('oid'+oid+'status'+status+'staff_id'+staff_id+'office_id'+office_id);
          $.ajax({
          url: "<?php echo Url::to(['wap/orderchangestatusajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "oid="+oid+"&status="+status+"&staff_id="+staff_id+"&office_id="+office_id,
          success: function(t){
                  //var url = "<?php echo Url::to(['officeorderdetail'],true) ?>";
                  //location.href = url+'&oid='+oid+'&staff_id='+staff_id+'&office_id='+office_id;
                  var url = "<?php echo \app\models\utils\BrowserHistory::current($wx_user->gh_id, $wx_user->openid) ?>";
                  location.href = url;
            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    }

  $(document).ready(function(){



    $("#blcg_attr").click(function(){
        //alert("办理成功");
        oid = $(this).attr('oid');
        status = $(this).attr('status');
        staff_id = $(this).attr('staff_id');
        office_id = $(this).attr('office_id');
        
        if(!confirm("办理成功，确定?"))
          return false;

        orderchangestatusajax(oid,status,staff_id,office_id);
        return false;
    });




    $("#gbdd_attr").click(function(){
        //alert("关闭订单");
        oid = $(this).attr('oid');
        status = $(this).attr('status');
        staff_id = $(this).attr('staff_id');
        office_id = $(this).attr('office_id');

        //alert("oid"+oid+"status"+status+"staff_id"+staff_id);
        //location.href="#blcg";

        if(!confirm("关闭订单，确定?"))
          return false;

        orderchangestatusajax(oid,status,staff_id,office_id);
        return false;
    });


    $("#cxbl_attr").click(function(){
        //alert("撤销办理");
        oid = $(this).attr('oid');
        status = $(this).attr('status');
        staff_id = $(this).attr('staff_id');
        office_id = $(this).attr('office_id');

        //alert("oid"+oid+"status"+status+"staff_id"+staff_id);
        //location.href="#blcg";
        if(!confirm("撤销办理，确定?"))
          return false;

        orderchangestatusajax(oid,status,staff_id,office_id);
        return false;
    });




    $("#cxblbtk_attr").click(function(){
        //alert("撤销办理并退款");

        $("#cxblbtk_attr").html("处理中...");

        oid = $(this).attr('oid');
        status = $(this).attr('status');
        staff_id = $(this).attr('staff_id');
        office_id = $(this).attr('office_id');


        if(!confirm("撤销办理并退款，确定?"))
          return false;

        //alert("oid"+oid+"status"+status+"staff_id"+staff_id+"office_id"+office_id);

        $.ajax({
          url: "<?php echo Url::to(['wap/orderrefundajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "oid="+oid+"&status="+status+"&staff_id="+staff_id+"&office_id="+office_id,
          success: function(t){
                 // var url = "<?php echo Url::to(['officeorderdetail'],true) ?>";
                 // location.href = url+'&oid='+oid+'&staff_id='+staff_id+'&office_id='+office_id;
                var url = "<?php echo \app\models\utils\BrowserHistory::current($wx_user->gh_id, $wx_user->openid) ?>";
                location.href = url;
            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    });




  });


  </script>


  </body>

</html>