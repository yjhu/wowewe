<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

$claimer = $giftbox->claimer;
if ($claimer->id === $observer->id) {
    $isSelf = true;
} else {
    $isSelf = false;
}

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>缤纷盛夏邀你共享微信好礼</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link href="./php-emoji/emoji.css" rel="stylesheet">    
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
        .num{
            color:black;
            font-size: 2em;
        }

        .modal {
          position: fixed;
          top: 0;
          z-index: 11;
          width: 100%;
          min-height: 100%;
          overflow: hidden;
          background-color: #fff;
          opacity: 0;
          -webkit-transition: -webkit-transform .25s, opacity 1ms .25s;
             -moz-transition:    -moz-transform .25s, opacity 1ms .25s;
                  transition:         transform .25s, opacity 1ms .25s;
          -webkit-transform: translate3d(0, 100%, 0);
              -ms-transform: translate3d(0, 100%, 0);
                  transform: translate3d(0, 100%, 0);
        }
        .modal.active {
          height: 100%;
          opacity: 0.9;
          -webkit-transition: -webkit-transform .25s;
             -moz-transition:    -moz-transform .25s;
                  transition:         transform .25s;
          -webkit-transform: translate3d(0, 0, 0);
              -ms-transform: translate3d(0, 0, 0);
                  transform: translate3d(0, 0, 0);
        }


    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
        <img width=100% height=100 src="/wx/web/images/gift-bar1.jpg?v1">
        <audio style="display:hiden" id="musicBox" preload="metadata" autoplay="false"></audio>  

        <p align="center">
            <img src="<?= $claimer->headImgUrl; ?>" style="width:24px">&nbsp;
            <?= emoji_unified_to_html(emoji_softbank_to_unified($claimer->nickname)) ?> &nbsp;
            的礼盒<br>
            <?php if ($giftbox->status >= \app\models\GiftboxClaimed::STATUS_COMPLETED) { ?>
            已有<span class='num'><a href="#fans"><?= $giftbox->getHelpersNumber(); ?></a></span>位好友为
        <?= $isSelf ? '我' : 'Ta'?>
            抢了礼盒<br>
            <?php } else { ?>
        已有<span class='num'><a href="#fans"><?= $giftbox->getHelpersNumber(); ?></a></span>位好友为
        <?= $isSelf ? '我' : 'Ta'?>
        抢了礼盒，还差<span class='num'><?= $giftbox->getHelpersNeeded();?></span>位<br>
            <?php } ?>

        <?php if ($giftbox->status < \app\models\GiftboxClaimed::STATUS_REWARDING) { ?>
        <img id="gift1" width=100% style="width: 250px;height:200px" class='giftbox' giftbox_type=1 src="/wx/web/images/gift1.jpg?v15">
        <img id="gift2" width=100% style="width: 250px;height:200px; display: none" class='giftbox' giftbox_type=2 src="/wx/web/images/gift2.jpg?v15">
        <img id="gift3" width=100% style="width: 250px;height:200px; display: none" class='giftbox' giftbox_type=3 src="/wx/web/images/gift3.jpg?v15">
        <?php } else { ?>
        <img width=100% style="width: 250px;height:200px" src="/wx/web/images/gift<?= $giftbox->category_id ?>a.jpg?v15">
        <?php } ?>
        </p>




        <!-- 我 -->
        <?php if (\app\models\GiftboxClaimed::STATUS_UNDERWAY === $giftbox->status) { ?>
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" href="#zrbm">找人帮忙抢</a>
        </p>
        <?php } ?>
        <!-- -->
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_COMPLETED === $giftbox->status) { ?> 
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" id='thatsit'>就选它了</a>
        </p>
        <?php } ?>
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_REWARDING === $giftbox->status) { ?>
        <p align="center">
            <span style='font-size:0.8em;'><i class='fa fa-exclamation-triangle' style='color:red;'></i>您需要到<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/nearestoutlets:gh_03a74ac96138#wechat_redirect'>附近营业厅</a>领取奖品后才点击此按钮！<i class='fa fa-exclamation-triangle'  style='color:red;'></i></span>
            <a class="btn btn-primary btn-block" style="width: 300px" id='ivegetit'>领取礼盒</a>
        </p>
        <?php } ?>
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_REWARDED === $giftbox->status) { ?>
        <p align="center">
            
        <a class="btn btn-block" style="width: 300px">已领取</a>
        领取时间：<?= date('Y-m-d H:i:s', $giftbox->getting_time); ?>
        </p>
        <?php } ?>
        
        

        <!-- 非我 -->
        <?php if (!$isSelf && \app\models\GiftboxClaimed::STATUS_UNDERWAY === $giftbox->status) { ?>
        <p align="center">
        <a class="btn btn-block" style="width: 300px" id="helpBtn">我帮Ta抢礼盒</a>
        </p>
        <?php } ?>
        
        
        <?php if (!$isSelf) { ?>
        <p align="center">
        <a class="btn btn-block" style="width: 300px" href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138#wechat_redirect">我也要抢礼盒</a>
        </p>
        <?php } ?>

       <br>

        <p align="center">
            <a href="#hjmd"><i class="fa fa-trophy"></i>&nbsp;获奖名单</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动规则</a>
        </p>
       <hr width=60%>
       <p align="center">已有<a href="#claimers"><span class="num"><?= \app\models\GiftboxClaimed::find()->count() ?></span></a>人抢了礼盒
           <br><br><br>
           本礼盒已被转发<?= \app\models\GiftboxShareLog::find()->where(['giftbox_id' => $giftbox->id])->count();
                ?>次；本活动已被转发<?= \app\models\GiftboxShareLog::find()->count(); ?>次。
       </p>

       <P>&nbsp;</P>
       <br>&nbsp;

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>



    <div id='hjmd'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hjmd"></a>
            <h1 class='title'>获奖名单</h1>
        </header>
        <div class="content">
            <?php 
            $total_rewards_count = \app\models\GiftboxClaimed::find()->where(['>', 'status', \app\models\GiftboxClaimed::STATUS_COMPLETED])->count();
            if (20 > $total_rewards_count) {
                $total_rewards = \app\models\GiftboxClaimed::find()->where(['>', 'status', \app\models\GiftboxClaimed::STATUS_COMPLETED])->orderBy(['claiming_time' => SORT_DESC])->all();
            } else {
                $total_rewards = \app\models\GiftboxClaimed::find()->where(['>', 'status', \app\models\GiftboxClaimed::STATUS_COMPLETED])->orderBy(['claiming_time' => SORT_DESC])->limit(20)->all();
            }
            ?>
