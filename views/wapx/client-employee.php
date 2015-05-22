<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
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

      <!--
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>
      -->
            <h1 class="title">
                <span class="badge badge-positive">员工</span>小强 (12345678900)
            </h1>

        </header>


        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">

        <div class="input-group">

            <p class="content-padded">&nbsp;</p>
            <p class="content-padded">微信信息 </p>

            <div class="input-row">
                <label style="color:#777777">昵称</label>
                <input type="text" value="阿强" readonly>
            </div>
            <div class="input-row">
                <label style="color:#777777">地区</label>
                <input type="text" value="中国 湖北 武汉" readonly>
            </div>
            <div class="input-row">
                <label style="color:#777777">绑定手机</label>
                <input type="text" value="12345678900" readonly>
            </div>


            <p class="content-padded">&nbsp;</p>
    
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">所属营业厅</li>
            
                    <li class="table-view-cell media">
                        <a data-ignore="push"  class="navigate-right" href="">
                            <span class="media-object pull-left icon icon-home"></span>
                            <div class="media-body">
                                老河口营业厅
                                <span class="badge badge-positive pull-right">
                                   营业员
                                </span>
                            </div>
                        </a>
                    </li>
            </ul>


            <p class="content-padded">&nbsp;</p>
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">所属部门</li>
            
                    <li class="table-view-cell media">
                        <a data-ignore="push"  class="navigate-right" href="">
                            <span class="media-object pull-left"><img src="/wx/web/images/comm-icon/iconfont-bumenguanli.png"></span>
                            <div class="media-body">
                                老河口营服中心
                                <span class="badge badge-positive pull-right">
                                   职位
                                </span>
                                </span>
                            </div>
                        </a>
                    </li>
            </ul>


            <br>

        </div>


    </div><!-- end of content -->

    <div id="showQr" class="modal">
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#showQr"></a>
            <h1 class="title">小强的推广二维码</h1>
        </header>

        <div class="content">

            <center>

                <img src="./web/images/woke/qr-demo.jpg" width="100%">
                <br><br>

                &nbsp;
            </center>

            <a class="btn btn-block" href="#showQr">返回</a>
        </div>
    </div>





  <nav class="bar bar-tab">
    <a class="tab-item">
      浏览者(我): 小明 12345678888 
    </a>
  
  </nav> 


    <script type="text/javascript">

    </script>

</body>
</html>
