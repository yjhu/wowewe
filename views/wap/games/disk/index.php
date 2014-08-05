
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
								//var json_data = eval('('+msg+')');
								//alert(json_data.code);
								json_data = data;
							}
						});

							if (json_data.code == 0)
							{
//								alert('aaaaaaaaaaaaaaaaaa');
								var a = json_data.angle;
								var value = json_data.value;
								var name = json_data.name;
								//alert(a + ":" + name + ":" + value);
								//var a = Math.floor(Math.random() * 360);
								$(this).rotate({
									duration:3000,
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

<div id="main">

   <div class="demo">
        <div id="disk"></div>
        <div id="start">
            <img src="<?php echo "$assetsPath/start.png"; ?>" id="startbtn" style="-webkit-transform: rotate(197deg);">
        </div>
   </div>
</div>


<?php

/*
				var a = <?php echo $rotateParam['angle']; ?>;
				var name = "<?php echo $rotateParam['name']; ?>";
				var value = <?php echo $rotateParam['value']; ?>;

								var has_right = <?php echo MDisk::getDiskQualification($gh_id,$openid); ?>;

*/