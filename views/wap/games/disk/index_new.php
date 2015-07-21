<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
use app\models\MDisk;
$this->title = '幸运大转盘';

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/disk/assets';
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');
?>


<style type="text/css">

#diskstart{
	text-align: center;
}

#start {
	top: -268px;
	position: relative;
}

</style>


<div data-role="page" id="page1" data-theme="c">

	<?php echo $this->render('/wap/header1', ['menuId'=>'menu1','title' => '八月浪漫季']); ?>


	<div data-role="footer">
		<h4>&copy; 襄阳联通 2015</h4>
	</div>
	<?php echo $this->render('/wap/menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid ]); ?>
</div>

<div data-role="page" id='dialogPage1' data-dialog="true" data-theme="c">

	<div data-role="header">
		<h1>抽奖结果</h1>
	</div>

	<div role="main" class="ui-content">
		<p>真可惜，就差一点点！</p>
		<a href="#page1" data-rel="back" class="ui-corner-all ui-btn">确认</a>
	</div>
</div>

<div data-role="page" id='dialogPage2' data-dialog="true" data-theme="c">

	<div data-role="header">
		<h1>抽奖结果</h1>
	</div>

	<div role="main" class="ui-content">
		<p>您今天的3次抽奖机会都用完了，请明天再来。</p>
		<a data-ajax=false  href="<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/home' ; ?>"  class="ui-shadow ui-corner-all ui-btn">确认</a>
	</div>

</div>

<div data-role="page" id='dialogPage3' data-dialog="true" data-theme="c">

	<div data-role="header">
		<h1>抽奖结果</h1>
	</div>

	<div role="main" class="ui-content">
		<p style="font-size: 14pt; font-weight: bolder;color: red">恭喜您，中奖了!</p>
		<a data-ajax=false href="<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/goodnumber#number-select' ; ?>" class="ui-shadow ui-corner-all ui-btn">确认</a>
	</div>

</div>



</html>


//////////////////////////////////////////////////////////////
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

use app\models\MDisk;
$this->title = '幸运大转盘';

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/disk/assets';
//$gh_id = U::getSessionParam('gh_id');
//$openid = U::getSessionParam('openid');

include('../models/utils/emoji.php');


\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>缤纷盛夏邀你共享微信好礼</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link href="./php-emoji/emoji.css" rel="stylesheet">    
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">

	<style type="text/css">

	#diskstart{
		text-align: center;
	}

	#start {
		top: -268px;
		position: relative;
	}

	</style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
    
	<div data-role="content" id="diskstart">

		<img width="100%" src="<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/metro_home_head2.jpg' ?>" alt="八月浪漫季">
		<br><br>
		<div id="disk">
			<img width="100%" src="<?php echo "$assetsPath/disk2.png"; ?>">
		</div>
		<div id="start">
			<img src="<?php echo "$assetsPath/start2.png"; ?>" id="startbtn" style="-webkit-transform: rotate(197deg);">
		</div>

	</div>

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>


<script src="<?php echo "$assetsPath/jQueryRotate.2.2.js"; ?> "></script>
<script src="<?php echo "$assetsPath/jquery.easing.min.js"; ?> "></script>
<script type="text/javascript">
	//$(function(){
	$(document).on("pageshow", "#page1", function(){
		$("#startbtn").rotate({
			bind:{
				tap:function(){
					var json_data;
					$.ajax({
						url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'diskclick'], true) ; ?>",
						type:"GET",
						async:false,
						cache:false,
						dataType:'json',
						data: "&openid="+'<?php echo $openid; ?>'+"&gh_id="+'<?php echo $gh_id; ?>',
						success: function(data){
							json_data = data;
						}
					});

					if (json_data.code == 0)
					{
						var a = json_data.angle;
						var value = json_data.value;
						var name = json_data.name;
						//alert(a + ":" + name + ":" + value);
						//var a = Math.floor(Math.random() * 360);
						$(this).rotate({
							duration:5000,
							angle: 0,
							animateTo:(360*4)+a,
							easing: $.easing.easeOutSine,
							callback: function()
							{
								if (value%2 == 0)
								{
									//中奖了， 转到选号页面， 可以选择靓号了~~
									//var res = 'ok';
									var res = '恭喜您，中奖了！';

									//window.location = '<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/goodnumber#number-select' ; ?>';
									//window.location='#dialogPage3';
								}
								else
								{
									//没中奖？？
									//var res = 'sorry';
									var res = '真可惜，就差一点点！';
									//window.location='#dialogPage1';
								}

								//alert(name + ':' + value + res );
								alert( res );
							}
						});
					}
					else
					{
						//alert(json_data.code+json_data.errmsg);
						//alert('您今天的3次抽奖机会都用完了，请明天再来。');
						//window.location = '<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/home' ; ?>';
						//window.location='#dialogPage2';
						alert('您今天的3次抽奖机会都用完了，请明天再来。');
					}

				}
			}
		});



	});
</script>


</html>



