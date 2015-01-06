
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
<title>教师风采</title>
<script type="text/javascript">
document.write('<div id="load-layer"><div id="loading"></div></div>');
window.onload=function(){
  var load = document.getElementById("load-layer");
  load.parentNode.removeChild(load);
}
</script>
<style type="text/css">
html {
-webkit-tap-highlight-color:rgba(0,0,0,0); 
-webkit-tap-highlight:rgba(0,0,0,0);
-webkit-text-size-adjust:none;
overflow:-moz-scrollbars-vertical;
/*强制firefox出现滑动条*/
}
</style>
<link rel="stylesheet" type="text/css" href="./swiper/swiper.css">
<link rel="stylesheet" type="text/css" href="./swiper/index.css?v3">
<link type="text/css" rel="stylesheet" href="./swiper/manimation.css" />
<link type="text/css" rel="stylesheet" href="./swiper/fancybox.css" />
</head>
<body>
<div class="swiper-container">
  <!--音乐控制-->
  <div class="audio-controls on" id="audio-controls"></div>
  <!-- 滑动操作指示 -->
  <div class="start"><strong></strong></div>
  <!-- 主体 -->
  <div class="swiper-wrapper">
          <div class="swiper-slide slide1" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/IB8X6up4lA46yQpi44WapTUaxI8YtA.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div> 
          <div class="swiper-slide slide2" id="t1" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/EDM26568dY0TM2vh8YD8fT6xH2v2h1.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide3" id="t2" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/j2VESivbqh2oSaTV5P5AuvyuIBy25u.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide4" id="t3" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/CkmUlhMBmBSuhb388SsF93hkssx3Al.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide5" id="t4" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/yychW2Y9agGSI4IbKasHYba7yKYCym.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide6" id="t5" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/R1t2c43hCbXihrjD4TdMQTtEd4Qx3b.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide7" id="t6" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/xFmwIm7RyV2i1OlRTtb429R781mVWz.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide8" id="t7" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/S0PHx6Q6Y8xzgg8H6ii4G7xHtXy6Gp.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide9" id="t8" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/T2ux4ff9u942vnn9GFxN993242uSUX.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide10" id="t9" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/u5tK1p7vbJafDAVK5DOzF55e5eovTV.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>   
          <div class="swiper-slide slide11" id="t10" style="background: url('http://nw.55wh.com/resource/attachment//images/1/2014/12/g55ChICFoly5c2ipZ10cT0xHwht0P0.jpg') no-repeat center center; background-size: 100% 100%;" >
          </div>
    
      </div>

</div>
<!-- 背景音乐 -->
<audio id="audio" autoplay="autoplay" loop="loop">
  <source src="http://sc.111ttt.com/up/mp3/141870/4B2377C8A574289125353A74676C6B1D.mp3" type="audio/mpeg" />
</audio>
<script src="./swiper/jquery.min.js"></script>
<script src="./swiper/jquery.mobile.js"></script>
<script src="./swiper/swiper.min.js"></script>
<script src="./swiper/wechat.min.js"></script>
<script src="./swiper/fancybox.js?v2"></script>
<script type="text/javascript">

<!-- 滑动 -->
var mySwiper = new Swiper('.swiper-container',{
  loop:1,
  mode:'vertical',
  tdFlow: {
    rotate :60,
    depth: 150,
  }
})


</script>

<!-- 音频暂停播放 -->
<script type="text/javascript">
var audioAuto = document.getElementById('audio');
audioAuto.play();

$(".audio-controls").click(function (){ 
 
  if (audioAuto.paused) {
    $(".audio-controls").addClass("on");  
    audioAuto.play();

        }
        else {
    $(".audio-controls").removeClass("on");   
    audioAuto.pause();

        }
});
</script>
<!-- 弹出层设置 -->
<script type="text/javascript">
$(document).ready(function() {

  $(".fancy").fancybox({
    'width':'100%',
    'height'  :'100%',
    'margin':'0',
    'padding':'0',
    'scrolling':'no',
    'autoScale':'false',
    'type':'iframe'
  });

});
</script>
<!-- 微信分享设置 -->
<script type="text/javascript">
WeixinApi.ready(function(Api) {
  Api.showOptionMenu();
  var wxData = {
    "imgUrl" : 'http://nw.55wh.com/resource/attachment/',
    "desc" : '爱迪天才在职员工100人，30%大学本科毕业，60%幼教专科毕业！',
    "title" : '教师风采',
    "link" : 'http://nw.55wh.com/mobile.php?act=module&id=1&name=huabao&do=detail&weid=1&wxref=mp.weixin.qq.com&wxref=mp.weixin.qq.com'
    };
  // 分享的回调
  var wxCallbacks = {
    // 分享被用户自动取消
    cancel : function(resp) {
      alert("亲，这么好的东西怎么能不分享给好朋友呢！");
    },
    // 分享失败了
    fail : function(resp) {
      alert("分享失败，可能是网络问题，一会儿再试试？");
    },
    // 分享成功
    confirm : function(resp) {
      window.location.href='';
    },
  };
  Api.shareToFriend(wxData,wxCallbacks);
  Api.shareToTimeline(wxData,wxCallbacks);
  Api.shareToWeibo(wxData,wxCallbacks);
});
</script>
<div id="mcover" onclick="$(this).hide()"><img src="./swiper/guide.png"></div>
<!--浏览量-->
</body>
</html>