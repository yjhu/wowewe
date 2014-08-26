<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;

use app\assets\JqmAsset;
JqmAsset::register($this);

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<style>
		.orderlist{

		}
	</style>
	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<div data-role="page" id="myorder" data-theme="e">

	<?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '我的订单']); ?>

	<div role="main" class="ui-content">
		<ul data-role="listview" data-inset="false" id="list_common_tbody">
		</ul>

		<br>

		<!--
		<button class="ui-btn ui-btn-inline" id="loadMyOrderListBtnPre">上一页</button>
		<button class="ui-btn ui-btn-inline" id="loadMyOrderListBtnNext">下一页</button>
		-->

		<div class="ui-grid-a">
			<div class="ui-block-a"><a href="#" class="ui-mini ui-shadow ui-btn ui-corner-all" id="loadMyOrderListBtnPre">上一页</a></div>
			<div class="ui-block-b"><a href="#" class="ui-mini ui-shadow ui-btn ui-corner-all" id="loadMyOrderListBtnNext">下一页</a></div>
		</div>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>

<div data-role="page" id="orderdetail" data-theme="e">

	<?php echo $this->render('menu', ['menuId'=>'menu2','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header2', ['menuId'=>'menu2','title' => '我的订单']); ?>

	<div role="main" class="ui-content">
	<h2>订单详情</h2>
		<p><span class="orderlist">订单编号:</span>&nbsp;<span id="oid"></span></p>
		<p><span class="orderlist">订单状态:</span>&nbsp;<span id="status"></span></p>
		<p><span class="orderlist">商品名称:</span>&nbsp;<span id="title"></span></p>
		<p><span class="orderlist">下单时间:</span>&nbsp;<span id="create_time"></span></p>
		<p><span class="orderlist">商品详情:</span>&nbsp;<span id="detail"></span></p>
		<p><span class="orderlist">营业厅:</span>&nbsp;<span id="office_id"></span></p>
		<p><span class="orderlist">价格:</span>&nbsp;￥<span id="feesum"></span></p>
		
		<hr color="#F7C708">
		
		<p><span class="orderlist">用户信息</span></p></li>
		<p><span class="orderlist">姓名:</span>&nbsp;<span id="username"></span></p>
		<p><span class="orderlist">手机号码:</span>&nbsp;<span id="usermobile"></span></p>
		<p><span class="orderlist">身份证:&nbsp;</span><span id="userid"></span></p>
	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<script>
var  currentPage = 1; 
var size = 3;
var count = 0;

var gh_id = '<?php echo $user->gh_id; ?>';
var openid = '<?php echo $user->openid; ?>';

var imgurl = '<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>';

office_name = <?php echo \app\models\MOffice::getOfficeNameOption($user->gh_id); ?>;


function load_data1(i, n)
{
	$("#oid").html(n.oid);
	$("#title").html(n.title);
	$("#create_time").html(n.create_time);
	$("#detail").html(n.detail);
	$("#feesum").html(n.feesum/100);
	$("#username").html(n.username);
	$("#usermobile").html(n.usermobile);
	$("#userid").html(n.userid);
	$("#office_id").html(office_name[n.office_id]);
	if(n.status == 0)
		$("#status").html(n.statusName +"<span style='color:blue' class='qxdd_orderdetail' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span>");
	else
		$("#status").html(n.statusName);
}

function load_data2(i, n)
{
	count++;

	if(n.cid == 0)//自由组合套餐
		imgurl = '../web/images/item/zyzhtc-120x120.jpg';
	else if(n.cid == 12)//AppleiPhone4s
		imgurl = '../web/images/item/iphone4s-120x120.jpg';
	else if(n.cid == 13)//K1
		imgurl = '../web/images/item/coolpad-k1-120x120.jpg';
	else if(n.cid == 14)//HTC
		imgurl = '../web/images/item/htc-d516w-120x120.jpg';
	else if(n.cid == 10)//微信沃卡/普通卡
		imgurl = '../web/images/item/wxwk-120x120.jpg';
	else if(n.cid == 11)//沃派校园套餐/普通卡
		imgurl = '../web/images/item/wpxytc-120x120.jpg';
	else if(n.cid == 300)//精选靓号
		imgurl = '../web/images/item/jxlh-120x120.jpg';

	text ="<li data-theme='c'><a href='#' class='ddxq' myOid='"+n.oid+"'>\
	<img style='padding-top:20px' src='"+imgurl+"'>\
	<p>订单编号:&nbsp;<span color='color:blue'>"+n.oid+"</span></p>\
	<p>下单时间:&nbsp;"+n.create_time+"</p>\
	<p>商品名称:&nbsp;"+n.title+"</p>\
	<p>价格:&nbsp;￥"+(n.feesum)/100+"</p>";

	if(n.status == 0) //wait to pay 
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"<span style='color:blue' class='qxdd' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span></p>";
	else
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"</p>";

	txt_mod = "</a></li>";

	text = text + txt_mos + txt_mod;

	$("#list_common_tbody").append(text).trigger('create');
	//$("#list_common_tbody").append(text);
}

function getMyOrderList()
{
	$("#list_common_tbody").html('');
	$.ajax({
	    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'myorder'], true) ; ?>",
	    type:"GET",
	    cache:false,
	    dataType:'json',
	    data: "&currentPage="+currentPage+"&size="+size+"&gh_id="+gh_id+"&openid="+openid,
	    success: function(json_data){
	        if(json_data)
	        {
	            $.each(json_data, load_data2);
	        }

			$('#list_common_tbody').listview('refresh');

	        if(json_data.length < 3)
	            currentPage =1;
	    }
	})
}

