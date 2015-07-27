<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

use app\models\MDisk;

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/disk/assets';
$gh_id = U::getSessionParam('gh_id');
$openid = U::getSessionParam('openid');

$disk = \app\models\MDisk::findOne([
            'openid' => $openid
        ]);

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

	#diskstart{
		text-align: center;
	}

	#start {
		top: -265px;
		position: relative;
	}

	</style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
	<script src="<?php echo "$assetsPath/jQueryRotate.2.2.js"; ?> "></script>
	<script src="<?php echo "$assetsPath/jquery.easing.min.js"; ?> "></script>

    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
  </head>
  <body>

    <!--<div class="content" style="background-color: #401080">-->
    <div class="content">
    <img width="100%" src="<?php echo "$assetsPath/yuemochoujiang.png"; ?>" alt="缤纷盛夏邀你共享微信好礼">

    <p align="center">
		<a href="#hjmd"><i class="fa fa-trophy"></i>&nbsp;获奖名单</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="#hdgz"><i class="fa fa-list"></i>&nbsp;活动规则</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#mzj">没中奖的看这里!</a>
	</p>

        <?php if ($disk->win == 1) { ?>
        <p align="center">
            <span style='font-size:0.8em;'><i class='fa fa-exclamation-triangle' style='color:red;'></i>您需要到<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/nearestoutlets:gh_03a74ac96138#wechat_redirect'>附近营业厅</a>领取奖品后才点击此按钮！<i class='fa fa-exclamation-triangle'  style='color:red;'></i></span>
            <a class="btn btn-primary btn-block" style="width: 300px" id='ivegetit'>领取奖品</a>
        </p>
        <?php } ?>

        <?php if ($disk->win == 2) { ?>
        <p align="center">
            
        <a class="btn btn-block" style="width: 300px">已领取</a>
        领取时间：<?= date('Y-m-d H:i:s', $disk->win_time); ?>
        </p>
        <?php } ?>

	<div id="diskstart">
		<div id="disk">
			<img width="85%" src="<?php echo "$assetsPath/disk5.png"; ?>">
		</div>
		<div id="start">
			<img src="<?php echo "$assetsPath/start4.png"; ?>" id="startbtn" style="-webkit-transform: rotate(197deg);">
		</div>

	</div>



	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;
	<br>&nbsp;

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          襄阳联通&copy;2015
        </a>
      </nav>
    </div>


    <div id='hdgz'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hdgz"></a>
            <h1 class='title'>活动规则</h1>
        </header>
        <div class="content">
        <div class="card" style="border:0">
          <p></p>

            <p>活动主题：缤纷盛夏 邀你共享微信好礼 月末抽奖</p>

            <p>奖品包括：PPTV功能、小风扇、电影票、U盘等、自拍神器</p>

            <p>领奖说明：当月新推广的粉丝月底开通幸运抽奖，次月第一周周五微平台公布幸运中奖名单，用户务必在7月31日之前至营业厅领取，逾期奖励作废。更多信息请咨询附近各联通营业厅。</p>

            <p>活动最终解释权归襄阳联通。</p>

            <br>
            <p>
            <a href="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/nearestoutlets:gh_03a74ac96138#wechat_redirect">附近营业厅</a>
            </p>

          <br><br>
          <a class="btn btn-block" href="#hdgz">返回</a>
        </div>
    </div>
 </div>



    <div id='mzj'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#mzj"></a>
            <h1 class='title'>推广赢话费</h1>
        </header>
        <div class="content">
        <div class="card" style="border:0">
          <p></p>
            <p >没有中奖的小伙伴也不用担心。</p>

            <p style="color:red">每推荐一个好友关注“襄阳联通”的微信，就能得到5块钱话费哦~ </p>

            <p style="color:red">每个月最高可得100元话费！</p>
            <br>

            <img width="100%" src="<?php echo "$assetsPath/tg.png"; ?>">

          <br><br>
          <a class="btn btn-block" href="#mzj">返回</a>
        </div>
    </div>
 </div>

 <!-- 获奖名单 页面 -->
 <div id='hjmd'  class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#hjmd"></a>
            <h1 class='title'>获奖名单</h1>
        </header>
        <div class="content">
            <?php 
                $total_rewards_count = \app\models\MDisk::find()->where(['>', 'win', 0])->count();
                //if (20 > $total_rewards_count) {
                    $total_rewards = \app\models\MDisk::find()->where(['>', 'win', 0])->orderBy(['win_time' => SORT_DESC])->all();
                //} else {
                 //   $total_rewards = \app\models\MDisk::find()->where(['>', 'win', 0])->orderBy(['win_time' => SORT_DESC])->limit(20)->all();
                //}
            ?>
