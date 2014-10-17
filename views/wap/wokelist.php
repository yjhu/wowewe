<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;

?>
    
<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

    .ui-listview>li.ui-first-child, .ui-listview>li.ui-first-child>a.ui-btn {
        background-color: #FFF0CC !important;
    }

    .perImg_bg{ width:60px; height:68px; position:relative;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
    .perImg{width:60px; height:60px; position:absolute; top:6px; left:6px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; overflow:hidden;}
    .perImg img{width:60px; height:60px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; }
    .client_dl dt{ width:68px; overflow:hidden; margin:0 10px; text-align:center; float:left; padding-top:3px;}
    .client_dl dd{ position:relative; float:left;}
    .client_dl dd f15{ line-height:22px;}

    .perImg{width:56px; height:56px; position:absolute; top:6px; left:6px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; overflow:hidden;}
    .perImg img{width:56px; height:56px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; }

    .jin_vip, .zuan_vip, .pu_vip,.yin_vip,.tong_vip{ width:80px; height:20px;margin-left:4px;display:inline-block; vertical-align:middle;}
    .jin_vip{background:url(../web/images/woke/jinpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .zuan_vip{background:url(../web/images/woke/zuanshi.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .pu_vip{ background:url(../web/images/woke/putong.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .yin_vip{background:url(../web/images/woke/yinpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .tong_vip{background:url(../web/images/woke/tongpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}


</style>

<div data-role="page" id="wokelist" data-theme="c">

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '我的沃客' ]); ?>
    <div data-role="content">
        
        <ul data-role="listview" data-inset="false">

        <li>
        <!--
        <a href="#">
        <span class="perImg">
        <img src="../web/images/woke/0.jpg">
        </span>
        <h2>小沃</h2>
    
        <p>我的沃点：0.00 点</p>
        <p>可提现沃点：0.00 点</P>
        </a>
        -->

        <dl class="client_dl">
            <dt>
                <div class="perImg_bg">
                    <div class="perImg">
                        <img id="myphoto" src="../web/images/woke/0.jpg" width="56">
                    </div>
                </div>
                <p class="f9 marT7"><em id="vip_p" class="jin_vip"></em></p>
            </dt>

            <dd>
                <p><span style="font-size:22px;font-weight: border">张小强</span></p>

                <!--
                <div class="growth">
                <div style="width: 10.41%;" class="percent"></div>
                <span style="font-size:5pt">104/999</span>
                </div>
                <br>
                <span class="f13">您还差895成长值升级为钻石会员</span>
                ->
                <!--
                <em class="seeM_btn"><img src="/wolm/images/seeM_btn.png" width="7"></em>
                -->
          
                <p class="f13">我的沃点：<span style="font-size:12pt;font-weight:bolder">0.00</span> 点</p>
                <p class="f13">提现沃点：<span style="font-size:12pt;font-weight:bolder">0.00</span> 点</p>
            </dd>
        </dl>
 
        </li>

        <li><a href="#wddd"><img src="../web/images/woke/wddd.gif" alt="我的订单" class="ui-li-icon ui-corner-none">我的订单<span class="ui-li-count">0</span></a></li>
        <li><a href="#wdcf"><img src="../web/images/woke/wdcf.gif" alt="我的财富" class="ui-li-icon ui-corner-none">我的财富<span class="ui-li-count">100</span></a></li>
        <li><a href="#tqjl"><img src="../web/images/woke/tqjl.gif" alt="提现记录" class="ui-li-icon ui-corner-none">提现记录<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdyhk.gif" alt="我的银行卡" class="ui-li-icon ui-corner-none">我的银行卡<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/aqsz.gif" alt="安全设置" class="ui-li-icon ui-corner-none">安全设置</a></li>
        <li><a href="#"><img src="../web/images/woke/wdhb.gif" alt="我的海报" class="ui-li-icon ui-corner-none">我的海报</a></li>
        <li><a href="#"><img src="../web/images/woke/lqjl.gif" alt="领取记录" class="ui-li-icon ui-corner-none">领取记录<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdsc.gif" alt="我的收藏" class="ui-li-icon ui-corner-none">我的收藏<span class="ui-li-count">10</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdmy.gif" alt="我的盟友" class="ui-li-icon ui-corner-none">我的盟友<span class="ui-li-count">20</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdrw.gif" alt="我的任务" class="ui-li-icon ui-corner-none">我的任务<span class="ui-li-count">2</span></a></li>


        </ul>

    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->


<div data-role="page" id="wddd" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu11','title' => '我的订单' ]); ?>
<div data-role="content">
    <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="wdddStatus-field">
        <legend>状态</legend>
 
        <input type="radio" name="wdddStatus" id="wdddStatus_1" value="1" />
        <label for="wdddStatus_1">已结算(0)</label>
                
        <input type="radio" name="wdddStatus" id="wdddStatus_2" value="2" />
        <label for="wdddStatus_2">未结算(0)</label>
        
        <input type="radio" name="wdddStatus" id="wdddStatus_3" value="3" />
        <label for="wdddStatus_3">无效订单(0)</label>
    </fieldset>


    <fieldset data-role="controlgroup" data-mini="true" data-type="horizontal" id="wdddTime-field">
        <legend>时间</legend>
 
        <input type="radio" name="wdddTime" id="wdddTime_1" value="1" />
        <label for="wdddTime_1">近一个月</label>
                
        <input type="radio" name="wdddTime" id="wdddTime_2" value="2" />
        <label for="wdddTime_2">近三个月</label>
        
        <input type="radio" name="wdddTime" id="wdddTime_3" value="3" />
        <label for="wdddTime_3">近六个月</label>
    </fieldset>

    <br>
    <div class="ui-grid-a">
        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" style="height:60px">
           订单笔数
            <br>
            <span style="font-size:18pt;">0</span> 
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-b" style="height:60px">
            实际收益沃点
            <br>
            <span style="font-size:18pt;">0.00</span> 
        </div>
        </div>

    </div>
    <br>

    <center>
    <span>
    <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
    <p>没有订单？快去催小伙伴购买吧~</p>
   </span>
   <c/enter>
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu11','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>



<div data-role="page" id="wdcf" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu2','title' => '我的财富' ]); ?>

<div data-role="content">

<div class="ui-grid-solo">
    <div class="ui-block-a">

    <div class="ui-bar ui-bar-a" style="height:60px">
    我的沃点
    <br>
    <span style="font-size:28pt;font-weight:bolder;color:#ff6500">0.00</span> 
    </div>
    </div>
</div>
<br>
<div class="ui-grid-a">
    <div class="ui-block-a">
    <div class="ui-bar ui-bar-a" style="height:60px">
        可提现沃点
        <br>
        <span style="font-size:18pt;">0.00</span> 
    </div>
    </div>

    <div class="ui-block-b">
    <div class="ui-bar ui-bar-b" style="height:60px">
        预期沃点
        <br>
        <span style="font-size:18pt;">0.00</span> 
    </div>
    </div>

    <div class="ui-block-a">
    <div class="ui-bar ui-bar-a" style="height:60px">
        累计结算沃点
        <br>
        <span style="font-size:18pt;">0.00</span> 
    </div>
    </div>

    <div class="ui-block-b">
    <div class="ui-bar ui-bar-b" style="height:60px">
        累计提现沃点
        <br>
        <span style="font-size:18pt;">0.00</span> 
    </div>
    </div>    

</div>

<ol data-role="listview" data-inset="true">
    <li>每日计算预期沃点</li>
    <li>每月20日结算沃点</li>
    <li>我的沃点 = 可提现沃点＋预期沃点</li>
    <li>预期沃点即未结算订单带来预估值</li>
</ol>
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
<?php echo $this->render('menu', ['menuId'=>'menu2','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>



<div data-role="page" id="tqjl" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu3','title' => '提取记录' ]); ?>
<div data-role="content">

    <div class="ui-grid-a">
        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" style="height:60px">
           累计提现(点)
            <br>
            <span style="font-size:18pt;">0.00</span> 
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-b" style="height:60px">
            折合人民币(元)
            <br>
            <span style="font-size:18pt;">0.00</span> 
        </div>
        </div>

    </div>
    <br>


    
    <center>
    <span>
    <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
    <p>没有找到提现记录哦！</p>
   </span>
   <c/enter>
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<?php
/*
 *
 *
 */
?>
