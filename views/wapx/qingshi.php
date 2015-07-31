<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

 $qas = \app\models\MQingshiAuthor::find()->where(['=', 'status', \app\models\MQingshiAuthor::AUDIT_PASS])->orderBy(['create_time' => SORT_DESC])->all();

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>三行情诗投票</title>

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
  </head>
  <body>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">

        <img width=100% src="/wx/web/images/quanchengrelian1.jpg?v1">

        <p align="center">
            <a href="#tppm"><i class="fa fa-trophy"></i>&nbsp;投票排名</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动内容</a>

            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#shqs"><i class="fa fa-heart" style="color:red"></i>&nbsp;三行情诗</a>
    
        </p>
        <br>

        <ul class="table-view">
         <?php foreach ($qas as $qa) {?>
          <li class="table-view-cell">

                <a  data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                    'qingshi-vote', 
                    'id' => $qa->id,
                ]) ?>">
              <span class="badge badge-negative">
                  <?php
                        $vote_count = \app\models\MQingshiVote::find()
                        ->where(['author_openid' => $qa->author_openid])
                        ->count();
                        echo $vote_count;
                  ?>
              </span>

                <?php if(!empty($qa->user->headimgurl)) { ?>
                    <img width="32" src='<?= $qa->user->headimgurl ?>' class="pull-left">
                <?php } else { ?>
                    <img width="32" src='/wx/web/images/wxmpres/headimg-blank.png' class="pull-left">
                <?php } ?>

              &nbsp;&nbsp;
              <span style="color:#ccc">
              <?= $qa->p1 ?>
              </span>
            </a>
          </li>
        <?php } ?>
        </ul>


    <div class="bar bar-standard bar-footer-secondary" style="height:52px">
       <a class="btn btn-primary btn-block"  href="#xieqingshi">我也写情诗</a>
    </div>

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>


    <div id='tppm'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#tppm"></a>
            <h1 class='title'>投票排名</h1>
        </header>
        <div class="content">

        </div>
    </div>

    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动内容</h1>
        </header>
        <div class="content">
            <p><b>参加活动</b></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;
            用户通过阅读文章或点击活动菜单进入活动页面，提交“你的他/她为你做过最浪漫的事”或者“你最想为他/她说的话”，或者“三行情诗”的文字内容，审核通过后即可在手机上展示和发起投票。每人仅能提交一次。</p>
            </p>
            <br><hr>
            <p><b>参与投票</b></p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;
            用户在关注“襄阳联通”微信号且绑定手机后，可以通过文章或活动菜单或朋友圈、微信群分享进入活动页面，参与投票。每人只能有1次投票机会,可无限转发给好友拉票。
            </p>
            <br><hr>
            <p><b>奖品设置</b></p>
            <p>一等奖（一名）：送情侣手机一对+情侣号一对（红米note*2）</p>
            <p>二等奖（两名）：拉杆箱+电台黄金时段告白一次</p>
            <p> 三等奖（三名）：送电影票一对</p>


            <br>
            <p align="center">
            <a class="btn btn-block" href="#hdgz" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <div id='xieqingshi'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#xieqingshi"></a>
            <h1 class='title'>我也写情诗</h1>
        </header>
        <div class="content">

            <form class="input-group">
                <input type="text" placeholder="第一行, 小于60个字符" id="p1" maxlength="60"><br>
                <input type="text" placeholder="第二行, 小于60个字符" id="p2" maxlength="60"><br>
                <input type="text" placeholder="第三行, 小于60个字符" id="p3" maxlength="60"><br>
                <br><br>
                <p align="center">
                    <a class="btn btn-positive btn-block" style="width: 300px" id="xiehaole">写好了</a>
                </p>

            </form>

        </div>
    </div>

    <div id='shqs'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#shqs"></a>
            <h1 class='title'>三行情诗起源</h1>
        </header>
        <div class="content">
            <br><br>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;
            “三行情书”来源于日本汉字协会为推广汉字教育而发起的一项诗歌体裁，往往以某事物为主题，要求作者以60字以内、排列成三句的诗歌形式表现出来。
            </p>
            <br>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;
            其实三行诗并不是日本人的原创，这种题材的诗历史上见诸各诗人手笔。其中文艺复兴时期的诗人但丁的名著《神曲》便是应用最多三行韵律的诗歌。《神曲》全书一百歌一律用“三行韵律”或“三行连锁押韵法”写成。每个歌都是由三行诗节一环扣一环，连锁接成的长链条。
            </p>

            <br>
            <p align="center">
            <a class="btn btn-block" href="#shqs" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>



    <script type="text/javascript">

    $(document).ready(function() {
        'use strict'; 
    

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

            var share2friendTitle = '<?= $observer->nickname ?>在襄阳联通参加三行情诗比赛和投票！';
            var share2friendDesc = '全城热恋·浪漫情话说出来，快来参与和投票，大奖等你拿！';
            var share2timelineTitle = '全城热恋·浪漫情话说出来，快来参与和投票，大奖等你拿！';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';
       
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/qingshi-author:gh_03a74ac96138#wechat_redirect', // 分享链接
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
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/qingshi-author:gh_03a74ac96138#wechat_redirect', // 分享链接
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


            $('#xiehaole').click (function () {

                //alert($("#p3").val());
                // alert('<?= $qingshi_author->id ?>');
                if(
                    ($("#p1").val() == "") || 
                    ($("#p2").val() == "") || 
                    ($("#p3").val() == "") 
                )
                {
                    alert("3行情诗的每一行都需要写哟 ~~");
                    return false;
                }

                var args = {
                    'classname':    '\\app\\models\\MQingshiAuthor',
                    'funcname':     'xiehaoleAjax',
                    'params':       {
                        'id':   <?= $qingshi_author->id ?>,
                        'p1':   $("#p1").val(),  
                        'p2':   $("#p2").val(),
                        'p3':   $("#p3").val()            
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
                            //alert("refresh");
                            alert("您以成功提交。审核通过后就可以呼朋唤友投票啦~");
                            location.href = '<?= Url::to() ?>';
                        }
                        else if(11 === ret['code'])
                        {
                            alert("您已经投稿一次, 每人一次机会哟。审核通过后就可以呼朋唤友投票啦~");
                            location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });


        });//end of wx  ready


    });
    </script>



</html>
