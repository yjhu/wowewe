<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>清凉一夏，邀你共享微信好礼</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
        .num{
            color:black;
            font-size: 16px;
        }

        .modal {
          position: fixed;
          top: 0;
          z-index: 11;
          width: 100%;
          min-height: 100%;
          overflow: hidden;
          background-color: #fff;
          opacity: 0;
          -webkit-transition: -webkit-transform .25s, opacity 1ms .25s;
             -moz-transition:    -moz-transform .25s, opacity 1ms .25s;
                  transition:         transform .25s, opacity 1ms .25s;
          -webkit-transform: translate3d(0, 100%, 0);
              -ms-transform: translate3d(0, 100%, 0);
                  transform: translate3d(0, 100%, 0);
        }
        .modal.active {
          height: 100%;
          opacity: 0.8;
          -webkit-transition: -webkit-transform .25s;
             -moz-transition:    -moz-transform .25s;
                  transition:         transform .25s;
          -webkit-transform: translate3d(0, 0, 0);
              -ms-transform: translate3d(0, 0, 0);
                  transform: translate3d(0, 0, 0);
        }


    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <!--
    <header class="bar bar-nav">

      <h1 class="title">
       清凉一夏，邀你共享微信好礼
      </h1>
    </header>
    -->

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
        <img width=100% height=100 src="/wx/web/images/gift-bar1.jpg">

        <p align="center">
        有<span class='num'><a href="#fans">15</a></span>位好友为你拆礼盒，还差<span class='num'>5</span>位<br>

        <img width=100% style="width: 250px;height:200px" src="/wx/web/images/gift1.png?v6">

        <!--
        <i class="fa fa-gift" style="color:red;font-size: 20em;"></i>
        -->
        </p>




        <!-- 我 -->
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" href="#zrbm">找人帮忙</a>
        </p>
        <!-- -->
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px">就选它了</a>
        </p>
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px">换个礼盒</a>
        </p>

        <!-- 非我 -->
        <p align="center">
        <a class="btn btn-block" style="width: 300px">帮Ta拆礼盒</a>
        </p>
        <p align="center">
        <a class="btn btn-block" style="width: 300px">我也要</a>
        </p>
       <br>

        <p align="center">
            <a href="#hjmd"><i class="fa fa-trophy"></i>&nbsp;获奖名单</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动规则</a>
        </p>
       <hr width=60%>
       <p align="center">已有<span class="num">30</span>人参与领取了礼盒</p>

       <P>&nbsp;</P>
       <br>&nbsp;

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>



    <div id='hjmd'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hjmd"></a>
            <h1 class='title'>获奖名单</h1>
        </header>
        <div class="content">

        </div>
    </div>

    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动规则</h1>
        </header>
        <div class="content">

        </div>
    </div>


    <div id='zrbm'  class='modal'>
        <div class="content" style="opacity : 1">
            <img src="\wx\web\images\share-v4.jpg" width="100%">
            <a class="btn btn-primary btn-block" style="margin: 0;" href="#zrbm">返回</a>
        </div>
    </div>
    



    <div id='fans'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#fans"></a>
            <h1 class='title'>给我帮忙的小伙伴们</h1>
        </header>
        <div class="content">


    <ul class="table-view">

        <li class="table-view-cell media">
        <img class="media-object pull-left" src="\wx\web\images\woke\0.jpg" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          明明
          <p>
            绑定手机 13545296480
            <br>
            2015-05-10
            <br>
          </p>
        </div>
        </li>

        <li class="table-view-cell media">
        <img class="media-object pull-left" src="\wx\web\images\woke\0.jpg" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          明明
          <p>
            绑定手机 13545296480
            <br>
            2015-05-10
            <br>
          </p>
        </div>
        </li>

            <li class="table-view-cell media">
        <img class="media-object pull-left" src="\wx\web\images\woke\0.jpg" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          明明
          <p>
            绑定手机 13545296480
            <br>
            2015-05-10
            <br>
          </p>
        </div>
        </li>       

    </ul>

        </div>
    </div>



      <script type="text/javascript">

      </script>

  </body>

</html>