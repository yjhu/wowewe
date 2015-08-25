<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();

$lists = \app\models\MHd201509t4::find()
        ->where(['openid' => $observer->openid, 'status' => 2])
        ->orderBy(['create_time' => SORT_ASC])
        ->all();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>捐献积分献爱心</title>

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
        <style type="text/css">

        </style>
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
        <br><br><br>
        <center>
        <h4>
            对不起 :(<br><br>
            暂时不符合此活动条件，感谢您的参与。
        </h4>

        <br>
        <a class="btn btn-primary btn-block" style="width: 300px" href="#history">爱心历史</a>
        </center>
    </div>


    <div id='history'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#history"></a>
            <h1 class='title'>爱心历史</h1>
        </header>
        <div class="content">

            <ul class="table-view">

            <?php 
                foreach ($lists as $list) 
                {
            ?>
                <li class="table-view-cell"><?= $list->create_time ?> 
                <span class="badge badge-primary" style="font-size: 12pt"><?= $list->score ?></span>
                </li>
            <?php } ?>
            </ul>

            <br>
            <p align="center">
            <a class="btn btn-block" href="#history" style="width: 300px" >返回</a>
            </p>
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
            //alert('wx ready');

            var share2friendTitle = '<?= $observer->nickname ?> 正在参加捐小积分大爱心活动';
            var share2friendDesc = '襄阳联通小积分大爱心正在进行中！看看你能参加吗？';
            var share2timelineTitle = '襄阳联通小积分大爱心正在进行中！看看你能参加吗？';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';
       
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t4:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            wx.onMenuShareTimeline({
                title: share2timelineTitle, // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t4:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });



        });//end of wx  ready


    });
    </script>

</html>