<ul class="table-view">
    <li class='table-view-cell'>
    
        <?php if($total_rewards_count < 400) { ?>
                月末抽奖已有<?= $total_rewards_count ?>位中奖
        <?php } else { ?>
                <span style="color:red">亲~ 本期活动奖品已抢完，下期再来吧！</span>
        <?php } ?>

    </li>
        <?php 
        foreach ($total_rewards as $reward) {
        ?>
        <li class="table-view-cell media">


            <img class="media-object pull-left" src="<?= $reward->winner->headImgUrl ?>" width="64" height="64">

        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($reward->winner->nickname)) ?>
          <p>
              抽奖时间：<?= date('Y-m-d H:i:s', $reward->win_time); ?>
          </p>
        </div>
           
        </li>
        <?php 
        }
        ?>
    </ul>
        </div>
    </div>
<script type="text/javascript">

	$(document).ready(function(){

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

            var share2friendTitle = '缤纷盛夏邀你共享微信好礼';
            var share2friendDesc = '当月新推广的粉丝月底开通幸运抽奖，奖品包括PPTV功能、小风扇、电影票、U盘等。';
            var share2timelineTitle = '缤纷盛夏邀你共享微信好礼';
            var shareImgUrl = "<?= Url::to($assetsPath.'/disk4.png', true); ?>";

            wx.onMenuShareAppMessage({
                title: share2friendTitle, // 分享标题
                desc: share2friendDesc, // 分享描述
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wap/disk1:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 

                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            wx.onMenuShareTimeline({
                title: share2timelineTitle, // 分享标题
                link: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wap/disk1:gh_03a74ac96138#wechat_redirect', // 分享链接
                imgUrl: shareImgUrl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 

                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });


            $('#ivegetit').click (function () {

                //var gifNum = "<?= $total_rewards_count ?>";
                //if (parseInt(gifNum) >= 400)
               // {
                //   alert("亲~ 本期活动奖品已经抢完。下期活动更加精彩，敬请关注！");
                 //   return;
                //}

                //alert('<?php echo $openid; ?>');

                if (!confirm('您需要到营业厅领取奖品后才点击此按钮！'))
                    return;
                
                var args = {
                    'classname':    '\\app\\models\\MDisk',
                    'funcname':     'diskwinnerAjax',
                    'params':       {
                        'openid':   '<?php echo $openid; ?>'
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
            


        });//end of wx.ready



		//alert('ready');
		$("#startbtn").rotate({
			bind:{
				click:function(){
					var json_data;
					$.ajax({
						url: "<?php echo Url::to(['wap/ajaxdata', 'cat'=>'diskclick'], true) ; ?>",
						type:"GET",
						async:false,
						cache:false,
						dataType:'json',
						data: "&openid="+'<?php echo $openid; ?>'+"&gh_id="+'<?php echo $gh_id; ?>',
						success: function(data){
							json_data = data;
						}
					});

					if (json_data.code == 0)
					{
						var a = json_data.angle;
						var value = json_data.value;
						var name = json_data.name;
						//alert(a + ":" + name + ":" + value);
						//var a = Math.floor(Math.random() * 360);
						$(this).rotate({
							duration:5000,
							angle: 0,
							animateTo:(360*4)+a,
							easing: $.easing.easeOutSine,
							callback: function()
							{
								if (value%2 == 0)
								{
									//中奖了， 转到选号页面， 可以选择靓号了~~
									//var res = 'ok';
									var res = '恭喜您，中奖了！ 您可通过获奖名单查看中奖情况。';

									//window.location = '<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/goodnumber#number-select' ; ?>';
									window.location.reload();
								}
								else
								{
									//没中奖？？
									//var res = 'sorry';
									var res = '真可惜，就差一点点！';
									//window.location='#dialogPage1';
								}

								//alert(name + ':' + value + res );
								alert( res );
							}
						});
					}
					else
					{
						//alert(json_data.code+json_data.errmsg);
						//alert('您今天的3次抽奖机会都用完了，请明天再来。');
						//window.location = '<//?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/home' ; ?>';
						//window.location='#dialogPage2';
						alert('您3次抽奖机会都用完了哟。');
					}

				}
			}
		});


	});
</script>
 
</body>
</html>



