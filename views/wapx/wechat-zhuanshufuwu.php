<?php
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

    <style type="text/css">
      .orderitem{
          color:#aaa;
          font-size: 12pt;
          line-height: 48px;
      }
    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>


  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">

      <h1 class="title">
      联通用户专属服务
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
       <ul class="table-view">

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://wap.10010.com/t/query/queryRealTimeFeeInfo.htm?menuId=000200010001">

               <span class="media-object pull-left fa-stack fa-lg" style="color:#ffc90e">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-area-chart fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">话费流量查询</span>
                </div>
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://wap.10010.com/t/query/queryRealTimeFeeInfo.htm?menuId=000200010001">

              <span class="media-object pull-left fa-stack fa-lg" style="color:#4db849">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">充值优惠</span>
                </div>
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="#">

              <span class="media-object pull-left fa-stack fa-lg" style="color:#00a2e8">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-home fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">附近营业厅</span>
                </div>
              </a>
            </li>

        </ul>

       <p>&nbsp;</p>
    </div>


  </body>
</html>