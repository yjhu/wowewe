<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
	use app\models\MItem;

	$cid=$_GET['cid'];
?>

<style type="text/CSS">

.ui-content {
    padding: 0.5em !important;
}

.ui-header .ui-title, .ui-footer .ui-title {
    margin-right: 0 !important; margin-left: 0 !important;
}

/*-------------------------------*/
.title_comm
{
    color:#aaaaaa;
    font-size: 10pt;
}

</style>
	

<div data-role="page" id="page1" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu4','title' => '双旦狂欢季秒杀']); ?>

	<div data-role="content">

		<?php if($cid==814) {?>
			<img src="../web/show_res/iphone5smiaosha-head.jpg" width="100%">
			<p>苹果Apple iPhone5S</p>
			<p>市场价4699元，秒杀价3799元 iPhone5S机身颜色:银色/金色/深空灰色 运行内存RAM:1GB 机身内存:16GB 网络模式:单卡多模 电池容量:1560mAh</p>
		<?php } else { ?>
			<img src="../web/show_res/samsungnote3miaosha-head.jpg" width="100%">
				<p>三星Note3</p>
				<p>市场价4999元，秒杀价3999元 三星GALAXY Note3 机身颜色:简约白 玫瑰金运行内存RAM:3GB 机身内存:16GB 网络模式:单卡多模 电池容量:3200mAh</p>
		<?php } ?>

		<div class="ui-field-contain">
			<input type="text" name="username" id="username" placeholder="姓名" data-mini=false value="">
			<input type="tel" name="usermobile" id="usermobile" placeholder="手机号码" value="">
		</div>
		
		<a href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">秒杀抢购</a>
		
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2015</h4>
	</div>

	<div data-role="popup" id="popupDialog-contactPage" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
		<div data-role="header" data-theme="c">
		<h1>温馨提示</h1>
		</div>
		<div role="main" id="popupDialog-contactPage-txt" class="ui-content">
			<span class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext'><span><p>姓名输入有误，请重新填写。</p>
		    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确认</a>

		</div>
	</div>

	<!--
	<//?php echo $this->render('menu', ['menuId'=>'menu4','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
	-->

</div>

<?php

	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];

	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/doubledanmiaoshainfo:'.Yii::$app->wx->getGhid());

	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	//$title = strip_tags($item->title);
	//$desc = strip_tags($item->title_hint);
	$title = strip_tags('双旦狂欢季秒杀');
	$desc = strip_tags('双旦狂欢季秒杀');
?>

<script>
	var dataForWeixin={
		appId:"<?php echo $appid; ?>",
		MsgImg:"<?php echo $myImg; ?>",
		TLImg:"<?php echo $myImg; ?>",
		url:"<?php echo $url; ?>",
		title:"<?php echo $title; ?>",
		desc:"<?php echo $desc; ?>",
		fakeid:"",
		prepare:function(argv) {	},
		callback:function(res){	 }
	};
</script>

<script>
var  currentPage = 1; /*init page num*/
var size = 8;
var feeSum = 0;
var count = 0;
//$().ready(function() {
var cid = "<?php echo $cid; ?>";


function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}

$(document).on("pageinit", "#page1", function(){

	var cardType = 0;

	//submit form
	$('#submitBtn').click(function(){

        //避免重复提交表单！！！
        //$("#submitBtn").hide();
        
		selectNum = null;
		office = null;
		//username = null;
		//usermobile = null;

		userid = null;
		address = null;
		username = $("#username").val();
		usermobile = $("#usermobile").val();

		office = "<?php echo $_GET['office'];?>";
 		realFee = "<?php echo $_GET['realFee'];?>";
 		cardType = null;

   
      	var usernameReg = /^[\u4E00-\u9FFF]+$/;
		if(usernameReg.test(username) === false)
		{
			fillErrmsg('#popupDialog-contactPage-txt','姓名输入不合法, 请重新输入.');
			$('#popupDialog-contactPage').popup('open');
			//alert("姓名输入不合法");
			return  false;
		} 

		var usermobileReg = /(^(1)\d{10}$)/;
		if(usermobileReg.test(usermobile) === false)
		{
			fillErrmsg('#popupDialog-contactPage-txt','手机号码输入不合法, 请重新输入.');
			$('#popupDialog-contactPage').popup('open');
			//alert("手机号码输入不合法");
			return  false;
		}

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			data: $("form#productForm").serialize() +"&cid="+cid+"&cardType="+cardType+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid+"&address="+address,
			success:function(json_data){
				//data = eval('('+data+')');
				if(json_data.status == 0)
				{
					localStorage.setItem("oid",json_data.oid);
					localStorage.setItem("url",json_data.pay_url);

					//localStorage.removeItem("num");
					var url = "<?php echo Url::to(['wap/orderinfo'], true); ?>";
					
					$.mobile.changePage((url+'&oid='+json_data.oid),{transition:"slide"});
					//location.href=url+'&oid='+json_data.oid;
				}
				else
				{
					return false;
				}
			}
		});
        /*end of ajax*/
        return false;
	});

});


function fillErrmsg(id,errmsg)
{
	 $(id).html("<p><a href='#' class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext ui-btn-inline'>Alert</a>"+errmsg+"</p><a href='#' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-rel='back'>确认</a>");
}


</script>	
<?php
/*

*/
?>
