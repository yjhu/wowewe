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

    .bankSelected{
        background-color: #FCEB9F;
    }

    .myHeadIcon
    {
        /* border-radius: 50%; */
    }

    .we{
        line-height:120%;
        color:#aaa;
        font-size:12pt;
    }

    div#sharePop .modal-header
    {
        padding: 0 !important;
    }

</style>



<div data-role="page" id="wokelist" data-theme="c">

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '会员中心' ]); ?>
    <div data-role="content">
        
        <ul data-role="listview" data-inset="false" id="woke-ul">

        <li>
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

                <p class="f13">手机号码：               
                <?php foreach($user->openidBindMobiles as $openidBindMobile): ?>
                    <?=  $openidBindMobile->mobile ?>
                <?php endforeach; ?>
                </p>

            </dd>
        </dl>
 
        </li>
        <!--
        <li><a href="#wddd"><img src="../web/images/woke/wddd.gif" alt="我的订单" class="ui-li-icon ui-corner-none">我的订单<span class="ui-li-count">0</span></a></li>
        <li><a ajax-data="false" href="#qdyl"><img src="../web/images/woke/wdrw.gif" alt="签到有礼" class="ui-li-icon ui-corner-none">签到有礼</a></li>
        
        <li><a ajax-data="false" href="#wytg"><img src="../web/images/woke/wdmy.gif" alt="我要推广" class="ui-li-icon ui-corner-none">我要推广</a></li>
        -->

        <li><a ajax-data="false" href="#wytg"><img src="../web/images/woke/wdmy.gif" alt="推荐有礼" class="ui-li-icon ui-corner-none">推荐有礼<span class="ui-li-count"><?= $user->getScore() ?></span></a></li>
        
        <li><a ajax-data="false" href="<?php echo Url::to(['jssdksample', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-ajax="false"><img src="../web/images/woke/wdsc.gif" alt="测速有奖" class="ui-li-icon ui-corner-none">测速有奖</a></li>
        
        <li><a href="<?php echo Url::to(['order', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-icon="shop" data-ajax="false"><img src="../web/images/woke/wddd.gif" alt="我的订单" class="ui-li-icon ui-corner-none">我的订单<span class="ui-li-count"><?= count($user->orders) ?></span></a></li>
       

		<?php if (empty($user->user_account_charge_mobile)) {?>
		<li><a href="#czsjmh"><img src="../web/images/woke/wdcf.gif" class="ui-li-icon ui-corner-none">充值手机号<span class="ui-li-count">未填</span></a></li>
		<?php } else { ?>
		<li><a href="#czsjmh"><img src="../web/images/woke/wdcf.gif" class="ui-li-icon ui-corner-none">充值手机号<span class="ui-li-count">已填</span></a></li>
		<?php } ?>

       <li><a href="<?php echo Url::to(['addbindmobile', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-icon="shop" data-ajax="false"><img src="../web/images/woke/aqsz.gif" alt="绑定管理" class="ui-li-icon ui-corner-none">绑定管理<span class="ui-li-count"><?= count($user->openidBindMobiles) ?></span></a></li>

        <!--
        <li><a href="#wdcf"><img src="../web/images/woke/wdcf.gif" alt="我的财富" class="ui-li-icon ui-corner-none">我的财富<span class="ui-li-count"><//?=  $user->getWokeYqwd() + $user->getWokeKtwd(); ?></span></a></li>
        <li><a href="#wdcf"><img src="../web/images/woke/wdcf.gif" alt="我的财富" class="ui-li-icon ui-corner-none">我的财富</a></li>
        -->
                        
        <!--
        <li><a href="#tqjl"><img src="../web/images/woke/tqjl.gif" alt="提现记录" class="ui-li-icon ui-corner-none">提现记录<span class="ui-li-count"><?=  $user->getWokeYtwd(); ?></span></a></li>
        <li><a href="#tqjl"><img src="../web/images/woke/tqjl.gif" alt="提现记录" class="ui-li-icon ui-corner-none">提现记录</a></li>
