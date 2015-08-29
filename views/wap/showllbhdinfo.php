<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>流量宝 流量套餐</title>
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
</style>

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
            <img src="./show_res/llbinfo-01.jpg" >
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
            <div class="main" >
              <a href="javascript:jump2order('llbhd')">
              <img class="lazy" data-original="./show_res/llbinfo-02.jpg" src="./show_res/llbinfo-02.jpg" >
              </a>
            </div>
				<!--
            	<div class="bg rel" style="height: 1097.775px; width: 697px;"><div class="draw" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_mark_1.png" src="./show_res/corner_mark_1.png" style="height: 1097.775px; width: 697px; display: block;"></div><div class="info" style="height: 1097.775px; width: 697px;"><img class="lazy" data-original="images/corner_title_1.png" src="./show_res/corner_title_1.png" style="height: 1097.775px; width: 697px; display: block;"></div></div>
				-->
             </div>


             <!-- light -->

             <!-- city -->   
            <div class="swiper-slide rel">
            <div class="main" >
        <!--
				<a href="sms:13545296480?body=hello">
        -->
				<a href="javascript:jump2order('llbhd')">
				<img class="lazy" data-original="./show_res/llbinfo-03.jpg" src="./show_res/llbinfo-03.jpg" >
				</a>
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

<script type="text/javascript" src="./show_res/stylee.js"></script>
<script type="text/javascript" src="./show_res/jquery.jplayer.min.js"></script> 
<script src="./show_res/main.js?v11" type="text/javascript"></script>
<script src="./js/wechat.js" type="text/javascript"></script>

<?php 
  $appid = Yii::$app->wx->gh['appid'];
  $url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/show4ginfo:'.Yii::$app->wx->getGhid());
  //$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
  $assetsPath = Yii::$app->getRequest()->baseUrl.'/show_res';
  $myImg = Url::to("$assetsPath/llbinfo-01.jpg", true);
  $title = '流量宝 流量套餐';
  $desc = '流量宝 流量套餐';
?>

<script>
var url_base="<?php echo  Url::to(['wap/llbhd'],true) ?>";

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


function jump2order(cat)
{
  if(cat=="llbhd")
  {
    //alert(url_base+"&cid=804");
    location.href=url_base+"&cid=80001&realFee=0";
  }
}
</script>
</script>
</body>
</html>