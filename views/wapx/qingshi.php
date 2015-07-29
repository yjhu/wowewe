<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>三行情诗投票</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link href="./php-emoji/emoji.css" rel="stylesheet">    
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">


    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">


        <p align="center">
            <a href="#tppm"><i class="fa fa-trophy"></i>&nbsp;投票排名</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动规则</a>
        </p>
    

        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" href="#xieqingshi">我也写情诗</a>
        </p>



      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>


    <div id='tppm'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#tppm"></a>
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


    <div id='xieqingshi'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#xieqingshi"></a>
            <h1 class='title'>我也写情诗</h1>
        </header>
        <div class="content">

            <form class="input-group">
                <input type="text" placeholder="情诗第一行" id="p1">
                <input type="text" placeholder="情诗第二行" id="p2">
                <input type="text" placeholder="情诗第三行" id="p3">

                <button class="btn btn-positive btn-block" id="xiehaole">写好了</button>

            </form>

        </div>
    </div>



    <script type="text/javascript">

    $(document).ready(function() {
        'use strict'; 
               
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
            ]
        });
        
        wx.ready(function () {

            $('#xiehaole').click (function () {
                var args = {
                    'classname':    '\\app\\models\\MQingshiAuthor',
                    'funcname':     'xiehaoleAjax',
                    'params':       {
                        'id':   <?= $qingshi_author->id ?>,
                        'p1':   $("#p1").val(),  
                        'p2':   $("#p2").val(),  
                        'p3':   $("#p3").val()            
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) {
                            location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });

        });//end of wx  ready


    });
    </script>



</html>
