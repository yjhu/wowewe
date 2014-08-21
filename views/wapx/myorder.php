<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;
$gh_id = Yii::$app->session['gh_id'];
$openid = Yii::$app->session['openid'];

$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<div data-role="page" id="myorder" data-theme="a">
	<div data-role="header" data-position="fixed"><h1>我的订单</h1></div>
	<div role="main" class="ui-content">
		<ul data-role="listview" data-inset="false" id="list_common_tbody">
		</ul>
		<br>
		<p>
			<input type="button" value="查看以前订单" id="loadMyOrderListBtn">
		</p>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

</div>

<script>
var  currentPage = 1; 
var size = 3;
var count = 0;

var gh_id = '<?php echo $user->gh_id; ?>';
var openid = '<?php echo $user->openid; ?>';

var imgurl = '<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>';

$(document).on("pageshow", "#myorder", function(){


	function loadData(i, n)
	{
		count++;

		text ="<li>\
		<img src='"+imgurl+"'>\
		<p>订单编号:<span color='color:blue'>"+n.oid+"</span></p>\
		<p>下单时间:"+n.create_time+"</p>\
		<p>商品名称:"+n.title+"</p>\
		<p>价格:￥"+(n.feesum)/100+"</p>";

		if(n.status == 0) //wait to pay 
			txt_mos ="<p>订单状态:"+n.statusName+"<span style='color:blue' id='qxdd' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span></p>";
		else
			txt_mos ="<p>订单状态:"+n.statusName+"</p>";

		txt_mod = "<i class='ui-corner-all ui-btn-icon-right ui-icon-arrow-r' id='ddxq' myOid="+n.oid+"></i></li>";

		text = text + txt_mos + txt_mod;

		//$("#list_common_tbody").append(text).trigger('create');
		$("#list_common_tbody").append(text);

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
		            $.each(json_data, loadData);
		        }

				$('#list_common_tbody').listview('refresh');
	

		        if(json_data.length < 3)
		            currentPage =1;
		    }
		});
	}

	getMyOrderList();

	$("#loadMyOrderListBtn").click(function(){
		// alert("玩命加载中...");
		currentPage++;
		getMyOrderList();
	});


	/*取消订单*/
	$(document).on("click","#qxdd",function(){
		oid = $(this).attr('myOid');
		//alert("取消订单: "+oid);
		//closeorder = confirm('取消此订单,确定?');

		if(confirm('取消此订单,确定?') == true)
		{
			alert("您的订单: "+oid+"已取消！");
			return false;//close order!!!
		}

		$.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'closeorder'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&currentPage="+currentPage+"&size="+size+"&oid="+oid,
		    success: function(json_data){
		        if(json_data)
		        {
		            
		        }

		    }
		});
	});


	/*订单详情*/
	$(document).on("click","#ddxq",function(){
		oid = $(this).attr('myOid');
		//alert("取消订单: "+oid);
		//closeorder = confirm('取消此订单,确定?');

		if(confirm('查看订单详情,确定?') == true)
		{
			alert("您的订单: "+oid+"马上转到订单详情页面！");
			return false;//close order!!!
		}

		$.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'vieworder'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&currentPage="+currentPage+"&size="+size+"&oid="+oid,
		    success: function(json_data){
		        if(json_data)
		        {
		            
		        }

		    }
		});
	});

	




});



</script>

<?php
/*
<li>
	<img src='<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>'>
	<p>订单编号:<span color='color:blue'>1234567890</span></p>
	<p>下单时间: 2014-8-20</p>
	<p>商品名称: 沃派校园套餐</p>
	<p>价格:￥ 66</p>
	<p>订单状态:等待付款<span style='color:blue'>&nbsp;&nbsp;取消订单</span></p>
</li>

<li>
	<img src='<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>'>
	<p>订单编号:<span color='color:blue'>1234567890</span></p>
	<p>下单时间: 2014-8-19</p>
	<p>商品名称: Apple iPhone 4s 8G</p>
	<p>价格:￥ 2399</p>
	<p>订单状态:等待付款<span style='color:blue'>&nbsp;&nbsp;取消订单</span></p>
</li>

<li>
	<img src='<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>'>
	<p>订单编号:<span color='color:blue'>1234567890</span></p>
	<p>下单时间: 2014-8-20</p>
	<p>商品名称: 微信沃卡</p>
	<p>价格:￥ 50</p>
	<p>订单状态:等待付款<span style='color:blue'>&nbsp;&nbsp;取消订单</span></p>
</li>

<!--
<p>用户信息</p><br>
<p>姓名:</p><p>张三</p><br>
<p>电话:</p><p>13545296488</p><br>
<p>身份证:</p><p>42010019900909199</p><br>
-->
*/