-->

        <!--
        <li><a href="#wdyhk"><img src="../web/images/woke/wdyhk.gif" alt="我的银行卡" class="ui-li-icon ui-corner-none">我的银行卡<span class="ui-li-count">1</span></a></li>
        -->

        <!--
        <li><a href="#"><img src="../web/images/woke/aqsz.gif" alt="安全设置" class="ui-li-icon ui-corner-none">安全设置</a></li>
        <li><a href="#"><img src="../web/images/woke/wdhb.gif" alt="我的海报" class="ui-li-icon ui-corner-none">我的海报</a></li>
        <li><a href="#"><img src="../web/images/woke/lqjl.gif" alt="领取记录" class="ui-li-icon ui-corner-none">领取记录<span class="ui-li-count">0</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdsc.gif" alt="我的收藏" class="ui-li-icon ui-corner-none">我的收藏<span class="ui-li-count">10</span></a></li>
        <li><a href="#"><img src="../web/images/woke/wdmy.gif" alt="我的盟友" class="ui-li-icon ui-corner-none">我的盟友<span class="ui-li-count">20</span></a></li>
       
        -->

        </ul>

<br><br>
    <!--

      <//?//php

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
                /*屏蔽Y轴VALUES字样*/
                'yAxis' => [
                    'title' => [],
                ],
     
                'series' => [
                    [
                        'type' => 'column',
                        'name' => '预期沃点',
                        //'data' => $user->getWokeYqwdLast7Days(),
                        'data' => [(int)$d[6], (int)$d[5],  (int)$d[4], (int)$d[3], (int)$d[2], (int)$d[1], (int)$d[0]],
                        //'data' => [0, 200, 0, 0, 0, 0, 0],
                    ],

             
                    // [
                    //     'type' => 'column',
                    //     'name' => 'John',
                    //     'data' => [2, 3, 5, 7, 6],
                    // ],
                    // [
                    //     'type' => 'column',
                    //     'name' => 'Joe',
                    //     'data' => [4, 3, 3, 9, 0],
                    // ],
              

             
                    // [
                    //     'type' => 'spline',
                    //     'name' => 'Average',
                    //     'data' => [3, 2.67, 3, 6.33, 3.33],
                    //     'marker' => [
                    //         'lineWidth' => 2,
                    //         'lineColor' => new JsExpression('Highcharts.getOptions().colors[3]'),
                    //         'fillColor' => 'white',
                    //     ],
                    // ],
               

                ],
            ]
        ]);
        ?>
    -->

    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
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
    <h4>&copy; 襄阳联通 2015</h4>
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
    <h4>&copy; 襄阳联通 2015</h4>
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
            <span style="font-size:18pt;"><?=  $user->getWokeYtwd(); ?></span> 
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-b" style="height:60px">
            折合人民币(元)
            <br>
            <span style="font-size:18pt;"><?=  $user->getWokeYtwd()/100; ?></span> 
        </div>
        </div>

    </div>
    <br>

    <form> 
    <label for="ktwd-max">最多可提沃点: <?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?> 沃点</label>
    <label for="ljtxSlider"></label>
    <input type="range" name="ljtxSlider" id="ljtxSlider" data-highlight="true" data-theme=a data-mini="true" min="100" max="<?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?>" step="100" value="100">
   
    <input type="tel" name="czhm" id="czhm" placeholder="手机号码" value="">
    <br>

    <!--
    <input type="button" id="ljtxBtn" value="沃点换话费" style="background-color: #44B549">
    -->

     <a href="#" id="ljtxBtn" class="ui-btn">沃点换话费</a>
    

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
    <h4>&copy; 襄阳联通 2015</h4>
</div>

<div data-role="popup" id="popupDialog-Page" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
    <div data-role="header" data-theme="c">
    <h1>温馨提示</h1>
    </div>
    <div role="main" id="popupDialog-Page-txt" class="ui-content">
        <span class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext'><span>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确认</a>
    </div>
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
                    $memo = "签到";
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
    <h4>&copy; 襄阳联通 2015</h4>
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
                    $memo = "签到";
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
    </center>
    <?php } ?>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu5','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>



<!-- 我的银行卡 列表 页面-->
<div data-role="page" id="wdyhk" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu6','title' => '我的银行卡' ]); ?>