function getMyOrderListDetail(oid)
{
	$.ajax({
    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'orderview'], true) ; ?>",
    type:"GET",
    cache:false,
    dataType:'json',
    data: "&oid="+oid,
    success: function(json_data){
	        if(json_data)
	        {
	           load_data1(0, json_data); 
	        }
	        //$.mobile.changePage("#orderdetail",{transition:"slide"});
	        //$('#orderdetail_content').listview('refresh');
	        $("#status").trigger('create');
    	}
	});
}

$(document).on("pageinit", "#myorder", function(){

	getMyOrderList();

	$(document).on("tap","#loadMyOrderListBtnNext",function(){
		// alert("玩命加载中...");
		currentPage++;
		getMyOrderList();
	});

	$(document).on("tap","#loadMyOrderListBtnPre",function(){
		// alert("玩命加载中...");
		if(currentPage != 1)
			currentPage--;
		getMyOrderList();
	});

	/*取消订单*/
	$(document).on("tap",".qxdd",function(){

		oid = $(this).attr('myOid');
		//alert("取消订单: "+oid);
		//closeorder = confirm('取消此订单,确定?');

		if(confirm('取消此订单,确定?') == false)
		{
			return false;
		}

		$.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'orderclose'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&oid="+oid,
		    success: function(json_data){
		        if(json_data)
		        {
		            
		        }
		        //$.mobile.changePage("#myorder",{transition:"slide"});
		      	getMyOrderList();
		    }
		});
	});

	/*订单详情*/
	$(document).on("tap",".ddxq",function(){
		oid = $(this).attr('myOid');
	
		$.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'orderview'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&oid="+oid,
		    success: function(json_data){
		        if(json_data)
		        {
		           load_data1(0, json_data); 
		        }
		        $.mobile.changePage("#orderdetail",{transition:"slide"});
		    }
		});
	
	});

});



$(document).on("pageinit", "#orderdetail", function(){

	/*取消订单@在详情页*/
	$(document).on("tap",".qxdd_orderdetail",function(){

		oid = $(this).attr('myOid');

		if(confirm('取消此订单,确定?') == false)
		{
			return false;
		}

		$.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'orderclose'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&oid="+oid,
		    success: function(json_data){
		        if(json_data)
		        {
		
		        }
		        getMyOrderListDetail(oid);
		    }
		});
	});

});

</script>

<?php
/*

*/