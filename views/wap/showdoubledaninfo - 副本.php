<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>双旦狂欢季</title> 
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

<div class="device rel" id="device" >
    <div class="swiper-container" id="swiper-container">
      <div class="swiper-wrapper">
            <div class="swiper-slide rel swiper-slide-visible swiper-slide-active">
              <div class="main">
              <img src="./show_res/index_doubledaninfo.jpg?v5" >
              </div>
            </div>
           
            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('iphone4s')">
                <img class="lazy" data-original="./show_res/iphone4s.jpg?v5" src="./show_res/iphone4s.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('iphone5s')">
                <img class="lazy" data-original="./show_res/iphone5s.jpg?v5" src="./show_res/iphone5s.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('iphone6')">
                <img class="lazy" data-original="./show_res/iphone6dd.jpg?v5" src="./show_res/iphone6dd.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('honor6')">
                <img class="lazy" data-original="./show_res/honor6.jpg?v5" src="./show_res/honor6.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('xiaomi4')">
                <img class="lazy" data-original="./show_res/xiaomi4.jpg?v5" src="./show_res/xiaomi4.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('samsungg5108q')">
                <img class="lazy" data-original="./show_res/samsungg5108q.jpg?v5" src="./show_res/samsungg5108q.jpg?v5" >
              </a>
              </div>
            </div>

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('100yuan5gshangwangka')">
                <img class="lazy" data-original="./show_res/100yuan5gshangwangka.jpg?v5" src="./show_res/100yuan5gshangwangka.jpg?v5" >
              </a>
              </div>
            </div>  

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('3gbannianshangwangka')">
                <img class="lazy" data-original="./show_res/3gbannianshangwangka.jpg?v5" src="./show_res/3gbannianshangwangka.jpg?v5" >
              </a>
              </div>
            </div>     

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('6gniankashangwangka')">
                <img class="lazy" data-original="./show_res/6gniankashangwangka.jpg?v5" src="./show_res/6gniankashangwangka.jpg?v5" >
              </a>
              </div>
            </div>     

            <div class="swiper-slide rel" >
              <div class="main" >
              <a href="javascript:jump2order('45gshangwangka')">
                <img class="lazy" data-original="./show_res/45gshangwangkadd.jpg?v5" src="./show_res/45gshangwangkadd.jpg?v5" >
              </a>
              </div>
            </div>                        

          <div class="swiper-slide rel">
            <div class="main" >
            <a href="javascript:jump2order('96gshangwangka')">
            <img class="lazy" data-original="./show_res/96gshangwangkadd.jpg?v5" src="./show_res/96gshangwangkadd.jpg?v5" >
            </a>
            </div>
          </div> 

      </div>
    </div>
</div>

<script type="text/javascript" src="./show_res/stylee.js"></script>
<script type="text/javascript" src="./show_res/jquery.jplayer.min.js"></script> 
<script src="./show_res/main.js?v51" type="text/javascript"></script>
<script src="./js/wechat.js" type="text/javascript"></script>

<?php 
  $appid = Yii::$app->wx->gh['appid'];
  $url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/showdoubledaninfo:'.Yii::$app->wx->getGhid());
  //$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
  $assetsPath = Yii::$app->getRequest()->baseUrl.'/show_res';
  $myImg = Url::to("$assetsPath/index_doubledaninfo.jpg?v5", true);
  $title = '双旦狂欢季';
  $desc = '2014年最后一波特大优惠已经来袭，亲们做好准备了吗？';
?>

<script>
var url_base="<?php echo  Url::to(['wap/doubledan'],true) ?>";

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
  if(cat=="iphone4s")
  {
    location.href=url_base+"&cid=813&realFee=0&office=16";
  }
  if(cat=="iphone5s")
  {
    location.href=url_base+"&cid=814&realFee=0&office=16";
  }
  if(cat=="iphone6")
  {
    location.href=url_base+"&cid=805&realFee=0&office=16";
  }
  if(cat=="honor6")
  {
    location.href=url_base+"&cid=815&realFee=0&office=16";
  }
  if(cat=="xiaomi4")
  {
    location.href=url_base+"&cid=816&realFee=0&office=16";
  }
  if(cat=="samsungg5108q")
  {
    location.href=url_base+"&cid=817&realFee=0&office=16";
  }
  else if(cat=="100yuan5gshangwangka")
  {
    location.href=url_base+"&cid=810&realFee=0&office=16";
  }
  else if(cat=="3gbannianshangwangka")
  {
    location.href=url_base+"&cid=811&realFee=0&office=16";
  }
  else if(cat=="6gniankashangwangka")
  {
    location.href=url_base+"&cid=812&realFee=0&office=16";
  }
  else if(cat=="45gshangwangka")
  {
    location.href=url_base+"&cid=808&realFee=0&office=16";
  }
  else if(cat=="96gshangwangka")
  {
    location.href=url_base+"&cid=809&realFee=0&office=16";
  }
}

</script>
</script>
</body>
</html>