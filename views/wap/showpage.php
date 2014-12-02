<?php
  use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>数信业务</title> 
<meta name="description" content=""> 
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
 <link href="./show_res/css.css" tppabs="css.css" rel="stylesheet" type="text/css">
<style type="text/css">
*{margin:0;padding:0}
body{margin:0;font-family:Arial,Helvetica,sans-serif;font-size:13px;line-height:1.5;}
.swiper-container{height:900px;width:640px}
.device{width:640px;height:auto;margin:0 auto;position:relative;overflow:hidden}
.wiper-container{height:auto;width:640px;overflow:hidden}
img{display:block;border:0}
.hide{display:none}
.rel{position:relative}.abs{position:absolute}
.swiper-slide{width:640px;height:900px}
.swiper-slide div{position:absolute;width:100%;height:100%;left:0;top:0;z-index:9}
div.bg{text-align:center;z-index:9}
div.main{z-index:2}
div.draw{opacity:0}
div.resize img{width:0;bottom:0;right:0}
div.down img{width:0;bottom:0;right:0}div.info{left:640px}

/*
.ikea-audio .music p span{background:url(images/music.png) no-repeat 0 0;background-size:cover;cursor:pointer}.ikea-audio{top:1%;right:1%;z-index:999;max-width:50px}.ikea-audio .music p{width:100%;height:100%}.ikea-audio .music p span{display:none;width:100%;height:100%}.ikea-audio .music p span:first-child{display:block}.ikea-audio .music audio{height:0;width:0;opacity:0}.ikea-audio .music p span.audio_open{background-position:-100% 0}.ikea-audio .music p span.audio_close{background-position:0 0}.loading{text-align:center;height:128px;width:100%;z-index:99;top:0;left:0}.loading img{width:128px;margin:0 auto}div.videocontroller,div.video{bottom:0;left:0;height:39%;width:100%;z-index:9}div.video{z-index:10}.citylist{width:50%;height:23%;z-index:9;top:30.75%;left:25%}.citylist a{display:block;float:left;width:33%;height:25%;overflow:hidden;text-indent:-200%} .topShare { opacity:0; display:none; }.light{ cursor:pointer; position: absolute; left: -180px; top: 0; width: 180px; height: 90px; background-image: -moz-linear-gradient(0deg,rgba(255,255,255,0),rgba(255,255,255,0.5),rgba(255,255,255,0)); background-image: -webkit-linear-gradient(0deg,rgba(255,255,255,0),rgba(255,255,255,0.5),rgba(255,255,255,0)); transform: skewx(-25deg); -o-transform: skewx(-25deg); -moz-transform: skewx(-25deg); -webkit-transform: skewx(-25deg); }
*/

/*
.btn_music a{float:left; display:inline-block; width:13px; height:17px;margin-right:2px;}
.btn_music a.weibo{width:17px;position:absolute;right:0px;top:0px;}
.btn_music a.jp-play{background:url(../images/music_ico.png) no-repeat}
.btn_music a.jp-pause{background:url(../images/music_ico.png) no-repeat -14px 0}
.btn_music .listening-icon{background:url(../images/zSGhlXp4.gif) no-repeat;width:14px;height:14px;display:inline-block}
.btn_music .listening-icon-pause{background:url(../images/OVZwOkXW.gif) no-repeat;width:14px;height:14px;display:inline-block}
*/
</style>

<!--
<meta name="viewport" id="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=1.0"> 

<script type="text/javascript">
var phoneWidth = parseInt(window.screen.width);
var phoneScale = phoneWidth/640;
var ua = navigator.userAgent; 
if (/Android (\d+\.\d+)/.test(ua)){ 
	if (phoneWidth >  640) {
		document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">');	
	} 
} else {
	document.write('<meta name="viewport" content="width=device-width, user-scalable=no, target-densitydpi=device-dpi">');
}

</script>

<meta name="viewport" content="width=device-width, user-scalable=no, target-densitydpi=device-dpi">
-->

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>
<body>

<!--
<div id="loading" class="loading" style="display: none;"><img src="./show_res/load.gif">加载中...</div>
-->

