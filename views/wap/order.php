﻿<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;

use app\assets\JqmAsset;
JqmAsset::register($this);

$gh_id = Yii::$app->session['gh_id'];
$openid = Yii::$app->session['openid'];

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

	<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>


<div data-role="page" id="myorder" data-theme="e">

	<div data-role="header" data-position="fixed">
	<h1>我的订单</h1>
	</div>
	<div role="main" class="ui-content">
		<ul data-role="listview" data-inset="false" id="list_common_tbody">
		</ul>

		<br>
		<button class="ui-btn ui-btn-inline" id="loadMyOrderListBtnPre">上一页</button>
		<button class="ui-btn ui-btn-inline" id="loadMyOrderListBtnNext">下一页</button>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>
</div>

<div data-role="page" id="orderdetail" data-theme="e">
	<div data-role="header" data-position="fixed" data-add-back-btn="true" data-back-btn-text="返回">
	<h1>我的订单</h1>
	</div>

	<div role="main" class="ui-content">
	<h2>订单详情</h2>
		<p>订单编号:&nbsp;<span id="oid"></span></p>
		<p>订单状态:&nbsp;<span id="status"></span></p>
		<p>商品名称:&nbsp;<span id="title"></span></p>
		<p>下单时间:&nbsp;<span id="create_time"></span></p>
		<p>商品详情:&nbsp;<span id="detail"></span></p>
		<p>营业厅:&nbsp;<span id="office_id"></span></p>
		<p>价格:&nbsp;￥<span id="feesum"></span></p>
		
		<hr color="#F7C708">
		
		<p>用户信息</p></li>
		<p>姓名:&nbsp;<span id="username"></span></p>
		<p>手机号码:&nbsp;<span id="usermobile"></span></p>
		<p>身份证:&nbsp;<span id="userid"></span></p>
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

	text ="<li>\
	<img src='"+imgurl+"'>\
	<p>订单编号:&nbsp;<span color='color:blue'>"+n.oid+"</span></p>\
	<p>下单时间:&nbsp;"+n.create_time+"</p>\
	<p>商品名称:&nbsp;"+n.title+"</p>\
	<p>价格:&nbsp;￥"+(n.feesum)/100+"</p>";

	if(n.status == 0) //wait to pay 
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"<span style='color:blue' class='qxdd' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span></p>";
	else
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"</p>";

	txt_mod = "<i class='ui-corner-all ui-btn-icon-right ui-icon-carat-r ddxq' myOid="+n.oid+"></i></li>";

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
	});
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