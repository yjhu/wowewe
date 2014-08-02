<?php
	use yii\helpers\Html;
	use yii\widgets\Breadcrumbs;
	use app\assets\JqmAsset;
	JqmAsset::register($this);

    use app\models\U;
    use app\models\MOffice;
    $gh_id = Yii::$app->session['gh_id'];

    $item = \app\models\MItem::findOne(['gh_id'=>$gh_id, 'cid' => $_GET['cid']]);
    U::W($item);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>产品</title>
	<?php 
/*
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/css/themes/default/jquery.mobile-1.4.3.min.css');
	$this->registerCssFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/css/jqm-demos.css'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.js'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/_assets/js/index.js'); 
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/jqm/demos/js/jquery.mobile-1.4.3.min.js'); 
*/
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
</style>
	
<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

	<div data-role="page" id="page2">

		<div data-role="header">
			<h1 id="title">
                <?php echo  $item->title; ?>
            </h1>
		</div>
		
		<div data-role="content">
		<form id="productForm">	
		<div data-role="content" data-theme="d">	
		<p  align=center id="imgURL">
		    <img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
		</p>

        <p id="desc">
            <!--【校园专享】沃派校园卡 26元/月 享500M省内流量-->
            <?php echo  $item->title_hint; ?>
        </p>

        <p id="price">
        价格  ￥<?php echo  ($item->price)/100; ?>
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
						<p id="richtextDesc"></p>
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
		<div id="result"></div>	
	</div> <!-- page2 end -->
	
	
	<div data-role="page" id="page3">
		<div data-role="header">
			<h1 id="title">沃派校园卡</h1>
		</div>
		
		<div data-role="content">

			<h2>订单详情</h2>
			<p id="oid"></p>

            <p id="desc">【校园专享】微信沃卡 永享六大微信特权 预存50得530元话费</p>
            <p id="selectNum">号码：13545296480</p>
            <p id="productPkgName">套餐：微信沃卡</p>
            <p id="addition">赠品：好友推荐最高得100元话费； 微信晒单最高得话费50元</p>

			<p align="right" style="font-size: 18px; color:#ff8600; font-weight:  bolder">
			<span  id="total">
			合计: ￥ 50
			</span>
			</p>	

			<br>
			<p>
			<input type="button" value="立即支付" id="payBtn">
			</p>	
			<!--
			<p id="url"></p>
			-->

		</div>

		<div data-role="footer">
			<h4>&copy; 襄阳联通 2014</h4>
		</div>
	</div>	<!-- page3 end -->	

	

	<div data-role="page" id="number-select">
		<div data-role="header">
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">
			<h2>请您选择手机号码</h2>
			<div class="ui-grid-a">
			<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >13545296480</a></div></div>
			<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >33333333333</a></div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >77777777777</a></div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >55555555555</a></div></div>
            <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >66666666666</a></div></div>
            <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >88888888888</a></div></div>
			</div><!-- /grid-->

            <p>
                <input type="button" value="换一批号码看看" id="seleNumBtn">
            </p>

		</div>


		<div data-role="footer">
			<h4>&copy; 襄阳联通 2014</h4>
		</div>
	</div>	<!-- page3 end -->	
	
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<script>
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>


<script>
//var productPkg = <//?php echo $_GET["productPkg"] ?>;
var  currentPage = 1; /*init page num*/
var feeSum = 0;
//$().ready(function() {

