<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;


\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();

$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>


<!DOCTYPE html>
<!-- saved from url=(0060)http://xx.zhouyi3.com/?/&from=singlemessage&isappinstalled=0 -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="x-key" content="fbfab7919bf139c1fc65bf79d3f55756">
<meta charset="utf-8">
<title>全世界只有六个人能玩到十七级......</title><meta name="keywords" content="见缝插针,见缝插针小游戏,在线玩">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="full-screen" content="true">
<meta name="screen-orientation" content="portrait">
<meta name="x5-fullscreen" content="true">
<meta name="360-fullscreen" content="true">
<meta name="renderer" content="webkit">

<style type="text/css">
html,body{padding:0;margin:0;border:0;overflow:hidden;text-align:center;background-color:#aaa;-moz-user-select:none;-webkit-user-select:none;user-select:none;}
body{overflow:visible;}/* for Android Native Browser bug */
canvas{background-color:#aaa;vertical-align:middle;opacity:1;border-top:solid 1px #000;}
.title{font-size:24px;font-family:微软雅黑,黑体;color:#000;letter-spacing:4px;margin-bottom:4px;}
#gohw {position:fixed;z-index:99;bottom:0;left:0;width:100%;}
#gohw a{display:block;width:100%;}
#gohw a img{width:100%;}
@media all and (min-width: 480px) and (max-height: 479px) {
    canvas {-webkit-transform:translateY(-80px) rotate(-90deg); -moz-transform:translateY(-80px) rotate(-90deg); transform:translateY(-80px) rotate(-90deg); border-top:0;border-right:solid 1px #000;}
}
.dba {
	background-color: #000000;
	height: 50px;
	width: 100%;
	line-height:50px;
	text-align: center;
}
.dba a{
	color: #FFFF00;
	text-decoration: none;
}
</style>
</head>
<body>

<div id="game3366" style="position:absolute; z-index:99; top:10px; left:0px; width:100%; text-align:center;">
    <a href="javascript:void(0);" style="padding: 8px 20px;background-color: #fff;border-radius: 5px;text-decoration: none;color:black;" ontouchstart="share_3366();">分享到朋友圈，与朋友比比</a>
    
</div>

<img src="http://t1.qpic.cn/mblogpic/27723526398ebfdaafc6/2000" width="0" height="0" style="position:absolute">
<div class="title"></div>
<canvas id="stage" width="320" height="480" style="height: 480px;"></canvas>
<div id="gohw"></div>

<div id="share" style="display: none;">
    <img width="100%" src="http://t1.qpic.cn/mblogpic/cee24bfca51e8029efaa/2000" style="position: fixed; z-index: 9999; top: 0; left: 0; display: " ontouchstart="document.getElementById('share').style.display='none';" onClick="document.getElementById('share').style.display='none';">
</div>
<script>document.getElementById('stage').style.height = (480 - Math.max(0, 568 - screen.height)) + 'px';</script>

    <script src="/wx/web/js/game-ball.js?v3"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

<script type="text/javascript">
    var S=1;
    var share2friendTitle = "我到第"+S+"关，世界上只有6个人能玩到十七关！";
    var share2friendDesc = '很好玩的小游戏见缝插针，好玩到停不下来。点击就开始玩，无需安装。';
    var share2timelineTitle = '很好玩的小游戏见缝插针，好玩到停不下来。点击就开始玩，无需安装。';
    var shareImgUrl = '<?= Url::to('/wx/web/images/game-ball.jpg', true); ?>';

    function level3366Fn(F){
        //alert(F);
        S = F; //kzeng add

        try{
            share2friendTitle = "我到第"+S+"关，世界上只有6个人能玩到十七关！";
            //alert(share2friendTitle);

            document.title =  "我到第"+S+"关，世界上只有6个人能玩到十七关！";

            ////document.title = window.shareData.desc = "我到第"+F+"关，世界上只有6个人能玩到十七关！"
            //document.title = shareData.tTitle = "我过了"+F+"关，全世界只有4个人能过17关！！";
            //submit_3366(F)
        }catch(e){console.log(e)}
    }

    function share_3366(){
        document.getElementById("share").style.display = "block";
    }

</script>



<script type="text/javascript">
/*
window.shareData = window.shareData || {
    title: "很好玩的小游戏《见缝插针》，好玩到停不下来。点击就开始玩，无需安装。", // 分享标题
    link:  "", // 分享链接
    imgUrl: 'wx.jpg', // 分享图标
    desc : "很好玩的小游戏《见缝插针》，好玩到停不下来。点击就开始玩，无需安装。"
};
*/

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

            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/game-ball:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            wx.onMenuShareTimeline({
                title: share2timelineTitle, // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/game-ball:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });

    })















</script>


<div class="" style="display:none;">

</div>


</body>
</html>

