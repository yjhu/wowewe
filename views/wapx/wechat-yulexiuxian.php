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
      娱乐休闲
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
       <ul class="table-view">

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wap/g2048:gh_03a74ac96138#wechat_redirect">

               <span class="media-object pull-left fa-stack fa-lg" style="color:#00a2e8">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-gamepad fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">2048</span>
                </div>
              </a>
            </li>

        </ul>

       <p>&nbsp;</p>
    </div>


  </body>
</html>