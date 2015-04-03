<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$signPackage = $jssdk->GetSignPackage();

$this->title = '4G测速';
?>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<?php
		$this->registerJs(
		   '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
		   yii\web\View::POS_READY
		);
	?>

	<h3><?php echo Html::encode($this->title) ?><br>已有<span style="font-size:48px;color:#ff0000;"><?= $n ?></span>人测速</h3>  

	<?php if (Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success flash-success">
			<?php echo Yii::$app->session->getFlash('success'); ?>
		</div>
	<?php else: ?>
	<?php endif; ?>

<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
			<?= $form->field($model, 'heat_map_id')->fileInput()->label('请选择测速截图...'); ?>


			<?= $form->field($model, 'speed_up')->textInput(['maxlength' => 10, 'placeholder'=>'上传速度', 'class'=>'form-control input-lg'])->label(false); ?>
			<?= $form->field($model, 'speed_down')->textInput(['maxlength' => 10, 'placeholder'=>'下载速度', 'class'=>'form-control input-lg'])->label(false); ?>
			<?= $form->field($model, 'speed_delay')->textInput(['maxlength' => 10, 'placeholder'=>'延时', 'class'=>'form-control input-lg'])->label(false); ?>
			
			<?= $form->field($model, 'lon')->textInput(['id' => 'lon'])->label(false); ?>
			<?= $form->field($model, 'lat')->textInput(['id' => 'lat'])->label(false); ?>
			

			<div class="form-group">
				<?= Html::submitButton('提交', ['class' => 'btn btn-success btn-block btn-lg', 'name' => 'contact-button']) ?>
			</div>
		<?php ActiveForm::end(); ?>
	</div>
</div>

<script>

    var lat;
    var lng;

    var d_tmp=0;
    var ds_tmp='';

    var x_pi = 3.14159265358979324 * 3000.0 / 180.0;

   function Rad(d){
     return d * Math.PI / 180.0;//经纬度转换成三角函数中度分表形式。
  }


  wx.config({
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: '<?php echo $signPackage["timestamp"];?>',
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo'
    ]
  });


  var shareData = {
    title: 'xxxx',
    desc: 'xxxxx',
    //link: 'http://backend.hoyatech.net/index.php?r=wx/yss/schoolbranch&gh_id=<//?php echo $gh_id;?>&openid=nobody',
    //imgUrl: '<//?php echo MPhoto::getUploadPicUrl("course.jpg") ?>'
  };

wx.ready(function () {

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

        $("#lon").val(lng);
        $("#lat").val(lat);
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
});

</script>
<?php
/*


*/