<div data-role="content">

    <div class="ui-grid-solo">
        <div class="ui-block-a">
            <div class="ui-bar ui-bar-a" style="height:50px">
            <span>

                <span>
                    <img src="../web/images/bank/CMBCHINA.png" align=center>
                    <span>
                    招商银行
                    </span>
            
                    <span style="font-size:12pt; color:#cccccc">尾号8888 储蓄卡</span>
                </span>
            </span>
                  
            </div>

            </div>
    </div>
    <br><br>
    <a href="#tjwdyhk" id="submitBtn" class="ui-btn" style="background-color: #44B549">添加我的银行卡</a>
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu6','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<!-- 添加我的银行卡 页面-->
<div data-role="page" id="tjwdyhk" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu7','title' => '添加我的银行卡' ]); ?>

<div data-role="content">

    <div class="ui-grid-b">
        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" id="ICBC" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/ICBC.png" >
        <br>
        工商银行
        </span>
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-a" id="ABC" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/ABC.png" >
        <br>
        农业银行
        </span>
        </div>
        </div>

        <div class="ui-block-c">
        <div class="ui-bar ui-bar-a" id="BOC" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/BOC.png" >
        <br>
        中国银行
        </span>
        </div>
        </div>

        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" id="CCB" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/CCB.png" >
        <br>
        建设银行
        </span>
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-a" id="BOCO" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/BOCO.png" >
        <br>
        交通银行
        </span>
        </div>
        </div>

        <div class="ui-block-c">
        <div class="ui-bar ui-bar-a" id="ECITIC" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/ECITIC.png" >
        <br>
        中信银行
        </span>
        </div>
        </div>

        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" id="CEB" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/CEB.png" >
        <br>
        光大银行
        </span>
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-a" id="CMBC" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/CMBC.png" >
        <br>
        民生银行
        </span>
        </div>
        </div>

        <div class="ui-block-c">
        <div class="ui-bar ui-bar-a" id="CGB" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/CGB.png" >
        <br>
        广发银行
        </span>
        </div>
        </div>

        <div class="ui-block-a">
        <div class="ui-bar ui-bar-a" id="CMBCHINA" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/CMBCHINA.png" >
        <br>
        招商银行
        </span>
        </div>
        </div>

        <div class="ui-block-b">
        <div class="ui-bar ui-bar-a" id="POST" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/POST.png" >
        <br>
        邮政储蓄
        </span>
        </div>
        </div>

        <div class="ui-block-c">
        <div class="ui-bar ui-bar-a" id="NSYH" style="height:60px" align=center>
        <span style="font-size:14px;font-weight:normal;color:#aaa">
        <img src="../web/images/bank/NSYH.png" >
        <br>
        农商银行
        </span>
        </div>
        </div>
    </div><!-- /grid-c -->
    <br>
    <input type=text placeholder="开户人姓名" name="buser" id="buser">

    <input type=text placeholder="银行卡号" name="bcn" id="bcn">

    <br>
    <a href="#tjwdyhk" id="tjwdyhkBtn" class="ui-btn" style="background-color: #44B549">确定</a>
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu7','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>




<!-- 签到有礼 页面-->
<div data-role="page" id="qdyl" data-theme="c">
<?php echo $this->render('header1', ['menuId'=>'menu8','title' => '签到有礼' ]); ?>

<div data-role="content">

<center>
    <span>
    <span id="qdyl_info"></span>
    </span>

    <br>

    <a href="javascript:reloadWokeList();" class="ui-btn">返回</a>
</center>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu8','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>


<!-- 我要推广 页面-->
<div data-role="page" id="wytg" data-theme="c">
<?php echo $this->render('header1', ['menuId'=>'menu9','title' => '推荐有礼' ]); ?>

<div data-role="content">

<center>
<span style="font-size:14pt">我的推广二维码</span>&nbsp;
<a style="color:blue;font-size:10pt;text-decoration:none;bold" href="<?php echo  Url::to(['wap/rhtg', 'gh_id'=>$gh_id,'openid'=>$openid],true) ?>">如何推广？</a>

