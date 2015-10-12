<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
    use app\models\MOrder;

    use app\models\SmsMarketingConfig;

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
      <a data-ignore="push" class="icon icon-left-nav pull-left" id="btn_back" onclick="goback()"></a>
      <h1 class="title">
       营销短信直发
      </h1>

    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

      <br>
      <p id="sms_status"></p>
 
        <div class="input-row">
          <input type="text" type="tel" id="sms_mobile" placeholder="手机号码">
        </div>
        <br>
        <center>
         <button type="submit" id="sms_send" class="btn btn-positive btn-block" style="width: 240px">发送</button>
         </center>

      <br>
     
    </div>


    <script>
        var url = "<?= Url::to(['wap/hyzx1'], true) ?>";
        function goback()
        {
          location.href=url;
        }

        $(document).ready(function () {
            'use strict';
            
        //    alert('ready!');
            
            $('#sms_send').click(function() {
                var ajax_url = "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>";
                var mobile = $('#sms_mobile').val();
        //        alert(mobile);
                var args = {
                    'classname':    '\\app\\models\\SmsMarketingConfig',
                    'funcname':     'smsAjax',
                    'params':       {
                        'mobile': mobile
                    } 
                };
                $.ajax({
                    url:        ajax_url,
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
        //                alert(JSON.stringify(ret));
                        if (0 === ret['err_code']) {
                            $('#sms_mobile').val(null);
                            $('#sms_status').html('营销短信发送至'+ mobile + '成功!');
                        } else {
                            $('#sms_status').html('发送失败，原因：'+ ret['err_msg']);
                        }
                    },                        
                    error:      function(){
                        $('#sms_status').html('AJAX 调用失败！');
                    }
                });             
            });
        });    
    </script>
  </body>
</html>