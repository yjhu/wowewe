<?php
	use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\MItem;

    use app\models\U;
    use app\models\MOffice;

    $item = \app\models\MItem::findOne(['gh_id'=>$gh_id, 'cid'=>$cid]);
	//if ($item === null)
	//{
	//	U::W("impossible! gh_id=$gh_id, cid=$cid .............");
	//}
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
    color: #aaaaaa;
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

.ui-header .ui-title, .ui-footer .ui-title {
    margin-right: 0 !important; margin-left: 0 !important;
}

.line {
color: red;
text-decoration: line-through;
}

</style>


<div data-role="page" id="page2" data-theme="c">
   
    <?php echo $this->render('header1', ['menuId'=>'menu2','title' => $item->title ]); ?>

	<div data-role="content">
	<form id="productForm">	
	<div data-role="content" data-theme="c">	
	<p  align=center id="imgURL">
	    <img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
	</p>

        <p id="desc">
            <?php echo  $item->title_hint; ?>
        </p>

        <p id="price">
        价格  <span class="fee">￥<?php echo  ($item->price)/100; ?></span>
        <span class="line"><small>原价￥<?php echo  ($item->old_price)/100; ?></small></span>
        <br><span id="priceHint" class="productPkgHint"><!--含预存款50元--> <?php echo  $item->price_hint; ?></span>
        </p>

        <!--
        <?//php if ($cid == MItem::ITEM_CAT_MOBILE_IPHONE4S): ?>
        -->
        <div class="ui-corner-all custom-corners">
        <!--
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <legend>型号颜色</legend>
                    <input type="radio" name="modelColor" id="modelColor_0" value="0" checked="checked">
                    <label for="modelColor_0" id="modelColor_0">黑色</label>
                    <input type="radio" name="modelColor" id="modelColor_1" value="1">
                    <label for="modelColor_1" id="modelColor_1">白色</label>
                </fieldset>
            </div>
        <?//php else: ?>
            <div class="ui-corner-all custom-corners">
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                        <legend>型号颜色</legend>
                        <input type="radio" name="modelColor" id="modelColor_1" value="1" checked="checked">
                        <label for="modelColor_1" id="modelColor_1">白色</label>
                    </fieldset>
                </div>
        <?//php endif; ?>
        -->

	  <div data-role="fieldcontain">
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
		  <legend>优惠活动</legend>
		  <input type="radio" name="prom" id="radio1_0" value="0" checked />

		  <!--<label for="radio1_0">买手机送话费</label>-->
          <label for="radio1_0">充话费送手机</label>
		</fieldset>
	  </div>

            <br>

            <ul data-role="listview" data-inset="false">

                <li>
                    <a href="#detail">
                    <p>产品详情</p>
                    </a>
                </li>

                <li>
                    <a href="#number-select">
                    <p id="sel-num">请选择手机号码</p>
                    </a>
                </li>

                <li>
                    <a href="#package">
                    <p id="package">套餐月费</p>
                    </a>
                </li>

                <li>
                    <a href="#contactPage">
                    <p id="contact">用户信息</p>
                    </a>
                </li>

                <li>
                    <a href="#office-select">
                    <p id="officeName">营业厅</p>
                    </a>
                </li>

            </ul>

        <br>

        <a  href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">确认套餐</a>
        <!--
        <input type="button" value="确认套餐" id="submitBtn" data-theme="a" style="background-color: green">
        -->		

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
<!--
<div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
	<h1 id="title"><?php echo  $item->title; ?></h1>
</div>
-->

<?php echo $this->render('header2', ['menuId'=>'menu4','title' => $item->title ]); ?>   

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
    <!--
	<div data-role="header" data-add-back-btn="true" data-back-btn-text="返回">
		<h1><?php echo  $item->title; ?></h1>
	</div>
    -->
	
    <?php echo $this->render('header2', ['menuId'=>'menu5','title' => $item->title ]); ?>   

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

