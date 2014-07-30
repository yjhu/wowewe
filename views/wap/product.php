<?php
	use yii\helpers\Html;
	use yii\widgets\Breadcrumbs;
	use app\assets\JqmAsset;
	JqmAsset::register($this);
	//$this->registerJs('alert("test")', yii\web\View::POS_READY); 
	
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

	<!--
<link href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" rel="stylesheet" type="text/css"/>
<link href="../../web/js/jqm/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.6.4.min.js" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js" type="text/javascript"></script>
<script src="../../web/js/jqm/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>	
	-->
	
	
<style type="text/CSS">
.tabSumm 
{
	color:#00C;
}
</style>
	
<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
	<!--
	<div data-role="page" id="page1">
		<div data-role="header">
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">
			<h2>产品列表</h2>
			<ul data-role="listview" data-autodividers="true" data-filter="true" data-inset="true">
			  <li>
				<a href="#page2" data-transition="flip">
				<img src="http://www.w3cschool.cc/try/demo_source/firefox.png">
				<h2>产品编号140729</h2>
				<p>该产品简单描述...</p>
				</a>
			  </li>

			  <li>
				<a href="#page2" data-transition="flip">
				<img src="http://www.w3cschool.cc/try/demo_source/chrome.png">
				<h2><p style="display:none">M</P> 红米手机</h2>
				<h2>价格:2048元</h2>
				<p>该产品简单描述...</p>
				</a>
			  </li>			  
			</ul>
		</div>

		<div data-role="footer">
			<h4>&copy; 襄阳联通 2014</h4>
		</div>
	</div>	
	-->

		
	<div data-role="page" id="page2">

		<div data-role="header">
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">
		<form id="productForm">	
		<div data-role="content" data-theme="d">	
		<p  align=center>        
		<img width="60%" src="http://res.mall.10010.com/mall/res/uploader/temp/20140514113951768477440_310_310.jpg" alt=""/>
		</p>

		<p> 
		【沃的套餐】自由组合套餐（手机营业厅客户端）<br>赠品：无纺布环保袋；好友推荐最高得100元话费；微信晒单最高得话费50元。
		</p>


		<div class="ui-corner-all custom-corners">

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

			<!-- #ec7218 yellow -->
			<p id="diy-create">自由组合套餐        月消费:8元</p>
			<div id="TabbedPanels1" class="TabbedPanels">
			  <ul class="TabbedPanelsTabGroup">
				<li class="TabbedPanelsTab" tabindex="0" id="flowPackTabTitle">流量包<br><span class='tabSumm'>100MB</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="packTabTitle">语音包<br><span class='tabSumm'>200分钟</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="msgPackTabTitle">短彩信包<br><span class='tabSumm'>200条</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="callshowPackTabTitle">来电显示<br><span class='tabSumm'>来显</span></li>
			  </ul>
			  <div class="TabbedPanelsContentGroup">
				<div class="TabbedPanelsContent">
				  <div data-role="fieldcontain">
					<fieldset data-role="controlgroup">
					  <legend>流量包</legend>
					  <input type="radio" name="flowPack" id="flowPack_0" value="0"  checked />
					  <label for="flowPack_0">100MB/8元&nbsp;&nbsp;0.08元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_1" value="1" />
					  <label for="flowPack_1">300MB/16元&nbsp;&nbsp;0.05元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_2" value="2" />
					  <label for="flowPack_2">500MB/24元&nbsp;&nbsp;0.05元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_3" value="3" />
					  <label for="flowPack_3">1GB/48元&nbsp;&nbsp;0.05元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_4" value="4" />
					  <label for="flowPack_4">2GB/72元&nbsp;&nbsp;0.04元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_5" value="5" />
					  <label for="flowPack_5">3GB/96元&nbsp;&nbsp;0.03元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_6" value="6" />
					  <label for="flowPack_6">4GB/120元&nbsp;&nbsp;0.03元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_7" value="7" />
					  <label for="flowPack_7">6GB/152元&nbsp;&nbsp;0.02元/1M</label>
					  <input type="radio" name="flowPack" id="flowPack_8" value="8" />
					  <label for="flowPack_8">11GB/232元&nbsp;&nbsp;0.02元/1M</label>

					</fieldset>
					<p>&nbsp;&nbsp;流量包超出部分按0.2元/MB收费</p>
				  </div>
				</div>

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					<fieldset data-role="controlgroup">
					  <legend>语音包</legend>
					  <input type="radio" name="voicePack" id="voicePack_0" value="0" checked />
					  <label for="voicePack_0">200分钟/32元&nbsp;&nbsp;0.16元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_1" value="1" />
					  <label for="voicePack_1">300分钟/40元&nbsp;&nbsp;0.13元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_2" value="2" />
					  <label for="voicePack_2">500分钟/56元&nbsp;&nbsp;0.11元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_3" value="3" />
					  <label for="voicePack_3">1000分钟/112元&nbsp;&nbsp;0.11元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_4" value="4" />
					  <label for="voicePack_4">2000分钟/160元&nbsp;&nbsp;0.08元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_5" value="5" />
					  <label for="voicePack_5">3000分钟/240元&nbsp;&nbsp;0.08元/1分钟</label>
					</fieldset>
					<p>&nbsp;&nbsp;语音包超出后按0.15元/分钟收费</p>
				  </div> 
				</div>

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					<fieldset data-role="controlgroup">
					  <legend>短彩信包</legend>
					  <input type="radio" name="msgPack" id="msgPack_0" value="0" checked />
					  <label for="msgPack_0">200条/10元</label>
					  <input type="radio" name="msgPack" id="msgPack_1" value="1" />
					  <label for="msgPack_1">400条/20元</label>
					  <input type="radio" name="msgPack" id="msgPack_2" value="2" />
					  <label for="msgPack_2">600条/30元</label>
					  <input type="radio" name="msgPack" id="msgPack_3" value="3" />
					  <label for="msgPack_3">不选短彩信包按0.1元/条收费费</label>
					</fieldset>
					<p>&nbsp;&nbsp;短彩信包超出后按0.1元/条收费</p>
				  </div>
				</div>         

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					  <fieldset data-role="controlgroup">
						<legend>来电显示</legend>
						<input type="radio" name="callshowPack" id="callshowPack_0" value="0" checked />
						<label for="callshowPack_0">6元/月&nbsp;&nbsp;来电显示</label>
						<input type="radio" name="callshowPack" id="callshowPack_1" value="1" />
						<label for="callshowPack_1">不选择</label>
					  </fieldset>
					  <p>&nbsp;&nbsp;您开通语音包后，将默认开通来电显示包</p>
					</div>
				</div>                

			  </div>
			</div>
			<!--	
			<button id="submitBtn">确认套餐</button>
			-->
			<input type="button" value="确认套餐" id="submitBtn">
			
			<br>
			<div id="TabbedPanels2" class="TabbedPanels">
			  <ul class="TabbedPanelsTabGroup">
				<li class="TabbedPanelsTab" tabindex="0">图文详情</li>
	
				<li class="TabbedPanelsTab" tabindex="0">商品评价</li>
			  </ul>
			  <div class="TabbedPanelsContentGroup">
				<div class="TabbedPanelsContent">

					<div role="main" class="ui-content">
						<p>
						<img width="100%" style="display:block" src="http://res.mall.10010.com/mall/res/uploader/gdesc/2014071512570459069472.jpg"  />
						<img width="100%" style="display:block" src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140715125741-395019744.jpg"  />
						<a href="http://www.10010.com/static/homepage/subjectpage/57100000121535.html" target="_blank">
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/2014052323300111030656.jpg" />
						</a>
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125526735531536.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125543-871142944.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125545-1488938112.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/201406201255471171857184.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125550-2085819232.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125552-1229077232.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125554890077008.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125555274224096.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/201406201255571229488080.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125558-1457143136.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125559-166693792.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125601-1539953360.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125603-795464784.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/201406201256041299213616.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/201406201256061847605616.jpg" />
						<img width="100%" style="display:block"  src="http://res.mall.10010.com/mall/res/uploader/gdesc/20140620125608882812384.jpg" />
						</p>
					</div><!-- /content -->        

				</div>

				<div class="TabbedPanelsContent">
					<div role="main" class="ui-content">
					<p> 好好好</p>
					</div><!-- /content -->       
				</div>


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
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">

			<h2>订单详情</h2>
			<!--
			<table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
			-->
			<p id="oid"></p>
			<table data-role="table" id="table-custom-2" data-mode="columntoggle"   class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-text="选择要显示的列..." data-column-popup-theme="a">
			 <thead>
			   <tr class="ui-bar-d">
				 <th data-priority="1">序号</th>
				 <th data-priority="1">组合项</th>
				 <th>详情</th>
				 <th>费用</th>
				 <!--
				 <th data-priority="5">Reviews</th>
				 -->
			   </tr>
			 </thead>
			 <tbody>
			   <tr>
				 <th>1</th>
				 <td>流量包</td>
				 <td id="flowPack_name">300MB</td>
				 <td id="flowPack_fee">16元</td>
			   </tr>
			   <tr>
				 <th>2</th>
				 <td>语音包</td>
				 <td id="voicePack_name">300分钟</td>
				 <td id="voicePack_fee">40元</td>
			   </tr>
			   <tr>
				 <th>3</th>
				 <td>短信彩信</td>
				 <td id="msgPack_name">400条</td>
				 <td id="msgPack_fee">20元</td>
			   </tr>	
			   <tr>
				 <th>4</th>
				 <td>来电显示</td>
				 <td id="callshowPack_name">来显每月</td>
				 <td id="callshowPack_fee">6元</td>
			   </tr>				   
		
			 </tbody>
		   </table>
			<p align="right" style="font-size: 18px; color:#ff8600; font-weight:  bolder">
			<span  id="total">
			合计:
			</span>
			</p>	
			<!--
			<p>
			<textarea cols="40" rows="8" name="address" id="address" placeholder="请输入您的收货地址"></textarea>
			</P>
			-->
			<p>
				<select>
					<option value="0">---请选择营业厅---</option>
					<option value="1">枣阳营业厅</option>
					<option value="2">枣阳盛鑫广场营业厅</option>
					<option value="3">宜城营业厅</option>
					<option value="4">宜城新建街营业厅</option>
					<option value="5">襄州营业厅</option>
					<option value="6">襄州民发世界城营业厅</option>
					<option value="7">襄城南街自有营业厅</option>
					<option value="8">襄城鼓楼自有营业厅</option>
					<option value="9">南漳营业厅</option>
					<option value="10">南漳凯达广场营业厅</option>
					<option value="11">老河口营业厅</option>
					<option value="12">老河口市中山路自有营业厅</option>
					<option value="13">谷城营业厅</option>
					<option value="14">谷城县府街自有营业厅</option>
					<option value="15">二汽营业厅</option>
					<option value="16">城区新华北路营业厅</option>
					<option value="17">城区三元路营业厅</option>
					<option value="18">城区人民路自有营业厅</option>
					<option value="19">城区人民广场营业厅</option>
					<option value="20">城区前进路营业厅</option>
					<option value="21">城区汉江路营业厅</option>
					<option value="22">城区长虹路营业厅</option>
					<option value="23">保康营业厅</option>
					<option value="24">保康新街营业厅</option>
				</select>
			</p>
			<br>
			<p>
			<input type="button" value="立即支付" id="payBtn">
			</p>	
			<!--
			<p id="url"></p>
			-->
			<p align="right">
			<a href="#page2" data-transition="slide">我想重新选择</a> 
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
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>


