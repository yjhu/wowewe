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

.title_comm
{
    color:#aaaaaa;
    font-size: 11pt;
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
		<h4>&copy; 襄阳联通 2015</h4>
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
		<p><span class="title_comm">订单编号:</span>&nbsp;<span id="oid"></span></p>

		
		
		<p><span class="title_comm">商品名称:</span>&nbsp;<span id="title"></span></p>
		<p><span class="title_comm">支付方式:</span>&nbsp;<span id="pay_kind"></span></p>
		<p><span class="title_comm">订单状态:</span>&nbsp;<span id="status"></span></p>

		<p><span class="title_comm">下单时间:</span>&nbsp;<span id="create_time"></span></p>
		<p><span class="title_comm">商品详情:</span>&nbsp;<span id="detail"></span>&nbsp;&nbsp;<span id="val_pkg_3g4g"></span></p>
		<p><span class="title_comm">营业厅:</span>&nbsp;<span id="office_id"></span></p>
		<p><span class="title_comm">价格:</span>&nbsp;
		￥<span id="feesum"></span>&nbsp;&nbsp;
		<span id="kaitong"></span>
		</p>
		
		<hr color="#F7C708">
		
		<p><span class="title_comm">用户信息</span></p></li>
		<p><span class="title_comm">姓名:</span>&nbsp;<span id="username"></span></p>
		<p><span class="title_comm">身份证:&nbsp;</span><span id="userid"></span></p>

		<p><span class="title_comm">收货联系方式</span></p></li>
		<p><span class="title_comm">手机号码:</span>&nbsp;<span id="usermobile"></span></p>
		<p><span class="title_comm">收货地址:&nbsp;</span><span id="address"></span></p>
		<hr color="#F7C708">
		<p><span class="title_comm">给卖家留言:&nbsp;</span><span id="memo"></span></p>


	</div>

	<div data-role="footer" data-position="fixed">
		<h4>&copy; 襄阳联通 2015</h4>
	</div>

	<div data-role="popup" id="confirm_orderdetail" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	    <div role="main" class="ui-content">
	        <h3 class="ui-title">您确定要取消此订单吗?</h3>
	    	<p>订单删除后不能恢复，如果您需要请再次下单.</p>
	        <a id="cancel" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-c" data-rel="back">不, 我再看看</a>
	        <a id="yes" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-transition="flow">是的</a>
	    </div>
	</div>


	<!-- 退款确认弹窗 -->
	<div data-role="popup" id="confirm_tuikuan" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
	    <div role="main" class="ui-content">
	        <h3 class="ui-title">确定要退款吗？亲。</h3>
	    	<p>一旦退款可能会错过您心仪的宝贝哟！如果您需要请再次下单.</p>
	        <a id="cancel" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-c" data-rel="back">不, 我再看看</a>
	        <a id="yes" href="#" class="ui-btn ui-mini  ui-corner-all ui-shadow ui-btn-inline ui-btn-a" data-transition="flow">是的</a>
	    </div>
	</div>

</div>


<script>
var  currentPage = 1; 
var size = 3;
var count = 0;

var pay_kind = {"0":"线下支付", "1":"支付宝", "2":"微信支付"};

var gh_id = '<?php echo $user->gh_id; ?>';
var openid = '<?php echo $user->openid; ?>';

var imgurl = '<?php echo Yii::$app->getRequest()->baseUrl.'/../web/images/share-icon.jpg'; ?>';

var wldh_span = "";

office_name = <?php echo \app\models\MOffice::getOfficeNameOption($user->gh_id); ?>;


var jsApiParameters;

function jsApiCall()
{
    WeixinJSBridge.invoke(
        'getBrandWCPayRequest',
        jsApiParameters,
        function(res){
            //WeixinJSBridge.log(res.err_msg);
            //alert(res.err_code+res.err_desc+res.err_msg);
            if (res.err_msg == 'get_brand_wcpay_request:ok')
            {
            } 
            else
            {
            }
            window.location.href = "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/order' ; ?>";
        }
    );
}


function callpay()
{
    if (typeof WeixinJSBridge == "undefined"){
        if( document.addEventListener ){
            document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
        }else if (document.attachEvent){
            document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
            document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
        }
    }else{
        jsApiCall();
    }
}

function load_wl_data(n)
{
	var wl_info = "";
	for(var i=0;i<n.data.length;i++)
	{
		wl_info = wl_info + n.data[i].time +"\n"+ n.data[i].context+"\n\n";
	}
	alert(wl_info);
}

function load_data1(i, n)
{
	if(n.val_pkg_3g4g == "3g")
		val_pkg_3g4g_name="3G普通套餐";
	else if(n.val_pkg_3g4g == "4g")
		val_pkg_3g4g_name="4G/3G一体化套餐";
	else
		val_pkg_3g4g_name="";

	$("#oid").html(n.oid);
	$("#title").html(n.title);
	$("#create_time").html(n.create_time);
	$("#pay_kind").html(pay_kind[n.pay_kind]);

	if(n.status == 0) //STATUS_SUBMITTED
	{
		if(n.pay_kind == 0)
		{
			$("#pay_kind").html(pay_kind[n.pay_kind]);
		}
		else
		{
			$("#pay_kind").html(pay_kind[n.pay_kind] +"<span style='color:blue' class='weixin_pay' myUrl="+n.url+">&nbsp;&nbsp;继续支付</span>"+"<span style='color:blue' class='xianxia_pay' myOid="+n.oid+">&nbsp;&nbsp;线下支付</span>");
		}
	}
	else
	{
		$("#pay_kind").html(pay_kind[n.pay_kind]);
	}

	$("#detail").html(n.detail);
	$("#val_pkg_3g4g").html(val_pkg_3g4g_name);
	$("#feesum").html(n.feesum/100);
	$("#username").html(n.username);

	if (n.usermobile == "undefined")
	{
	    //alert("undefined");
	    $("#usermobile").html("");
	}
	else
		$("#usermobile").html(n.usermobile);

	
	$("#userid").html(n.userid);
	$("#address").html(n.address);
	//$("#office_id").html(office_name[n.office_id]);

	if(n.office_id == 0)
		$("#office_id").html("");
	else
		$("#office_id").html(office_name[n.office_id]);

	if(n.status == 0)
		$("#status").html(n.statusName +"<span style='color:blue' class='qxdd_orderdetail' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span>");
	else if(n.status == 1) //退款
		$("#status").html(n.statusName +"<span style='color:blue' class='tuikuan_orderdetail' myOid="+n.oid+">&nbsp;&nbsp;退款</span>");
	else if(n.status == 2) //订单已办理 时用户发起的确认 STATUS_SUCCEEDED 
		$("#status").html(n.statusName +"<span style='color:blue' class='queren_orderdetail' myOid="+n.oid+">&nbsp;&nbsp;确认</span>");
	else
		$("#status").html(n.statusName);

	$("#kaitong").html(n.kaitong);

	$("#memo").html(n.memo);
}

function load_data2(i, n)
{
	count++;

	if(n.cid == 0)//自由组合套餐
		imgurl = '../web/images/item/zyzhtc-120x120.jpg';
	else if(n.cid == 12)//AppleiPhone4s
		imgurl = '../web/images/item/iphone4s-head.jpg-120x120.jpg';
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
	else if(n.cid == 331)
		imgurl = '../web/images/item/xiaomi-4-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 700)
		imgurl = '../web/images/item/45gliuliang-700x500.jpg-120x120.jpg';
	else if(n.cid == 701)
		imgurl = '../web/images/item/96gliuliang-700x500.jpg-120x120.jpg';
	else if(n.cid == 702)
		imgurl = '../web/images/item/flow100mb-700x500.jpg-120x120.jpg';
	else if(n.cid == 703)
		imgurl = '../web/images/item/flow300mb-700x500.jpg-120x120.jpg';
	else if(n.cid == 704)
		imgurl = '../web/images/item/flow500mb-700x500.jpg-120x120.jpg';
	else if(n.cid == 705)
		imgurl = '../web/images/item/flow1gb-01-700x500.jpg-120x120.jpg';
	else if(n.cid == 706)
		imgurl = '../web/images/item/flow2.5g-700x500.jpg-120x120.jpg';
	else if(n.cid == 707)
		imgurl = '../web/images/item/flow1gb-02-700x500.jpg-120x120.jpg';
	//双十一活动 上网卡
	else if(n.cid == 708)
		imgurl = '../web/images/item/200yuan-bendi-5g-1111-700x500.jpg-120x120.jpg';
	else if(n.cid == 709)
		imgurl = '../web/images/item/3gliuliang-1111-700x500.jpg-120x120.jpg';
	else if(n.cid == 710)
		imgurl = '../web/images/item/6gliuliang-1111-700x500.jpg-120x120.jpg';
	else if(n.cid == 711)
		imgurl = '../web/images/item/100yuan-bendi-5g-1111-700x500.jpg-120x120.jpg';
	else if(n.cid == 712)
		imgurl = '../web/images/item/45gliuliang-1111-700x500.jpg-120x120.jpg';
	else if(n.cid == 713)
		imgurl = '../web/images/item/96gliuliang-1111-700x500.jpg-120x120.jpg';

	//718 719 720

	else if(n.cid == 800)
		imgurl = '../web/show_res/index.jpg';
	else if(n.cid == 801)
		imgurl = '../web/show_res/index.jpg';
	else if(n.cid == 802)
		imgurl = '../web/show_res/index.jpg';
	else if(n.cid == 803)
		imgurl = '../web/show_res/index.jpg';	

	else if(n.cid == 804)
		imgurl = '../web/show_res/lyjhxj-head.jpg';						

	else if((n.cid == 805)||(n.cid == 806)||(n.cid == 807)||(n.cid == 808)||(n.cid == 809))
		imgurl = '../web/show_res/index_double12info.jpg';		

	else if((n.cid == 810)||(n.cid == 811)||(n.cid == 812)||(n.cid == 808)||(n.cid == 809)
		||(n.cid == 813)||(n.cid == 814)||(n.cid == 805)||(n.cid == 815)
		||(n.cid == 816)||(n.cid == 817)||(n.cid == 818))
		imgurl = '../web/show_res/index_doubledaninfo.jpg';

	//双十一活动 手机 begin
	//----------------------------------------------------------
	//ITEM_CAT_MOBILE_IPHONE4S iPhone 4S  8GB GSM  =12
	//ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE 荣耀6 =328
	//ITEM_CAT_MOBILE_XIAOMI4 小米4 =331
	//const ITEM_CAT_APPLE_5S_16G = 332;
	//const ITEM_CAT_APPLE_6_16G = 333;
	//const ITEM_CAT_MOBILE_XIAOMI_HM_NOTE = 334;
	//const ITEM_CAT_MOBILE_SONY_S55U = 335;
	//const ITEM_CAT_MOBILE_XIAOMI_HM_1S = 336;
	else if(n.cid == 328)
		imgurl = '../web/images/item/huawei-honor-6-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 332)
		imgurl = '../web/images/item/iphone5s-silver-700x500.jpg-120x120.jpg';
	else if(n.cid == 333)
		imgurl = '../web/images/item/iphone6-white-700x500.jpg-120x120.jpg';
	else if(n.cid == 334)
		imgurl = '../web/images/item/xiaomi-note-700x500.jpg-120x120.jpg';
	else if(n.cid == 336)
		imgurl = '../web/images/item/xiaomi-hm-1s-700x500.jpg-120x120.jpg';
	// 双十一活动 手机 end

	//双4G双百兆手机
	else if(n.cid == 850)
		imgurl = '../web/images/item/meilan-note-700x500.jpg-120x120.jpg';
	else if(n.cid == 851)
		imgurl = '../web/images/item/meizu-x4-700x500.jpg-120x120.jpg';
	else if(n.cid == 852)
		imgurl = '../web/images/item/iphone6-700x500.jpg-120x120.jpg';
	else if(n.cid == 853)
		imgurl = '../web/images/item/iphone6-700x500.jpg-120x120.jpg';
	else if(n.cid == 854)
		imgurl = '../web/images/item/iphone6-700x500.jpg-120x120.jpg';
	else if(n.cid == 855)
		imgurl = '../web/images/item/iphone6-700x500.jpg-120x120.jpg';
	else if(n.cid == 856)
		imgurl = '../web/images/item/iphone6-700x500.jpg-120x120.jpg';
	else if(n.cid == 857)
		imgurl = '../web/images/item/zhongxing-v5-700x500.jpg-120x120.jpg';
	else if(n.cid == 858)
		imgurl = '../web/images/item/huawei-mate7-700x500.jpg-120x120.jpg';
	//双4G双百兆手机 end
	//4g手机 疯狂直降
	else if(n.cid == 859)
		imgurl = '../web/images/item/iphone4s-8g-700x500.jpg-120x120.jpg';
	else if(n.cid == 860)
		imgurl = '../web/images/item/iphone5c-8g-700x500.jpg-120x120.jpg';
	else if(n.cid == 861)
		imgurl = '../web/images/item/iphone6-16g-700x500.jpg-120x120.jpg';
	else if(n.cid == 862)
		imgurl = '../web/images/item/sanxing-g5108q-700x500.jpg-120x120.jpg';
	else if(n.cid == 863)
		imgurl = '../web/images/item/sanxing-g9006v-700x500.jpg-120x120.jpg';
	//4g手机 疯狂直降 end
	//5.1

	else if(n.cid == 864)
		imgurl = '../web/images/item/lianxiang-a3600/lianxiang-a3600-700x500.jpg-120x120.jpg';

	else if(n.cid == 865)
		imgurl = '../web/images/item/kupai-7061/kupai-7061-700x500.jpg-120x120.jpg';

	else if(n.cid == 866)
		imgurl = '../web/images/item/kupai-y76/kupai-y76-700x500.jpg-120x120.jpg';

	else if(n.cid == 867)
		imgurl = '../web/images/item/xiaomi4-4g/xiaomi4-4g-700x500.jpg-120x120.jpg';

	else if(n.cid == 868)
		imgurl = '../web/images/item/htc-820u/htc-820u-700x500.jpg-120x120.jpg';

	else if(n.cid == 869)
		imgurl = '../web/images/item/iphone6-16g-5.1/iphone6-16g-700x500.jpg-120x120.jpg';


	//老用户专享
	else if(n.cid == 870)
		imgurl = '../web/images/item/sanxing-g9006v-700x500.jpg-120x120.jpg';
	else if(n.cid == 871)
		imgurl = '../web/images/item/htc-shishang-700x500.jpg-120x120.jpg';
	else if(n.cid == 872)
		imgurl = '../web/images/item/zhongxing-q801u-700x500.jpg-120x120.jpg';
	else if(n.cid == 873)
		imgurl = '../web/images/item/lianxiang-a606-700x500.jpg-120x120.jpg';
	else if(n.cid == 874)
		imgurl = '../web/images/item/zhongxing-v5-700x500.jpg-120x120.jpg';
	else if(n.cid == 875)
		imgurl = '../web/images/item/iphone4s-8g-5.1/iphone4s-8g-700x500.jpg-120x120.jpg';
	else if(n.cid == 876)
		imgurl = '../web/images/item/iphone5s-16g-5.1/iphone5s-16g-700x500.jpg-120x120.jpg';
	//老用户专享end



	if(n.val_pkg_3g4g == "3g")
		val_pkg_3g4g_name="3G普通套餐";
	else if(n.val_pkg_3g4g == "4g")
		val_pkg_3g4g_name="4G/3G一体化套餐";
	else
		val_pkg_3g4g_name ="";

	if(n.wldh!="" && n.wlgs!=0)
	{
		if(n.wlgs==1)
		{
			wlgsId='shunfeng';
			wlgsName="顺丰速递";
		}
		else if(n.wlgs==2)//tiantian for test
		{
			wlgsId='tiantian';
			wlgsName="天天快递";
		}

		//wl_url="http://www.kuaidi100.com/query?type=tiantian&postid=580112936827"
		wl_url="http://www.kuaidi100.com/query?type="+wlgsId+"&postid="+n.wldh;
		//alert(wl_url);
		wldh_span = "<p><span class='title_comm'>物流信息:</span>&nbsp;<span style='color:blue' class='viewWlInfo' wl_url_1="+wlgsId+" wl_url_2="+n.wldh+">"+wlgsName+"&nbsp;&nbsp;"+n.wldh+"</span></p>";
	}
	else
	{
		wldh_span="";
	}

	text ="<li><a href='#' class='ddxq' myOid='"+n.oid+"'>\
	<img style='padding-top:20px' myOid="+n.oid+" src='"+imgurl+"'>\
	<p><span class='title_comm'>订单编号:</span>&nbsp;<span color='color:blue'>"+n.oid+"</span></p>\
	<p><span class='title_comm'>下单时间:</span>&nbsp;"+n.create_time+"</p>\
	<p><span class='title_comm'>商品名称:</span>&nbsp;"+n.title+ '&nbsp;&nbsp;' +val_pkg_3g4g_name+"</p>\
	<p><span class='title_comm'>价格:</span>&nbsp;￥"+(n.feesum)/100+"&nbsp;&nbsp;"+(n.kaitong)+"</p>"+wldh_span+"<p><span id='wl_result'></p>\
	<p><span class='title_comm'>支付方式:</span>&nbsp;"+pay_kind[n.pay_kind]+"</p>\
	<p><span class='title_comm'>订单状态:</span>&nbsp;"+n.statusName+"</p>";

	txt_mos="";
	//if(n.status == 0) //wait to pay 
	//	txt_mos ="<p><span class='title_comm'>订单状态:</span>&nbsp;"+n.statusName+"<span style='color:blue' class='qxdd' myOid="+n.oid+">&nbsp;&nbsp;取消订单</span></p>";
	//else
	//	txt_mos ="<p><span class='title_comm'>订单状态:</span>&nbsp;"+n.statusName+"</p>";


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

	/*查看物流信息*/
	$(document).on("tap",".viewWlInfo",function(e){

		//取消冒泡
 		e.stopPropagation();
		wl_url_1 = $(this).attr('wl_url_1');
		wl_url_2 = $(this).attr('wl_url_2');

 		//alert(wl_url_2);

 		//location.href = wl_url;
        $.ajax({
		    url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'wlinfo'], true) ; ?>",
		    type:"GET",
		    cache:false,
		    dataType:'json',
		    data: "&wl_url_1="+wl_url_1+"&wl_url_2="+wl_url_2,
		    success: function(json_data){
		        if(json_data)
		        {
					load_wl_data(json_data); 
		        }

		        //getMyOrderListDetail(oid);
		    }
		});

		//$("#wl_result").load(wl_url)
		//return false;
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



	/*weixin pay @在详情页*/
	$(document).on("tap",".weixin_pay",function(){

		//alert("weixin_pay");
		url = $(this).attr('myUrl');
		//alert(url);
		jsApiParameters = JSON.parse(url);
		//alert(jsApiParameters);
		callpay();
	   	return false;

	});


	$(document).on("tap",".xianxia_pay",function(){

		//alert("weixin_pay");
		oid = $(this).attr('myOid');
		//alert(oid);

		var url = "<?php echo Url::to(['wap/orderxianxiapay'], true); ?>";
		//$.mobile.changePage((url+'&oid='+json_data.oid),{transition:"slide"});              
		window.location.href = url+'&oid='+oid;

	   	return false;
	});


	$(document).on("tap",".tuikuan_orderdetail",function(){

		//alert("weixin_pay");
		oid = $(this).attr('myOid');
		status = "<?= MOrder::STATUS_BUYER_REFUND_CLOSED ?>";
		//alert(oid);

		//var url = "<?php echo Url::to(['wap/ordertuikuan'], true); ?>";

	    // Show the confirmation popup
	    $( "#confirm_tuikuan" ).popup( "open" );
	    $( "#confirm_tuikuan #yes" ).on( "click", function() {
	        $( "#confirm_tuikuan" ).popup( "close" );

	        //window.location.href = url+'&oid='+oid+'&ismanager='+ismanager;

	        $.ajax({
	          url: "<?php echo Url::to(['wap/orderrefundajax'], true) ; ?>",
	          type:"GET",
	          cache:false,
	          dataType:"json",
	          data: "oid="+oid+"&status="+status,
	          success: function(t){

	                  var url = "<?php echo Url::to(['order'],true) ?>";
	                  location.href = url+'&gh_id='+gh_id+'&openid='+openid;
	            },
	            error: function(){
	              alert('error!');
	            }
	        });

	        return false;


	    });

	    $( "#confirm_tuikuan #cancel" ).on( "click", function() {
	        $( "#confirm_tuikuan #yes" ).off();
	    });

	   	return false;
	});

	
	$(document).on("tap",".queren_orderdetail",function(){

		oid = $(this).attr('myOid');
		status = "<?= MOrder::STATUS_SUCCEEDED ?>";
		//alert(oid);

        $.ajax({
          url: "<?php echo Url::to(['wap/orderchangestatusajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "oid="+oid+"&status="+status,
          success: function(t){

                  var url = "<?php echo Url::to(['order'],true) ?>";
                  location.href = url+'&gh_id='+gh_id+'&openid='+openid;
            },
            error: function(){
              alert('error!');
            }
        });

        return false;
	});

});

</script>

<?php
/*

*/