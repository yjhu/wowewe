<?php
use yii\helpers\Html;
use yii\grid\GridView;
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
  <title>4G测速</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">  
  <link href="http://libs.useso.com/js/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
</head>
<body ontouchstart="">
<div class="container">

    <!--
      <h3 id="menu-image">图像接口</h3>
      <span class="desc">拍照或从手机相册中选图接口</span>
      <button class="btn btn_primary" id="chooseImage">chooseImage</button>

      <span class="desc">预览图片接口</span>
      <button class="btn btn_primary" id="previewImage">previewImage</button>
      <span class="desc">上传图片接口</span>
      <button class="btn btn_primary" id="uploadImage">uploadImage</button>
      <span class="desc">下载图片接口</span>
      <button class="btn btn_primary" id="downloadImage">downloadImage</button>

      <h3 id="menu-device">设备信息接口</h3>
      <span class="desc">获取网络状态接口</span>
      <button class="btn btn_primary" id="getNetworkType">getNetworkType</button>

      <h3 id="menu-location">地理位置接口</h3>
      <span class="desc">使用微信内置地图查看位置接口</span>
      <button class="btn btn_primary" id="openLocation">openLocation</button>
      <span class="desc">获取地理位置接口</span>
      <button class="btn btn_primary" id="getLocation">getLocation</button>
      -->
<h1>4G测速</h1>
<form id="productForm">
  <button class="btn btn_primary" id="chooseImage">选择测速截图</button><br>
  <div class="form-group">
    <input type="hidden" class="form-control" id="lon" placeholder="Enter lon">
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control" id="lat" placeholder="Enter lat">
  </div>
  <div class="form-group">
    <input type="number" class="form-control input-lg" id="speed_up" placeholder="上传速度 Mbps">
  </div>
  <div class="form-group">
    <input type="number" class="form-control input-lg" id="speed_down" placeholder="下载速度 Mbps">
  </div>
  <div class="form-group">
    <input type="number" class="form-control input-lg" id="speed_delay" placeholder="延时 ms">
  </div>
  <div class="form-group">
    <input type="hidden" class="form-control" id="serverId">
  </div>

<!--
  <button type="submit" class="btn btn-default">Submit</button>
-->
  <button class="btn btn-success btn-block btn-lg " id="submit_speed">提交</button>

</form>

  </div>

</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  //$("#submit_speed").hide();
  $("#submit_speed").attr("disabled","disabled");

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


  var shareData = {
    title: '4G测速',
    desc: '4G测速',
    link: 'http://wosotech.com/wx/web/index.php?r=wx/jssdksample',
    imgUrl: '<?php echo Yii::$app->getRequest()->baseUrl.'/images/share-icon.jpg' ?>'
  };

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

