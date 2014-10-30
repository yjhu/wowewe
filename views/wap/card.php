<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
	use app\models\MItem;

    $item = \app\models\MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$cid]);
    //U::W($item);
?>

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
    color: #aaaaaa;
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
    color:#000000;
    font-size: 10pt;
}

.ui-content {
    padding: 0.5em !important;
}

.TabbedPanelsContent {
    padding: 0.1em  !important;
}

.ui-select-num{
    font-size: 12px !important;
    margin: .5em 0 !important;
    padding: .5em 0em !important;
}

.n1
{
	font-size: 12pt;
	font-weight: bolder;
}
.n2
{
	font-size: 10pt;
	background-color: yellow;
}
.n3
{
	font-size:10pt;
	color: #0033cc;
}

.ui-btn .ui-btn-green
{
	background-color: #44B549;
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

.title_unset
{
    color:#ff4c01;
    font-size: 10pt;
}

.title_set
{
    color:#aaaaaa;
    font-size: 10pt;
}

.title_set_content
{
	color:#000000;
    font-size: 10pt;
    text-align: right;
}


</style>
	


<div data-role="page" id="page2" data-theme="c">

	<?php echo $this->render('header1', ['menuId'=>'menu2','title' => $item->title]); ?>
	
	<div data-role="popup" id="popupErrorMsg" data-theme="c">
	<p id="errorMsg"></p>
	</div>

	<form id="productForm">	
	<div data-role="content" data-theme="c">	
	<p  align=center id="imgURL">
	    <img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
	</p>

    <p id="desc">
            <!--【校园专享】沃派校园卡 26元/月 享500M省内流量-->
            <?php echo  $item->title_hint; ?>
    </p>

    <p id="price" class="title_comm">
		价格  <span class="fee">￥<?php echo  ($item->price)/100; ?></span>
		
		<br>
		<span id="priceHint" class="productPkgHint"><?php echo $item->price_hint; ?></span>
	
    </p>


    	<input type="hidden" name="productPkg" vaule="0">
		<!--
        <div class="ui-corner-all custom-corners">
        <div data-role="fieldcontain">
        <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
            <legend>套餐</legend>
            <input type="radio" name="productPkg" id="radio-choice-h-2a" value="0" checked="checked">
            <label for="radio-choice-h-2a" id="productPkgName"> <?//php echo  $item->pkg_name; ?></label>
        </fieldset>
        </div>
        <p id="productPkgHint" class="productPkgHint">
            <?//php echo  $item->pkg_name_hint; ?>
        </p>
        -->

		<!-- kind == 4 流量包 -->
		<?php if($item->kind == 4) {?>
			<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
			  <!--<legend class="title_comm">开通</legend>-->

			  <input type="radio" name="kaitong" id="radio1_1" value="立即开通" checked />
			  <label for="radio1_1">立即开通</label>
			  <input type="radio" name="kaitong" id="radio1_2" value="次月开通" />
			  <label for="radio1_2">次月开通</label>
			</fieldset>

			<input type="hidden" name="cardType" vaule="0">
		<?php } else { ?>
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
		  <legend class="title_comm">卡类型</legend>

		  <input type="radio" name="cardType" id="radio1_0" value="0" checked />
		  <label for="radio1_0">普通卡</label>
		  <input type="radio" name="cardType" id="radio1_1" value="1" />
		  <label for="radio1_1">Micro卡</label>
		  <input type="radio" name="cardType" id="radio1_2" value="2" />
		  <label for="radio1_2">Nano卡</label>

		<a href="#popupInfo" data-rel="popup" data-transition="pop" class="my-tooltip-btn ui-btn ui-alt-icon ui-nodisc-icon ui-btn-inline ui-icon-info ui-btn-icon-notext" title="help">help</a></p>
		<div data-role="popup" id="popupInfo" class="ui-content" data-theme="a" style="max-width:350px;">
		<img width="100%" style="display:block" src="../web/images/item/card.jpg" alt=""/>
		</div>
		</fieldset>
		<?php } ?>



	  <br>

    <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">

		<li id="detail-li">
			<a href="#detail">
			<p class="title_comm">产品详情</p>
			</a>
		</li>

		<li id="sel-num-li">
			<a href="#number-select">
			<p id="sel-num" class="title_unset">请选择手机号码</p>
			</a>
		</li>

		<li id="contact-li">
			<a href="#contactPage" data-ajax="false">
			<p id="contact" class="title_unset">用户信息</p>
			</a>
		</li>

		<li id="address-li">
			<a href="#addressPage" data-ajax="false">
			<p id="address" class="title_unset">收货地址</p>
			</a>
		</li>

		<li id="office-li">
			<a href="#office-select">
			<p id="officeName" class="title_unset">营业厅</p>
			</a>
		</li>

    </ul>
	
	<br>
	<br>

	<!-- kind == 4 流量包 -->
	<?php if($item->kind == 4) {?>
		<a  href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">确认</a>
	<?php } else { ?>
		<a  href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">一键购买</a>
	<?php } ?>

	<br>

</div>
</form>		
	
<div data-role="footer">
	<h4>&copy; 襄阳联通 2014</h4>
</div>
<?php echo $this->render('menu', ['menuId'=>'menu2','gh_id'=>$gh_id, 'openid'=>$openid]); ?>

</div> <!-- page2 end -->



<div data-role="page" id="contactPage" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu4','title' => $item->title]); ?>

	<div data-role="content">

		<h2>用户信息</h2>
		<div class="ui-field-contain">

		 	<!-- only for test -->
		 	<!--
		 	<label for="file">File:</label>
			<input type="file" name="file" id="file" value="">
			-->

			<input type="text" name="username" id="username" placeholder="姓名" data-mini=false value="">
			<?php //为虚拟物品 如流量包时，不需收货地址，但是需要用户填写充值的手机号码
				if($item->kind == 4) {
			?>
				<input type="tel" name="usermobile" id="usermobile" placeholder="手机号码" value="">
			<?php } ?>
			<input type="text" name="userid" id="userid" placeholder="身份证号码" value="">
		</div>

		<input type="button" value="确认" id="addContactBtn">

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
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

	<?php echo $this->render('menu', ['menuId'=>'menu4','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	<!-- contactPage end -->


<div data-role="page" id="number-select" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu5','title' => $item->title]); ?>

	<div data-role="content">
		<h3>请选择手机号码</h3>
        <div class="ui-grid-a" id="list_common_tbody">
        <!--
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >13545296480</a></div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >33333333333</a></div></div>
        <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >77777777777</a></div></div>
        <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >55555555555</a></div></div>
        <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >66666666666</a></div></div>
        <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >88888888888</a></div></div>
        -->
		</div>

        <p>
            <input type="button" value="换一批号码看看" id="seleNumBtn">
        </p>

	</div>


	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu5','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	<!-- number-select end -->


<div data-role="page" id="detail" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu6','title' => $item->title]); ?>

	<div data-role="content">
 		<?php echo  $item->detail; ?>
	</div>

	<div data-role="footer">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu6','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<div data-role="page" id="office-select" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu7','title' => $item->title]); ?>

	<div data-role="content">
			<?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false),["id"=>"office"]); ?>
        <p>
            <input type="button" value="确定" id="seleOffice">
        </p>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu7','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<!-- 用户收货地址 -->
<div data-role="page" id="addressPage" data-theme="c">

	<?php echo $this->render('header2', ['menuId'=>'menu8','title' => $item->title]); ?>

	<div data-role="content">

		<h2>收货地址</h2>
		<div class="ui-field-contain">
			<input type="tel" name="usermobile1" id="usermobile1" placeholder="手机号码" value="">

			<input type="text" name="addr" id="addr" placeholder="省市区街道-邮政编码" data-mini=false value="">
		</div>

		<input type="button" value="确认" id="addAddressBtn">

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

	<div data-role="popup" id="popupDialog-addressPage" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
		<div data-role="header" data-theme="c">
		<h1>温馨提示</h1>
		</div>
		<div role="main" id="popupDialog-addressPage-txt" class="ui-content">
			<span class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext'><span><p>地址输入有误，请重新填写。</p>
		    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确认</a>
		</div>
	</div>

	<?php echo $this->render('menu', ['menuId'=>'menu8','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	<!-- addressPage end -->



<?php

	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];

	if($cid == MItem::ITEM_CAT_CARD_WO)
		$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/cardwo:'.Yii::$app->wx->getGhid());
	else if($cid == MItem::ITEM_CAT_CARD_XIAOYUAN)
		$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/cardxiaoyuan:'.Yii::$app->wx->getGhid());
	else
		$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/cardwo:'.Yii::$app->wx->getGhid());

	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = strip_tags($item->title);
	$desc = strip_tags($item->title_hint);
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
var kind = "<?php echo $item->kind; ?>";
var price = "<?php echo $item->price; ?>";


var ctrl_mobnumber = "<?php echo  $item->ctrl_mobnumber; ?>";
var ctrl_userinfo = "<?php echo  $item->ctrl_userinfo; ?>";
var ctrl_office = "<?php echo  $item->ctrl_office; ?>";
var ctrl_supportpay = "<?php echo  $item->ctrl_supportpay; ?>";
var ctrl_address = "<?php echo  $item->ctrl_address; ?>";
var ctrl_detail = "<?php echo  $item->ctrl_detail; ?>";


function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}

$(document).on("pageshow", "#page2", function(){

	/*item ctrl begin --------------------------------------------*/
	if(ctrl_detail == 0)
	{
		$("#detail-li").hide();
	}
	else
	{
		$("#detail-li").show();
	}

	if(ctrl_mobnumber == 0)
	{
		$("#sel-num-li").hide();
	}
	else
	{
		$("#sel-num-li").show();
	}

	if(ctrl_userinfo == 0)
	{
		$("#contact-li").hide();
	}
	else
	{
		$("#contact-li").show();
	}
	
	if(ctrl_office == 0)
	{
		$("#office-li").hide();
	}
	else
	{
		$("#office-li").show();
	}
	

	if(ctrl_address == 0)
	{
		$("#address-li").hide();
	}
	else
	{
		$("#address-li").show();
	}

	/*item ctrl end --------------------------------------------------*/

	if(localStorage.getItem("num") != null)
	{			
		//alert(localStorage.getItem("num"));
		$("#sel-num")[0].innerHTML="选中号码 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+localStorage.getItem("num")+"</span>";
		//$("#sel-num").trigger('create');
		$("#sel-num").removeClass("title_unset").addClass("title_set");
	}

	if(localStorage.getItem("username") != null)
	{			
		$("#contact")[0].innerHTML="用户信息 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+localStorage.getItem("username")+"...</span>";
		$("#contact").removeClass("title_unset").addClass("title_set");
	}
	
	office_name = <?php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

	if(localStorage.getItem("office") != null)
	{
		$("#officeName")[0].innerHTML="营业厅 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+ office_name[localStorage.getItem("office")] +"...</span>";
		$("#officeName").removeClass("title_unset").addClass("title_set");
	}

	if(localStorage.getItem("address") != null)
	{			
		$("#address")[0].innerHTML="收货地址 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+localStorage.getItem("address")+"...</span>";
		$("#address").removeClass("title_unset").addClass("title_set");
	}	
});

$(document).on("pageinit", "#page2", function(){

	var cardType = 0;

	//submit form
	$('#submitBtn').click(function(){

        //避免重复提交表单！！！
        $("#submitBtn").hide();
        
		selectNum = null;
		office = null;
		username = null;
		usermobile = null;
		userid = null;
		address = null;

		if(ctrl_mobnumber != 0)
		{
	        if( localStorage.getItem("num") == null)
	        {
	        	$("#submitBtn").show();
	            //$.mobile.changePage("#number-select",{transition:"slide"});
	            $("#errorMsg").html("<span class='title_unset'>请选择手机号码</span>");
	            $("#popupErrorMsg").popup("open");
	            return false;
	        }
	        else
	        {
	            selectNum = localStorage.getItem("num");
	        }
    	}

        if(ctrl_userinfo != 0)
    	{
	        if( localStorage.getItem("username") == null)
	        {
	        	 $("#submitBtn").show();
	        	//alert("aaa");
	            //$.mobile.changePage("#contactPage",{transition:"slide"});
	            $("#errorMsg").html("<span class='title_unset'>请输入用户信息</span>");
	            $("#popupErrorMsg").popup("open");

	            return false;
	        }
	        else
	        {
		        username = localStorage.getItem("username");
		        usermobile = localStorage.getItem("usermobile");
		        userid = localStorage.getItem("userid");
	        }
    	}
 
        if(ctrl_address != 0)
    	{
	        if( localStorage.getItem("usermobile") == null)
	        {
	        	$("#submitBtn").show();
	            $("#errorMsg").html("<span class='title_unset'>请输入收货信息</span>");
	            $("#popupErrorMsg").popup("open");

	            return false;
	        }
	        else
	        {
		        usermobile = localStorage.getItem("usermobile");
		        address = localStorage.getItem("address");
	        }
    	}

    	if(ctrl_office != 0)
    	{
	        if( localStorage.getItem("office") == null)
	        {
	        	 $("#submitBtn").show();
	            //$.mobile.changePage("#office-select",{transition:"slide"});
	           	$("#errorMsg").html("<span class='title_unset'>请选择营业厅</span>");
	            $( "#popupErrorMsg" ).popup( "open" );
	            return false;
	        }
	        else
	        {
	            office = localStorage.getItem("office");
	        }
        }

       if(kind == 4 || kind == 3)/*流量包 , 上网卡*/
       {
   	 		realFee =  price/100;
       }
       else
       {
			if((localStorage.getItem('ychf')/100) >= 50)
				realFee = localStorage.getItem('ychf')/100;
			else
				realFee = 50;
       }



 		/* realFee = 0.01 */

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			data: $("form#productForm").serialize() +"&cid="+cid+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid+"&address="+address,
			success:function(json_data){
				//data = eval('('+data+')');
				if(json_data.status == 0)
				{
					//alert(data.oid);
					localStorage.setItem("oid",json_data.oid);
					localStorage.setItem("url",json_data.pay_url);

					localStorage.removeItem("num");
					//$.mobile.changePage("#page3",{transition:"slide"}); //page3 removed!
					var url = "<?php echo Url::to(['wap/orderinfo'], true); ?>";
					$.mobile.changePage((url+'&oid='+json_data.oid),{transition:"slide"});
					//window.location.href = url+'&oid='+json_data.oid;
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
/*用户信息*/
$(document).on("pageinit", "#contactPage", function(){

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
			fillErrmsg('#popupDialog-contactPage-txt','姓名输入不合法, 请重新输入.');
			$('#popupDialog-contactPage').popup('open');
			//alert("姓名输入不合法");
			return  false;
		}
	
		<?php //为虚拟物品 如流量包时，不需收货地址，但是需要用户填写充值的手机号码
			if 	($item->kind == 4) {
		?>
			var usermobileReg = /(^(1)\d{10}$)/;
			if(usermobileReg.test(usermobile) === false)
			{
				fillErrmsg('#popupDialog-contactPage-txt','手机号码输入不合法, 请重新输入.');
				$('#popupDialog-contactPage').popup('open');
				//alert("手机号码输入不合法");
				return  false;
			}
		<?php } ?>

		var useridReg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
		if(useridReg.test(userid) === false)
		{
			fillErrmsg('#popupDialog-contactPage-txt','身份证输入不合法, 请重新输入.');
			$('#popupDialog-contactPage').popup('open');
			//alert("身份证输入不合法");
			return  false;
		}

		localStorage.setItem('username',username);
		localStorage.setItem('usermobile',usermobile);
		localStorage.setItem('userid',userid);

		$.mobile.changePage("#page2",{transition:"slide"});
	});

});


/*收货地址*/
$(document).on("pageinit", "#addressPage", function(){

	if(localStorage.getItem('usermobile') != '')
		$('#usermobile1').val(localStorage.getItem('usermobile'));
	if(localStorage.getItem('address') != '')
		$('#addr').val(localStorage.getItem('address'));

	//alert('here is contact page');
	$("#addAddressBtn").click(function(){
		var address = $('#addr').val();
		var usermobile = $('#usermobile1').val();


		var usermobileReg = /(^(1)\d{10}$)/;
		if(usermobileReg.test(usermobile) === false)
		{
			fillErrmsg('#popupDialog-addressPage-txt','手机号码输入不合法, 请重新输入.');
			$('#popupDialog-addressPage').popup('open');
			//alert("手机号码输入不合法");
			return  false;
		}

		//var addressReg = /^[\u4E00-\u9FFF]+$/;
		//if(addressReg.test(address) === false)
		if(address == "")
		{
			fillErrmsg('#popupDialog-addressPage-txt','收货地址输入不合法, 请重新输入.');
			$('#popupDialog-addressPage').popup('open');
			return  false;
		}
		//alert(address);

		localStorage.setItem('usermobile',usermobile);
		localStorage.setItem('address',address);

		$.mobile.changePage("#page2",{transition:"slide"});
	});

});
function load_data2(i, n)
{
	//alert(i);
	//alert(n.office_id+"---"+n.title);
	text = "<option value="+ n.office_id +">"+ n.title+"("+ n.address+")"+"</option>";
	$("#office").append(text).trigger('create');
}


$(document).on("pageinit", "#office-select", function(){

	if (navigator.geolocation)
	    navigator.geolocation.getCurrentPosition(getPositionSuccess, getPositionError, {enableHighAccuracy: true, maximumAge: 60000, timeout: 20000});

	function getPositionSuccess( position ){
	        var lat = position.coords.latitude;
	        var lng = position.coords.longitude;
	        //alert( "您所在的位置： 纬度" + lat + "，经度" + lng );

			var gh_id = "<?= $gh_id ?>";
	        $.ajax({
	            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'getnearestoffice'], true) ; ?>",
	            type:"GET",
		        cache:false,
		        dataType:'json',
	            data: "&gh_id="+gh_id+"&lon="+lng+"&lat="+lat,
	            success: function(json_data){
					//alert('jd');

					$("#office").html('');
	                if(json_data.code == 0)
	                {
						offices = json_data.offices;
						//alert(offices.length);
	                    //$.each(json_data, loadData);

	                    $.each(offices, load_data2);
	                }

	            }
	        });

	}
	 
	function getPositionError(error) {
	/*
	    switch (error.code) {
	        case error.TIMEOUT:
	            alert("连接超时，请重试");
	            break;
	        case error.PERMISSION_DENIED:
	            alert("您拒绝了使用位置共享服务，查询已取消");
	            break;
	        case error.POSITION_UNAVAILABLE:
	            alert("获取位置信息失败");
	            break;
	    }
	*/
	}


	$("#seleOffice").click(function(){
		var office = $('#office').val();

		if(office != 0)
		{
			localStorage.setItem('office',office);
			$.mobile.changePage("#page2",{transition:"slide"});
		}

	});

});

$(document).on("pageinit", "#number-select", function(){

    function loadData(i, n)
    {
        count++;
	    cssStr1 = 'ui-bar ui-bar-a';
	    cssStr = "style='height:60px;'";
        if( localStorage.getItem("num") != null)
        {
            if(n.num == localStorage.getItem("num"))
                cssStr = "style='height:60px; background-color:yellow'";
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

    function getNumberList()
    {
        $("#list_common_tbody").html('');

        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'mobileNum'], true) ; ?>",
            type:"GET",
	        cache:false,
	        dataType:'json',
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
    getNumberList();

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