<?php echo Html::img($user->getQrImageUrl(), ['style'=>'display: block;max-width:45%;height: auto;']); ?>
<!--
<span>快叫小伙伴拿起手机微信扫一扫加关注。<br>
你即可获得<b><font color=red>100</font></b>沃点！<br>
还等什么？<br>
快~
</span>
-->
<?php 
$expectedMoney = (count($fans)/1)*5;
$realMoney = (count($mobiledFans)/1)*5;
?>

<?php if (!empty($fans)): ?>
<br>
<table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="显示列..." data-column-popup-theme="a">
         <thead>
           <tr class="ui-bar-d">
             <th data-priority="1">头像</th>
             <th data-priority="1">昵称</th>
             <th data-priority="1">绑定手机</th>
             <th data-priority="4">关注时间</th>
             <!--
             <th data-priority="5">Reviews</th>
             -->
           </tr>
         </thead>
         <tbody>
            <?php foreach($fans as $fan) 
                { 
            ?>

           <tr>
            <th>
            <?php if (!empty($fan->headimgurl)): ?>
            <img src="<?= $fan->headimgurl; ?>" width="36" height="36">
            <?php endif; ?>
            </th>
             <td><?= $fan->nickname ?></td>

             <td>
            <?php if (!empty($fan->getBindMobileNumbers())): ?>
            <?= implode(',', $fan->getBindMobileNumbers()) ?>
            <?php else: ?>
            非会员(未绑定手机)
            <?php endif; ?>

             </td>
             <td><?= substr($fan->create_time,0,10) ?></td>
           </tr>

            <?php
                }
            ?>

         </tbody>
</table>
<?php endif; ?>

<br>

<?php if (empty($user->user_account_charge_mobile)): ?>
<p align=left>
以便为您充值，请<a style="color:blue" href="#czsjmh">填写充值手机号</a>。
</p>
<?php endif; ?>

<div class="ui-grid-a">
    <div class="ui-block-a">
    <div id="ktxwd_span" class="ui-bar ui-bar-a" style="height:60px">
        可兑现话费

        <br>
        <span style="font-size:18pt;"><?= $realMoney ?>元</span> 
    </div>
    </div>

    <div class="ui-block-b">
    <div id="yqwd_span" class="ui-bar ui-bar-b" style="height:60px">
        预期话费
        <br>
        <span style="font-size:18pt;"><?= $expectedMoney ?> 元</span> 
    </div>
    </div>  

</div>
<br>
    <a href="javascript:reloadWokeList();" class="ui-btn">返回</a>

</center>

