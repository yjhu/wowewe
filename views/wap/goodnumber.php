<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\MItem;
use app\assets\JqmAsset;
JqmAsset::register($this);

use app\models\U;
use app\models\MOffice;
$gh_id = Yii::$app->session['gh_id'];

$item = \app\models\MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$cid]);
if ($item === null)
{
	U::W("impossible! gh_id=$gh_id, cid=$cid .............");
}
//U::W($item);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style type="text/CSS">
		.tabSumm
		{
			color:#00C;
		}
		.keyword
		{
			color: red;
			background-color: yellow;
		}
		.highlight
		{
			color: red;
			background-color: yellow;
		}

		.productPkgHint
		{
			color: #cccccc;
			font-size: 10pt;
		}

		.fee
		{
			font-size: 18px;
			color:#ff8600;
			font-weight:  bolder;
		}

		.title_hint
		{
			color:red;
			font-size: 9pt;
		}

		.ui-content {
			padding: 0.5em !important;
		}

		.TabbedPanelsContent {
			padding: 0.1em  !important;
		}

		#seleNum_hint
		{
			color:red;
			font-size: 13pt;
		}
		.n1
		{
			font-size: 12pt;
			font-weight: bolder;
		}
		.n2
		{
			font-size: 10pt;
			background-color: red;
		}
		.n3
		{
			font-size:10pt;
			color: #0033cc;
		}

	</style>

	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div data-role="page" id="page2" data-theme="e">

	<div data-role="header">

		<h1 id="title">
			精选靓号
		</h1>

	</div>

	<div data-role="content">
		<form id="productForm">
			<div data-role="content" data-theme="e">
				<p  align=center id="imgURL">
					<img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
				</p>

				<a  id="sel-num" href="#number-select" class="ui-btn">请选择手机号码</a>


						<div id="TabbedPanels1" class="TabbedPanels">
							<ul class="TabbedPanelsTabGroup">
								<li class="TabbedPanelsTab" tabindex="0" id="Title66">月消费66元</li>
								<li class="TabbedPanelsTab" tabindex="0" id="Title96">月消费96元</li>
								<li class="TabbedPanelsTab" tabindex="0" id="Title126">月消费126元</li>
							</ul>
							<div class="TabbedPanelsContentGroup">
								<div class="TabbedPanelsContent">
									<div role="main" class="ui-content">
										<fieldset data-role="controlgroup">
											<legend>套餐类型</legend>
											<input type="radio" name="plan66" id="plan66_0" value="0"  checked />
											<label for="plan66_0">A计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan66" id="plan66_1" value="1" />
											<label for="plan66_1">B计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan66" id="plan66_2" value="2" />
											<label for="plan66_2">C计划&nbsp;&nbsp;</label>
										</fieldset>
										<p id="plan66-show">&nbsp;</p>

									</div><!-- /content -->
								</div>

								<div class="TabbedPanelsContent">
									<div role="main" class="ui-content">
										<fieldset data-role="controlgroup">
											<legend>套餐类型</legend>
											<input type="radio" name="plan96" id="plan96_0" value="0"  checked />
											<label for="plan96_0">A计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan96" id="plan96_1" value="1" />
											<label for="plan96_1">B计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan96" id="plan96_2" value="2" />
											<label for="plan96_2">C计划&nbsp;&nbsp;</label>
										</fieldset>
										<p id="plan96-show">&nbsp;</p>

									</div><!-- /content -->
								</div>

								<div class="TabbedPanelsContent">
									<div role="main" class="ui-content">
										<fieldset data-role="controlgroup">
											<legend>套餐类型</legend>
											<input type="radio" name="plan126" id="plan126_0" value="0"  checked />
											<label for="plan126_0">A计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan126" id="plan126_1" value="1" />
											<label for="plan126_1">B计划&nbsp;&nbsp;</label>
											<input type="radio" name="plan126" id="plan126_2" value="2" />
											<label for="plan126_2">C计划&nbsp;&nbsp;</label>
										</fieldset>
										<p id="plan126-show">&nbsp;</p>

									</div><!-- /content -->
								</div>

							</div>
						</div>

						<a href="#contactPage" class="ui-btn">用户信息</a>

						<?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false)); ?>

						<input type="button" value="确认订单" id="submitBtn">

						<br>

					</div>
				</div>
		</form>
	</div>

	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

