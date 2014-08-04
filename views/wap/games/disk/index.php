
<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '幸运大转盘';
$assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/disk/assets';
?>

<style type="text/css">
.demo{width:417px; height:417px; position:relative; margin:50px auto}
#disk{width:417px; height:417px; background:url(<?php echo "$assetsPath/disk.jpg"; ?>) no-repeat}

#start{width:163px; height:320px; position:absolute; top:46px; left:130px;}
#start img{cursor:pointer}
#main{width:450px; min-height:300px; margin:30px auto 0 auto; background:#fff; -moz-border-radius:12px;-khtml-border-radius: 12px;-webkit-border-radius: 12px; border-radius:12px;}
</style>

<script src="<?php echo "$assetsPath/jquery.js"; ?> "></script>
<script src="<?php echo "$assetsPath/jQueryRotate.2.2.js"; ?> "></script>
<script src="<?php echo "$assetsPath/jquery.easing.min.js"; ?> "></script>

<script type="text/javascript">
$(function(){
	$("#startbtn").rotate({
		bind:{
			click:function(){
				var a = Math.floor(Math.random() * 360);
				 $(this).rotate({
					 	duration:3000,
					 	angle: 0, 
            			animateTo:1440+a,
						easing: $.easing.easeOutSine,
						callback: function(){
							alert('中奖了！');
						}
				 });
			}
		}
	});
});
</script>

<div id="main">

   <div class="demo">
        <div id="disk"></div>
        <div id="start">
            <img src="<?php echo "$assetsPath/start.png"; ?>" id="startbtn" style="-webkit-transform: rotate(197deg);">
        </div>
   </div>
</div>


