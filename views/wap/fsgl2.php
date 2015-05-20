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

      .btn1 {
        border-radius: 2px ;
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
       粉丝管理
      </h1>

    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <p class="content-padded">
      <table width="100%" border=0 style="padding:3px;text-align:center">
      <tr>
        <td width=100%>
          <a class="btn btn-positive btn-block" href="#showQr">
            <?= $office->title ?>粉丝
            <br>
            <span style="font-size:48px;font-weight:bolder">
            <?= emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)) ?>
            <!--
            <img src="../web/images/woke/qr.png" width=24px>
            -->
            </span>

        </a>
        </td>
      </tr>
      </table>

    </p>

    <div class="input-group">
  
  <!--
      <div class="input-row">
        <label style="color:#777777">姓名</label>
        <input type="text" value="<\\?\\= $staff->name ?>" id="ygxm">
      </div>

      <div class="input-row">
        <label style="color:#777777">手机号码</label>

         <input type="text" value="<\\?\\= $staff->mobile ?>"  id="ygsjhm">
      </div>
  -->

      <?php

          if(!empty($user->headimgurl))
          {
              $wx_nickname = $user->nickname;
              $wx_mobile = $user->getBindMobileNumbersStr();
              $wx_country = $user->country;
              $wx_province = $user->province;
              $wx_city = $user->city;
              $wx_create_time = $user->create_time;
              
          }
          else
          {
              $wx_nickname = "";
              $wx_mobile = "";
              $wx_country = "";
              $wx_province = "";
              $wx_city = "";
              $wx_create_time = "";
          }

      ?>

      <p class="content-padded">微信信息 </p>

      <!--
      <div class="input-row">
        <label style="color:#777777">昵称</label>
        <input type="text" value="<//?//= emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)) ?>" readonly>
      </div>
      -->
      <div class="input-row">
         <label style="color:#777777">地区</label>
         <input type="text" value="<?= $wx_country ?> <?= $wx_province ?> <?= $wx_city ?>" readonly>
      </div>
      <div class="input-row">
        <label style="color:#777777">绑定手机</label>
        <input type="text" value="<?= $wx_mobile ?>" readonly>
      </div>
      <div class="input-row">
        <label style="color:#777777">关注时间</label>
        <input type="text" value="<?= $wx_create_time ?>" readonly>
      </div>
    <br>
    
    <!--
    <button class="btn btn-positive btn-block" style="border-radius:3px" staff_id="<//?//= $staff->staff_id?>">修改</button>
    <button class="btn btn-negative btn-block" style="border-radius:3px" id="btnDel" staff_id="<//?//= $staff->staff_id?>">删除</button>
    -->

    <button class="btn btn-block" style="border-radius:3px" onclick="history.back();">返回</button>

    </div>
    </div><!-- end of content -->


  <script type="text/javascript">


  </script>

  </body>
</html>