<script>
var feeSum = 0;
//$().ready(function() {

function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}


$(document).on("pagecreate", "#page2", function(){

	var fee_flowPack = 8;
	var fee_pack = 32;
	var fee_msgPack = 10;
	var fee_callshowPack = 6;
	
   	function feeSummary()
	{
		feeSum= fee_flowPack + fee_pack + fee_msgPack + fee_callshowPack;
		$("#diy-create").html("自由组合套餐    月消费:<span style='font-size: 18px; color:#ff8600; font-weight:  bolder'>"+feeSum+"元</span>");
		//$("#total_fee").val(feeSum);
	}
	
	feeSummary();
	
   	$("[name=flowPack]").click(function(){
		changeTabTitle("flowPack",$(this).val());
	});
	
   	$("[name=voicePack]").click(function(){
		changeTabTitle("voicePack",$(this).val());
	});
	
   	$("[name=msgPack]").click(function(){
		changeTabTitle("msgPack",$(this).val());
	});
	
   	$("[name=callshowPack]").click(function(){
		changeTabTitle("callshowPack",$(this).val());
	});	
	
	function changeTabTitle(v1,v2)
	{
		if(v1=="flowPack")
		{
			if(v2==0)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'>100MB</span>");
				fee_flowPack = 8;
			}
			else if(v2==1)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 300MB</span>");
				fee_flowPack = 16;
			}
			else if(v2==2)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 500MB</span>");
				fee_flowPack = 24;
			}
			else if(v2==3)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 1GB</span>");	
				fee_flowPack = 48;
			}
			else if(v2==4)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 2GB</span>");
				fee_flowPack = 72;
			}
			else if(v2==5)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 3GB</span>");
				fee_flowPack = 96;
			}
			else if(v2==6)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 4GB</span>");
				fee_flowPack = 120;
			}
			else if(v2==7)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 6GB</span>");
				fee_flowPack = 152;
			}
			else if(v2==8)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 11GB</span>");
				fee_flowPack = 232;
			}
			else
				$("#flowPackTabTitle").html("流量包<br>&nbsp");	
		}
		else if(v1=="voicePack")
		{
			if(v2==0)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 200分钟</span>");
				fee_pack = 32;
			}
			else if(v2==1)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 300分钟</span>");
				fee_pack = 40;
			}
			else if(v2==2)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 500分钟</span>");
				fee_pack = 56;
			}
			else if(v2==3)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 1000分钟</span>");	
				fee_pack = 112;
			}
			else if(v2==4)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 2000分钟</span>");
				fee_pack = 160;
			}
			else if(v2==5)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 3000分钟</span>");
				fee_pack = 240;
			}
			else
				$("#packTabTitle").html("语音<br>&nbsp包");
		}
		else if(v1=="msgPack")
		{
			if(v2==0)
			{
				$("#msgPackTabTitle").html("短彩信包<br><span class='tabSumm'> 200条</span>");
				fee_msgPack = 10;
			}
			else if(v2==1)
			{
				$("#msgPackTabTitle").html("短彩信包<br><span class='tabSumm'> 400条</span>");
				fee_msgPack = 20;
			}
			else if(v2==2)
			{
				$("#msgPackTabTitle").html("短彩信包<br><span class='tabSumm'> 600条</span>");
				fee_msgPack = 30;
			}
			else if(v2==3)
			{
				$("#msgPackTabTitle").html("短彩信包<br>&nbsp");	
				fee_msgPack = 0;
			}
			else
				$("#msgPackTabTitle").html("短彩信包<br>&nbsp");
		}
		else if(v1=="callshowPack")
		{
			if(v2==0)
			{
				$("#callshowPackTabTitle").html("来电显示<br><span class='tabSumm'> 来显</span>");
				fee_callshowPack = 6;
			}
			else if(v2==1)
			{
				$("#callshowPackTabTitle").html("来电显示<br>&nbsp ");
				fee_callshowPack = 0;
			}
			else
				$("#callshowPackTabTitle").html("来电显示<br>&nbsp");

		}
		
		/**/
		feeSummary();
	}
	
	
	//submit form
	$('#submitBtn').click(function(){
		//alert('save args to local storage');
		//alert($("form#productForm").serialize());
		
		localStorage.setItem("item",$("form#productForm").serialize())
		$.ajax({
			//url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/g2048save' ; ?>"+"&bigNum="+bigNum+"&score="+myGameStateObj.score+"&best="+myScore,
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
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
	   
	});
	
	

});

