<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
use app\models\MOfficeCampaignDetail;


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
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       参赛门店资料提交
      </h1>
    </header>



    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p>
        <?= $model_ocpc->name ?>
      </p>
       

      <?php 
          $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_ocpc->id, 'office_id' => $model_office->office_id]);

          if(!empty($model_office_campaign_detail))
          {
            $url = $model_office_campaign_detail->getImageUrl();
          }
          else
            $url = 'http://placehold.it/200x200';
      ?>

      <img width=100% class="media-object pull-left" src="<?= $url ?>">
    
      <form>
              <input type="hidden" class="form-control" id="serverId">
              <button class="btn btn-positive btn-block" id="chooseImage">选择照片</button>
              <button class="btn btn-negative btn-block" id="submitImage">上传照片</button>
      </form>

    </div>
      
  </body>

  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  //$("#submit_speed").hide();
  //$("#submit_speed").attr("disabled","disabled");

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

var cat = "<?= $model_ocpc->id ?>";
var office_id = "<?= $model_office->office_id ?>";

$("#chooseImage").hide();
$("#submitImage").hide();


wx.ready(function () {
   //alert('aaaa');

    $("#chooseImage").show();

  // 5 图片接口
  // 5.1 拍照、本地选图
  document.querySelector('#chooseImage').onclick = function () {
    //alert("bbbb");
    wx.chooseImage({
      success: function (res) {
        if (res.localIds.length > 1) {
          alert('一次只能选择一张图片，请重新选择！');
          return;
          //return false;
        }

        $("#chooseImage").hide();
        $("#submitImage").show();


        images.localId = res.localIds;
        //alert('已选择 ' + res.localIds.length + ' 张图片');
        //alert(images.localId[0]);
/*
        if (images.localId.length > 1) {
          alert('一次只能选择一张图片。');
          return;
          //return false;
        }
*/
      }
    });
    return false;
  };

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



});


wx.error(function (res) {
  alert(res.errMsg);
});

document.querySelector('#submitImage').onclick = function () {
//    alert(1);
//    return false;

    if (images.localId.length == 0) {
      alert('请先选择上传图片');
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
          //alert('已上传：' + i + '/' + length);
          alert('恭喜你，已成功上传！');
          images.serverId.push(res.serverId);
          if (i < length) {
            upload();
          } 
          else {

            //alert('localid=' + images.localId[0] + ', serverId=' + images.serverId[0]);

            $("#serverId").val(images.serverId[0]);
            serverId = $("#serverId").val();

           // status = $("#status").val();

            //alert('status'+status);
            //alert("cat="+cat+"&office_id="+office_id+"&serverId="+serverId);

            $.ajax({
                    url: "<?php echo Url::to(['wap/handlecsmdzltj'], true) ; ?>",
                    type:"GET",
                    cache:false,
                    dataType:'json',
                    //data: $("#productForm").serialize();
                    data: "cat="+cat+"&office_id="+office_id+"&serverId="+serverId,
                    success: function(json_data){
                      //alert('success');
                      var url = "<?php echo Url::to(['wap/csmdzltj2','office_id'=>$model_office->office_id], true); ?>";
                      location.href = url;
                      //history.back();
                    }
               });
        

          }
        },
        fail: function (res) {
          alert("fail::"+JSON.stringify(res));
        }
      });
    }
    upload();

    return false;    

};

</script>
</html>