<div data-role="page" id="detail" data-theme="c">

    <?php echo $this->render('header2', ['menuId'=>'menu6','title' => $item->title]); ?>

    <div data-role="content">
        <?php echo  $item->detail; ?>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu6','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<div data-role="page" id="office-select" data-theme="c">
    <?php echo $this->render('header2', ['menuId'=>'menu7','title' => $item->title]); ?>
    <div data-role="content">
        <h2>请选择营业厅</h2>
            <?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false),["id"=>"office"]); ?>
        <p>
            <input type="button" value="确定" id="seleOffice">
        </p>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu7','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<div data-role="page" id="package" data-theme="c">
    <?php echo $this->render('header2', ['menuId'=>'menu8','title' => $item->title]); ?>
    <div data-role="content">

                <div id="TabbedPanels1" class="TabbedPanels">
                <ul class="TabbedPanelsTabGroup">
                    <li class="TabbedPanelsTab" tabindex="0" id="Title66">月消费66元</li>
                    <li class="TabbedPanelsTab" tabindex="0" id="Title96">月消费96元</li>
                    <li class="TabbedPanelsTab" tabindex="0" id="Title126">月消费126元</li>
                </ul>
                <div class="TabbedPanelsContentGroup">
                    <div class="TabbedPanelsContent">
                        <div role="main" class="ui-content">
                            <fieldset data-role="controlgroup">
                                <legend>套餐类型</legend>
                                <input type="radio" name="plan66" id="plan66_0" value="0"  checked />
                                <label for="plan66_0">A计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan66" id="plan66_1" value="1" />
                                <label for="plan66_1">B计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan66" id="plan66_2" value="2" />
                                <label for="plan66_2">C计划&nbsp;&nbsp;</label>
                            </fieldset>
                            <p id="plan66-show">&nbsp;</p>

                        </div><!-- /content -->
                    </div>

                    <div class="TabbedPanelsContent">
                        <div role="main" class="ui-content">
                            <fieldset data-role="controlgroup">
                                <legend>套餐类型</legend>
                                <input type="radio" name="plan96" id="plan96_0" value="0"  checked />
                                <label for="plan96_0">A计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan96" id="plan96_1" value="1" />
                                <label for="plan96_1">B计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan96" id="plan96_2" value="2" />
                                <label for="plan96_2">C计划&nbsp;&nbsp;</label>
                            </fieldset>
                            <p id="plan96-show">&nbsp;</p>

                        </div><!-- /content -->
                    </div>

                    <div class="TabbedPanelsContent">
                        <div role="main" class="ui-content">
                            <fieldset data-role="controlgroup">
                                <legend>套餐类型</legend>
                                <input type="radio" name="plan126" id="plan126_0" value="0"  checked />
                                <label for="plan126_0">A计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan126" id="plan126_1" value="1" />
                                <label for="plan126_1">B计划&nbsp;&nbsp;</label>
                                <input type="radio" name="plan126" id="plan126_2" value="2" />
                                <label for="plan126_2">C计划&nbsp;&nbsp;</label>
                            </fieldset>
                            <p id="plan126-show">&nbsp;</p>

                        </div><!-- /content -->
                    </div>

                </div>
            </div>
        <!--
        <p>
            <input type="button" value="确定" id="seleOffice">
        </p>
        -->
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu8','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<?php
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '特惠手机';
	$desc = '多款热销机型，优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
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
    var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    //var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2");
</script>

<script>
var  currentPage = 1; /*init page num*/
var size = 8;
var feeSum = 0;
var count = 0;
var phonePrice = <?php echo ($item->price)/100; ?>;


planFlag = 'plan66';
//$().ready(function() {
var cid = <?php echo $_GET['cid']; ?>;

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
        $("#sel-num")[0].innerHTML="您选的号码 <span class='productPkgHint'>"+localStorage.getItem("num")+"</span>";
        //$("#sel-num").trigger('create');
    }

    if(localStorage.getItem("planFlag")=="plan66")
    {
        planPrice = "66元/月";
        if(localStorage.getItem("plan66")==0)
            planName = "A计划";
        else if(localStorage.getItem("plan66")==1)
            planName = "B计划";
        else if(localStorage.getItem("plan66")==2)
            planName = "B计划"; 
    }
    else if(localStorage.getItem("planFlag")=="plan96")
    {
        planPrice = "96元/月";
        if(localStorage.getItem("plan96")==0)
            planName = "A计划";
        else if(localStorage.getItem("plan96")==1)
            planName = "B计划";
        else if(localStorage.getItem("plan96")==2)
            planName = "B计划"; 
    }
    else if(localStorage.getItem("planFlag")=="plan126")
    {
        planPrice = "126元/月";
        if(localStorage.getItem("plan126")==0)
            planName = "A计划";
        else if(localStorage.getItem("plan126")==1)
            planName = "B计划";
        else if(localStorage.getItem("plan126")==2)
            planName = "B计划"; 
    }

    if(localStorage.getItem("planFlag") != null)
    {           
        $("#package")[0].innerHTML="套餐月费 <span class='productPkgHint'>"+planPrice+"|"+planName+"</span>";
        //$("#sel-num").trigger('create');
    }

    if(localStorage.getItem("username") != null)
    {           
        $("#contact")[0].innerHTML="用户信息 <span class='productPkgHint'>"+localStorage.getItem("username")+"...</span>";
    }

    office_name = <?php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

    if(localStorage.getItem("office") != null)
    {
        $("#officeName")[0].innerHTML="营业厅 <span class='productPkgHint'>"+ office_name[localStorage.getItem("office")] +"...</span>";
    }    
    
});