</div> <!-- page2 end -->


<div data-role="page" id="page3" data-theme="e">
	<div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
		<h1 id="title"><?php echo  $item->title; ?></h1>
	</div>

	<div data-role="content">

		<h2>订单详情</h2>
		<p id="oid"></p>

		<p><?php echo  $item->title_hint; ?></p>
		<p id="selectNum">号码：13545296480</p>
		<p id="office"></p>
		<p id="contact"></p>

		<p align="right" >
			合计
			<span  id="total" style="font-size: 18px; color:#ff8600; font-weight:  bolder">
			 ￥ 50
			</span>
		</p>

		<!--
		<br>
		<p>
		<input type="button" value="确认订单" id="payBtn">
		</p>
		-->
		<!--
		<a href="#page2" class="ui-btn">我alreadyWin了</a>
		-->
		<a data-ajax=false href="<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/home' ; ?>" class="ui-btn">我知道了</a>


		<!--
		<p id="url"></p>
		-->

	</div>

	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>	<!-- page3 end -->


<div data-role="page" id="contactPage" data-theme="e">
	<div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
		<h1 id="title"><?php echo  $item->title; ?></h1>
	</div>

	<div data-role="content">

		<h2>用户信息</h2>
		<div class="ui-field-contain">
			<!--
			<label for="username">姓名</label>
			-->
			<input type="text" name="username" id="username" placeholder="姓名" value="">

			<input type="text" name="usermobile" id="usermobile" placeholder="手机号码" value="">

			<input type="text" name="userid" id="userid" placeholder="身份证号码" value="">
		</div>

		<input type="button" value="确认" id="addContactBtn">

	</div>

	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>	<!-- contactPage end -->


<div data-role="page" id="number-select" data-theme="e">
	<div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
		<h1><?php echo  $item->title; ?></h1>
	</div>

	<div data-role="content">
		<h2>请您选择手机号码</h2>
		<p id="seleNum_hint"></p>

		<div class="ui-grid-a" id="list_common_tbody">
			<!--
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >13545296480</a></div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >33333333333</a></div></div>
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >77777777777</a></div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >55555555555</a></div></div>
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >66666666666</a></div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >88888888888</a></div></div>
		-->
		</div><!-- /grid-->

		<p>
			<input type="button" value="换一批号码看看" id="seleNumBtn">
		</p>

	</div>


	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>	<!-- page3 end -->

<?php
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/goodnumber:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '精选靓号';
	$desc = '手机靓号，您值得拥有。靓号有限，先抢先得啦...';
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

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<script>
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>

<script>
var  currentPage = 1; /*init page num*/
var size = 8;
var feeSum = 0;
var count = 0;

planFlag = 'plan66';
//$().ready(function() {
var cid = <?php echo $cid; ?>;

function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}


