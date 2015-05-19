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
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">

      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="history.back();"></a>

      <h1 class="title">
      <!--
      <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
      -->
       我的推广
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <p class="content-padded">
      <table width="100%" border=0 style="padding:3px;text-align:center">
      <tr>
        <td width=45%>
        <button class="btn btn-primary btn-block">
          我推广的粉丝
          <br>
          <span style="font-size:48px;font-weight:bolder"><?= $user->staff->getFanCount() ?></span>
        </button>
   
        </td>

        <td width=45%>
          <button class="btn btn-positive btn-block">
            我推广的会员
            <br>
            <span style="font-size:48px;font-weight:bolder"><?= $user->staff->getFanBoundCount() ?></span>
        </button>
        </td>
      </tr>
      </table>

    </p>



    <ul class="table-view">

      <?php 
      foreach ($fans as $fan) {
      ?> 

        <li class="table-view-cell media">
          <img class="media-object pull-left" src="<?= $fan->headimgurl ?>" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($fan->nickname)) ?>
          <p>
            绑定手机 <?= $fan->getBindMobileNumbersStr() ?>
            <?php if (count($fan->getBindMobileNumbers()) > 0) { ?>
            <span class="badge badge-positive pull-right">会员</span>
            <?php } ?>
            <br>
            关注时间 <?= $fan->create_time ?> 
            <br>
            <!-- <span style="color:red">已取消关注</span> -->
          </p>
        </div>
        </li>

      <?php 
      }
      ?> 
                
    </ul>

    </div><!-- end of content -->



  <script type="text/javascript">

  </script>

  </body>
</html>