$(document).on("pageinit", "#package", function(){
    $("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
    $("[name=plan66]").click(function(){
        planFlag = 'plan66';
        localStorage.setItem("planFlag","plan66");
        localStorage.setItem("plan66",$(this).val());
        //alert($(this).val());
        if($(this).val() == 0) /*plan a*/
            $("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
        else if($(this).val() == 1)
            $("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
        else if($(this).val() == 2)
            $("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
        else
            $("#plan66-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

    });

    $("[name=plan96]").click(function(){
        //alert($(this).val());
        planFlag = 'plan96';
        localStorage.setItem("planFlag","plan96");
        localStorage.setItem("plan96",$(this).val());
        if($(this).val() == 0) /*plan a*/
            $("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
        else if($(this).val() == 1)
            $("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
        else if($(this).val() == 2)
            $("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
        else
            $("#plan96-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

    });

    $("[name=plan126]").click(function(){
        //alert($(this).val());
        planFlag = 'plan126';
        localStorage.setItem("planFlag","plan126");
        localStorage.setItem("plan126",$(this).val());
        if($(this).val() == 0) /*plan a*/
            $("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");
        else if($(this).val() == 1)
            $("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-b.png'>");
        else if($(this).val() == 2)
            $("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-c.png'>");
        else
            $("#plan126-show").html("<img width='100%' style='display:block' src='../web/images/item/plan-a.png'>");

    });
});

$(document).on("pageinit", "#page2", function(){

	var cardType = 0;

    $("[name=office]").change(function(){
        if($("[name=office]").val() != 0)
            $("#officeArea").removeAttr('style');
    });

	//submit form
    $(document).on("tap", "#submitBtn", function(){
        if( localStorage.getItem("num") == null)
        {
            $.mobile.changePage("#number-select",{transition:"slide"});
            return false;
        }
        else
        {
            selectNum = localStorage.getItem("num");
        }


       // if($("[name=office]").val() == 0)
       // {
            //alert("请选择营业厅");
        //    $("#officeArea").attr('style', 'border:1px solid #ffffff;background-color:#ff99ff;');
        //    return false;
       // }

        if( localStorage.getItem("office") == null)
        {
            $.mobile.changePage("#office",{transition:"slide"});
            return false;
        }
        else
        {
            office = localStorage.getItem("office");
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

        planFlag = localStorage.getItem("planFlag");
        plan66 = localStorage.getItem("plan66");
        plan96 = localStorage.getItem("plan96");
        plan126 = localStorage.getItem("plan126");

        if((localStorage.getItem('ychf')/100) >= 50)
            realFee = localStorage.getItem('ychf')/100;
        else
            realFee = 50;

        if(realFee < 100)
            realFee = phonePrice;
        else
            realFee = realFee - 100 + phonePrice;

		localStorage.setItem("item",$("form#productForm").serialize());
		$.ajax({
			url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/prodsave' ; ?>",
			type:"GET",
            cache:false,
            dataType:'json',
			data: $("form#productForm").serialize()+"&cid="+cid+"&planFlag="+planFlag+"&plan66="+plan66+"&plan96="+plan96+"&plan126="+plan126+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid,
			success:function(json_data){
				//data = eval('('+data+')');

				if(json_data.status == 0)
				{
					//alert(data.oid);
					localStorage.setItem("oid",json_data.oid);
					localStorage.setItem("url",json_data.pay_url);

                    localStorage.removeItem("num");
                    //$.mobile.changePage("#page3",{transition:"slide"});   
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

/*
$(document).on("pageinit", "#page3", function(){

    var selectNum = localStorage.getItem("num");
    $("#selectNum").html("号码: "+selectNum);
    //remove seleted mobile number from client
    localStorage.removeItem("num");

    office_name = <?//php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

    var item = localStorage.getItem("item");
    item_new = item.replace(/&/g, ";") +';';
    eval(item_new);

    $("#office").html('所选营业厅: ' +office_name[office] );
	$("#contact").html('用户信息<br>' +'姓名: '+ localStorage.getItem("username")+'<br>手机: '+ localStorage.getItem("usermobile")+'<br>身份证: '+ localStorage.getItem("userid")  );

    // show total
    if((localStorage.getItem('ychf')/100) >= 50)
        realFee = localStorage.getItem('ychf')/100;
    else
        realFee = 50;

    if(realFee < 100)
        realFee = phonePrice;
    else
        realFee = realFee - 100 + phonePrice;

    $("#total").html("￥ " + realFee);

	var url = localStorage.getItem("url");
	//$("#url").html("<a href='"+url+"'>Pay</a>");


	$("#payBtn").click(function(){

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

	   }); //end of pay submit

});
*/


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

$(document).on("pageinit", "#office-select", function(){

    $("#seleOffice").click(function(){
        var office = $('#office').val();
        localStorage.setItem('office',office);
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

    feeSum = <?php echo  ($item->price)/100; ?>;
    function getNumberList()
    {
        $("#list_common_tbody").html('');

        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'mobileNum'], true) ; ?>",
            type:"GET",
	        cache:false,
	        dataType:'json',
            //data: $("form#productForm").serialize() +"&feeSum="+feeSum,
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

    $(document).on("tap",".ui-grid-a a",function(){
	    cardInfo = $(this).attr('myParams').split('-');
	    localStorage.setItem("num",cardInfo[0]);
	    localStorage.setItem("ychf",cardInfo[1]);
	    localStorage.setItem("zdxf",cardInfo[2]);
	    $.mobile.changePage("#page2",{transition:"slide"});
    });


    $(document).on("tap","#seleNumBtn",function(){
        // alert("玩命加载中...");
        currentPage++;
        getNumberList();
    });

});
</script>

<?php
/*

*/
?>