wx.ready(function () {
 //   alert(1);
/*
    wx.getLocation({
      success: function (res) {
              alert(2);
        alert(JSON.stringify(res));
      },
      cancel: function (res) {
        alert('用户拒绝授权获取地理位置');
      }
    });
*/

    wx.getLocation({
      success: function (res) {
        //alert(JSON.stringify(res));

//        alert("lon"+res.longitude+"lat"+res.latitude);
        lat = res.latitude;
        lng = res.longitude;

//        alert("lon"+lng+"lat"+lat);


        /// 中国正常坐标系GCJ02协议的坐标，转到 百度地图对应的 BD09 协议坐标
        var z = Math.sqrt(lng * lng + lat * lat) + 0.00002 * Math.sin(lat * x_pi);
        var theta = Math.atan2(lat, lng) + 0.000003 * Math.cos(lng * x_pi);

        lng = z * Math.cos(theta) + 0.0065;
        lat = z * Math.sin(theta) + 0.006;

        $("#lon").val(lng);
        $("#lat").val(lat);
  //      document.querySelector('#lon').val(lng);
//        document.querySelector('#lat').val(lng);
          //$("#submit_speed").show();
          $("#submit_speed").removeAttr("disabled");

      },
      cancel: function (res) {
          alert('用户拒绝授权获取地理位置');
          //bindDistWithoutGEO();
      }
    });


    wx.onMenuShareAppMessage({
      title: 'xxx',
      desc: 'xxx',
      link: 'xxx',
      imgUrl: 'xxx',
      trigger: function (res) {
        alert('用户点击发送给朋友');
      },
      success: function (res) {
        alert('已分享');
      },
      cancel: function (res) {
        alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

    wx.onMenuShareTimeline({
      title: 'xxx',
      link: 'xxx',
      imgUrl: 'xxx',
      trigger: function (res) {
        alert('用户点击分享到朋友圈');
      },
      success: function (res) {
        alert('已分享');
      },
      cancel: function (res) {
        alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

    wx.onMenuShareQQ({
      title: 'xxx',
      desc: 'xxx',
      link: 'xxx',
      imgUrl: 'xxx',
      trigger: function (res) {
        alert('用户点击分享到QQ');
      },
      complete: function (res) {
        alert(JSON.stringify(res));
      },
      success: function (res) {
        alert('已分享');
      },
      cancel: function (res) {
        alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

    wx.onMenuShareWeibo({
      title: 'xxx',
      desc: 'xxx',
      link: 'xxx',
      imgUrl: 'xxx',
      trigger: function (res) {
        alert('用户点击分享到微博');
      },
      complete: function (res) {
        alert(JSON.stringify(res));
      },
      success: function (res) {
        alert('已分享');
      },
      cancel: function (res) {
        alert('已取消');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });

  wx.onMenuShareAppMessage(shareData);
  wx.onMenuShareTimeline(shareData);

  // 5 图片接口
  // 5.1 拍照、本地选图
  document.querySelector('#chooseImage').onclick = function () {
    wx.chooseImage({
      success: function (res) {
        images.localId = res.localIds;
        //alert('已选择 ' + res.localIds.length + ' 张图片');
        //alert(images.localId[0]);

        if (images.localId.length > 1) {
          alert('一次只能选择一张图片。');
          return;
          //return false;
        }
      }
    });
    return false;
  };

/*
  // 5.2 图片预览
  document.querySelector('#previewImage').onclick = function () {
    wx.previewImage({
      current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
      urls: [
        'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
        'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
        'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'
      ]
    });
  };
*/
  // 5.3 上传图片
  document.querySelector('#uploadImage').onclick = function () {
    if (images.localId.length == 0) {
      alert('请先选择上传图片');
      return;
    }
    if (images.localId.length > 1) {
      alert('Select one picture every time');
      return;
    }

    var i = 0, length = images.localId.length;
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          //alert('localid=' + images.localId[i] + 'serverId=' + res.serverId);
          i++;
          alert('已上传：' + i + '/' + length);
          images.serverId.push(res.serverId);
          if (i < length) {
            upload();
          }
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    }
    upload();

  };

  // 5.4 下载图片
  document.querySelector('#downloadImage').onclick = function () {
    if (images.serverId.length === 0) {
      alert('请先使用 uploadImage 上传图片');
      return;
    }
    var i = 0, length = images.serverId.length;
    images.localId = [];
    function download() {
      wx.downloadImage({
        serverId: images.serverId[i],
        success: function (res) {
          i++;
          alert('已下载：' + i + '/' + length);
          images.localId.push(res.localId);
          if (i < length) {
            download();
          }
        }
      });
    }
    download();
  };

  // 6 设备信息接口
  // 6.1 获取当前网络状态
  document.querySelector('#getNetworkType').onclick = function () {
    wx.getNetworkType({
      success: function (res) {
        alert(res.networkType);
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
    });
  };


});


wx.error(function (res) {
  alert(res.errMsg);
});

document.querySelector('#submit_speed').onclick = function () {
//    alert(1);
//    return false;

    if (images.localId.length == 0) {
      alert('请先使用 chooseImage 接口选择图片');
      return false;
    }
    if (images.localId.length > 1) {
      alert('Select one picture every time');
      return false;
    }

    var i = 0, length = images.localId.length;
    images.serverId = [];
    function upload() {
      wx.uploadImage({
        localId: images.localId[i],
        success: function (res) {
          //alert('localid=' + images.localId[i] + 'serverId=' + res.serverId);
          i++;
          alert('已上传：' + i + '/' + length);
          images.serverId.push(res.serverId);
          if (i < length) {
            upload();
          } 
          else {

            alert('localid=' + images.localId[0] + ', serverId=' + images.serverId[0]);

            $("#serverId").val(images.serverId[0]);
            //alert('xxx'+$("#productForm").serialize());
            lon = $("#lon").val();
            lat = $("#lat").val();
            speed_up = $("#speed_up").val();
            speed_down = $("#speed_down").val();
            speed_delay = $("#speed_delay").val();
            serverId = $("#serverId").val();

            //alert("&lon="+lon+"&lat="+lat+"&speed_up="+speed_up+"&speed_down="+speed_down+"&speed_delay="+speed_delay+"&serverId="+serverId);

            $.ajax({
                    url: "<?php echo Url::to(['wap/handlespeed'], true) ; ?>",
                    type:"GET",
                    cache:false,
                    dataType:'json',
                    //data: $("#productForm").serialize();
                     data: "lon="+lon+"&lat="+lat+"&speed_up="+speed_up+"&speed_down="+speed_down+"&speed_delay="+speed_delay+"&serverId="+serverId,
                    success: function(json_data){
                    }
               });
          }
        },
        fail: function (res) {
          alert(JSON.stringify(res));
        }
      });
    }
    upload();


    return false;    

};

</script>
</html>
