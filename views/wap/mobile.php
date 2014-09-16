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
    color:#000000;
    font-size: 10pt;
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
color: #aaaaaa;
text-decoration: line-through;
}
/*-----------------------------------------------*/

.title_comm
{
    color:#aaaaaa;
    font-size: 10pt;
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


<div data-role="page" id="page2" data-theme="c">
   
    <?php echo $this->render('header1', ['menuId'=>'menu2','title' => $item->title ]); ?>

    <div data-role="popup" id="popupErrorMsg" data-theme="c">
    <p id="errorMsg"></p>
    </div>

	<div data-role="content">
	<form id="productForm">	
	<div data-role="content" data-theme="c">	
	<p  align=center id="imgURL">
	    <img width="100%" src="<?php echo  $item->pic_url; ?>" alt=""/>
	</p>

        <p id="desc">
            <?php echo  $item->title_hint; ?>
        </p>

        <p id="price" class="title_comm">
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
        
    <input type="hidden" name="prom" vaule="0">
      <!--
	  <div data-role="fieldcontain">
		<fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
		  <legend>优惠活动</legend>
		  <input type="radio" name="prom" id="radio1_0" value="0" checked />
          <label for="radio1_0">充话费送手机</label>
		</fieldset>
	  </div>
      -->
        <br>
        <br>

        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">

            <li>
                <a href="#detail">
                <p class="title_comm">产品详情</p>
                </a>
            </li>

            <li id="sel-num-li">
                <a href="#number-select">
                <p id="sel-num" class="title_unset">请选择手机号码</p>
                </a>
            </li>

            <li id="package-li">
                <a href="#packagePage">
                <p id="package" class="title_unset">套餐月费</p>
                </a>
            </li>

            <li id="contact-li">
                <a href="#contactPage">
                <p id="contact" class="title_unset">用户信息</p>
                </a>
            </li>

            <li id="office-li">
                <a href="#office-select">
                <p id="officeName" class="title_unset">营业厅</p>
                </a>
            </li>

        </ul>
        <br>
        <br>

        <a  href="#" id="submitBtn" class="ui-btn" style="background-color: #44B549">一键购买</a>

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
	
    <?php echo $this->render('header2', ['menuId'=>'menu5','title' => $item->title ]); ?>   

	<div data-role="content">
		<h3>请选择手机号码</h3>
        <div class="ui-grid-a" id="list_common_tbody">
        <!--
		<div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >13545296480</a></div></div>
		<div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >33333333333</a></div></div>
        <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >77777777777</a></div></div>
        <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >55555555555</a></div></div>
        <div class="ui-block-a"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >66666666666</a></div></div>
        <div class="ui-block-b"><div class="ui-bar ui-bar-a" style="height:60px"><a href="" >88888888888</a></div></div>
        -->
		</div>
        
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

    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu6','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<div data-role="page" id="office-select" data-theme="c">
    <?php echo $this->render('header2', ['menuId'=>'menu7','title' => $item->title]); ?>
    <div data-role="content">
 
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


<div data-role="page" id="packagePage" data-theme="c">
    <?php echo $this->render('header2', ['menuId'=>'menu8','title' => $item->title]); ?>
    <div data-role="content">

        <?php 
            $pkg3g4gOption = $item->getPkg3g4gOption();
            $pkgPeriodOption = $item->getpkgPeriodOption();
            $pkgMonthpriceOption = $item->getpkgMonthpriceOption();
            $pkgPlanOption = $item->getpkgPlanOption();
      
            //U::W($pkg3g4gOption);
        ?>
        <!-- -->    

        <?php if (!empty($pkg3g4gOption)): ?>
            <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="pkg3g4g-field">
                <legend>套餐类型</legend>
                    <?php foreach($pkg3g4gOption as $value => $text) { ?>
                    <input type="radio" name="pkg3g4g" id="pkg3g4g_<?= $value ?>" value="<?= $value ?>" />
                    <label for="pkg3g4g_<?= $value ?>"><?= $text ?></label>
                    <?php } ?> 
            </fieldset>
        <?php endif; ?>

        <?php if (!empty($pkgPeriodOption)): ?>
            <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="pkgPeriod-field">
                <legend>合约期长</legend>
                    <?php foreach($pkgPeriodOption as $value => $text) { ?>
                    <input type="radio" name="pkgPeriod" id="pkgPeriod_<?= $value ?>" value="<?= $value ?>" />
                    <label for="pkgPeriod_<?= $value ?>"><?= $text ?></label>
                    <?php } ?> 
            </fieldset>
        <?php endif; ?>

        <?php if (!empty($pkgMonthpriceOption)): ?>
            <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="pkgMonthprice-field">
                <legend>套餐月租</legend>
                    <?php foreach($pkgMonthpriceOption as $value => $text) { ?>
                    <input type="radio" name="pkgMonthprice" id="pkgMonthprice_<?= $value ?>" value="<?= $value ?>" />
                    <label for="pkgMonthprice_<?= $value ?>"><?= $text ?></label>
                    <?php } ?> 
            </fieldset>
        <?php endif; ?>

        <?php if (!empty($pkgPlanOption)): ?>
            <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="pkgPlan-field">
                <legend>套餐计划</legend>
                    <?php foreach($pkgPlanOption as $value => $text) { ?>
                    <input type="radio" name="pkgPlan" id="pkgPlan_<?= $value ?>" value="<?= $value ?>" />
                    <label for="pkgPlan_<?= $value ?>"><?= $text ?></label>
                    <?php } ?> 
            </fieldset>
        <?php endif; ?>

        <!--
        pkg_price":"6299", 产品包价格（元）
        "prom_price":"5399", 优惠购机款（元）
        "yck":"900", 预存款（元）
        "income_return":"0", 
        "month_return":"75" 分月返还金额
        -->

        <hr color="#F7C708">
        <div id='pkginfo_common_body'>
        <p id='pkg_price'><span class='title_comm'>产品包价格:</span> </p>
        <p id='prom_price'><span class='title_comm'>优惠购机款:</span> </p>
        <p id='yck'><span class='title_comm'>预存款:</span> </p>

        <p id='month_return'><span class='title_comm'>分月返还金额:</span> </p>

        <p>
            <input type="button" value="确定" id="selePackage">
        </p>

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
    //var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
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

var ctrl_mobnumber = "<?php echo  $item->ctrl_mobnumber; ?>";
var ctrl_userinfo = "<?php echo  $item->ctrl_userinfo; ?>";
var ctrl_office = "<?php echo  $item->ctrl_office; ?>";
var ctrl_package = 1; 
var ctrl_supportpay = "<?php echo  $item->ctrl_supportpay; ?>";

var ctrl_pkg_plan = "<?php echo  $item->ctrl_pkg_plan; ?>";


function isWeiXin() {
	var ua = window.navigator.userAgent.toLowerCase();
	if (ua.match(/MicroMessenger/i) == 'micromessenger') {
		return true;
	} else {
		return false;
	}
}



$(document).on("pageshow", "#page2", function(){

    /*item ctrl begin --------------------------------------------*/
    if(ctrl_mobnumber == 0)
    {
        $("#sel-num-li").hide();
    }
    else
    {
        $("#sel-num-li").show();
    }

    if(ctrl_userinfo == 0)
    {
        $("#contact-li").hide();
    }
    else
    {
        $("#contact-li").show();
    }
    
    if(ctrl_office == 0)
    {
        $("#office-li").hide();
    }
    else
    {
        $("#office-li").show();
    }
    
    if(ctrl_package == 0)
    {
        $("#package-li").hide();
    }
    else
    {
        $("#package-li").show();
    }

    /*item ctrl end --------------------------------------------------*/


    if(localStorage.getItem("pkg3g4g")=="3g")
    {
        pkg3g4g = "3G普通套餐";
    }
    else
    {
        pkg3g4g = "4G/3G一体化套餐";
    }

    if(localStorage.getItem("pkg3g4g") != null)
    {           
        $("#package")[0].innerHTML="套餐月费 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+pkg3g4g+"...</span>";
        //$("#sel-num").trigger('create');
         $("#package").removeClass("title_unset").addClass("title_set");
    }

    if(localStorage.getItem("num") != null)
    {           
        //alert(localStorage.getItem("num"));
        $("#sel-num")[0].innerHTML="选中号码 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+localStorage.getItem("num")+"</span>";
        //$("#sel-num").trigger('create');
        $("#sel-num").removeClass("title_unset").addClass("title_set");
    }

    if(localStorage.getItem("username") != null)
    {           
        $("#contact")[0].innerHTML="用户信息 &nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+localStorage.getItem("username")+"...</span>";
        $("#contact").removeClass("title_unset").addClass("title_set");
    }
    
    office_name = <?php echo \app\models\MOffice::getOfficeNameOption($gh_id); ?>;

    if(localStorage.getItem("office") != null)
    {
        $("#officeName")[0].innerHTML="营业厅 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='title_set_content'>"+ office_name[localStorage.getItem("office")] +"...</span>";
        $("#officeName").removeClass("title_unset").addClass("title_set");
    }
    
});

function loadData2(i, n)
{
    $("#pkg_price").html("<span class='title_comm'>产品包价格:</span>"+n.pkg_price+"元");
    $("#prom_price").html("<span class='title_comm'>优惠购机款:</span>"+n.prom_price+"元");
    $("#yck").html("<span class='title_comm'>预存款:</span>"+n.yck+"元");
    //$("#income_return").html("<span class='title_comm'>income_return:</span>"+n.income_return+"元");
    $("#month_return").html("<span class='title_comm'>分月返还金额:</span>"+n.month_return+"元");
}

function PkgItemQuerycheck() 
{ 
  var ipt;
  var textboxs = new Array(); // text类型的input集合 
  var radioList = new Object(); 
  //radio类型的input集合，因为Radio比较特殊，要一组一组检测，所以这里用一个Hashtable，根据radio的name作为Key来保存所有的Radio集合
  
  // 每一个name对应的Radio集合 
  var inputs = document.getElementsByTagName("INPUT"); // 取form下的所有input 
  
  // 遍历所有INPUT 
  for (var i=0; i<inputs.length; i++) 
  { 
    ipt = inputs[i]; 
    
    if (ipt.type == "radio")  
    { 
      radioes = radioList[ipt.name]; 
      if (!radioes) 
      { 
        radioes = new Array(); 
      } 
      radioes[radioes.length] = ipt; 
      radioList[ipt.name] = radioes; 
    }
  } 

  // 遍历所有Radiobox组 
  for (var radioboxName in radioList) 
  { 
    radioes = radioList[radioboxName]; 
    var chk = false; // 是否有选中的 
    var radio;  
    // 检测该组Radio是否都选中了 
    for (var j=0; j<radioes.length; j++) 
    { 
      var radio = radioes[j]; 
      if (radio.checked) 
      { 
        chk = true; 
        break; 
      } 
    } 
    if (!chk) // 没有选中的 
    { 
      //alert("please select: " + radioboxName); 
      return false; 
    } 
  } 

  return true; 
}


function PkgItemQuery()
{   //localStorage.getItem("num") == null
    if(PkgItemQuerycheck())
    {
        //alert('all cheched!');
        $("#pkginfo_common_body").show();
        $("#selePackage").removeAttr("disabled");

        pkg3g4g = localStorage.getItem("pkg3g4g");
        pkgPeriod = localStorage.getItem("pkgPeriod");
        pkgMonthprice = localStorage.getItem("pkgMonthprice");
        pkgPlan = localStorage.getItem("pkgPlan");

        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'pkginfo'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: "&cid="+cid+"&pkg3g4g="+pkg3g4g+"&pkgPeriod="+pkgPeriod+"&pkgMonthprice="+pkgMonthprice+"&pkgPlan="+pkgPlan,
            success: function(json_data){
                if(json_data)
                {
                   loadData2(0, json_data); 
                }
            }
        });
    }
    else
    {
        //alert('not checked all');
    }

}