</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>
 <?php echo $this->render('menu', ['menuId'=>'menu8','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>



<!-- 用户增加在此处添加要充值的手机号码 -->
<div data-role="page" id="czsjmh" data-theme="c">
<?php echo $this->render('header2', ['menuId'=>'menu3','title' => '充值手机号码' ]); ?>

<div data-role="content">
    <form> 
    
    <input type="tel" name="czhm1" id="czhm1" placeholder="请提交您要充值的手机号码" value="<?= $user->user_account_charge_mobile ?>">

     <a href="#" id="czsjmhBtn" class="ui-btn">确定</a>

    <br>

    <fieldset style="margin: 0px; padding: 5px; border: 1px solid rgb(0, 187, 236); color: rgb(68, 68, 68); font-family: 微软雅黑; font-size: 13px; line-height: 24px; white-space: normal; border-radius: 5px; background-color: rgb(239, 239, 239);">
    <legend style="margin: 0px 10px; padding: 0px; border-width: 0px;">
    <span class="ue_t" style="margin: 0px; padding: 5px 10px; border: 0px; color: rgb(255, 255, 255); font-weight: bold; font-size: 14px; border-radius: 5px; background-color: rgb(0, 187, 236);">温馨提示</span>
    </legend>
    <blockquote style="margin: 0px; padding: 10px; border: 0px;">
    <p class="ue_t" style="margin-top: 0px; margin-bottom: 0px; padding: 0px; border: 0px;">
    <ol>
    <li>您赢得的话费将充到您提交的手机号码中。</li>

    </ol>
    </p>
    </blockquote>
    </fieldset>
    </form>
   
</div>

<div data-role="footer" data-position="fixed">
    <h4>&copy; 襄阳联通 2015</h4>
</div>

<div data-role="popup" id="popupDialog-Page1" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
    <div data-role="header" data-theme="c">
    <h1>温馨提示</h1>
    </div>
    <div role="main" id="popupDialog-Page-txt1" class="ui-content">
        <span class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext'><span>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确认</a>
    </div>
</div>


 <?php echo $this->render('menu', ['menuId'=>'menu3','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div>





<script>
var ktwd = "<?=  $user->getWokeKtwd()-$user->getWokeYtwd(); ?>";

function fillErrmsg(id,errmsg)
{
     $(id).html("<p><a href='#' class='ui-btn ui-shadow ui-corner-all ui-icon-alert ui-btn-icon-notext ui-btn-inline'>Alert</a>"+errmsg+"</p><a href='#' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-rel='back'>确认</a>");
}

/*
function showGold()
{
    //alert("show gold !!");
    $.ajax({
        url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'wokeqdyl'], true) ; ?>",
        type:"GET",
        cache:false,
        dataType:'json',
        data: "&memo=签到有礼",
        success: function(json_data){
            if(json_data)
            {

            }
        }
    });

    $.mobile.changePage("#qdyl",{transition:"slide"});
}
*/

function reloadWokeList()
{
    var url = "<?php echo Url::to(['wap/hyzx'], true); ?>";
    location.href = url;
}



$(document).on("pageshow", "#qdyl", function(){

    //alert('qdyl');
    $.ajax({
        url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'wokeqdyl'], true) ; ?>",
        type:"GET",
        cache:false,
        dataType:'json',
        data: "&memo=签到",
        success: function(json_data){
            if(json_data)
            {

            }
            //alert(json_data.sign_money);
            if(json_data.sign_money != "marked")
            {
                $("#qdyl_info").html("<img src='../web/images/woke/glod2.png'><h3>恭喜，你今天已经领取<span style='font-size:28pt;font-weight:bolder;color:red'> "+json_data.sign_money+" </span>个沃点。</h3>");
            }
            else
            {
                $("#qdyl_info").html("<img src='../web/images/woke/glod1.png'><h3>今天的沃点已领，明天再来吧 :-)</h3>");
            }
        }
    });

});


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


function cleanAllBankSelected()
{
    $("#ICBC").removeClass('bankSelected');
    $("#ABC").removeClass('bankSelected');
    $("#BOC").removeClass('bankSelected');
    $("#CCB").removeClass('bankSelected');
    $("#BOCO").removeClass('bankSelected');
    $("#ECITIC").removeClass('bankSelected');
    $("#CEB").removeClass('bankSelected');
    $("#CMBC").removeClass('bankSelected');
    $("#CGB").removeClass('bankSelected');
    $("#CMBCHINA").removeClass('bankSelected');
    $("#POST").removeClass('bankSelected');
    $("#NSYH").removeClass('bankSelected');
}

$(document).on("pageshow", "#tjwdyhk", function(){

    $(document).on("tap","#ICBC",function(){
        cleanAllBankSelected();
        $("#ICBC").addClass('bankSelected');
        localStorage.setItem('bankname','ICBC');
    });
    $(document).on("tap","#ABC",function(){
        cleanAllBankSelected();
        $("#ABC").addClass('bankSelected');
        localStorage.setItem('bankname','ABC');
    });
    $(document).on("tap","#BOC",function(){
        cleanAllBankSelected();
        $("#BOC").addClass('bankSelected');
        localStorage.setItem('bankname','BOC');
    });
    $(document).on("tap","#CCB",function(){
        cleanAllBankSelected();
        $("#CCB").addClass('bankSelected');
        localStorage.setItem('bankname','CCB');
    });
    $(document).on("tap","#BOCO",function(){
        cleanAllBankSelected();
        $("#BOCO").addClass('bankSelected');
        localStorage.setItem('bankname','BOCO');
    });
    $(document).on("tap","#ECITIC",function(){
        cleanAllBankSelected();
        $("#ECITIC").addClass('bankSelected');
        localStorage.setItem('bankname','ECITIC');
    });
    $(document).on("tap","#CEB",function(){
        cleanAllBankSelected();
        $("#CEB").addClass('bankSelected');
        localStorage.setItem('bankname','CEB');
    });
    $(document).on("tap","#CMBC",function(){
        cleanAllBankSelected();
        $("#CMBC").addClass('bankSelected');
        localStorage.setItem('bankname','CMBC');
    });
    $(document).on("tap","#CGB",function(){
        cleanAllBankSelected();
        $("#CGB").addClass('bankSelected');
        localStorage.setItem('bankname','CGB');
    });
    $(document).on("tap","#CMBCHINA",function(){
         cleanAllBankSelected();
        $("#CMBCHINA").addClass('bankSelected');
        localStorage.setItem('bankname','CMBCHINA');
    });
    $(document).on("tap","#POST",function(){
        cleanAllBankSelected();
        $("#POST").addClass('bankSelected');
        localStorage.setItem('bankname','POST');
    });
    $(document).on("tap","#NSYH",function(){
         cleanAllBankSelected();
        $("#NSYH").addClass('bankSelected');
        localStorage.setItem('bankname','NSYH');
    });


    $(document).on("tap","#tjwdyhkBtn",function(){
        //todo ...
        alert("tjwdyhkBtn");
    });

});

$(document).on("pageinit", "#tqjl", function(){

    $(document).on("click","#ljtxBtn",function(){
       var ljtx = $("#ljtxSlider").val();

        if(ktwd < 100)
        {
            fillErrmsg('#popupDialog-Page-txt','提现最低值为100沃点!');
            $('#popupDialog-Page').popup('open');
            //alert("姓名输入不合法");
            return  false;
        }

        var czhm = $('#czhm').val();
        var czhmReg = /(^(1)\d{10}$)/;
        if(czhmReg.test(czhm) === false)
        {
            fillErrmsg('#popupDialog-Page-txt','充值手机号码不正确。请重新填写!');
            $('#popupDialog-Page').popup('open');
            //alert("姓名输入不合法");
            return  false;
        }


        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'woketixian'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: "&ljtx="+ljtx+"&czhm="+czhm+"&memo=提现申请",
            success: function(json_data){
                if(json_data)
                {

                }
            }
        });

        alert("你已成功提现"+$("#ljtxSlider").val()+"沃点; 价值"+($("#ljtxSlider").val())/100+"元。稍后会充值到你的手机上。" );

       // $("#userMsg").html("提现成功:"+$("#ljtxSlider").val()+"沃点。");
       // $("#popupUserMsg").popup("open");
        //return false;

        window.location.reload();
        return false;

    });

});



