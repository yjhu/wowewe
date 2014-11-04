<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MChannel;
    use app\models\MSceneDetail;
    use app\models\MUser;
?>


    
<style type="text/CSS">

    #qrBtn{
        background-image: ../web/images/woke/qr.png;
    }
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

    .c_txwdlist_0 { font-size:14px; background-color: #FFF0CC !important;} 
    .c_txwdlist_1 { font-size:14px; background-color: #C3FFC0 !important;} 

    .c_list_0 { font-size:14px; background-color: #fff !important;} 
    .c_list_1 { font-size:14px; background-color: #eee !important;} 

   
    #my_list1>li, #my_list2>li
    {
         background-color: #ffffff !important;
    } 


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
                    <!--
                        <img id="myphoto" src="../web/images/woke/0.jpg" width="56">
                    -->

                    <img id="myphoto" src="<?php echo $user->headimgurl; ?>" width="56">
                    </div>
                </div>
                <p class="f9 marT7"><em id="vip_p" class="pu_vip"></em></p>
            </dt>

            <dd>
                <p><span style="font-size:22px;font-weight: border"><?= $user->nickname ?></span> 
                &nbsp;&nbsp;&nbsp;&nbsp;

                <!--
                <img src="../web/images/woke/qr.png" width="24px" height="24px">
                -->
                <a href="#qrBtnPopup" data-rel="popup" data-position-to="window" id="qrBtn">
                    <img src="../web/images/woke/qr.png" width="24px" height="24px">
                </a>
                <div data-role="popup" id="qrBtnPopup" class="photopopup" data-overlay-theme="a" data-corners="false" data-tolerance="30,15">
                <!--<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>-->
                <!--<img src="../web/images/woke/qr.png">-->

                <?php echo Html::img($user->getQrImageUrl(), ['style'=>'display: block;max-width:100%;height: auto;']); ?>

                </div>

                </p>
                    
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
          
                <p class="f13">我的沃点：<span style="font-size:12pt;font-weight:bolder"><?=  $user->getWokeYqwd() + $user->getWokeKtwd(); ?></span> 点</p>
                <p class="f13">可提现沃点：<span style="font-size:12pt;font-weight:bolder"><?=  $user->getWokeKtwd() - $user->getWokeYtwd(); ?></span> 点</p>
            </dd>
        </dl>
 
        </li>
        <!--
        <li><a href="#wddd"><img src="../web/images/woke/wddd.gif" alt="我的订单" class="ui-li-icon ui-corner-none">我的订单<span class="ui-li-count">0</span></a></li>
        -->
        <li><a href="#wdcf"><img src="../web/images/woke/wdcf.gif" alt="我的财富" class="ui-li-icon ui-corner-none">我的财富<span class="ui-li-count"><?=  $user->getWokeYqwd() + $user->getWokeKtwd(); ?></span></a></li>
        
        
        <li><a href="#tqjl"><img src="../web/images/woke/tqjl.gif" alt="提现记录" class="ui-li-icon ui-corner-none">提现记录<span class="ui-li-count"><?=  $user->getWokeYtwd(); ?></span></a></li>
        <!--
        <li><a href="#"><img src="../web/images/woke/wdyhk.gif" alt="我的银行卡" class="ui-li-icon ui-corner-none">我的银行卡<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/aqsz.gif" alt="安全设置" class="ui-li-icon ui-corner-none">安全设置</a></li>
        <li><a href="#"><img src="../web/images/woke/wdhb.gif" alt="我的海报" class="ui-li-icon ui-corner-none">我的海报</a></li>
        <li><a href="#"><img src="../web/images/woke/lqjl.gif" alt="领取记录" class="ui-li-icon ui-corner-none">领取记录<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdsc.gif" alt="我的收藏" class="ui-li-icon ui-corner-none">我的收藏<span class="ui-li-count">10</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdmy.gif" alt="我的盟友" class="ui-li-icon ui-corner-none">我的盟友<span class="ui-li-count">20</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdrw.gif" alt="我的任务" class="ui-li-icon ui-corner-none">我的任务<span class="ui-li-count">2</span></a></li>
        -->

        </ul>
<br><br>
      <?php

        use miloschuman\highcharts\Highcharts;
        use yii\web\JsExpression;

        $d =  $user->getWokeYqwdLast7Days();

        echo Highcharts::widget([

            'scripts' => [
            //    'modules/exporting',
                'themes/grid-light',
            ],
            'options' => [
                'credits' => ['enabled' => false],
                'title' => [
                    'text' => '预期沃点最近7天统计',
                ],
                'xAxis' => [
                    'categories' => ['1', '2',  '3', '4', '5', '6', '7'],
                ],
     
                'series' => [
                    [
                        'type' => 'column',
                        'name' => '预期沃点',
                        //'data' => $user->getWokeYqwdLast7Days(),
                        'data' => [(int)$d[6], (int)$d[5],  (int)$d[4], (int)$d[3], (int)$d[2], (int)$d[1], (int)$d[0]],
                        //'data' => [0, 200, 0, 0, 0, 0, 0],
                    ],

                    /*
                    [
                        'type' => 'column',
                        'name' => 'John',
                        'data' => [2, 3, 5, 7, 6],
                    ],
                    [
                        'type' => 'column',
                        'name' => 'Joe',
                        'data' => [4, 3, 3, 9, 0],
                    ],
                    */

                    /*
                    [
                        'type' => 'spline',
                        'name' => 'Average',
                        'data' => [3, 2.67, 3, 6.33, 3.33],
                        'marker' => [
                            'lineWidth' => 2,
                            'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                            'fillColor' => 'white',
                        ],
                    ],
                    */

                ],
            ]
        ]);
        ?>

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
    <!--
    <span style="font-size:28pt;font-weight:bolder;color:#ff6500">
    -->
    <span style="font-size:28pt;font-weight:bolder;">
    <?=  $user->getWokeKtwd()+$user->getWokeYqwd(); ?>
    <img src="../web/images/woke/money.png" width="32px" height="32px">

    </span> 
    </div>
    </div>
</div>
<br>
<div class="ui-grid-a">
    <div class="ui-block-a">
    <div id="ktxwd_span" class="ui-bar ui-bar-a" style="height:60px">
        可提现沃点
        <br>
        <span style="font-size:18pt;"><?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?></span> 
    </div>
    </div>

    <div class="ui-block-b">
    <div id="yqwd_span" class="ui-bar ui-bar-b" style="height:60px">
        预期沃点
        <br>
        <span style="font-size:18pt;"><?=  $user->getWokeYqwd(); ?></span> 
    </div>
    </div>

    <div class="ui-block-a">
    <div id="ytxwd_span" class="ui-bar ui-bar-a" style="height:60px">
        已提现沃点 
        <br>
        <span style="font-size:18pt;"><?=  $user->getWokeYtwd(); ?></span> 
    </div>
    </div>

    <div class="ui-block-b">
    <div class="ui-bar ui-bar-b" style="height:60px">
        <!--
        累计结算沃点xxx
        <br>
        <span style="font-size:18pt;">0</span> 
        -->
    </div>
    </div>    

</div>

<ol data-role="listview" data-inset="true" id="my_list1">
    <!--<li>每日计算预期沃点</li>-->
    <li>100沃点=人民币1元</li>
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

<div data-role="popup" id="popupUserMsg" data-theme="c">
<p id="userMsg"></p>
</div>

<div data-role="content">

    <div class="ui-grid-a">
        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" style="height:60px">
           累计提现(点)
            <br>
            <span style="font-size:18pt; color:#028724"><?=  $user->getWokeYtwd(); ?></span> 
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-b" style="height:60px">
            折合人民币(元)
            <br>
            <span style="font-size:18pt; color:#028724"><?=  $user->getWokeYtwd()/100; ?></span> 
        </div>
        </div>

    </div>
    <br>

    <form> 
    <label for="ktwd-max">最多可提沃点: <?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?> 沃点</label>
    <label for="ljtxSlider">现在提现沃点</label>
    <input type="range" name="ljtxSlider" id="ljtxSlider" data-highlight="true" data-theme=a data-mini="true" min="100" max="<?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?>" step="100" value="100">
    <input type="button" id="ljtxBtn" value="立即提现">
    </form>
   <br>
    <ul data-role="listview" data-inset="false" >
        <?php $flag=0; foreach($scenes as $scene) {?>
            
  
            <?php if($scene->status == 0) { ?>
                <li class="c_txwdlist_0">
            <?php } else { ?>
                <li class="c_txwdlist_1">
            <?php } ?>
    
            <div>
            <span class=""><?= $scene->create_time ?></span>
            &nbsp;&nbsp;
            <?php if($scene->status == 0) { ?>
                <span class="c_memo"><?= $scene->memo ?></span>
            <?php } else { ?>
                <span class="c_memo">提现成功</span>
            <?php } ?>
            &nbsp;&nbsp;
            <span class="c_scene_amt"><?= abs($scene->scene_amt) ?></span>沃点
            &nbsp;&nbsp;

            <?php if($scene->status == 0) { ?>
                 <img src="../web/images/woke/wait.png">
            <?php } else { ?>
                 <img src="../web/images/woke/ok.png">
            <?php } ?>
            </div>
        </li>
        <?php $flag++; } ?>
    </ul>

    <?php if($flag == 0) { ?>
    <br>
    <center>
        <span>
        <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
        <p>没有找到提现记录哦！</p>
        </span>
    </enter>
    <?php } ?>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>




<!-- 可提现沃点 页面-->
<div data-role="page" id="ktxwd" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu4','title' => '可提现沃点' ]); ?>

<div data-role="content">

    <div class="ui-grid-solo">
        <div class="ui-block-a">

        <div class="ui-bar ui-bar-a" style="height:60px">
        可提现沃点
        <br>

        <span style="font-size:28pt;font-weight:bolder;">
        <?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?>
        </span> 
        </div>
        </div>
    </div>
    <br><br>

    <ul data-role="listview" data-inset="true" >
        <?php $flag=0; foreach($ktxwd_scenes as $ktxwd_scene) {?>
    
            <?php if($flag%2==0) { ?>
                <li class="c_list_0">
            <?php } else { ?>
                <li class="c_list_1">
            <?php } ?>

            <?php
                if($ktxwd_scene->cat == 0)//item
                {
                    $memo = $ktxwd_scene->memo;
                }
                else if($ktxwd_scene->cat == 1) //fan
                {
                    $memo = "粉丝推广";
                }
                else//reward
                {
                    $memo = "签到任务";
                }
            ?>

            <div>
            <span><?= $ktxwd_scene->create_time ?></span>
            &nbsp;&nbsp;
            <span><?= $memo ?></span>
            &nbsp;&nbsp;
            <span><?= abs($ktxwd_scene->scene_amt) ?></span>沃点
            &nbsp;&nbsp;
            </div>
        </li>
        <?php $flag++; } ?>
    </ul>

    <?php if($flag == 0) { ?>
    <br>
    <center>
        <span>
        <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
        <p>没有找到任何记录哦！</p>
        </span>
    </enter>
    <?php } ?>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu4','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>



<!-- 预期沃点 页面-->
<div data-role="page" id="yqwd" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu5','title' => '预期沃点' ]); ?>

<div data-role="content">

    <div class="ui-grid-solo">
        <div class="ui-block-a">

        <div class="ui-bar ui-bar-a" style="height:60px">
        预期沃点
        <br>

        <span style="font-size:28pt;font-weight:bolder;">
        <?=  $user->getWokeYqwd(); ?>
        </span> 
        </div>
        </div>
    </div>
    <br>
    <br>

    <ul data-role="listview" data-inset="true" id="my_list2">
        <?php $flag=0; foreach($yqwd_fans_qx_scenes as $yqwd_fans_qx_scene) {?>
    
            <?php if($flag%2==0) { ?>
                <li class="c_list_0">
            <?php } else { ?>
                <li class="c_list_1">
            <?php } ?>
            

            <?php
                if($yqwd_fans_qx_scene->cat == 0)//item
                {
                    $memo = $yqwd_fans_qx_scene->memo;
                }
                else if($yqwd_fans_qx_scene->cat == 1) //fan
                {
                    $memo = "粉丝推广";
                }
                else//reward
                {
                    $memo = "签到任务";
                }
            ?>
            
            <div>

     
                <?php if($yqwd_fans_qx_scene->status == 2) {?>
                <span style="color: #aaaaaa;text-decoration: line-through">
                <?php } else {?>
                <span>
                <?php } ?>

                <span><?= $yqwd_fans_qx_scene->create_time ?></span>
                &nbsp;&nbsp;
                <span><?= $memo ?></span>
                &nbsp;&nbsp;
                <span><?= abs($yqwd_fans_qx_scene->scene_amt) ?></span>沃点
                &nbsp;&nbsp;

                </span>
            </div>


        </li>
        <?php $flag++; } ?>
    </ul>

    <?php if($flag == 0) { ?>
    <br>
    <center>
        <span>
        <img src="../web/images/woke/womei_sad.png" width="96px" height="96px">
        <p>没有找到任何记录哦！</p>
        </span>
    </enter>
    <?php } ?>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2014</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu5','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<script>
var ktwd = "<?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?>";

$(document).on("pageinit", "#wdcf", function(){

    $(document).on("tap","#ktxwd_span",function(){
        $.mobile.changePage("#ktxwd",{transition:"slide"});
    });

    $(document).on("tap","#yqwd_span",function(){
        $.mobile.changePage("#yqwd",{transition:"slide"});
    });  

    $(document).on("tap","#ytxwd_span",function(){
        $.mobile.changePage("#tqjl",{transition:"slide"});
    });

});


$(document).on("pageinit", "#ktxwd", function(){
    //alert("ktxwd");
});

$(document).on("pageshow", "#yqwd", function(){
    //alert("yqwd");
});

$(document).on("pageinit", "#tqjl", function(){

    $(document).on("click","#ljtxBtn",function(){
       var ljtx = $("#ljtxSlider").val();
       if(ktwd < 100)
       {
            alert("提现最低值为100沃点。");
            return false; 
       }

        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'woketixian'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: "&ljtx="+ljtx+"&memo=提现申请",
            success: function(json_data){
                if(json_data)
                {

                }
            }
        });

        alert("提现成功:"+$("#ljtxSlider").val()+"沃点。");

       // $("#userMsg").html("提现成功:"+$("#ljtxSlider").val()+"沃点。");
       // $("#popupUserMsg").popup("open");
        //return false;

        window.location.reload();
        return false;

    });

});

</script>

<?php
/*
 *
 *
 */
?>
