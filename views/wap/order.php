<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;

use app\models\U;
use app\models\MStaff;
use app\models\MOffice;
use app\models\MOrder;


$this->title = '襄阳联通';
$basename = basename(__FILE__, '.php');

?>

<style>
	.orderlist{

	}
</style>


<div data-role="page" id="myorder" data-theme="c">

	<?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '我的订单']); ?>

	<div role="main" class="ui-content">
	
		<!--
		<ul data-role="listview" data-inset="false" id="list_common_tbody">
		-->
		<ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon" id="list_common_tbody">
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

	<div data-role="popup" id="confirm" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	    <div role="main" class="ui-content">
	        <h3 class="ui-title">您确定要取消此订单吗?</h3>
	    	<p>订单删除后不能恢复，如果您需要请再次下单.</p>
	        <a id="cancel" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-c" data-rel="back">不, 我再看看</a>
	        <a id="yes" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-transition="flow">是的</a>
	    </div>
	</div>	


</div>



<div data-role="page" id="orderdetail" data-theme="c">

	<?php echo $this->render('menu', ['menuId'=>'menu2','gh_id'=>$gh_id, 'openid'=>$openid]); ?>	
	<?php echo $this->render('header2', ['menuId'=>'menu2','title' => '我的订单']); ?>

	<div role="main" class="ui-content">
	<h2>订单详情</h2>
		<p><span class="orderlist">订单编号:</span>&nbsp;<span id="oid"></span></p>
		<p><span class="orderlist">订单状态:</span>&nbsp;<span id="status"></span></p>
		<p><span class="orderlist">商品名称:</span>&nbsp;<span id="title"></span></p>
		<p><span class="orderlist">下单时间:</span>&nbsp;<span id="create_time"></span></p>
		<p><span class="orderlist">商品详情:</span>&nbsp;<span id="detail"></span>|<span id="val_pkg_3g4g"></span></p>
		<p><span class="orderlist">营业厅:</span>&nbsp;<span id="office_id"></span></p>
		<p><span class="orderlist">价格:</span>&nbsp;￥<span id="feesum"></span></p>
		
		<hr color="#F7C708">
		
		<p><span class="orderlist">用户信息</span></p></li>
		<p><span class="orderlist">姓名:</span>&nbsp;<span id="username"></span></p>
		<p><span class="orderlist">手机号码:</span>&nbsp;<span id="usermobile"></span></p>
		<p><span class="orderlist">身份证:&nbsp;</span><span id="userid"></span></p>

		<hr color="#F7C708">
		<p><span class="orderlist">给卖家留言:&nbsp;</span><span id="memo"></span></p>


	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

	<div data-role="popup" id="confirm_orderdetail" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	    <div role="main" class="ui-content">
	        <h3 class="ui-title">您确定要取消此订单吗?</h3>
	    	<p>订单删除后不能恢复，如果您需要请再次下单.</p>
	        <a id="cancel" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-c" data-rel="back">不, 我再看看</a>
	        <a id="yes" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-transition="flow">是的</a>
	    </div>
	</div>

</div>


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
	if(n.val_pkg_3g4g == "3g")
		val_pkg_3g4g_name="3G普通套餐";
	else if(n.val_pkg_3g4g == "4g")
		val_pkg_3g4g_name="4G/3G一体化套餐";

	$("#oid").html(n.oid);
	$("#title").html(n.title);
	$("#create_time").html(n.create_time);
	$("#detail").html(n.detail);
	$("#val_pkg_3g4g").html(val_pkg_3g4g_name);
	$("#feesum").html(n.feesum/100);
	$("#username").html(n.username);
	$("#usermobile").html(n.usermobile);
	$("#userid").html(n.userid);
	$("#office_id").html(office_name[n.office_id]);
	if(n.status == 0)
		$("#status").html(n.statusName +"<span style='color:blue' class='qxdd_orderdetail' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span>");
	else
		$("#status").html(n.statusName);

	$("#memo").html(n.memo);
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
	/*15 mobile*/
	else if(n.cid == 310)
		imgurl = '../web/images/item/iphone5c-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 311)
		imgurl = '../web/images/item/iphone5c-blue-700x500.jpg-120x120.jpg';
	else if(n.cid == 312)
		imgurl = '../web/images/item/htc8160-silver-700x500.jpg-120x120.jpg';
	else if(n.cid == 313)
		imgurl = '../web/images/item/samsung7506v-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 314)
		imgurl = '../web/images/item/coolpad7298a-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 315)
		imgurl = '../web/images/item/lenovoa850-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 316)
		imgurl = '../web/images/item/coolpad7295c-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 317)
		imgurl = '../web/images/item/iphone5s-silver-700x500.jpg-120x120.jpg';
	else if(n.cid == 318)
		imgurl = '../web/images/item/coolpad7296-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 319)
		imgurl = '../web/images/item/coolpad7296-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 320)
		imgurl = '../web/images/item/coolpad-k1-120x120.jpg';
	else if(n.cid == 321)
		imgurl = '../web/images/item/coolpad7235-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 322)
		imgurl = '../web/images/item/coolpad7230s-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 323)
		imgurl = '../web/images/item/hisenseu939-black-700x500.jpg-120x120.jpg';
	else if(n.cid == 324)
		imgurl = '../web/images/item/coolpad7295c-black-700x500.jpg-120x120.jpg';

	if(n.val_pkg_3g4g == "3g")
		val_pkg_3g4g_name="3G普通套餐";
	else if(n.val_pkg_3g4g == "4g")
		val_pkg_3g4g_name="4G/3G一体化套餐";

	text ="<li><a href='#' class='ddxq' myOid='"+n.oid+"'>\
	<img style='padding-top:20px' myOid="+n.oid+" src='"+imgurl+"'>\
	<p>订单编号:&nbsp;<span color='color:blue'>"+n.oid+"</span></p>\
	<p>下单时间:&nbsp;"+n.create_time+"</p>\
	<p>商品名称:&nbsp;"+n.title+ '|' +val_pkg_3g4g_name+"</p>\
	<p>价格:&nbsp;￥"+(n.feesum)/100+"</p>";

	if(n.status == 0) //wait to pay 
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"<span style='color:blue' class='qxdd' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span></p>";
	else
		txt_mos ="<p>订单状态:&nbsp;"+n.statusName+"</p>";


	txt_mod = "</a></li>";

	text = text + txt_mos + txt_mod;

	$("#list_common_tbody").append(text).trigger('create');
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
	$(document).on("tap",".qxdd",function(e){

		//取消冒泡
 		e.stopPropagation();

		oid = $(this).attr('myOid');

        // Show the confirmation popup
        $( "#confirm" ).popup( "open" );
        $( "#confirm #yes" ).on( "click", function() {
 
            $( "#confirm" ).popup( "close" );
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

        $( "#confirm #cancel" ).on( "click", function() {
            $( "#confirm #yes" ).off();
        });

       return false;
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

	    // Show the confirmation popup
	    $( "#confirm_orderdetail" ).popup( "open" );
	    $( "#confirm_orderdetail #yes" ).on( "click", function() {
	        $( "#confirm_orderdetail" ).popup( "close" );

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

	    $( "#confirm_orderdetail #cancel" ).on( "click", function() {
	        $( "#confirm_orderdetail #yes" ).off();
	    });
	   return false;

	});

});

</script>

<?php
/*

*/