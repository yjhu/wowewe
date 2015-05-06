<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;


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
    <p>枣阳营业厅 &nbsp;&nbsp;曾开 13545296480</p>

      <img width=100% height=200 class="media-object pull-left" src="../web/images/comm-icon/upload-pic-64x64.png">


        <span>
          <ul class="table-view">

            <li class="table-view-cell table-view-divider">订单信息</li>

            <li class="table-view-cell"><span class="orderitem">订单编号</span>&nbsp;&nbsp; 1234567890</li>
            <li class="table-view-cell"><span class="orderitem">商品名称</span>&nbsp;&nbsp; 联想A3600</li>

            <li class="table-view-cell"><span class="orderitem">支付方式</span>&nbsp;&nbsp; 微信支付</li>
            <li class="table-view-cell"><p><span class="orderitem">订单状态</span>


            &nbsp;&nbsp; 
            等待付款
            &nbsp;&nbsp; 
            <a class="btn btn-negative btn-outlined" href="#cancelorder">取消订单<span class="icon icon icon-close"></span></a>
            </p>
            </li>

            <li class="table-view-cell"><span class="orderitem">下单时间</span>&nbsp;&nbsp; 2015-05-06 18:00:00</li>
            <li class="table-view-cell"><span class="orderitem">订单详情</span>&nbsp;&nbsp; 联想A3600 安卓智能手机</li>

            <li class="table-view-cell table-view-divider">用户信息</li>
            <li class="table-view-cell"><span class="orderitem">用户姓名</span>&nbsp;&nbsp; 曾开</li>
            <li class="table-view-cell"><span class="orderitem">联系电话</span>&nbsp;&nbsp; 13545296480</li>
            <li class="table-view-cell"><span class="orderitem">身份证号</span>&nbsp;&nbsp; 123456789012345</li>


            <li class="table-view-cell table-view-divider">收货地址</li>
            <li class="table-view-cell">武汉光谷国际2栋1309 邮编430074</li>

          </ul>
        </span>

 &nbsp;<br>&nbsp;<br>&nbsp;<br>
    </div>


      <!-- 取消订单确认弹窗 -->
      <div id="cancelorder" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#cancelorder"></a>
          <h1 class="title">确实要取消订单吗?</h1>
        </header>

        <div class="content">
            
            <ul class="table-view">
            <li class="table-view-cell table-view-divider">订单信息</li>
            <li class="table-view-cell"><span class="orderitem">订单编号</span>&nbsp;&nbsp; 1234567890</li>
            <li class="table-view-cell"><span class="orderitem">商品名称</span>&nbsp;&nbsp; 联想A3600</li>
            </ul>

            <br>
            <a class="btn btn-block" href="#cancelorder">不取消，再看看。</a>
            <a class="btn btn-negative btn-block" onclick="#">取消订单</a>
            
        </div>
      </div>

  </body>

</html>