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
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
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
      <h1 class="title">
       消息中心
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <br>

       <ul class="table-view" id="ul-body">
      
            <li class="table-view-cell media">

                <div class="media-body">
                  <p><span class="orderitem">标题</span>&nbsp;&nbsp;<?= $messagebox->title; ?></p>
                  <p><span class="orderitem">作者</span>&nbsp;&nbsp;<?= $messagebox->author; ?></p>
                  <p><span class="orderitem">摘要</span>&nbsp;&nbsp;<?= $messagebox->digest; ?></p>
                  <p><span class="orderitem">时间</span>&nbsp;&nbsp;<?= $messagebox->create_time; ?></p>

                  <p>&nbsp;</p>

                  <p><span class="orderitem">详情</span>&nbsp;&nbsp;<?= $messagebox->content; ?></p>
                </div> 

            </li>

        </ul>

          <a class="btn btn-block" onclick="goback();">返回</a>
          &nbsp;<br>&nbsp;<br> 

    </div>



    <script type="text/javascript">

        var url = "<?= Url::to(['wapx/messagebox'], true) ?>";
        function goback()
        {
          location.href=url;
        }

        $(document).ready(function () {


        });

    </script>
  </body>
</html>