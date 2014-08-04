<?php
	use yii\helpers\Html;
    use yii\helpers\Url;
	use yii\widgets\Breadcrumbs;
	use app\assets\JqmAsset;
	JqmAsset::register($this);
	//$this->registerJs('alert("test")', yii\web\View::POS_READY);
use app\models\U;
    use app\models\MOffice;
    $gh_id = Yii::$app->session['gh_id'];
U::W($gh_id);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

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

		
	<div data-role="page" id="page2" data-theme="e">

		<div data-role="header" data-theme="b">
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">
		<form id="productForm">	
		<div data-role="content" data-theme="f">	
		<p  align=center>        
		<img width="100%" src="../web/images/item/20140514113951768477440.jpg" alt=""/>
		</p>

 		<p>
		自由组合套餐
         <!--<br>赠品：无纺布环保袋；好友推荐最高得100元话费；微信晒单最高得话费50元。-->
            <span class="title_hint"> 自由选择， 随意组合， 私人定制， 沃随你变， 每月最低10元起</span>
		</p>


		<div class="ui-corner-all custom-corners">

		  <div data-role="fieldcontain" data-theme="g">
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

			<!-- #ec7218 yellow -->
			<p id="diy-create">自由组合套餐        月消费:8元</p>
			<div id="TabbedPanels1" class="TabbedPanels">
			  <ul class="TabbedPanelsTabGroup">
				<li class="TabbedPanelsTab" tabindex="0" id="flowPackTabTitle">流量包<br><span class='tabSumm'>100MB</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="packTabTitle">语音包<br><span class='tabSumm'>&nbsp;</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="msgPackTabTitle">短彩信包<br><span class='tabSumm'>&nbsp;</span></li>
				<li class="TabbedPanelsTab" tabindex="0" id="callshowPackTabTitle">来电显示<br><span class='tabSumm'>&nbsp;</span></li>
                <li class="TabbedPanelsTab" tabindex="0" id="otherPackTabTitle">其他<br><span class='tabSumm'>&nbsp;</span></li>
			  </ul>
			  <div class="TabbedPanelsContentGroup">
				<div class="TabbedPanelsContent">
				  <div data-role="fieldcontain">
					<fieldset data-role="controlgroup" data-theme="c">
					  <legend>流量包</legend>
					  <input type="radio" name="flowPack" id="flowPack_0" value="0"  checked />
					  <label for="flowPack_0">100MB/10元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_1" value="1" />
					  <label for="flowPack_1">300MB/20元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_2" value="2" />
					  <label for="flowPack_2">500MB/30元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_3" value="3" />
					  <label for="flowPack_3">1GB/60元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_4" value="4" />
					  <label for="flowPack_4">2GB/90元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_5" value="5" />
					  <label for="flowPack_5">3GB/129元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_6" value="6" />
					  <label for="flowPack_6">4GB/150元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_7" value="7" />
					  <label for="flowPack_7">6GB/190元&nbsp;&nbsp;</label>
					  <input type="radio" name="flowPack" id="flowPack_8" value="8" />
					  <label for="flowPack_8">11GB/290元&nbsp;&nbsp;</label>

					</fieldset>
					<p>&nbsp;流量包超出部分按0.2元/MB收费</p>
				  </div>
				</div>

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					<fieldset data-role="controlgroup" data-theme="c">
					  <legend>语音包</legend>
					  <input type="radio" name="voicePack" id="voicePack_0" value="0"  />
					  <label for="voicePack_0">200分钟/40元&nbsp;&nbsp;0.2元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_1" value="1" />
					  <label for="voicePack_1">300分钟/50元&nbsp;&nbsp;0.16元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_2" value="2" />
					  <label for="voicePack_2">500分钟/70元&nbsp;&nbsp;0.14元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_3" value="3" />
					  <label for="voicePack_3">1000分钟/140元&nbsp;&nbsp;0.14元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_4" value="4" />
					  <label for="voicePack_4">2000分钟/200元&nbsp;&nbsp;0.1元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_5" value="5" />
					  <label for="voicePack_5">3000分钟/300元&nbsp;&nbsp;0.1元/1分钟</label>
					  <input type="radio" name="voicePack" id="voicePack_notselect" value="999" checked />
					  <label for="voicePack_notselect">不选择</label>		  
					</fieldset>
					<p>&nbsp;语音包超出后按0.15元/分钟收费</p>
				  </div> 
				</div>

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					<fieldset data-role="controlgroup" data-theme="c">
					  <legend>短彩信包</legend>
					  <input type="radio" name="msgPack" id="msgPack_0" value="0" />
					  <label for="msgPack_0">200条/10元</label>
					  <input type="radio" name="msgPack" id="msgPack_1" value="1" />
					  <label for="msgPack_1">400条/20元</label>
					  <input type="radio" name="msgPack" id="msgPack_2" value="2" />
					  <label for="msgPack_2">600条/30元</label>
					  <input type="radio" name="msgPack" id="msgPack_notselect" value="999" checked />
					  <label for="msgPack_notselect">不选短彩信包按0.1元/条收费</label>
					</fieldset>
					<p>&nbsp;短彩信包超出后按0.1元/条收费</p>
				  </div>
				</div>         

				<div class="TabbedPanelsContent">
					<div data-role="fieldcontain">
					  <fieldset data-role="controlgroup">
						<legend>来电显示</legend>
						<input type="radio" name="callshowPack" id="callshowPack_0" value="0" />
						<label for="callshowPack_0">6元/月&nbsp;&nbsp;来电显示</label>
						<input type="radio" name="callshowPack" id="callshowPack_notselect" value="999" checked />
						<label for="callshowPack_notselect">不选择</label>
					  </fieldset>
					  <p>&nbsp;您开通语音包后，将默认开通来电显示包</p>
					</div>
				</div>

              <div class="TabbedPanelsContent">
                  <div data-role="fieldcontain" data-theme="g">
                      <fieldset data-role="controlgroup">
                          <legend>其他增值业务</legend>
                          <input type="radio" name="otherPack" id="otherPack_0" value="0" />
                          <label for="otherPack_0">炫铃 5元/月</label>

                          <input type="radio" name="otherPack" id="otherPack_1" value="1" />
                          <label for="otherPack_1">手机邮箱 5元/月</label>

                          <input type="radio" name="otherPack" id="otherPack_2" value="2" />
                          <label for="otherPack_2">炫铃+手机邮箱 6元/月</label>

                          <input type="radio" name="otherPack" id="otherPack_notselect" value="999" checked />
                          <label for="otherPack_notselect">不选择</label>
                      </fieldset>
                      <p>&nbsp;</p>
                  </div>
              </div>

              </div>
			</div>

            <a  id="sel-num" href="#number-select" class="ui-btn">请选择手机号码</a>

            <?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false)); ?>

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
						<p>
                            <img width="100%" style="display:block" src="../web/images/item/zyzh-001.jpg" alt=""/>
                            <img width="100%" style="display:block" src="../web/images/item/zyzh-002.jpg" alt=""/>
                            <img width="100%" style="display:block" src="../web/images/item/zyzh-003.jpg" alt=""/>
                            <img width="100%" style="display:block" src="../web/images/item/zyzh-004.jpg" alt=""/>
                        </p>
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
	
	
	<div data-role="page" id="page3" data-theme="f">
		<div data-role="header">
			<h1>自由组合套餐</h1>
		</div>
		
		<div data-role="content">

			<h2>订单详情</h2>
			<!--
			<table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
			-->
			<p id="oid"></p>
            <p id="selectNum"></p>
            <p id="office"></p>


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

               <tr>
                   <th>4</th>
                   <td>其他增值业务</td>
                   <td id="otherPack_name">来显每月</td>
                   <td id="otherPack_fee">6元</td>
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

            <!--
			<p>
			<input type="button" value="确认订单" id="payBtn">
			</p>
			-->
            <a href="javascript:jumpPage2();" class="ui-btn" data-ajax="false">我知道了</a>

			<!--
			<p id="url"></p>
			-->
			<p align="right">

            <!--
			<a href="#page2" data-transition="slide">我想重新选择自由组合套餐</a>
			-->

			</p>

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
var  currentPage = 1; /*init page num*/
var size = 8;
var feeSum = 0;
var count = 0;