$(document).on("pageinit", "#packagePage", function(){
    
    //alert("packagePage");   
    $("#pkginfo_common_body").hide();
    $("#selePackage").attr("disabled", "disabled");

    $(document).on("tap","#selePackage",function(){
        $.mobile.changePage("#page2",{transition:"slide"});
    });

    $("[name=pkg3g4g]").click(function(){
        localStorage.setItem("pkg3g4g",$(this).val());
        PkgItemQuery();
    });

    $("[name=pkgPeriod]").click(function(){
        localStorage.setItem("pkgPeriod",$(this).val());
        PkgItemQuery();
    });

    $("[name=pkgMonthprice]").click(function(){
        localStorage.setItem("pkgMonthprice",$(this).val());
        PkgItemQuery();
    });

    $("[name=pkgPlan]").click(function(){
        localStorage.setItem("pkgPlan",$(this).val());
        PkgItemQuery();
    });

});

$(document).on("pageinit", "#page2", function(){

	var cardType = 0;

    selectNum = null;
    office = null;
    username = null;
    usermobile = null;
    userid = null;

    pkg3g4g = null;
    pkgPeriod = null;
    pkgMonthprice = null;
    pkgPlan = null;

	//submit form
    $(document).on("tap", "#submitBtn", function(){

        if(ctrl_mobnumber != 0)
        {
            if( localStorage.getItem("num") == null)
            {
                //$.mobile.changePage("#number-select",{transition:"slide"});
                $("#errorMsg").html("<span class='title_unset'>请选择手机号码</span>");
                $("#popupErrorMsg").popup("open");
                return false;
            }
            else
            {
                selectNum = localStorage.getItem("num");
            }
        }

        if(ctrl_package != 0)
        {
            if( localStorage.getItem("pkg3g4g") == null)
            {
                //$.mobile.changePage("#package",{transition:"slide"});
                $("#errorMsg").html("<span class='title_unset'>请选择套餐月费</span>");
                $( "#popupErrorMsg" ).popup( "open" );
                return false;
            }
            else
            {
                pkg3g4g = localStorage.getItem("pkg3g4g");
                pkgPeriod = localStorage.getItem("pkgPeriod");
                pkgMonthprice = localStorage.getItem("pkgMonthprice");
                pkgPlan = localStorage.getItem("pkgPlan");
            }
        }

        if(ctrl_userinfo != 0)
        {
            if( localStorage.getItem("username") == null)
            {
                //alert("aaa");
                //$.mobile.changePage("#contactPage",{transition:"slide"});
                $("#errorMsg").html("<span class='title_unset'>请输入用户信息</span>");
                $("#popupErrorMsg").popup("open");

                return false;
            }
            else
            {
                username = localStorage.getItem("username");
                usermobile = localStorage.getItem("usermobile");
                userid = localStorage.getItem("userid");
            }
        }       
 
        if(ctrl_office != 0)
        {
            if( localStorage.getItem("office") == null)
            {
                //$.mobile.changePage("#office-select",{transition:"slide"});
                $("#errorMsg").html("<span class='title_unset'>请选择营业厅</span>");
                $( "#popupErrorMsg" ).popup( "open" );
                return false;
            }
            else
            {
                office = localStorage.getItem("office");
            }
        }
       

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
			data: $("form#productForm").serialize()+"&cid="+cid+"&pkg3g4g="+pkg3g4g+"&pkgPeriod="+pkgPeriod+"&pkgMonthprice="+pkgMonthprice+"&pkgPlan="+pkgPlan+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid,
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
                    //window.location.href = url+'&oid='+json_data.oid;
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

        if(office != 0)
        {
            localStorage.setItem('office',office);
            $.mobile.changePage("#page2",{transition:"slide"});
        }        
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
