<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MStaff;
    
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
    <link href="/wx/web/ratchet/dist/css/ratchet.css?v11" rel="stylesheet">

  
    <link href="./php-emoji/emoji.css" rel="stylesheet">


    <style type="text/css">

      .btn {
        border-radius: 0 ;
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
      <!--
      <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
      -->
       员工管理
      </h1>

    </header>



    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">




    <p class="content-padded">
    所属营业厅 > 老河口营业厅
    <span class="badge badge-positive pull-right">5人</span>
    </p>
    <ul class="table-view" id="ul-content">

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee']) ?>">
        <img class="media-object pull-left" src="/wx/web/images/woke/0.jpg" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          小强&nbsp;<span class="badge pull-right">营业员</span>
          <p>
            手机号码 12345678900
            <br>

          </p>
        </div>
        </a>
        </li>
            <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee']) ?>">
        <img class="media-object pull-left" src="/wx/web/images/woke/0.jpg" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          小强&nbsp;<span class="badge pull-right">营业员</span>
          <p>
            手机号码 12345678900
            <br>

          </p>
        </div>
        </a>
        </li>

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee']) ?>">
        <img class="media-object pull-left" src="/wx/web/images/woke/0.jpg" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          小强&nbsp;<span class="badge pull-right">营业员</span>
          <p>
            手机号码 12345678900
            <br>

          </p>
        </div>
        </a>
        </li>        

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee']) ?>">
        <img class="media-object pull-left" src="/wx/web/images/woke/0.jpg" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          小强&nbsp;<span class="badge pull-right">营业员</span>
          <p>
            手机号码 12345678900
            <br>

          </p>
        </div>
        </a>
        </li>   

                    <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee']) ?>">
        <img class="media-object pull-left" src="/wx/web/images/woke/0.jpg" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          小强&nbsp;<span class="badge pull-right">营业员</span>
          <p>
            手机号码 12345678900
            <br>

          </p>
        </div>
        </a>
        </li>   
    </ul>

    &nbsp;
    <br>
    &nbsp;
    <br>

    </div><!-- end of content -->

  <nav class="bar bar-tab">
    <a class="tab-item" href="#">
      浏览者(我): 小明 12345678888
    </a>
  </nav> 

  <script type="text/javascript">
  


  </script>

  </body>
</html>