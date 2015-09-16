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
      .goodsitem{
          color:#aaaaaa;
          font-size: 11pt;
      }

      .goodprice
      {
          font-size: 14px;
          color:#000;
          font-weight:  bolder;
      }
      .goodrmb
      {
          font-size: 12px;
          color:#000;
      }

      .goodpriceold {
        color: #aaaaaa;
        font-size: 12px;
        text-decoration: line-through;
      }
              
      .jiang {
          color: #aaaaaa;
          font-size: 12px;
          font-weight: bolder;
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
            积分兑换
          </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <br>
        <p>
          
        </p>

       <ul class="table-view">
   
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="http://jf.10010.com">
                <img class="media-object pull-left" src="/wx/web/images/jfsc.png" width="64" height="64">

                <div class="media-body">
                  <p>积分商城&nbsp;&nbsp;</p>
                  <p><span class="goodsitem">积分新玩法尽在积分商城！</span>&nbsp;&nbsp;</p>
                </div> 
              </a>
            </li>


            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t3:gh_03a74ac96138#wechat_redirect">
                <img class="media-object pull-left" src="/wx/web/images/aixin.png" width="64" height="64">
               
                <div class="media-body">
                  <p>小积分大爱心活动&nbsp;&nbsp;</p>
                  <p><span class="goodsitem">用您的积分为孩子们献上一份爱心吧 ...</span>&nbsp;&nbsp;</p>
                </div> 
              </a>
            </li>
        </ul>
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 

    </div>


    <script type="text/javascript">

    </script>
  </body>
</html>