<div class="device rel" id="device" >
    <div class="swiper-container" id="swiper-container">
      <div class="swiper-wrapper">
            <div class="swiper-slide rel swiper-slide-visible swiper-slide-active">
            <div class="main">
            <img src="./show_res/index.jpg" >
            </div>
            <!--
            <div class="bg rel" >
            <div id="light" >
            <img src="./show_res/light.png">
            </div>
            </div>
            -->
            </div>
           
             <!-- corner -->
             <div class="swiper-slide rel" >
            	<div class="main" ><img class="lazy" data-original="./show_res/wohb.jpg" src="./show_res/wohb.jpg" ></div>
				<!--
            	<div class="bg rel" style="height: 1097.775px; width: 697px;"><div class="draw" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_mark_1.png" src="./show_res/corner_mark_1.png" style="height: 1097.775px; width: 697px; display: block;"></div><div class="info" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_title_1.png" src="./show_res/corner_title_1.png" style="height: 1097.775px; width: 697px; display: block;"></div></div>
				-->
             </div>
              <div class="swiper-slide rel" >
            	<div class="main" ><img class="lazy" data-original="./show_res/aiqiyi.jpg" src="./show_res/aiqiyi.jpg" ></div>
				<!--
            	<div class="bg rel" style="height: 1097.775px; width: 697px;"><div class="draw" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_mark_2.png" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" style="height: 1097.775px; width: 697px;"></div><div class="info" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_title_2.png" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" style="height: 1097.775px; width: 697px;"></div></div>
				-->
             </div>
			 
	
             <!-- light -->
         

             <!-- city -->   
        <div class="swiper-slide rel">
        <div class="main" >
        <!--
				<a href="sms:13545296480?body=hello">
        -->
				<img class="lazy" data-original="./show_res/pptv.jpg" src="./show_res/pptv.jpg" >
				<!--
        </a>
        -->
				</div>
				<!--
            	<div class="bg rel" style="height: 1097.775px; width: 697px;"><div class="draw" style="height: 1097.775px; width: 697px;"><a href="tel:02786337717"><img class="lazy" data-original="images/ikea_city_0.png" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" style="height: 1097.775px; width: 697px;"></a></div><div class="info" style="height: 1097.775px; width: 697px;"><a href="tel:02786337717"><img class="lazy" data-original="images/outdoor_title_3.png" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" style="height: 1097.775px; width: 697px;"></a></div></div>
				-->
        </div> 
      
      </div>
    </div>
</div>
<!--
<script src="js/audio.js" tppabs="js/audio.js" type="text/javascript"></script>
 <script>
window.addEventListener("DOMContentLoaded", function(){
playbox.init("playbox");
}, false);
</script>
        
<span id="playbox" class="btn_music" onclick="playbox.init(this).play();"><audio src="images/wuwangxinan.mp3" tppabs="images/wuwangxinan.mp3" loop preload="preload" id="audio"></audio></span>

-->
<!--<div id="ikea-audio" class="ikea-audio abs" style="height: 56.2464px; width: 56.232px;">
  <div class="music">
    <p class="music_audio"><span class="abs audio_open" style="background-position: -56.232px 50%;"></span><span class="abs audio_close"></span></p>
    <audio id="music_audio" loop preload="preload">
      <source src="images/wuwangxinan.mp3" type="audio/mpeg">
      您的浏览器不支持HTML5音频格式</audio>
  </div>-->

<script type="text/javascript" src="./show_res/stylee.js"></script>
<!--
<script type="text/javascript">
   !window.jQuery && document.write('<scr' + 'ipt type="text/javascript" src="js/jquery-1.8.2.js"></scr' + 'ipt>');   
</script>
-->
<script type="text/javascript" src="./show_res/jquery.jplayer.min.js"></script> 
<script src="./show_res/main.js" type="text/javascript"></script>

<!--
<div id="ikea-audio" class="ikea-audio abs" style="height: 54.44964px; width: 54.4357px;"><div class="music"><p class="music_audio"><span class="abs audio_open" style="background-position: -54.4357px 50%;"></span><span class="abs audio_close"></span></p><audio id="music_audio" loop="loop" preload="preload"><source src="images/music2.mp3" type="audio/mpeg">您的浏览器不支持HTML5音频格式</audio></div></div>
-->



<?php 
  $appid = Yii::$app->wx->gh['appid'];
  $url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/showpage:'.Yii::$app->wx->getGhid());
  $assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
  $myImg = Url::to("$assetsPath/share-icon.jpg", true);
  $title = '数信业务资费';
  $desc = '数信业务资费';
?>

<script>
var dataForWeixin={
  appId:"<?php echo $appid; ?>",
  MsgImg:"<?php echo $myImg; ?>",
  TLImg:"<?php echo $myImg; ?>",
  url:"<?php echo $url; ?>",
  title:"<?php echo $title; ?>",
  desc:"<?php echo $desc; ?>",
  fakeid:"",
  prepare:function(argv)
  {                        
  },

  callback:function(res)
  {
    //发送给好友或应用
    if (res.err_msg=='send_app_msg:confirm') {
      //todo:func1();
      ///alert(res.err_desc);
    }
    if (res.err_msg=='send_app_msg:cancel') {
    }
    //分享到朋友圈
    if (res.err_msg=='share_timeline:confirm') {
    }
    if (res.err_msg=='share_timeline:cancel') {
    }
    //分享到微博
    if (res.err_msg=='share_weibo:confirm') {
    }
    if (res.err_msg=='share_weibo:cancel') {
    }
    //收藏或分享到应用
    if (res.err_msg=='send_app_msg:ok') {
    }     
  }
};
</script>
</body>
</html>