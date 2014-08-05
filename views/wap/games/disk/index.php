
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
$this->title = '幸运大转盘';
$assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/disk/assets';

//$gh_id = Yii::$app->session['gh_id'];
//$openid = Yii::$app->session['openid'];
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');
U::W($gh_id);
U::W($openid);
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

    /**/
    $.ajax({
        url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'diskpermission  '], true) ; ?>",
        type:"GET",
        cache:false,
        data: "&openid="+'<?php echo $openid; ?>'+"&gh_id="+'<?php echo $gh_id; ?>',
        success: function(msg){
            alert('我有资格转盘子...');


				var a = <?php echo $rotateParam['angle']; ?>;
				var name = "<?php echo $rotateParam['name']; ?>";
				var value = <?php echo $rotateParam['value']; ?>;

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
												if (value%2 == 0)
												{
													var res = 'ok';
												}
												else
													var res = 'sorry';
												alert(name + ':' + value + res );
/*
                                                    alert('告诉服务器该用户转了盘子...');
                                                    $.ajax({
                                                        url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'diskresult'], true) ; ?>",
                                                        type:"GET",
                                                        cache:false,
                                                        data: "&openid="+'<?php echo $openid; ?>'+"&gh_id="+'<?php echo $gh_id; ?>',
                                                        success: function(msg){
                                                            //var json_data = eval('('+msg+')');
                                                            alert('aaaaaaaaaaaaaaaaaa');
                                                        }
                                                    });
*/

                                }
                            });
                        }
                    }
                });
        }/*end of first ajax request for diskpermission */
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


