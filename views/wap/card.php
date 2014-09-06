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
</style>
	

<div data-role="page" id="page2" data-theme="c">

	<?php echo $this->render('header1', ['menuId'=>'menu2','title' => $item->title]); ?>

	<div data-role="content">
	<form id="productForm">	
	<div data-role="content" data-theme="c">	
	<p  align=center id="imgURL">
	    <img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
	</p>

    <p id="desc">
            <!--【校园专享】沃派校园卡 26元/月 享500M省内流量-->
            <?php echo  $item->title_hint; ?>
        </p>

    <p id="price">
    价格  <span class="fee">￥<?php echo  ($item->price)/100; ?></span>
   <br><span id="priceHint" class="productPkgHint"><!--含预存款50元--> <?php echo  $item->price_hint; ?></span>
    </p>

        <div class="ui-corner-all custom-corners">
        <div data-role="fieldcontain">
        <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
            <legend>套餐</legend>
            <input type="radio" name="productPkg" id="radio-choice-h-2a" value="0" checked="checked">
            <label for="radio-choice-h-2a" id="productPkgName"><!--微信沃卡--> <?php echo  $item->pkg_name; ?></label>
        </fieldset>
        </div>
        <p id="productPkgHint" class="productPkgHint">
            <!--500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G-->
            <?php echo  $item->pkg_name_hint; ?>
        </p>

	  <div data-role="fieldcontain">
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
		  <legend>卡类型</legend>
		  <input type="radio" name="cardType" id="radio1_0" value="0" checked />
		  <label for="radio1_0">普通卡</label>
		  <input type="radio" name="cardType" id="radio1_1" value="1" />
		  <label for="radio1_1">Micro卡</label>
		  <input type="radio" name="cardType" id="radio1_2" value="2" />
		  <label for="radio1_2">Nano卡</label>
		</fieldset>
	  </div>

      <img width="100%" style="display:block" src="../web/images/item/card.jpg" alt=""/>

		<a  id="sel-num" href="#number-select" class="ui-btn">请选择手机号码</a>

        <a href="#contactPage" class="ui-btn">用户信息</a>

		<div id="officeArea">
		<?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false)); ?>
		</div>

		<input type="button" value="确认套餐" id="submitBtn">
		
		<br>
		<div id="TabbedPanels2" class="TabbedPanels">
		  <ul class="TabbedPanelsTabGroup">
			<li class="TabbedPanelsTab" tabindex="0">图文详情</li>
            <!--
			<li class="TabbedPanelsTab" tabindex="0">商品评价</li>
			-->
		  </ul>
		  <div class="TabbedPanelsContentGroup">
			<div class="TabbedPanelsContent">

				<div role="main" class="ui-content">
                    <?php echo  $item->detail; ?>
				</div><!-- /content -->        

			</div>

              <!--
			<div class="TabbedPanelsContent">
				<div role="main" class="ui-content">
				<p> 好好好</p>
				</div>
			</div>
            -->

		  </div>
		</div>       
	</div>
</div>
</form>		
</div>
	
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
			<!--
			<label for="username">姓名</label>
			-->
			<input type="text" name="username" id="username" placeholder="姓名" value="">

			<input type="tel" name="usermobile" id="usermobile" placeholder="手机号码" value="">

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
		<h2>请您选择手机号码</h2>
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


	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
	<?php echo $this->render('menu', ['menuId'=>'menu5','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>	<!-- number-select end -->


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
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>

<script>
var  currentPage = 1; /*init page num*/
var size = 8;
var feeSum = 0;
var count = 0;
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
	if(localStorage.getItem("num") != null)
	{			
		//alert(localStorage.getItem("num"));
		$("#sel-num")[0].innerHTML="您选的号码 "+localStorage.getItem("num");
		//$("#sel-num").trigger('create');
	}
});

$(document).on("pageinit", "#page2", function(){

	var cardType = 0;

	$("[name=office]").change(function(){
        if($("[name=office]").val() != 0)
            $("#officeArea").removeAttr('style');
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
            //alert("请选择营业厅");
            $("#officeArea").attr('style', 'border:1px solid #ffffff;background-color:#ff99ff;');
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
 		/* realFee = 0.01 */

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			cache:false,
			dataType:'json',
			data: $("form#productForm").serialize() +"&cid="+cid+"&feeSum="+realFee+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid,
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
		var usermobileReg = /(^(1)\d{10}$)/;
		if(usermobileReg.test(usermobile) === false)
		{
			fillErrmsg('#popupDialog-contactPage-txt','手机号码输入不合法, 请重新输入.');
			$('#popupDialog-contactPage').popup('open');
			//alert("手机号码输入不合法");
			return  false;
		}
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