$(document).on("pageshow", "#page2", function(){

	var cardType = 0;

	function showSelectedNumber()
	{
		if(localStorage.getItem("num") != null)
		{
			$("#sel-num")[0].innerHTML="您选的号码 "+localStorage.getItem("num");
		}
	}
	showSelectedNumber();
	$("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
	$("[name=plan66]").click(function(){
		planFlag = 'plan66';
		//alert($(this).val());
		if($(this).val() == 0) /*plan a*/
			$("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
		else if($(this).val() == 1)
			$("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
		else if($(this).val() == 2)
			$("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
		else
			$("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

	});

	$("[name=plan96]").click(function(){
		//alert($(this).val());
		planFlag = 'plan96';
		if($(this).val() == 0) /*plan a*/
			$("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
		else if($(this).val() == 1)
			$("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
		else if($(this).val() == 2)
			$("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
		else
			$("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

	});

	$("[name=plan126]").click(function(){
		//alert($(this).val());
		planFlag = 'plan126';
		if($(this).val() == 0) /*plan a*/
			$("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
		else if($(this).val() == 1)
			$("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
		else if($(this).val() == 2)
			$("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
		else
			$("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

	});


	//submit form
	$('#submitBtn').click(function(){

		if( localStorage.getItem("num") == null)
		{
			$.mobile.changePage("#number-select",{transition:"slide"});
			return false;
		}
		else
		{
			selectNum = localStorage.getItem("num");
		}

		if($("[name=office]").val() == 0)
		{
			alert("请选择营业厅");
			return false;
		}

        if( localStorage.getItem("username") == null)
        {
            $.mobile.changePage("#contactPage",{transition:"slide"});
            return false;
        }
        else
        {
	        username = localStorage.getItem("username");
	        usermobile = localStorage.getItem("usermobile");
	        userid = localStorage.getItem("userid");
        }


		if((localStorage.getItem('ychf')/100) >= 50)
			realFee = localStorage.getItem('ychf')/100;
		else
			realFee = 50;

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			data: $("form#productForm").serialize() +"&cid="+cid+"&planFlag="+planFlag+"&feeSum="+realFee+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid,
			success:function(data){
				//data = eval('('+data+')');
				if(data.status == 0)
				{
					//alert(data.oid);
					localStorage.setItem("oid",data.oid);
					localStorage.setItem("url",data.pay_url);
					$.mobile.changePage("#page3",{transition:"slide"});
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


$(document).on("pageshow", "#page3", function(){

	var selectNum = localStorage.getItem("num");
	$("#selectNum").html("号码: "+selectNum);
	/*remove seleted mobile number from client*/
	localStorage.removeItem("num");
	
	office_name = <?php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

	var item = localStorage.getItem("item");
	item_new = item.replace(/&/g, ";") +';';
	eval(item_new);

	$("#office").html('所选营业厅: ' +office_name[office] );
	$("#contact").html('用户信息<br>' +'姓名: '+ localStorage.getItem("username")+'<br>手机: '+ localStorage.getItem("usermobile")+'<br>身份证: '+ localStorage.getItem("userid")  );


	var url = localStorage.getItem("url");
	//$("#url").html("<a href='"+url+"'>Pay</a>");

	$("#payBtn").click(function(){
		//1.verfy  address

		//2. submit form
		//alert('pay ok');
		/*
		 $.ajax({
		 url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
		 type:"GET",
		 data: $("form#productForm").serialize() +"&feeSum="+feeSum,
		 success:function(data){
		 data = eval('('+data+')');
		 if(data.status == 0)
		 {
		 //alert(data.oid);
		 localStorage.setItem("oid",data.oid);
		 localStorage.setItem("url",data.pay_url);
		 $.mobile.changePage("#page3",{transition:"slide"});
		 }
		 else
		 {
		 return false;
		 }
		 }
		 });
		 */

		if (isWeiXin()) {
			var text = window.navigator.userAgent;
			if (text.indexOf("Android") >= 0) {
				alert('您的订单已经生成.');
				//alert("你的手机系统是：安卓");
			} else if (text.indexOf("iPhone") >= 0) {
				//alert("你的手机系统是：苹果");
				location.href=url;
			} else if (text.indexOf("iPad") >= 0) {
				location.href=url;
			}
			else {
				alert("尚未识别您的手机");
			}
		} else {
			alert("尚未识别您的手机");
		}

	}); /*end of pay submit*/

});

/*用户信息*/
$(document).on("pageshow", "#contactPage", function(){

	if(localStorage.getItem('username') != '')
		$('#username').val(localStorage.getItem('username'));
	if(localStorage.getItem('usermobile') != '')
		$('#usermobile').val(localStorage.getItem('usermobile'));
	if(localStorage.getItem('userid') != '')
		$('#userid').val(localStorage.getItem('userid'));

	//alert('here is contact page');
	$("#addContactBtn").click(function(){
		var username = $('#username').val();
		var usermobile = $('#usermobile').val();
		var userid = $('#userid').val();


		var usernameReg = /^[\u4E00-\u9FFF]+$/;
		if(usernameReg.test(username) === false)
		{
			alert("姓名输入不合法");
			return  false;
		}
		var usermobileReg = /(^(130|131|132|133|134|135|136|137|138|139)\d{8}$)/;
		if(usermobileReg.test(usermobile) === false)
		{
			alert("手机号码输入不合法");
			return  false;
		}
		var useridReg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
		if(useridReg.test(userid) === false)
		{
			alert("身份证输入不合法");
			return  false;
		}

		localStorage.setItem('username',username);
		localStorage.setItem('usermobile',usermobile);
		localStorage.setItem('userid',userid);

		$.mobile.changePage("#page2",{transition:"slide"});
	});

});


$(document).on("pageshow", "#number-select", function(){

	function loadData(i, n)
	{
		count++;
		cssStr1 = 'ui-bar ui-bar-a';
		cssStr = "style='height:60px;'";
		if( localStorage.getItem("num") != null)
		{
			if(n.num == localStorage.getItem("num"))
				cssStr = "style='height:60px; background-color:red'";
			else
				cssStr = "style='height:60px;'";
		}

		var params = n.num+'-'+ n.ychf+'-'+ n.zdxf;
		//var userNum = n.num;
		var userNum = '<div class=n1>'+ n.num+'<div><span class=n2>靓号</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class=n3>预存 ￥'+ n.ychf+'</span></div></div>';
		var numInfo = '<a  myParams='+params+'>'+userNum+'</a>';


		if(i%2 == 0)
			var text = '<div class=ui-block-a><div class='+cssStr1+cssStr+'>'+numInfo+'</div></div>';
		else
			var text = '<div class=ui-block-b><div class='+cssStr1+cssStr+'>'+numInfo+'</div></div>';


		$("#list_common_tbody").append(text).trigger('create');

	}

	feeSum = <?php echo  ($item->price)/100; ?>;
	function getNumberList()
	{
		$("#list_common_tbody").html('');

		$.ajax({
			url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'mobileNum'], true) ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			//data: $("form#productForm").serialize() +"&feeSum="+feeSum,
			data: "&currentPage="+currentPage+"&size="+size+"&cid="+cid+"&feeSum="+feeSum,
			success: function(json_data){
				//var json_data = eval('('+msg+')');
				if(json_data)
				{
					$.each(json_data, loadData);
				}
				if(json_data.length < 8)
					currentPage =1;
			}
		});
	}


	$.ajax({
		url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'diskRestCnt'], true) ; ?>",
		type:"GET",
		data: "&cid="+cid,
		dataType: "json",
		success: function(json_data){
			//json_data. ???????
			//getNumberList();

			if (json_data.alreadyWin == 1)
			{
				// 可以选号码
				$('#seleNum_hint').html('中奖了！恭喜您。 请把握机会，尽快选择靓号哟~');
				getNumberList();
			}
			else if (json_data.cnt > 0)
			{
				//alert('去转盘');
				//$.mobile.changePage("<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/disk' ; ?>",{transition:"slide", reloadPage:true});
				window.location = '<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/disk' ; ?>';
			}
			else
			{
				//。。。
				alert('明天再来抽奖！');
				$('#seleNumBtn').attr('disabled','disabled');

				return false;
			}

		}
	});

	$(document).on("click",".ui-grid-a a",function(){
		cardInfo = $(this).attr('myParams').split('-');
		localStorage.setItem("num",cardInfo[0]);
		localStorage.setItem("ychf",cardInfo[1]);
		localStorage.setItem("zdxf",cardInfo[2]);
		$.mobile.changePage("#page2",{transition:"slide"});
	});

	$("#seleNumBtn").click(function(){
		// alert("换一批号码看看, 玩命加载中...");
		currentPage++;
		getNumberList();

	});


});

</script>
<?php
/*

*/
?>
