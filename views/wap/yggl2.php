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
       员工管理
      </h1>

    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <p class="content-padded">
      <table width="100%" border=0 style="padding:3px;text-align:center">
      <tr>
        <td width=100%>
          <a class="btn btn-positive btn-block" href="#showQr">
            <?= $office->title ?>员工
            <br>
            <span style="font-size:48px;font-weight:bolder">
            <?= $staff->name ?>
    
            <img src="../web/images/woke/qr.png" width=24px>
            </span>

        </a>
        </td>
      </tr>
      </table>

    </p>

    <div class="input-group">
  
      <div class="input-row">
        <label style="color:#777777">姓名</label>
        <input type="text" value="<?= $staff->name ?>" id="ygxm">
      </div>

      <div class="input-row">
        <label style="color:#777777">手机号码</label>
        <!--
        <input type="email" placeholder="ratchetframework@gmail.com">
        -->
         <input type="text" value="<?= $staff->mobile ?>"  id="ygsjhm">
      </div>

      <?php

          if(!empty($staff->user->headimgurl))
          {
              $wx_nickname = $staff->user->nickname;
              $wx_mobile = $staff->user->getBindMobileNumbersStr();
              $wx_country = $staff->user->country;
              $wx_province = $staff->user->province;
              $wx_city = $staff->user->city;
          }
          else
          {
              $wx_nickname = "";
              $wx_mobile = "";
              $wx_country = "";
              $wx_province = "";
              $wx_city = "";
          }

      ?>

      <p class="content-padded">微信信息 </p>

      <div class="input-row">
        <label style="color:#777777">昵称</label>
        <input type="text" value="<?= $wx_nickname ?>" readonly>
      </div>
      <div class="input-row">
         <label style="color:#777777">地区</label>
         <input type="text" value="<?= $wx_country ?> <?= $wx_province ?> <?= $wx_city ?>" readonly>
      </div>
      <div class="input-row">
        <label style="color:#777777">绑定手机</label>
        <input type="text" value="<?= $wx_mobile ?>" readonly>
      </div>

    <br>
    <button class="btn btn-positive btn-block" style="border-radius:3px" staff_id="<?= $staff->staff_id?>">修改</button>
    <button class="btn btn-negative btn-block" style="border-radius:3px" id="btnDel" staff_id="<?= $staff->staff_id?>">删除</button>
    <button class="btn btn-block" style="border-radius:3px" onclick="history.back();">返回</button>

    </div>
    </div><!-- end of content -->

    <div id="showQr" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#showQr"></a>
        <h1 class="title"><?= $staff->name ?>的推广二维码</h1>
      </header>

      <div class="content">

          <center>
    
              <?php echo Html::img($staff->user->getQrImageUrl(), ['style'=>'display: block;max-width:100%;height: auto;']); ?>
      
              <!--
              <br>
              <a href="#rhtg">如何推广?</a>
              -->
              <br><br>

              &nbsp;
          </center>

          <a class="btn btn-block" href="#showQr">返回</a>
      </div>
    </div>

  <script type="text/javascript">


    function ygglshanchuajax()
    {
        //alert('czhm'+czhm+'czje'+czje);
        $.ajax({
        url: "<?php echo Url::to(['wap/ygglshanchuajax'], true) ; ?>",
        type:"GET",
        cache:false,
        dataType:"json",
        //data: "czhm="+czhm+"&czje="+czje+"&gh_id="+gh_id+"&openid="+openid,
        success: function(t){

                if(t.code==0)
                {
                    //var url = "<//?//php echo Url::to(['hyzx1'],true) ?>";
                    //location.href = url+'&gh_id=<//?//= $user->gh_id ?>&openid<//?//= $user->openid ?>';
                    alert("delete ok");
                }
                else
                {
                  alert('error');
                }

          },
          error: function(){
            alert('error!');
          }
      });

      return false;
    }

    $(document).ready(function(){

        $('#btnDel').click(function() {
            //ajax 
            //alert($('#searchStr').val());
            staff_id = $(this).attr('staff_id');
            if(!confirm("删除这个员工，确定?"))
              return false;

            ygglshanchuajax();
            return false;
        }); 

    })


  </script>

  </body>
</html>