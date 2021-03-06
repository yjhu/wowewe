<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

include('../models/utils/emoji.php');

\Yii::$app->wx->setGhId($observer->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();

/*
$votes = \app\models\MQingshiVote::find()->select('*, count(*) as c')
->groupBy(['author_openid'])
->orderBy(['c'=>SORT_DESC, 'vote_time'=>SORT_ASC])
->limit(50)
->all(); 
*/

/*

foreach ($votes as $vote) {
    $top_num ++;

    if($vote->author_openid == $zhongqiu_score->author_openid)
        break;
}
*/
    $top_num = 0;
    $top = 0;

    //至少获得10票 才能上榜
    $votes = \app\models\MZhongqiuScore::find()
        ->where(['>' , 'score' , 499])
        ->orderBy(['score' => SORT_DESC, 'create_time' => SORT_ASC])
        ->limit(50)
        ->all(); 
        
    foreach ($votes as $vote) {
        $top_num ++;

        if($vote->author_openid == $zhongqiu_score->author_openid)
           break;
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>襄阳联通中秋抢iPhone6s活动</title>

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
        .p1{
            font-size: 12pt;
        }

        .pc{
            color:#000;
            font-size: 12pt;
        }

        .ht{
            color:#aaa;
            font-size: 10pt;
        }

        .vv{
            color:#aaa;
            font-size: 28pt;
            font-weight: bolder;
        }
        
        .vt{
            color:#aaa;
            font-size: 10pt;
        }

        /*#round_photo{ margin:10px auto} */
        /*#round_photo img{ border-radius:50%}*/

        /*
        .content {
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          overflow: auto;
          -webkit-overflow-scrolling: touch;
          background-image: url("/wx/web/images/beijing4.jpg?v3");
          background-position: center top;
          z-index: 1
        }
        */
    </style>

  </head>
  <body>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
        <!--
        <img border='0' src='/wx/web/images/beijing2.jpg'>
        -->
        <p align="center">
            <a href="#tppm"><i class="fa fa-trophy fa-2x" style="color:#ed6d00"></i>&nbsp;排名</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动说明</a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#tp_friends"><i class="fa fa-users"></i>&nbsp;看看有谁帮我</a>
        </p>
        
        <p align="center">
            <?php if(!empty($zhongqiu_score->user->headimgurl)) { ?>
                <img width="42" src='<?= $zhongqiu_score->user->headimgurl ?>'><br>
                <?= emoji_unified_to_html(emoji_softbank_to_unified($zhongqiu_score->user->nickname)) ?>
            <?php } else { ?>
                <img width="42" src='/wx/web/images/wxmpres/headimg-blank.png'><br>
                <?= emoji_unified_to_html(emoji_softbank_to_unified($zhongqiu_score->user->nickname)) ?>
            <?php } ?>
        </p>

        <center>
            <?php
                $vote_count = \app\models\MZhongqiuScore::findOne(['author_openid' => $zhongqiu_score->author_openid]);
                if(empty($vote_count))
                {
            ?>
                <img width=65% height=40% src="/wx/web/images/hongbao.png?v2" id="toupiao">
            <?php } else { ?>

                <?php 
                    $zs = \app\models\MZhongqiuScore::findOne(['author_openid' => $zhongqiu_score->author_openid]);
                    if($zs->score == 0)
                    {
                ?>
                    <img width=65% height=40% src="/wx/web/images/hongbao.png?v2" id="toupiao"><br>
                <?php } else { ?>
                    <img width=65% height=40% src="/wx/web/images/hongbao-open.png?v2"><br>
                <?php } ?>
          
                <span class="vt">得</span>
                <span  style="color:red; font-size: 18pt; font-weight: bolder">
                    <?= $vote_count->score; ?>
                </span>
                <span class="vt">联通币 &nbsp;&nbsp;&nbsp;&nbsp; 第</span>
                <sapn style="color:red; font-size: 18pt; font-weight: bolder"><?= $top_num ?></sapn>
                <span class="vt">名</span>
            <?php } ?>

        </center>
        <br>
        <p align="center">
            <!--
            <a class="btn btn-negative btn-block" style="width: 300px" id="toupiao">拆红包</a>
            -->

            <a class="btn btn-negative btn-block" style="width: 300px"  id="kankan">
            我也来抢红包
            </a>

            <a class="btn btn-block btn-primary" style="width: 300px"  href="#lapiao">
            怎么抢红包赢iPhone6s？
            </a>
        </p>
        <br>
        &nbsp;
    </div>


    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动说明</h1>
        </header>
        <div class="content">
            <p><b>参加活动</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            用户通过阅读文章或点击活动菜单进入活动页面，提交“你的他/她为你做过最浪漫的事”或者“你最想为他/她说的话”，或者“三行情诗”的文字内容，审核通过后即可在手机上展示和发起投票。每人仅能投稿一次。</p>
            </p>
            <br><hr>
            <p><b>参与投票</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            用户在关注“襄阳联通”微信号且绑定手机后，可以通过文章或活动菜单或朋友圈、微信群分享进入活动页面，参与投票。每人只能有1次投票机会。
            </p>
            <br><hr>
            <p><b>怎么拉票？</b></p>
            <p class='p1'>&nbsp;&nbsp;&nbsp;&nbsp;
            把“我的情诗”或者“心仪的情诗”转发给好友或朋友圈，叫小伙伴们帮忙投票吧~ 可无限转发给好友拉票哟。
            </p>
            <br><hr>
            <p><b>奖品设置</b></p>
            <p class='p1'> 至8月20日24:00，按所得票数对作品进行排名，由上至下分配获奖名额，赠送用户相应积分，积分可兑换奖品如下： </p>
            <p class='p1'> 一等奖（一名）：积分10000分，可兑换送情侣手机一对+情侣号一对(红米note)。</p>
            <p class='p1'> 二等奖（两名）：积分5000分，可兑换拉杆箱一个+电台黄金时段告白一次。 </p>
            <p class='p1'> 三等奖（三名）：积分500分，可兑换电影票二张。 </p>
            <br>
            <p align="center">
            <a class="btn btn-block" href="#hdgz" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <div id='lapiao'  class='modal'>

        <div class="content">
            <img width=100% src="/wx/web/images/toupiao.jpg?v2">

            <br>
            <p align="center">
            <a class="btn btn-block" href="#lapiao" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <div id='tppm'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#tppm"></a>
            <h1 class='title'>红包排名</h1>
        </header>
        <div class="content">

            <ul class="table-view">
            <li class="table-view-cell media">
                <div class="media-body">
                    名次
                </div>

                <span class="badge" style="font-size: 12pt">
                    所得红包
                </span>
            </li>

            <?php foreach ($votes as $vote) 
                {
                    $top ++ ;
                    //$author = \app\models\MQingshiAuthor::findOne(['author_openid' => $vote->author_openid]);
            ?>
              <li class="table-view-cell media">


                <sapn class="pull-left" style="font-size: 18pt; font-weight: bolder;color:green;">
                    <?= $top ?>.
                    &nbsp;&nbsp;
                </sapn>

                <?php if(!empty($vote->user->headimgurl)) { ?>
                    <img width="42" src='<?= $vote->user->headimgurl ?>' class="media-object pull-left">
                <?php } else { ?>
                    <img width="42" src='/wx/web/images/wxmpres/headimg-blank.png' class="media-object pull-left">
                <?php } ?>

                <div class="media-body">
                    <?= emoji_unified_to_html(emoji_softbank_to_unified($vote->user->nickname)) ?>
                    <p><?= $vote->create_time; ?></p>
                </div>

                <span class="badge badge-primary" style="font-size: 12pt">
                   <?php
                        $zhongqiu_score = \app\models\MZhongqiuScore::findOne(['author_openid' => $vote->author_openid]);
                        echo $zhongqiu_score->score;
                   ?>
                </span>

              </li>
            <?php } ?>
            </ul>
    
            <span style="color:red">有999个沃币方可获得兑奖资格哟~</span>

            <br>
            <p align="center">
            <a class="btn btn-block" href="#tppm" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <div id='tp_friends'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#tp_friends"></a>
            <h1 class='title'>帮忙拆红包的好友</h1>
        </header>
        <div class="content">
            <?php

               $tp_friends = \app\models\MZhongqiuVote::find()
                ->where(['author_openid' => $zhongqiu_score->author_openid])
                ->orderBy(['vote_time' => SORT_DESC])
                ->all();

               $vote_cnt = 0;

            ?>

            <ul class="table-view">
                <li class='table-view-cell'>
        
                </li>
                    <?php 

                        foreach ($tp_friends as $tp_friend) {
                        $vote_cnt ++;

                        if($vote_cnt > 20) break;

                        $friend = \app\models\MUser::findOne(['openid' => $tp_friend->vote_openid]);
                    ?>
                    <li class="table-view-cell media">
  
                    <img class="media-object pull-left" src="<?= $friend->headImgUrl ?>" width="64" height="64">

                    <div class="media-body">
                      <!--粉丝昵称--> 
                      <?= emoji_unified_to_html(emoji_softbank_to_unified($friend->nickname)) ?>
                      <p>
                          拆红包时间：<?= $tp_friend->vote_time ?>
                      </p>
                    </div>
                        
                    </li>
                    <?php 
                        }
                    ?>
                </ul>
            

            <br><br>
            <p align="center">
            <a class="btn btn-block" href="#tp_friends" style="width: 300px" >返回</a>
            </p>
        </div>
    </div>


    <script type="text/javascript">

    $(document).ready(function() {
        'use strict'; 
        //$("#toupiao").hide();
 
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
            //$("#toupiao").show();


            $('#kankan').click (function () {
                location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/zhongqiu-vote:gh_03a74ac96138#wechat_redirect";

            })

            $('#toupiao').click (function () {
                //alert('toupiaoAjax');
                var author_openid = '<?= $zhongqiu_score->author_openid ?>';  
                var vote_openid = '<?= $observer->openid ?>';

                //alert('author_openid:'+author_openid);
                //alert('vote_openid:'+vote_openid);

                if(author_openid === vote_openid)/*自己*/
                {
                    var score = 500;
                    alert("拆到大红包，获得500联通币！");
                }
                else
                {
                    var score = Math.floor(Math.random()*10+1);
                    alert("为好友拆到"+score+"联通币");
                }

                var args = {
                    'classname':    '\\app\\models\\MZhongqiuVote',
                    'funcname':     'toupiaoAjax',
                    'params':       {
                        'author_openid': '<?= $zhongqiu_score->author_openid ?>',    
                        'vote_openid':   '<?= $observer->openid ?>',
                        'score': score,
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
                            //alert("成功！");
                            location.href = '<?= Url::to() ?>';
                        }
                        else if(11 === ret['code'])
                        {
                            alert("只有一次机会哟！ 可分享到朋友圈帮你拉票 ~~");
                            //location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });

            var share2friendTitle = '快来帮 <?= $observer->nickname ?> 拆红包赢iPhoone6s！';
            var share2friendDesc = '拆红包抢iPhoone6s，大奖等你拿！';
            var share2timelineTitle = '拆红包抢iPhoone6s，大奖等你拿！';
            var shareImgUrl = '<?= Url::to($observer->headimgurl, true); ?>';
       
            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/zhongqiu-vote:gh_03a74ac96138:id=<?= $zhongqiu_score->author_openid ?>#wechat_redirect', // 分享链接
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
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/zhongqiu-vote:gh_03a74ac96138:id=<?= $zhongqiu_score->author_openid ?>#wechat_redirect', // 分享链接
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