$(document).on("pageinit", "#czsjmh", function(){

    $(document).on("click","#czsjmhBtn",function(){
        var czhm1 = $('#czhm1').val();
        var czhmReg = /(^(1)\d{10}$)/;

        if(czhmReg.test(czhm1) === false)
        {
            fillErrmsg('#popupDialog-Page-txt1','充值手机号码不正确。请重新填写!');
            $('#popupDialog-Page1').popup('open');
            return  false;
        }

        $.ajax({
            url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'czsjhm'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: "czhm1="+czhm1,
            success: function(json_data){
                if(json_data)
                {

                }
            }
        });

       // alert("你已成功提现"+$("#ljtxSlider").val()+"沃点; 价值"+($("#ljtxSlider").val())/100+"元。稍后会充值到你的手机上。" );

        window.location.reload();
        return false;

    });

});
</script>

<?php
/*
 

//$fans = $user->getFans(); 

        $year = date('Y');
        $month = date('m');
//        $year = 2014;
//        $month = 12;
        if ($month == 1) {
            $year = $year - 1;
            $last_month = 12;
        } else {        
            $last_month = $month - 1;
        }
        $theFirstDayOfLastMonth = U::getFirstDate($year, $last_month);
        $theLastDayOfLastMonth = U::getLastDate($year, $last_month);


$fans = $user->staff->getFansByRange($theFirstDayOfLastMonth, $theLastDayOfLastMonth); 
$score =  $user->staff->getScoreByRange($theFirstDayOfLastMonth, $theLastDayOfLastMonth); 
$expectedMoney = ($score/3)*5;
$user_acount_balance = $user->getUserAccountBalanceInfo();


 
 */
?>
