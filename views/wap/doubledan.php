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

	<?php echo $this->render('header2', ['menuId'=>'menu4','title' => '上网卡']); ?>

	<div data-role="content">

		<?php if($cid==805) {?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>苹果Apple iPhone6</p>
			<p>市场价5499元，活动价5499元 iPhone6 机身颜色:银色/深空灰色/金色 运行内存RAM:2GB 机身内存:16GB/64GB/128GB 网络模式:单卡多模 电池容量:1810mAh</p>
		<?php } elseif($cid==813) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>苹果Apple iPhone4S</p>
			<p>市场价2599元，活动价1999元 iPhone4S 机身颜色:白色/黑色 运行内存RAM:512MB 机身内存:8GB 网络模式:单卡双模 电池容量:1420mAh</p>

		<?php } elseif($cid==814) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>苹果Apple iPhone5S</p>
			<p>市场价4699元，活动价4099元 iPhone 5S机身颜色: 银色 金色 深空灰色运行内存RAM: 1GB机身内存: 16GB网络模式: 单卡多模电池容量: 1560mAh</p>

		<?php } elseif($cid==815) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>华为荣耀6</p>
			<p>市场价2199元，活动价1999元 Huawei/华为 H60-L02 白色/黑色 运行内存RAM:3GB 机身内存:16GB 网络模式:双卡多模 电池容量:3100mAh</p>

		<?php } elseif($cid==816) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>小米4</p>
			<p>市场价2199元，活动价2099元 机身颜色:亮白运行 内存RAM:3GB 机身内存:16GB 网络模式:单卡双模 电池容量:3000mah</p>

		<?php } elseif($cid==817) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>三星G5108Q</p>
			<p>市场价1799元，活动价1599元 Samsung/三星 SM-G5108Q 白色/炭灰 运行内存RAM:1GB 机身内存:8GB 网络模式:双卡双模 电池容量:2200mAh</p>

		<?php } elseif($cid==810) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>100元5G本地流量上网卡</p>
			<p>市场价100元，活动价80元 联通3G上网卡套餐:60元/月移动卡号 发行地区:湖北 本地流量所在省:湖北 本地流量所在市:襄阳 内含资费: 月卡（含一个月资费）网速: 42M  是否包含设备:否 本地流量:归属地当地流量5G流量 全国漫游:仅限省内</p>	

		<?php } elseif($cid==811) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>3G半年卡</p>
			<p>市场价300元，活动价240元 通3G上网卡套餐:3GB/半年移动卡号 发行地区:湖北本地流量所在省:湖北 内含资费: 半年卡（含半年资费） 网速:42M 是否包含设备:否 本地流量:国内流量3GB 全国漫游:可漫游</p>	

		<?php } elseif($cid==812) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>6G年卡</p>
			<p>市场价600元，活动价480元 联通3G上网卡套餐:600元包6GB全年全国流量卡 移动卡号发行地区:湖北 本地流量所在省:湖北 内含资费:年卡（含整年资费）网速:42M 是否包含设备:否 本地流量:全国流量6GB 全国漫游:无全国漫游</p>	
		<?php } elseif($cid==808) { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
			<p>45G 上网卡</p>
			<p>市场价600元，活动价480元 联通3G上网卡套餐:其他套餐 移动卡号发行地区: 湖北本地流量所在省:湖北本地 内含资费:年卡（含整年资费）网速:42M 是否包含设备:否 无本地流量:40G省内流量 全国漫游:5G国内流量</p>
		<?php } else { ?>
			<img src="../web/show_res/doubledan-head.jpg?v1" width="100%">
				<p>96G 上网卡</p>
				<p>市场价1000元，活动价800元 联通3G上网卡套餐:全国+省内套餐移动 卡号发行地区:湖北 本地流量所在省:湖北 恩施内含资费: 年卡（含整年资费）网速:42M 是否包含设备:否 本地流量:90G省内流量 全国漫游:6G国内流量</p>
		<?php } ?>

		<div class="ui-field-contain">
			<input type="text" name="username" id="username" placeholder="姓名" data-mini=false value="">
			<input type="tel" name="usermobile" id="usermobile" placeholder="手机号码" value="">

			<?php if(($cid==805)||($cid==813)||($cid==814)||
					($cid==815)||($cid==816)||($cid==817) ) { ?>
				<?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false),["id"=>"office"]); ?>
			<?php } ?>

		</div>
		
		<a href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">预约订购</a>
		
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

	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/doubledaninfo:'.Yii::$app->wx->getGhid());

	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	//$title = strip_tags($item->title);
	//$desc = strip_tags($item->title_hint);
	$title = strip_tags('上网卡');
	$desc = strip_tags('上网卡');
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

		//alert(cid);
		if((cid==805)||(cid==813)||(cid==814)||
			(cid==815)||(cid==816)||(cid==817))
		{
			office = $("#office").val();
			if(office==0)
			{
				fillErrmsg('#popupDialog-contactPage-txt','请选择营业厅.');
				$('#popupDialog-contactPage').popup('open');
				return  false;
			}
		}
		else
		{
			office = "<?php echo $_GET['office'];?>";
		}

		var urlStr= "&cid="+cid+"&cardType="+cardType+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid+"&address="+address;

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			data: $("form#productForm").serialize() + urlStr,
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