<ul class="table-view">
    <li class='table-view-cell'>
    
        <?php if($total_rewards_count < 400) { ?>
                已有<?= $total_rewards_count ?>位领取了礼盒
        <?php } else { ?>
                <span style="color:red">亲~ 本期活动奖品已抢完，下期再来吧！</span>
        <?php } ?>

    </li>
        <?php 
        foreach ($total_rewards as $reward) {
        ?>
        <li class="table-view-cell media">
            <a data-ignore='push' class="navigate-right" href="<?= Url::to([
                'yaoyiyao',
                'giftbox_id' => $reward->id,
                'gh_id' => $observer->gh_id,
                'openid' => $observer->openid,
            ]);?>">
            <img class="media-object pull-left" src="<?= $reward->claimer->headImgUrl ?>" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($reward->claimer->nickname)) ?>
          <p>
              抢礼盒时间：<?= date('Y-m-d H:i:s', $reward->claiming_time); ?>
          </p>
        </div>
            </a>
        </li>
        <?php 
        }
        ?>
    </ul>
        </div>
    </div>

    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动规则</h1>
        </header>
        <div class="content">
        <div class="card" style="border:0">
          <p></p>
          
            <p>活动主题：缤纷盛夏 邀你共享微信好礼</p>
            <p>活动时间：2015年7月1日-2015年8月31日</p>
            <p>活动内容：邀请好友拆礼盒，送消暑大礼——自拍器/电影票/U盘</p>

            <p>活动详情：邀请20名好友帮拆礼盒，即可获赠礼品一份(每人仅限领取一次)，关注才能参与领取。
            </p>

            <p>领奖说明：用户带上手机到当地自有营业厅出示兑奖页面领取相应礼品。</p>


            <p>
            <a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/nearestoutlets:gh_03a74ac96138#wechat_redirect">附近营业厅</a>
            </p>

          <br>
          <a class="btn btn-block" href="#hdgz">返回</a>
        </div>
    </div>
 </div>

    <div id='zrbm'  class='modal'>
        <div class="content" style="opacity : 1">
            <img src="\wx\web\images\share-v4.jpg" width="100%">
            <a class="btn btn-primary btn-block" style="margin: 0;" href="#zrbm">返回</a>
        </div>
    </div>
    



    <div id='fans'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#fans"></a>
            <h1 class='title'>给<?= $isSelf ? '我' : 'Ta'?>帮忙的小伙伴们</h1>
        </header>
        <div class="content">


    <ul class="table-view">
        <?php 
        $helpers = $giftbox->helpers;
        foreach ($helpers as $helper) {
        ?>
        <li class="table-view-cell media">
            <img class="media-object pull-left" src="<?= $helper->helper->headImgUrl ?>" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($helper->helper->nickname)) ?>
          <p>
              帮抢时间：<?= date('Y-m-d H:i:s', $helper->helping_time); ?>
          </p>
        </div>
        </li>
        <?php 
        }
        ?>
    </ul>

        </div>
    </div>

    <div id='claimers'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#claimers"></a>
            <h1 class='title'>已经抢了礼盒的Ta</h1>
        </header>
        <div class="content">


    <ul class="table-view">
        <?php 
        $claimed_giftboxes = \app\models\GiftboxClaimed::find()->orderBy(['claiming_time' => SORT_DESC])->limit(20)->all();
        foreach ($claimed_giftboxes as $claimed_giftbox) {
        ?>
        <li class="table-view-cell media">
            <a data-ignore='push' class="navigate-right" href="<?= Url::to([
                'yaoyiyao',
                'giftbox_id' => $claimed_giftbox->id,
                'gh_id' => $observer->gh_id,
                'openid' => $observer->openid,
            ]);?>">
            <img class="media-object pull-left" src="<?= $claimed_giftbox->claimer->headImgUrl ?>" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($claimed_giftbox->claimer->nickname)) ?>
          <p>
              抢礼盒时间：<?= date('Y-m-d H:i:s', $claimed_giftbox->claiming_time); ?>
          </p>
        </div>
            </a>
        </li>
        <?php 
        }
        ?>
    </ul>

        </div>
    </div>



    <script type="text/javascript">
    var SHAKE_THRESHOLD = 800;  
    var last_update = 0;
    var giftbox_categories = [<?= implode(',', \app\models\GiftboxCategory::getRemainingList()); ?>];
    var select_giftbox = 0;
    var x = y = z = last_x = last_y = last_z = 0;   

    function yaoyiyao() {  
        if (window.DeviceMotionEvent) {  
            window.addEventListener('devicemotion', deviceMotionHandler, false);  
        } else {  
            alert('not support mobile event');  
        }  
    }  
    
    function deviceMotionHandler(eventData) {  
        var acceleration = eventData.accelerationIncludingGravity;  
        var curTime = new Date().getTime();  
        if ((curTime - last_update) > 200) {  
            var diffTime = curTime - last_update;  
            last_update = curTime;  
            x = acceleration.x;  
            y = acceleration.y;  
            z = acceleration.z;  
            var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;  

            if (speed > SHAKE_THRESHOLD) {  
                //alert("摇动了");  
                var r = Math.random();
                if (r > 0.4) 
                    select_giftbox = 0;
                else if (r > 0.2)
                    select_giftbox = 1;
                else
                    select_giftbox = 2;
//                select_giftbox = (select_giftbox + 1) % giftbox_categories.length;
                var n = giftbox_categories[select_giftbox];
                //播放声音
//                musicBox.setAttribute("src", "http://wosotech.com/wx/web/images/au"+n+".mp3");  
//                musicBox.load();  
//                musicBox.play();

                //更换礼盒
                $("#gift1").hide();
                $("#gift2").hide();
                $("#gift3").hide();
               
                $("#gift"+n).show();

            }  
            last_x = x;  
            last_y = y;  
            last_z = z;  
        }  
    }  

    $(document).ready(function() {
        'use strict'; 

        $("#gift1").hide();
        $("#gift2").hide();
        $("#gift3").hide();

        $("#gift"+giftbox_categories[select_giftbox]).show();

        yaoyiyao();
               
        wx.config({
            debug: false,
            appId: '<?php echo $signPackage["appId"];?>',
            timestamp: <?php echo $signPackage["timestamp"];?>,
            nonceStr: '<?php echo $signPackage["nonceStr"];?>',
            signature: '<?php echo $signPackage["signature"];?>',
            jsApiList: [
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'translateVoice',
                'startRecord',
                'stopRecord',
                'onRecordEnd',
                'playVoice',
                'pauseVoice',
                'stopVoice',
                'uploadVoice',
                'downloadVoice',
                'chooseImage',
                'previewImage',
                'uploadImage',
                'downloadImage',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow',
                'scanQRCode',
                'chooseWXPay',
                'openProductSpecificView',
                'addCard',
                'chooseCard',
                'openCard'
            ]
        });
        
        wx.ready(function () {
            $('.giftbox').click ( function (e) {
                e.preventDefault();
                e.stopPropagation();
                var giftbox_type = $(e.target).attr('giftbox_type');
                musicBox.setAttribute("src", "http://wosotech.com/wx/web/images/au"+giftbox_type+".mp3");  
                musicBox.load();  
                musicBox.play();
                //alert(giftbox_type);
            });
            
            $('#thatsit').click (function () {
                var args = {
                    'classname':    '\\app\\models\\GiftboxClaimed',
                    'funcname':     'thatsitAjax',
                    'params':       {
                        'giftbox_id':   <?= $giftbox->id ?>,
                        'giftbox_catid':   giftbox_categories[select_giftbox]                          
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) {
                            location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });
            
            $('#ivegetit').click (function () {

                var gifNum = "<?= $total_rewards_count ?>";
                if (parseInt(gifNum) >= 400)
                {
                    alert("亲~ 本期活动奖品已经抢完。下期活动更加精彩，敬请关注！");
                    return;
                }

                if (!confirm('您需要到营业厅领取奖品后才点击此按钮！'))
                    return;
                
                var args = {
                    'classname':    '\\app\\models\\GiftboxClaimed',
                    'funcname':     'ivegetitAjax',
                    'params':       {
                        'giftbox_id':   <?= $giftbox->id ?>                         
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) {
                            location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });
            
            function shareSuccessCallback(giftbox_id, gh_id, openid, share_to) {
                var args = {
                    'classname':    '\\app\\models\\GiftboxShareLog',
                    'funcname':     'loggingAjax',
                    'params':       {
                        'giftbox_id':   giftbox_id,
                        'gh_id':        gh_id,  
                        'openid':       openid,
                        'shareTo':      share_to
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function() {                    
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            }
            
            <?php if (\app\models\GiftboxClaimed::STATUS_COMPLETED > $giftbox->status) { ?>
            var share2friendTitle = '帮<?= $claimer->nickname ?>来襄阳联通抢礼盒';
            var share2friendDesc = '已有<?= $giftbox->getHelpersNumber() ?>位好友帮<?= $claimer->nickname ?>抢了礼盒，还差<?= $giftbox->getHelpersNeeded();?>位，快来帮忙！';
            var share2timelineTitle = '<?= $claimer->nickname ?>正在参与襄阳联通缤纷盛夏抢礼盒活动，已有<?= $giftbox->getHelpersNumber() ?>位好友帮<?= $claimer->nickname ?>抢了礼盒，还差<?= $giftbox->getHelpersNeeded();?>位，快来帮忙！';
            var shareImgUrl = '<?= Url::to('/wx/web/images/gift1.jpg', true); ?>';
            <?php } else if (\app\models\GiftboxClaimed::STATUS_REWARDING > $giftbox->status) { ?>
            var share2friendTitle = '<?= $claimer->nickname ?>在襄阳联通抢到了礼盒';
            var share2friendDesc = '礼盒多多，绞尽脑汁，不知选啥，汗流如雨，快去围观！';
            var share2timelineTitle = '快来围观！<?= $claimer->nickname ?>在襄阳联通抢到了礼盒，绞尽脑汁，不知选啥，汗流如雨......';
            var shareImgUrl = '<?= Url::to('/wx/web/images/gift1.jpg', true); ?>';    
            <?php } else { ?>
            var share2friendTitle = '<?= $claimer->nickname ?>在襄阳联通抢到了<?= $giftbox->giftboxCategory->content ?>！';
            var share2friendDesc = '缤纷盛夏邀你共享微信好礼活动，快来围观并参与！';
            var share2timelineTitle = '<?= $claimer->nickname ?>在襄阳联通抢到了<?= $giftbox->giftboxCategory->content ?>！快来围观并参与缤纷盛夏邀你共享微信好礼活动！';
            var shareImgUrl = '<?= Url::to('/wx/web/images/gift'.$giftbox->category_id.'a.jpg', true); ?>';
            <?php } ?>
            
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138:giftbox_id=<?= $giftbox->id ?>#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                        <?= $giftbox->id ?>, 
                        '<?= $observer->gh_id ?>', 
                        '<?= $observer->openid ?>',
                        'friend'
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            wx.onMenuShareTimeline({
                title: share2timelineTitle, // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138:giftbox_id=<?= $giftbox->id ?>#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                        <?= $giftbox->id ?>, 
                        '<?= $observer->gh_id ?>', 
                        '<?= $observer->openid ?>',
                        'timeline'
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });


//            $('#changeBoxBtn').click(function (e) {
//                //alert('changeBoxBtn');
//                var n = giftbox_categories[select_giftbox];
//                //播放声音
//                musicBox.setAttribute("src", "http://wosotech.com/wx/web/images/au"+n+".mp3");  
//                musicBox.load();  
//                musicBox.play();
//
//                //更换礼盒
//                $("#gift1").hide();
//                $("#gift2").hide();
//                $("#gift3").hide();
//               
//                $("#gift"+n).show();
//
//            });


            
            $('#helpBtn').click(function (e) {
//                alert('helpBtn');
//                return;
                var args = {
                    'classname':    '\\app\\models\\GiftboxHelped',
                    'funcname':     'toHelpAjax',
                    'params':       {
                        'giftbox_id':    '<?= $giftbox->id; ?>',
                        'gh_id':  '<?= $observer->gh_id; ?>',  
                        'openid':  '<?= $observer->openid; ?>'
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) {
                        if (ret['code'] === 0) {
                            location.href = '<?= Url::to() ?>';
                        } else {
                            alert(ret['errmsg']);
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


        });
    });
    </script>



</html>
