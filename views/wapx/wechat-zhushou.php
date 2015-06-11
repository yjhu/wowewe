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
      微信小助手
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
       <ul class="table-view">
   
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://m.kuaidi100.com">
    
               <span class="media-object pull-left fa-stack fa-lg" style="color:blue">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-truck fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">快递查询</span>
                </div> 
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://3g.tianqi.cn/index.html">
    
              <span class="media-object pull-left fa-stack fa-lg" style="color:#4db849">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-cloud fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">天气预报</span>
                </div> 
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://m.familydoctor.com.cn/">
    
              <span class="media-object pull-left fa-stack fa-lg" style="color:#00a2e8">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-user-md fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">家庭医生</span>
                </div> 
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://app.gupiao123.cn/?c=103#security/000001.SH">
    
              <span class="media-object pull-left fa-stack fa-lg" style="color:red">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-line-chart fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">自选股</span>
                </div> 
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://m.46644.com/tool/tel/?tpltype=qq">
    
               <span class="media-object pull-left fa-stack fa-lg" style="color:#ffc90e">

                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">常用电话</span>
                </div> 
              </a>
            </li>
            
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://m.lnka.cn/">
    
              <span class="media-object pull-left fa-stack fa-lg" style="color:#a349a4">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-heart fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">算命大师</span>
                </div> 
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://wx.html5.qq.com/?ch=001203#tab/100/0/0/001203/wxcard">
    
              <span class="media-object pull-left fa-stack fa-lg" style="color:#4db849">
                <i class="fa fa-square fa-stack-2x"></i>
                <i class="fa fa-weixin fa-stack-1x fa-inverse"></i>
              </span>

                <div class="media-body">
                  <span class="orderitem">微信热文</span>
                </div> 
              </a>
            </li>

        </ul>

       <p>&nbsp;</p>
    </div>


  </body>
</html>