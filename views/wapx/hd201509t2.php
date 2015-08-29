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
    <title>充话费送话费活动</title>

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
    <img width=100%  src="/wx/web/images/hd201509t2-head.jpg?v2">

        <p align="center">
            <a href="#hdgz"><i class="fa fa-list" style="color:green"></i>&nbsp;活动说明</a>
        </p>

        <br>
        <?php
            if($hd201509t2->status == 1)
            {
        ?>
            <center>
                <h4>
                您已经参加过充话费送话费活动。
                </h4>
                <p>参加时间: <?= $hd201509t2->create_time; ?></p>
            </center>
        <?php } else { ?>
            <center>
                <h4>
                    恭喜，您符合充话费送话费活动条件。
                </h4>
                <br>
                 <a class="btn btn-negative btn-block" style="width: 300px" id="queding">确认已领取</a>
                 <p><b>注意</b> <br>‘确认已领取’按钮由联通工作人员点击。<br>用户请勿点击!</p>
            </center>
        <?php } ?>
       

        <nav class="bar bar-tab">
            <a class="tab-item" href="#">
           襄阳联通&copy;2105
            </a>
        </nav>
    </div>


    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动说明</h1>
        </header>
        <div class="content">

            <p><b>活动规则</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （一）但凡2015年8月前入网的用户，使用本机号码关注襄阳联通微信号并绑定手机，即可参与活动。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （二）用户可享受存100元送20元、存200元送40元话费优惠。上限为200元，且每个用户只能参与一次。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （三）符合条件的用户在渠道或营业厅当场充值100/200元话费，由各渠道当场发放20元面值充值卡。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （四）渠道通过20元充值卡给用户充值，用户领取卡后必须由联通营业员点击微信活动页面的“确认已领取”按钮，便于微信后台统计数据，防止用户重复参与活动。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （五）校园用户不可参与本次活动。
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

                if (!confirm("如果您不是联通工作人员，请点'取消' ！"))
                    return;

                var args = {
                    'classname':    '\\app\\models\\MHd201509t2',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'openid': '<?= $hd201509t2->openid ?>',    
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
                            alert("我已充值完成！");
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

            var share2friendTitle = '<?= $observer->nickname ?> 正在参加充话费送话费活动';
            var share2friendDesc = '襄阳联通充话费送话费真是实惠！看看你能参加吗？';
            var share2timelineTitle = '阳联通充话费送话费真是实惠！看看你能参加吗？';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';
       
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t2:gh_03a74ac96138#wechat_redirect', // 分享链接
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
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t2:gh_03a74ac96138#wechat_redirect', // 分享链接
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
