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
<title></title>

<?php
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm_flatui/generated/jquery.mobile.flatui.min.css');
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

	<?php $this->head() ?>
</head> 
<body>
<?php $this->beginBody() ?>


<div data-role="page" id="page1" data-theme="e">
	<div data-role="header">
		<h1>八月浪漫季</h1>
	</div>
	<div data-role="content" id="diskstart">

		<img width="100%" src="<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/metro_home_head2.jpg' ?>" alt="八月浪漫季">
		<br><br>
		<div id="disk">
			<img width="100%" src="<?php echo "$assetsPath/disk2.png"; ?>">
		</div>
		<div id="start">
			<img src="<?php echo "$assetsPath/start2.png"; ?>" id="startbtn" style="-webkit-transform: rotate(197deg);">
		</div>
		<div style='position:relative;top:-200px;text-align: left;'>
			<h2>八月浪漫季，情侣靓号等你来！</h2>
			<h3>活动参与</h3>
			<ol>
				<li>关注“襄阳联通”官方微信号；（具体关注方式，如下图所示。）</li>
				<li>摇玫瑰幸运转盘；</li>
				<li>中奖后即可入靓号池选号，N多靓号等你来，520（我爱你），1314（一生一世），9213（就爱一生）......</li>
			</ol>
			<h3>活动规则</h3>
			<ol>
				<li>参与者必须是“襄阳联通”关注用户；</li>
				<li>每个关注用户每天有3次机会摇玫瑰幸运转盘；今天未中，明天再来；</li>
				<li><span style="background-color:#da156d;">深玫瑰格</span>为未中奖，<span style="background-color:#fdd8e0;">浅玫瑰色</span>为中奖；</li>
				<li>中奖用户必须在30分钟内完成选号及订单，24小时内到指定营业厅办理，否则，做弃权处理；</li>
				<li>本活动最终解释权归襄阳联通所有。</li>
			</ol>
		</div>
		<div>
			<img width="100%" src="/wx/web/images/wx-tuiguang2.jpg" alt="">
		</div>

	</div>
	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
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

<?php $this->endBody() ?>
</body>

<?php

	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/css/jquery.home.min.js');
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/jquery.mobile-1.4.3.min.js');
?>

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
									window.location = '<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/goodnumber#number-select' ; ?>';
								}
								else
								{
									//没中奖？？
									//var res = 'sorry';
									//var res = '真可惜，就差一点点！';
									window.location='#dialogPage1';
								}

								//alert(name + ':' + value + res );
								//alert( res );
							}
						});
					}
					else
					{
						//alert(json_data.code+json_data.errmsg);
						alert('您今天的3次抽奖机会都用完了，请明天再来。');
						window.location = '<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/home' ; ?>';
					}

				}
			}
		});



	});
</script>
</html>
<?php $this->endPage() ?>