var fee_flowPack = 10;
var fee_pack = 0;
var fee_msgPack = 0;
var fee_callshowPack = 0;
var fee_otherPack = 0;

//$().ready(function() {
function jumpPage2()
{
    localStorage.removeItem("num");
    localStorage.removeItem("ychf");
    localStorage.removeItem("zdxf");
    $.mobile.changePage('#page2',{ reloadPage:'true'});
    //$.mobile.changePage('#page2');
}

function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}


$(document).on("pageshow", "#page2", function(){

   	function feeSummary()
	{
		feeSumVal= fee_flowPack + fee_pack + fee_msgPack + fee_callshowPack + fee_otherPack;

        localStorage.setItem("feeSum", feeSumVal);
        feeSum = localStorage.getItem("feeSum");

		$("#diy-create").html("自由组合套餐    月消费:<span style='font-size: 18px; color:#ff8600; font-weight:  bolder'>"+feeSum+"元</span>");
		//$("#total_fee").val(feeSum);
	}
	
	feeSummary();
	
	function showSelectedNumber()
	{
		if(localStorage.getItem("num") != null)
		{			
			$("#sel-num")[0].innerHTML="您选的号码 "+localStorage.getItem("num");
		}
	}
	showSelectedNumber();

   	$("[name=flowPack]").click(function(){
		changeTabTitle("flowPack",$(this).val());
	});
	
   	$("[name=voicePack]").click(function(){
		changeTabTitle("voicePack",$(this).val());

		if( $(this).val() != 999)
		{
			$( "#callshowPack_0" ).prop( "checked", true ).checkboxradio( "refresh" );
			$( "#callshowPack_notselect" ).checkboxradio( "option", "disabled", true ).checkboxradio( "refresh" );
			changeTabTitle("callshowPack",0);
		}
		else
		{
			$( "#callshowPack_notselect" ).checkboxradio( "enable" );
			changeTabTitle("callshowPack",0);
		}
	});
	
   	$("[name=msgPack]").click(function(){
		changeTabTitle("msgPack",$(this).val());
	});
	
   	$("[name=callshowPack]").click(function(){
		changeTabTitle("callshowPack",$(this).val());
	});

    $("[name=otherPack]").click(function(){
        changeTabTitle("otherPack",$(this).val());
    });

    function changeTabTitle(v1,v2)
	{
		if(v1=="flowPack")
		{
			if(v2==0)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'>100MB</span>");
				fee_flowPack = 10;
			}
			else if(v2==1)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 300MB</span>");
				fee_flowPack = 20;
			}
			else if(v2==2)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 500MB</span>");
				fee_flowPack = 30;
			}
			else if(v2==3)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 1GB</span>");	
				fee_flowPack = 60;
			}
			else if(v2==4)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 2GB</span>");
				fee_flowPack = 90;
			}
			else if(v2==5)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 3GB</span>");
				fee_flowPack = 129;
			}
			else if(v2==6)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 4GB</span>");
				fee_flowPack = 150;
			}
			else if(v2==7)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 6GB</span>");
				fee_flowPack = 190;
			}
			else if(v2==8)
			{
				$("#flowPackTabTitle").html("流量包<br><span class='tabSumm'> 11GB</span>");
				fee_flowPack = 290;
			}
			else
				$("#flowPackTabTitle").html("流量包<br>&nbsp");	
		}
		else if(v1=="voicePack")
		{
            if(v2==0)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 200分钟</span>");
				fee_pack = 40;
			}
			else if(v2==1)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 300分钟</span>");
				fee_pack = 50;
			}
			else if(v2==2)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 500分钟</span>");
				fee_pack = 70;
			}
			else if(v2==3)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 1000分钟</span>");	
				fee_pack = 140;
			}
			else if(v2==4)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 2000分钟</span>");
				fee_pack = 200;
			}
			else if(v2==5)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'> 3000分钟</span>");
				fee_pack = 300;
			}
			else if( v2==999)
			{
				$("#packTabTitle").html("语音包<br><span class='tabSumm'>&nbsp;</span>");
				fee_pack = 0;
			}
			else
				$("#packTabTitle").html("语音包<br><span class='tabSumm'>&nbsp;</span>");
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
			else if(v2==999)
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
			else if(v2==999)
			{
				$("#callshowPackTabTitle").html("来电显示<br>&nbsp ");
				fee_callshowPack = 0;
			}
			else
				$("#callshowPackTabTitle").html("来电显示<br>&nbsp");

		}
        else if(v1=='otherPack')
        {
            if(v2==0)
            {
                $("#otherPackTabTitle").html("其他<br><span class='tabSumm'> 已选</span>");
                fee_otherPack = 5;
            }
            else if(v2==1)
            {
                $("#otherPackTabTitle").html("其他<br><span class='tabSumm'> 已选</span>");
                fee_otherPack = 5;
            }
            else if(v2==2)
            {
                $("#otherPackTabTitle").html("其他<br><span class='tabSumm'> 已选</span>");
                fee_otherPack = 6;
            }
            else if(v2==999)
            {
                $("#otherPackTabTitle").html("其他<br>&nbsp");
                fee_otherPack = 0;
            }
            else
                $("#otherPackTabTitle").html("其他<br>&nbsp");
        }
		
		/**/
		feeSummary();
	}
	
	
	//submit form
	//$('#submitBtn').click(function(){
        $(document).on("click", "#submitBtn", function(){
		//alert('page2topage3');

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
            alert("请选择营业厅");
            return false;
        }

        if(localStorage.getItem('ychf') >= 50)
            realFee = localStorage.getItem('ychf');
        else
            realFee = 50;

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			//url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/g2048save' ; ?>"+"&bigNum="+bigNum+"&score="+myGameStateObj.score+"&best="+myScore,
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
            cache:false,
			data: $("form#productForm").serialize() +"&cid="+0+"&feeSum="+realFee+"&selectNum="+selectNum,
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
                    //alert(data.status +"------"+ data.errmsg);
					return false;
				}
			}
		});
        return false;
	});

});