$(document).on("pageshow", "#page3", function(){
	// alert("page3 create");
	
//	flowPack_name = {"0":"100MB", "1":"300MB", "2":"500MB", "3":"1GB", "4":"2GB", "5":"3GB", "6":"4GB", "7":"6GB", "8":"11GB"};
//	flowPack_fee = {"0":"8", "1":"16", "2":"24", "3":"48", "4":"72", "5":"96", "6":"120", "7":"152", "8":"232"};
	flowPack_name = <?php echo \app\models\MOrder::getFlowPackName(); ?>;
	flowPack_fee =<?php echo \app\models\MOrder::getFlowPackFee(); ?>;
	
	//voicePack_name = {"0":"200分钟", "1":"300分钟", "2":"500分钟", "3":"1000分钟", "4":"2000分钟", "5":"3000分钟"};
	//voicePack_fee = {"0":"32", "1":"40", "2":"56", "3":"112", "4":"160", "5":"240"};
	voicePack_name = <?php echo \app\models\MOrder::getVoicePackName(); ?>;
	voicePack_fee = <?php echo \app\models\MOrder::getVoicePackFee(); ?>;
	
	//msgPack_name = {"0":"200条", "1":"400条", "2":"600条", "3":"不选"};
	//msgPack_fee = {"0":"10", "1":"20", "2":"30", "3":"0"};
	msgPack_name = <?php echo \app\models\MOrder::getMsgPackName(); ?>;
	msgPack_fee = <?php echo \app\models\MOrder::getMsgPackFee(); ?>;
	
	//callshowPack_name = {"0":"来显", "1":"不选"};
	//callshowPack_fee = {"0":"6", "1":"0"};
	callshowPack_name = <?php echo \app\models\MOrder::getCallShowPackName(); ?>;
	callshowPack_fee =<?php echo \app\models\MOrder::getCallShowPackFee(); ?>;
	
	var item = localStorage.getItem("item");
	item_new = item.replace(/&/g, ";") +';';

	eval(item_new);
	//alert('流量包'+flowPack_name[flowPack]+"费用"+flowPack_fee[flowPack]);
	
	$("#flowPack_name").html(flowPack_name[flowPack]);
	$("#flowPack_fee").html(flowPack_fee[flowPack]+"元");
	
	$("#voicePack_name").html(voicePack_name[voicePack]);
	$("#voicePack_fee").html(voicePack_fee[voicePack]+"元");
	
	$("#msgPack_name").html(msgPack_name[msgPack]);
	$("#msgPack_fee").html(msgPack_fee[msgPack]+"元");
	
	$("#callshowPack_name").html(callshowPack_name[callshowPack]);
	$("#callshowPack_fee").html(callshowPack_fee[callshowPack]+"元");
	
	$("#total").html("合计:"+feeSum+"元");
	
	var oid = localStorage.getItem("oid");
	$("#oid").html("您的订单号: "+oid);
	
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
				alert('you mobile is android, can not pay.');
				//alert("你的手机系统是：安卓");

			} else if (text.indexOf("iPhone") >= 0) {
				//alert("你的手机系统是：苹果");
				location.href=url;

			} else {
				alert("尚未识别您的手机");
			}
		} else 
		{
			alert("尚未识别您的手机");
		}
	   
	   }); /*end of pay submit*/
	
	
	
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
