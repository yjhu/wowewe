<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;

    //use app\models\utils;
    //use app\models\utils\emoji;
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

    <link href="./php-emoji/emoji.css" rel="stylesheet">
    <style type="text/css">
    .btn {
      font-size: 16px;
    }

    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
    <!--
      <a class="icon icon-left-nav pull-left" id="btn_back"></a>
    -->

      <h1 class="title">
        <!--
        <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
        -->
        会员中心
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
      绑定管理
      </p>

      <span id="errmsg"> </span>
      <form>
      <input type="tel" id="sjh" placeholder="手机号码">

      <span>
      <input type="tel" id='yzm' placeholder="验证码">
      <button class="btn btn-primary" id='btnYzm'>免费获取验证码</button>
      </span>

      <br><br>
      <button class="btn btn-positive btn-block" id='zjbd'>添加绑定手机号, 立即成为会员</button>
      </form>


      <p class="content-padded">
      已绑定的手机号
      </p>
      <ul class="table-view">
        <li class="table-view-cell">13545296480 <button class="btn btn-negative" id="jcbd" mobile="13545296480">解除绑定</button></li>
        <li class="table-view-cell">13545296480 <button class="btn btn-negative">解除绑定</button></li>
        <li class="table-view-cell">13545296480 <button class="btn btn-negative">解除绑定</button></li>
      </ul>

    </div><!-- end of content -->


  <script type="text/javascript">

    function jcbdajax(mobile)
    {
          //alert('oid'+oid+'status'+status+'staff_id'+staff_id+'office_id'+office_id);
          $.ajax({
          url: "<?php echo Url::to(['wap/orderchangestatusajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          //data: "oid="+oid+"&status="+status,
          data: "mobile="+mobile,
          success: function(t){

                  if(t.code==0)
                  {
                      var url = "<?php echo Url::to(['bdgl'],true) ?>";
                      //location.href = url+'&oid='+oid;
                      location.href = url+'&oid='+oid;
                  }
                  else
                  {
                    $("#errmsg").html("解除绑定失败！");
                  }

            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    }



    $(document).ready(function(){

      $("#jcbd").click(function(){
          //alert("解除绑定");
          mobile = $(this).attr('mobile');
          alert('解除绑定'+mobile);

          if(!confirm("解除绑定，确定?"))
            return false;

          jcbdajax(mobile);
          return false;
      });

      $("#zjbd").click(function(){
          //alert("增加绑定");
          mobile = $(this).attr('mobile');

          //if(!confirm("添加手机号绑定，确定?"))
          // return false;

          zjbdajax(mobile);
          return false;
      });

      $("#btnYzm").click(function(){
          alert("获取验证码");
          return false;
      });



    });
  </script>

  </body>
</html>