$(document).on("pageshow", "#page3", function(){

	flowPack_name = <?php echo \app\models\MOrder::getFlowPackName(); ?>;
	flowPack_fee =<?php echo \app\models\MOrder::getFlowPackFee(); ?>;

	voicePack_name = <?php echo \app\models\MOrder::getVoicePackName(); ?>;
	voicePack_fee = <?php echo \app\models\MOrder::getVoicePackFee(); ?>;

	msgPack_name = <?php echo \app\models\MOrder::getMsgPackName(); ?>;
	msgPack_fee = <?php echo \app\models\MOrder::getMsgPackFee(); ?>;

	callshowPack_name = <?php echo \app\models\MOrder::getCallShowPackName(); ?>;
	callshowPack_fee =<?php echo \app\models\MOrder::getCallShowPackFee(); ?>;

    otherPack_name = <?php echo \app\models\MOrder::getOtherPackName(); ?>;
    otherPack_fee =<?php echo \app\models\MOrder::getOtherPackFee(); ?>;

    office_name = <?php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

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

    $("#otherPack_name").html(otherPack_name[otherPack]);
    $("#otherPack_fee").html(otherPack_fee[otherPack]+"元");

	$("#total").html("合计:"+feeSum+"元");
	
	var oid = localStorage.getItem("oid");
	$("#oid").html("您的订单号: "+oid);

    var selectNum = localStorage.getItem("num");
    $("#selectNum").html("所选的号码: "+selectNum);

    localStorage.removeItem("luckNum");/*订单生成后，锁定该手机号*/

   $("#office").html('所选营业厅: ' +office_name[office] );

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
            cache:false,
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

    function loadData(i, n)
    {
        //alert('load data');
        count++;
        //alert(count);
        cssStr = "style='height:60px;'";
        if( localStorage.getItem("num") != null)
        {
            if(n.num == localStorage.getItem("num"))
               // cssStr = "style='height:60px; border:1px solid red'";
                cssStr = "style='height:60px; background-color:yellow'";
            else
                cssStr = "style='height:60px;'";
        }

        if(i%2 == 0)
                var text = " <div class='ui-block-a'><div class='ui-bar ui-bar-a' "+cssStr+"><a href='' >"+n.num+"-"+ n.ychf+"-"+ n.zdxf+"</a></div></div>";
        else
                var text = " <div class='ui-block-b'><div class='ui-bar ui-bar-a' "+cssStr+"><a href='' >"+n.num+"-"+ n.ychf+"-"+ n.zdxf+"</a></div></div>";

        $("#list_common_tbody").append(text).trigger('create');

    }

    function getNumberList()
    {
        $("#list_common_tbody").html('');
            $.ajax({
                //url: "<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/ajaxdata' ; ?>",
                url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'mobileNum'], true) ; ?>",
                type:"GET",
                cache:false,
                //data: $("form#productForm").serialize() +"&feeSum="+feeSum,
                data: "&currentPage="+currentPage+"&size="+size+"&cid="+0+"&feeSum="+feeSum,
                success: function(msg){
                    var json_data = eval('('+msg+')');

                    if(json_data)
                    {
                        $.each(json_data, loadData);
                    }
                    if(json_data.length < 8)
                        currentPage =1;
                    //$("#list_count").html(count);

                }
            });
        return false;
    }
    getNumberList();

    $(document).on("click",".ui-grid-a a",function(){
		//alert($(this).text());
		//localStorage.setItem("luckNum",$(this).text());

        cardInfo = ($(this).text()).split('-');
        localStorage.setItem("num",cardInfo[0]);
        localStorage.setItem("ychf",cardInfo[1]);
        localStorage.setItem("zdxf",cardInfo[2]);

		//location.href="#page2";
        $.mobile.changePage("#page2",{transition:"slide"});
	});

    $("#seleNumBtn").click(function(){
        //alert("换一批号码看看, 玩命加载中...");
        currentPage++;
        getNumberList();
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
