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

/*
$js_code=<<<EOD
$(document).on("pagecreate", "#page1", function() {
	$.mobile.ajaxEnabled = false; 
});
EOD;
$this->registerJs($js_code, yii\web\View::POS_END); 
*/
?>

<div data-role="page" id="myorder">
	<div data-role="header" data-position="fixed"><h1>我的订单</h1></div>
	<div role="main" class="ui-content">
		<ul data-role="listview" data-inset="true">
			<li id="list_common_tbody">
				<img src='img.jpg'>
				<span>订单编号:</span><span><a href='#'></a></span><br>
				<span>下单时间:</span><span></span><br>
				<span>商品名称:</span><span></span><br>
				<span>价格:</span><span></span><br>
				<span>订单状态:</span><span></span> <span><a href='#'></a></span><br>
			</li>
		</ul>

		<p>
			<input type="button" value="查看以前订单" id="loadMyOrderListBtn">
		</p>

	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2014</h4>
	</div>

</div>

<script>
var  currentPage = 1; /*init page num*/
var size = 3;
var count = 0;

var gh_id = <?php echo $user->gh_id; ?>;
var openid = <?php echo $user->openid; ?>;

$(document).on("pageshow", "#myorder", function(){

	function loadData(i, n)
	{
		count++;

		text ="\
		<img src='"+n.imgurl+"'>\
		<span>订单编号:</span><span><a href='#'>"+n.oid+"</a></span><br>\
		<span>下单时间:</span><span>"+n.create_time+"</span><br>\
		<span>商品名称:</span><span>"+n.detail+"</span><br>\
		<span>价格:</span><span>￥"+(n.feesum)/100+"</span><br>";

		if(n.status == 0) /*wait to pay*/ 
			txt_mos ="<span>订单状态:</span><span>"+n.status+"</span> <span><a href='#'>取消订单</a></span><br>";
		else
			txt_mos ="<span>订单状态:</span><span>"+n.status+"</span> <br>";

		text = text + txt_mos;

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
		            $.each(json_data, loadData);
		        }
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


});

</script>

<?php
/*
<li>
	<img src="<?php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
	<h2><?= $row['name'] ?></h2>
	<p><?= $row['title'] ?></p>
	<span class="ui-li-count"><?= $row['score'] ?></span>
</li>


<!--
<span>用户信息</span><br>
<span>姓名:</span><span>张三</span><br>
<span>电话:</span><span>13545296488</span><br>
<span>身份证:</span><span>42010019900909199</span><br>
-->
*/