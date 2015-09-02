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
    <title>9月特惠3天</title>

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
    <img width=100%  src="/wx/web/images/hd201509t2-head.jpg?v3">

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
                <h2 style="color: red">
                    恭喜！
                </h2>
                <h4 style="color: red">
                    凭此画面可到营业厅充费送费，<br><br>了解详情请看'活动说明'。
                </h4>
                <br>
                 <a class="btn btn-block" style="width: 120px" id="queding">确认已参与</a>
                 <p><b style="font-size: 14pt;color:red">注意!</b> <br>‘确认已参与’按钮由联通工作人员点击。<br>用户请勿点击!</p>
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
            （一）用户在充值后请点击微信活动界面的“确认已参与”按钮，便于系统话费到账；
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （二）用户可享受充100元送20元，充200元送40元话费优惠，上限为200元，且每个用户只能参加一次。赠送的话费在两天内由系统自动到账。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （三）用户在营业厅出示微信参与资格，即可参与活动。所充手机号码必须与襄阳联通微信绑定的会员号码一致。
            </p>

            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            （四）所预存的话费到账方式如下：
            <center>
            <table width="95%" border="1" style="font-size: 12pt;color:#aaa">
                <tr>  
                    <th>
                    用户网别
                    </th>
                    <th>
                    预存100元
                    </th>
                    <th>
                    预存200元
                    </th>
                    <th>
                    赠送的话费
                    </th>
                </tr>

                <tr>  
                    <td>
                    2G/3G用户
                    </td>
                    <td>
                    60元一次性到账，40元话费分4个月每月到账10元 
                    </td>
                    <td>
                    120元一次性到账，80元话费分4个月每月到账20元
                    </td>
                    <td>
                      两天内系统自动到账
                    </td>
                </tr>

                <tr>  
                    <td>
                    4G用户/首次续费用户
                    </td>
                    <td colspan="2">
                    一次性到账 
                    </td>
                    <td>
                      两天内系统自动到账
                    </td>
                </tr>
            </table>
            </center>
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
