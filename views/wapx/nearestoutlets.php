<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

//require_once "jssdk.php";
//$jssdk = new JSSDK("yourAppID", "yourAppSecret");
$signPackage = $jssdk->GetSignPackage();
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
    <!--
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      -->
      <h1 class="title">
       附近营业厅
      </h1>
      <a class="icon icon-refresh pull-right" onclick="javascript:location.reload();"></a>
    </header>



    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded" align="center">
          <i  id="loading" class="fa fa-refresh fa-spin fa-3x" style="color: #ccc"></i>
      </p>

        <ul class="table-view" id="ul-body">
        <!--
            <li class="table-view-cell media">
            <a data-ignore="push" class="navigate-right" href="#">
                <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                  <p><span class="orderitem">老河口营业厅</span></p>
                  <p><span class="orderitem">距离</span>&nbsp;&nbsp;1.5公里</p>
                  <p><span class="orderitem">电话</span>&nbsp;&nbsp;87654321</p>
              </div>
            </a>
          </li>
          -->
        </ul>

      <br>

        <!--<button class="btn btn-positive btn-block">刷新</button>-->
      <br>


    </div>


  </body>

  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  <script>

  var images = {
    localId: [],
    serverId: []
  };

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
</script>

<script>
  var lat;
  var lng;

  var d_tmp=0;
  var ds_tmp='';

  var x_pi = 3.14159265358979324 * 3000.0 / 180.0;
   function Rad(d){
     return d * Math.PI / 180.0;//经纬度转换成三角函数中度分表形式。
  }

   var objectList = new Array();

   function Persion(title,latitude,longitude,url,dist,telephone,address){
      this.title=title;
      this.latitude=latitude;
      this.longitude=longitude;
      this.url=url;
      this.dist=dist;
      this.telephone=telephone;
      this.address=address;
    }

  //计算距离，参数分别为第一点的纬度，经度；第二点的纬度，经度
  function GetDistanceNum(lat1,lng1,lat2,lng2){

      var radLat1 = Rad(lat1);
      var radLat2 = Rad(lat2);
      var a = radLat1 - radLat2;
      var  b = Rad(lng1) - Rad(lng2);
      var s = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(a/2),2) +
      Math.cos(radLat1)*Math.cos(radLat2)*Math.pow(Math.sin(b/2),2)));
      s = s *6378.137 ;// EARTH_RADIUS;
      //s = Math.round(s * 10000) / 10000; //输出为公里
      s = parseInt(Math.round(s * 10000) / 10000 * 1000); //输出为米
      //s=s.toFixed(4);
      return s;
  }

  function bindDist(lat,lng)
  {
      //alert("bindDist");

        <?php
          $n = 1;
          foreach ($outlets as $outlet) {
        ?>

          url = 'http://wosotech.com/wx/web/index.php?r=wapx/client-outlet&gh_id=<?= $gh_id ?>&openid=<?= $openid ?>&outlet_id=<?= $outlet->outlet_id ?>';

          d = GetDistanceNum(lat,lng,'<?=$outlet->latitude?>','<?=$outlet->longitude?>');
          //ds = '<li class="table-view-cell media"><a data-ignore="push" class="navigate-right" href="#"><img class="media-object pull-left" src="http://placehold.it/80x80"><div class="media-body"><p><span class="orderitem"><?= $outlet->title; ?></span></p><p><span class="orderitem">距离</span>&nbsp;&nbsp;'+ d +'米</p><p><span class="orderitem">电话</span>&nbsp;&nbsp;<?= empty($outlet->telephone)?"":$outlet->telephone ; ?></p><p><span class="orderitem">地址</span>&nbsp;&nbsp;<?= empty($outlet->address)?"":$outlet->address; ?></p></div></a></li>';          
          objectList.push(new Persion("<?=$outlet->title?>", "<?=$outlet->latitude?>", "<?=$outlet->longitude?>", url, d, "<?=$outlet->telephone?>", "<?=$outlet->address?>"));

        <?php
          $n = $n + 1;
          }
        ?>

        //按距离从小到大排序
        objectList.sort(function(a,b){
            return b.dist-a.dist});

        for(var i=0;i<objectList.length;i++){
              
              mapurl = '<a data-ignore="push" class="btn btn-link pull-right" id="openLocation"><i class="fa fa-map-marker li-body fa-2x" style="color:#ea8010" latitude="'+ objectList[i].latitude +'" longitude="'+ objectList[i].longitude +'" title="'+ objectList[i].title+'" address="'+ objectList[i].address+'"></i></a>';

              //ds = '<li class="table-view-cell media"><a data-ignore="push" class="navigate-right" href="'+ objectList[i].url +'"><img class="media-object pull-left" src="http://placehold.it/80x80"><div class="media-body"><p><span class="orderitem">'+ objectList[i].title +'</span></p><p><span class="orderitem">距离</span>&nbsp;&nbsp;'+ objectList[i].dist +'米</p><p><span class="orderitem">电话</span>&nbsp;&nbsp;'+ objectList[i].telephone +'</p><p><span class="orderitem">地址</span>&nbsp;&nbsp;'+ objectList[i].address +'</p></div></a></li>';
              ds = '<li class="table-view-cell"><div class="media-body"><h5>'+ objectList[i].title +'</h5><p><span class="orderitem">距离</span>&nbsp;&nbsp;'+ objectList[i].dist +'米</p><p><span class="orderitem">电话</span>&nbsp;&nbsp;'+ objectList[i].telephone +'</p><p><span class="orderitem">地址</span>&nbsp;&nbsp;'+ objectList[i].address +'</p></div>'+mapurl+'</li>';
              ds_tmp = ds + ds_tmp;
            }

      $("#ul-body").html(ds_tmp);
  }

  function bindDistWithoutGEO()
  {


     // $("#ul-body").html(ds_tmp);
  }

wx.ready(function () {
   //alert('ready');
   $("#loading").hide();


    $('#ul-body').on('click', '.li-body', function (e) {
        var latitude = $(e.target).attr('latitude');
        var longitude = $(e.target).attr('longitude');
        var title = $(e.target).attr('title');
        var address = $(e.target).attr('address');
        //alert(title);

       // alert(serverId);
        wx.openLocation({
        latitude: latitude,
        longitude: longitude,
        name: title,
        address: address,
        scale: 12,
        infoUrl: ''
      });
    });

    wx.getLocation({
      success: function (res) {
        //alert(JSON.stringify(res));
        //alert("lon"+res.longitude+"lat"+res.latitude);
        lat = res.latitude;
        lng = res.longitude;

        /// 中国正常坐标系GCJ02协议的坐标，转到 百度地图对应的 BD09 协议坐标
        var z = Math.sqrt(lng * lng + lat * lat) + 0.00002 * Math.sin(lat * x_pi);
        var theta = Math.atan2(lat, lng) + 0.000003 * Math.cos(lng * x_pi);

        lng = z * Math.cos(theta) + 0.0065;
        lat = z * Math.sin(theta) + 0.006;
        //alert("convert: lng="+lng);

        bindDist(lat,lng);
      },
      cancel: function (res) {
          alert('用户拒绝授权获取地理位置');
          bindDistWithoutGEO();
      }
    });

});

wx.error(function (res) {
  alert(res.errMsg);
});


</script>

</html>