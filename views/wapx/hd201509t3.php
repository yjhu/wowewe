<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();

$lists = \app\models\MHd201509t4::find()
        ->where(['openid' => $observer->openid, 'status' => 2])
        ->orderBy(['create_time' => SORT_DESC])
        ->all();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>小积分大爱心活动</title>

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

    <img width=100%  src="/wx/web/images/hd201509t3-head.jpg?v3">
    <hr width="100%" color="green">

        <p align="center">
            <a href="http://jf.10010.com"><i class="fa fa-gift fa-3x" style="color:#FC8301"></i>&nbsp;积分兑换</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list fa-2x" style="color:green"></i>&nbsp;活动说明</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#history"><i class="fa fa-heart fa-2x" style="color:red"></i>&nbsp;爱心历史</a>
        </p>

        <br><br>
        <?php if($flag == 1) { ?>

            <?php
                if($hd201509t3->status == 1)
                {
            ?>
                <center>
                    <h3 style="color:red">
                    捐献<?= $hd201509t3->score;?>积分
                    </h3>

                    <h4>
                    谢谢！您的爱心已送出...
                    </h4>
                    <br>
                    <p>参加时间: <?= $hd201509t3->create_time; ?></p>
                </center>
            <?php } else { ?>
                <center>
                    <h4 style="color:red">
                        恭喜，您符合捐献积分献爱心活动条件。
                    </h4>
                    <br>
                     <a class="btn btn-positive btn-block" style="width: 300px" id="queding1">捐献99积分</a>
                        <br>
                     <a class="btn  btn-block btn-negative" style="width: 300px" id="queding2">捐献199积分</a>

                </center>
            <?php } ?>

        <?php } else { ?>
            <center>
            <h4>
                对不起 :(<br><br>
                暂时不符合此活动条件，感谢您的参与。
            </h4>
            </center>
        <?php } ?>
       
            <!--
            <center>
                <br>
                <a class="btn btn-primary btn-block" style="width: 300px" href="#history">爱心历史</a>
            </center>
            -->

      <nav class="bar bar-tab">
            <a class="tab-item" href="#">
           襄阳联通&copy;2105
            </a>
      </nav>
    </div>

    <div id='history'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#history"></a>
            <h1 class='title'>爱心历史</h1>
        </header>
        <div class="content">

            <ul class="table-view">

              <li class="table-view-cell media">
                    <div class="media-body">
                     <span class="badge" style="font-size: 12pt">
                        捐献时间
                    </span>
                    </div>

                    <span class="badge" style="font-size: 12pt">
                        积分
                    </span>
              </li>

            <?php 
                foreach ($lists as $list) 
                {
            ?>
                <li class="table-view-cell"><?= $list->create_time ?> 
                <span class="badge badge-negative" style="font-size: 12pt"><?= $list->score ?></span>
                </li>
            <?php } ?>
            </ul>

            <br>
            <p align="center">
            <a class="btn btn-block" href="#history" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动说明</h1>
        </header>
        <div class="content">
            <p><b>“小积分、大爱心”活动</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            小积分、大爱心”是襄阳联通组织开展的一次公益捐赠活动，用户可通过消费积分兑换指定物品参与公益捐赠事业，共同关爱山区贫困儿童。
            </p>
            </p>
            <br><hr>
            <p><b>活动时间</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            2015年9月1日至11月30日
            </p>
            <br><hr>
            <p><b>捐赠地点</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            湖北省襄阳市保康县寺坪镇板庙小学
            </p>
            <br><hr>
            <p><b>活动兑换产品</b></p>
            <p class='p1'>铅笔/支  消减99积分</p>
            <p class='p1'>软皮本/本  消减199积分</p>

            <br><hr>
            <p><b>用户参与标准</b></p>
            <p class='p1'>仅限襄阳联通2G、3G移网客户参加；</p>
            <p class='p1'>无兑换历史用户，首次兑换需达到1500分</p>
            <p class='p1'>用户处于欠费、停机状态无法实现兑换</p>

            <br><hr>
            <p><b>如何查询参与信息</b></p>
            <p class='p1'>全市各实体渠道通过BSS系统查询客户积分兑换记录；</p>
            <p class='p1'>关注襄阳联通公众微信、官方微博，在活动公布信息中查询；</p>
            <p class='p1'>留意襄阳日报、晚报相关报道。</p>
            <br><hr>
            <p><b>兑换成功后是否可以取消、所兑物品是否给用户？</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;积分一经兑换不可取消，礼品不直接配送至客户，由襄阳联通统一派送至保康县寺坪镇龙凤村小学；</p>
            <br>
            
            <p align="center">
            <a class="btn btn-block" href="#hdgz" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <script type="text/javascript">

    $(document).ready(function() {
        'use strict'; 
    
            $('#queding1').click (function () {

                //alert('confirmAjax1');
                var args = {
                    'classname':    '\\app\\models\\MHd201509t4',
                    'funcname':     'confirmAjax',
                    'params':       { 
                        'mobile': '<?= empty($hd201509t3)?"":$hd201509t3->mobile ?>',
                        'score': 99,
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
                            alert("谢谢，您的爱心已送出！");
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


            $('#queding2').click (function () {

                //alert('confirmAjax2');
                var args = {
                    'classname':    '\\app\\models\\MHd201509t4',
                    'funcname':     'confirmAjax',
                    'params':       {
                        'mobile': '<?= empty($hd201509t3)?"":$hd201509t3->mobile ?>',   
                        'score': 199, 
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
                            alert("谢谢，您的爱心已送出！");
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

            var share2friendTitle = '<?= $observer->nickname ?> 正在参加捐小积分大爱心活动';
            var share2friendDesc = '襄阳联通小积分大爱心正在进行中！看看你能参加吗？';
            var share2timelineTitle = '襄阳联通小积分大爱心正在进行中！看看你能参加吗？';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';
       
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t3:gh_03a74ac96138#wechat_redirect', // 分享链接
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
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/hd201509t3:gh_03a74ac96138#wechat_redirect', // 分享链接
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