/*
if(productPkg == 0)
{
    //$("#title").html("【校园专享】沃派校园卡");
    $("#imgURL").html("<img width=\"60%\" src=\"http://res.mall.10010.com/mall/res/uploader/temp/20140719115711-1726575840_310_310.jpg\" alt=\"\"/>");
    $("#desc").html("【校园专享】沃派校园卡 26元/月 享500M省内流量 ");

    $("#price").html(" 价格  <span class='fee'>￥50</span>");
    $("#priceHint").html("含预存款50元");

    $("#productPkgName").html("沃派校园套餐");
    $("#productPkgHint").html("500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G ");
    $("#richtextDesc").html("<img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404210955181014136816.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140801164013-1800990032.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140421114304-463429008.jpg\" alt=\"\" />\
                                                <a href=\"http://www.10010.com/pushpage/59800000134189.71.html\" target=\"_blank\"><img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201407201133341283576080.jpg\" alt=\"\" /> </a>\
                                                <a href=\"http://www.10010.com/static/homepage/subjectpage/57100000121535.html\" target=\"_blank\"><img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404091216411015373808.jpg\" alt=\"\" /></a>\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140317125516342466672.jpg\" alt=\"\" />");


}
else if(productPkg == 1)
{
    //$("#title").html("【校园专享】微信沃卡 ");
    $("#imgURL").html("<img width=\"60%\" src=\"http://res.mall.10010.com/mall/res/uploader/temp/20140421101117476467616_310_310.jpg\" alt=\"\"/>");
    $("#desc").html("【校园专享】微信沃卡 永享六大微信特权 预存50得530元话费 500M微信定向流量+500M省内流量");
    $("#productPkgName").html("微信沃卡");

    $("#price").html(" 价格  <span class='fee'>￥50</span>");
    $("#priceHint").html("含预存款50元");

    $("#productPkgHint").html("500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G");
    $("#richtextDesc").html("<img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404210955181014136816.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201407150942461222527408.jpg\" alt=\"\" />\
                                                <a href=\"http://www.10010.com/pushpage/59800000134189.71.html\" target=\"_blank\">\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201407201133341283576080.jpg\" alt=\"\" />\
                                                </a>\
                                                <a href=\"http://www.10010.com/static/homepage/subjectpage/57100000121535.html\" target=\"_blank\">\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140715094313541965008.jpg\" alt=\"\" />\
                                                </a>\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140409121513440614720.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140408222215453828688.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140408222356-1139107584.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404082224242089061808.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140408222436-275090176.jpg\" alt=\"\" /> \
                                                <img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140317125516342466672.jpg\" alt=\"\" />");


}
*/

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
		cardluckNum = localStorage.getItem("cardluckNum");
		if(cardluckNum != null)
		{			
			$("#sel-num")[0].innerHTML="您选的号码 "+cardluckNum;
		}
	}
	showSelectedNumber();


	//submit form
	$('#submitBtn').click(function(){
		//alert('save args to local storage');
		//alert($("form#productForm").serialize());

        if( localStorage.getItem("cardluckNum") == null)
        {
            $.mobile.changePage("#number-select",{transition:"slide"});
            return;
        }
        else
        {
            selectNum = localStorage.getItem("cardluckNum");
        }

        /*
		localStorage.setItem("item",$("form#productForm").serialize())
		$.ajax({
			url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
			data: $("form#productForm").serialize() +"&feeSum="+feeSum+"&selectNum="+selectNum,
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
        $.mobile.changePage("#page3",{transition:"slide"});
        /*end of ajax*/
	   
	});
	
});

$(document).on("pageshow", "#page3", function(){
/*
	flowPack_name = <//?php echo \app\models\MOrder::getFlowPackName(); ?>;
	flowPack_fee =<//?php echo \app\models\MOrder::getFlowPackFee(); ?>;

	var item = localStorage.getItem("item");
	item_new = item.replace(/&/g, ";") +';';

	eval(item_new);
    */
	//alert('流量包'+flowPack_name[flowPack]+"费用"+flowPack_fee[flowPack]);

    /*
	$("#flowPack_name").html(flowPack_name[flowPack]);
	$("#flowPack_fee").html(flowPack_fee[flowPack]+"元");
	
	$("#total").html("合计:"+feeSum+"元");
	
	var oid = localStorage.getItem("oid");
	$("#oid").html("您的订单号: "+oid);
    */

    var selectNum = localStorage.getItem("cardluckNum");
    $("#selectNum").html("号码: "+selectNum);

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

$(document).on("pageshow", "#number-select", function(){

    /*highLlght selected num*/
    if( localStorage.getItem("cardluckNum") != null)
    {
        $('.ui-grid-a').highLight();
        $('.ui-grid-a').highLight(localStorage.getItem("cardluckNum"));
    }

    $(".ui-grid-a a").click(function(){
		//alert($(this).text());
		localStorage.setItem("cardluckNum",$(this).text());
		location.href="#page2";

        /*
		$.ajax({
			url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodnum' ; ?>",
			type:"GET",
			//data: $("form#productForm").serialize() +"&feeSum="+feeSum,
			data: "&currentPage="+currentPage,
			success:function(data){
				data = eval('('+data+')');
				if(data.status == 0)
				{
					//alert(data.oid);
					//localStorage.setItem("oid",data.oid);
					//$.mobile.changePage("#page3",{transition:"slide"});
				}
				else
				{
					return false;
				}
			}
		});
        */
        /*end of ajax*/
	});

    $("#seleNumBtn").click(function(){
        alert("换一批号码看看, 玩命加载中...");
    });


});


</script>	
<?php
/*
	<link rel="stylesheet" href="../css/themes/default/jquery.mobile-1.4.3.min.css">
	<link rel="stylesheet" href="../_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="../favicon.ico">
	<script src="../js/jquery.js"></script>
	<script src="../_assets/js/index.js"></script>
	<script src="../js/jquery.mobile-1.4.3.min.js"></script>
*/
?>
