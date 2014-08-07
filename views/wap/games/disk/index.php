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

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>disk</title>

<?php
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm_flatui/generated/jquery.mobile.flatui.min.css');
?>
<style type="text/css">

#disk {
	position: absolute;
	left: 118px;
	top: 80px;
	width: 137px;
	height: 256px;
	z-index: 1;
	background-image: url(<?php echo "$assetsPath/start.png"; ?>);
	background-size: cover;
}
</style>

	<?php $this->head() ?>
</head> 
<body>
<?php $this->beginBody() ?>


<div data-role="page" id="page1" data-theme="e">
	<div data-role="header">
		<h1>幸运大转盘</h1>
	</div>
	<div data-role="content">
		<div id="disk"></div>
		<div id="start">
		<img src="<?php echo "$assetsPath/disk.png"; ?>" width="336" height="336" id="startbtn" style="-webkit-transform: rotate(197deg);">
		</div>
		</div>
	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>

<?php $this->endBody() ?>
</body>

<!--
<script src="<//?php echo "$assetsPath/jquery.js"; ?> "></script>
-->
<?php

	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/css/jquery.home.min.js');
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/jquery.mobile-1.4.3.min.js');
?>

<script src="<?php echo "$assetsPath/jQueryRotate.2.2.js"; ?> "></script>
<script src="<?php echo "$assetsPath/jquery.easing.min.js"; ?> "></script>
<script type="text/javascript">
	$(function(){
		$("#startbtn").rotate({
			bind:{
				click:function(){
					var json_data;
					//alert('告诉服务器该用户转了盘子...');
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
							duration:10000,
							angle: 0,
							animateTo:1440+a,
							easing: $.easing.easeOutSine,
							callback: function()
							{
								if (value%2 == 0)
								{
									var res = 'ok';
								}
								else
									var res = 'sorry';
								alert(name + ':' + value + res );
							}
						});
					}
					else
					{
						alert(json_data.code+json_data.errmsg);
					}

				}
			}
		});



	});
</script>
</html>
<?php $this->endPage() ?>
