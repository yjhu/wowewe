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
    <title>清凉一夏，邀你共享微信好礼</title>

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
          opacity: 0.8;
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
        <img width=100% height=100 src="/wx/web/images/gift-bar1.jpg">
        <audio style="display:hiden" id="musicBox" preload="metadata" autoplay="false"></audio>  

        <p align="center">
            <img src="<?= $claimer->headImgUrl; ?>" style="width:24px">&nbsp;
            <?= emoji_unified_to_html(emoji_softbank_to_unified($claimer->nickname)) ?> &nbsp;
            的礼盒<br>
            <?php if ($giftbox->isCompleted()) { ?>
            已有<span class='num'><a href="#fans"><?= $giftbox->getHelpersNumber(); ?></a></span>位好友为
        <?= $isSelf ? '我' : 'Ta'?>
            抢了礼盒<br>
            <?php } else { ?>
        已有<span class='num'><a href="#fans"><?= $giftbox->getHelpersNumber(); ?></a></span>位好友为
        <?= $isSelf ? '我' : 'Ta'?>
        抢了礼盒，还差<span class='num'><?= $giftbox->getHelpersNeeded();?></span>位<br>
            <?php } ?>


        <img id="gift1" width=100% style="width: 250px;height:200px" src="/wx/web/images/gift1.png?v13">
        <img id="gift2" width=100% style="width: 250px;height:200px; display: none" src="/wx/web/images/gift2.png?v13">
        <img id="gift3" width=100% style="width: 250px;height:200px; display: none" src="/wx/web/images/gift3.png?v13">
        <!--
        <i class="fa fa-gift" style="color:red;font-size: 20em;"></i>
        -->
        </p>




        <!-- 我 -->
        <?php if (\app\models\GiftboxClaimed::STATUS_UNDERWAY === $giftbox->status) { ?>
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" href="#zrbm">找人帮忙抢</a>
        </p>
        <?php } ?>
        <!-- -->
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_COMPLETED === $giftbox->status) { ?>
        <!--
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px" id="changeBoxBtn">换个礼盒</a>
        </p>
        -->
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px">就选它了</a>
        </p>
        <?php } ?>
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_REWARDING === $giftbox->status) { ?>
        <p align="center">
        <a class="btn btn-primary btn-block" style="width: 300px">领取礼盒</a>
        </p>
        <?php } ?>
        <?php if ($isSelf && \app\models\GiftboxClaimed::STATUS_REWARDED === $giftbox->status) { ?>
        <p align="center">
        <a class="btn btn-block" style="width: 300px">已领取</a>
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
       <p align="center">已有<a href="#claimers"><span class="num"><?= \app\models\GiftboxClaimed::find()->count() ?></span></a>人抢了礼盒</p>

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

        </div>
    </div>

    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动规则</h1>
        </header>
        <div class="content">

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
        $claimed_giftboxes = \app\models\GiftboxClaimed::find()->all();
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
                select_giftbox = (select_giftbox + 1) % giftbox_categories.length;
                var n = giftbox_categories[select_giftbox];
                //播放声音
                musicBox.setAttribute("src", "http://wosotech.com/wx/web/images/au"+n+".mp3");  
                musicBox.load();  
                musicBox.play();

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
            debug: true,
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
            
            wx.onMenuShareAppMessage({
                title: '帮<?= $claimer->nickname ?>来襄阳联通抢礼盒', // 分享标题
                desc: '已有<?= $giftbox->getHelpersNumber() ?>位好友帮<?= $claimer->nickname ?>抢了礼盒，还差<?= $giftbox->getHelpersNeeded();?>位，快来帮忙！', // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138:giftbox_id=<?= $giftbox->id ?>#wechat_redirect', // 分享链接
                imgUrl: '<?= Url::to('/wx/web/images/gift1.png', true); ?>', // 分享图标
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
                title: '<?= $claimer->nickname ?>正在参与襄阳联通清凉一夏抢礼盒活动，已有<?= $giftbox->getHelpersNumber() ?>位好友帮<?= $claimer->nickname ?>抢了礼盒，还差<?= $giftbox->getHelpersNeeded();?>位，快来帮忙！', // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/yaoyiyao:gh_03a74ac96138:giftbox_id=<?= $giftbox->id ?>#wechat_redirect', // 分享链接
                imgUrl: '<?= Url::to('/wx/web/images/gift1.png', true); ?>', // 分享图标
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


            $('#changeBoxBtn').click(function (e) {
                //alert('changeBoxBtn');
                var numbers = [1,2,3,1,2,3,1,2,3,3,2];
                var n = numbers[Math.floor(Math.random()*10) + 1].toString();
                //播放声音
                //musicBox.setAttribute("src", "http://wosotech.com/wx/web/images/au"+n+".mp3");  
                //musicBox.load();  
                //musicBox.play();

                //更换礼盒
                $("#gift1").hide();
                $("#gift2").hide();
                $("#gift3").hide();
               
                $("#gift"+n).show();

            });


            
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
