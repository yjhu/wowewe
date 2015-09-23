<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>中秋送话费活动</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link href="./php-emoji/emoji.css" rel="stylesheet">    
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">


    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <style type="text/css">

        </style>
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
    <img width=100%  src="/wx/web/images/hd201509t6-head.jpg?v3">
        <marquee direction=left style="color:red" scrollamount=3>
        <span>
        <?php
            $hd_users = app\models\MHd201509t6::find()->where(["status" => 1])->orderBy(['hbme' => SORT_DESC])->all();
            foreach ($hd_users as $hd_user) 
            {
        ?>
            <?= emoji_unified_to_html(emoji_softbank_to_unified($hd_user->user->nickname)) ?> &nbsp;
            手机<?= '*******'.substr($hd_user->mobile,7,4) ?> &nbsp;
            已抢到红包<?= $hd_user->hbme ?>元&nbsp;&nbsp;

        <?php 
            } 
        ?>
        </span> 
        </marquee>
        <hr color="#E727F1">

        <p align="center">
            <a href="#hdgz"><i class="fa fa-list fa-2x" style="color:green"></i>&nbsp;活动说明</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#share"><i class="fa fa-share-alt fa-2x" style="color:blue"></i>&nbsp;与小伙伴分享</a>
        </p>

        <br>

        <?php
            if($hd201509t6->status == 1)
            {
        ?>
            <center>
                <h4>
                您已经参加过中秋送话费活动。
                </h4>
                <p>红包收入: <span style="font-weight: bolder;color:red;font-size: 20pt"><?= $hd201509t6->hbme; ?></span> 元</p>
                <p>参加时间: <?= $hd201509t6->create_time; ?></p>
                <p>渠道编码: <?= $hd201509t6->qdbm; ?></p>
                <br>&nbsp;
                <br>&nbsp;
                <br>&nbsp;
            </center>
        <?php } else { ?>

                <?php if($hd201509t6->hbme == 0) { ?>
                <center>
                <!--
                    <a class="btn btn-block btn-negative" style="width: 200px" id="hongbao">点击拆红包</a>
                -->
                    <img width=90% src="/wx/web/images/hongbao1.png?v7" id="hongbao">

                    <br>&nbsp;
                    <br>&nbsp;
                    <br>&nbsp;
                </center>
                <?php } else { ?>
                    <center>
                        <h2 style="color: red">
                            恭喜, 已得红包 <?= $hd201509t6->hbme ?> 元！
                        </h2>
                        <h4 style="color: red">
                            凭此画面可到营业厅领取，<br><br>详情见&#8593; '活动说明'。
                        </h4>
                        <br>
                         <input type="text" placeholder="请输入渠道编码" id="qdbm" style="width:200px">
                         <a class="btn btn-block" style="width: 200px" id="queding">确认已当场兑换</a>
                         <p><b style="font-size: 14pt;color:red">注意!</b> <br>'确认已当场兑换' 按钮由联通工作人员点击。<br>用户请勿点击!</p>
                        <br>&nbsp;
                        <br>&nbsp;
                        <br>&nbsp;
                    </center>
                <?php } ?>

        <?php } ?>
       

        <nav class="bar bar-tab">
            <a class="tab-item" href="#">
           襄阳联通&copy;2105
            </a>
        </nav>
    </div>

    <div id='share'  class='modal'>
        <div class="content">
            <img width=100% src="/wx/web/images/share-v4.jpg?v1">

            <br>
            <p align="center">
            <a class="btn btn-block" href="#share" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>

    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动说明</h1>
        </header>
        <div class="content">

            <p><b>活动规则</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （1）用户缴纳100元话费或者在联通办理入网即可兑换红包，以话费形式充入用户号码。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （2）用户在缴费后由联通营业人员输入信息并点击用户手机界面的“确认已当场兑换”按钮，随后由营业人员为用户当场兑换话费红包。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （3）每位用户只能参加一次，所充手机号码必须与襄阳联通微信绑定的会员号码一致。
            </p>

            <br><hr>
            
            <p align="center">
            <a class="btn btn-block" href="#hdgz" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>

    <script type="text/javascript">

    $(document).ready(function() {
        'use strict'; 
    
            $('#queding').click (function () {

                //alert('confirmAjax');
                var qdbm = $("#qdbm").val();
                if(qdbm == "")
                {
                    alert("请输入渠道编码");
                    return false;
                }

                if (!confirm("如果您不是联通工作人员，请点'取消' 或 '关闭网页'！"))
                    return;

                var args = {
                    'classname':    '\\app\\models\\MHd201509t6',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'openid': '<?= $hd201509t6->openid ?>',
                        'qdbm': qdbm,
                        
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            alert("已成功参与本次活动！");
                            location.href = '<?= Url::to() ?>';
                        }
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


            $('#hongbao').click (function () {

                var args = {
                    'classname':    '\\app\\models\\MHd201509t6',
                    'funcname':     'hangbaoAjax',
                    'params':       {
                        'openid': '<?= $hd201509t6->openid ?>',
                        'tcnx': '<?= $hd201509t6->tcnx ?>',
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) 
                        {
                            //alert("ok1");
                            location.href = '<?= Url::to() ?>';
                        }
                        else
                        {
                             alert("error");
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


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
            //alert('wx ready');

           
            var share2friendDesc = '襄阳联通中秋送话费活动火热进行中 ... ...';
            var share2timelineTitle = '襄阳联通中秋送话费活动火热进行中 ... ...';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';

            //var hbme = ',已抢到 '+'<?= $hd201509t6->hbme ?>'+' 元红包！';
            var hbme = "<?= ($hd201509t6->hbme)?',已抢到'.$hd201509t6->hbme.' 元红包!':'' ?>";
            var share2friendTitle = '<?= $observer->nickname ?> 正在参加中秋送话费活动'+hbme;

            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t6:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            wx.onMenuShareTimeline({
                title: share2timelineTitle, // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t6:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    shareSuccessCallback(
                    );
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });



        });//end of wx  ready


    });
    </script>



</html>
