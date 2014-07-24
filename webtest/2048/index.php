<?php
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

//$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');

//$this->title = '靓号运程';
//$this->params['breadcrumbs'][] = $this->title;
?>

<!DOCTYPE html>
<!-- saved from url=(0038)http://gabrielecirulli.github.io/2048/ -->
<html lang="en" manifest="cache.appcache"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>2048</title>

  <link href="./2048_files/main.css" rel="stylesheet" type="text/css">

  <!--
  <link rel="shortcut icon" href="http://gabrielecirulli.github.io/2048/favicon.ico">
 
  <link rel="apple-touch-icon" href="http://gabrielecirulli.github.io/2048/meta/apple-touch-icon.png">
  -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta name="format-detection" content="telephone=no">

  <meta name="apple-itunes-app" content="app-id=868076805">
 <!--
  <meta property="og:title" content="2048 game">
  <meta property="og:site_name" content="2048 game">
 <link href="2048_files/main.css" rel="stylesheet" type="text/css"/>
 <link href="2048_files/main.css" rel="stylesheet" type="text/css"/>
  <meta property="og:description" content="Join the numbers and get to the 2048 tile! Careful: this game is extremely addictive!">
  <meta property="og:image" content="http://gabrielecirulli.github.io/2048/meta/og_image.png">
  -->
 
</head>
<body>
  <div class="container">
    <div class="heading">
      <h1 class="title">2048</h1>
      <div class="scores-container">
	
        <img src="./2048_files/10010-logo.png">
        <div class="score-container">8<div class="score-addition">+8</div></div>
        <div class="best-container">8</div>
      </div>
    </div>

    <div class="above-game">
      <p class="game-intro">
	  <!--
	  Join the numbers and get to the <strong>2048 tile!</strong>
	  -->
	  全球最火益智游戏，今天你<strong>2048</strong>了吗？
	  <!--
	  合并数字直到<strong>2048！</strong>
	  -->
	  </p>
      <a class="restart-button">新游戏</a>
    </div>

    

    <div class="game-container">
      <div class="game-message">
        <p></p>
        <div class="lower">
	        <a class="keep-playing-button">继续玩</a>
          <a class="retry-button">重新开始</a>
	
          <div class="score-sharing"></div>
	
		  
		  <!--
          <div class="mailing-list">
            <!\\-- MailChimp Signup Form --\\>
            <form action="http://gabrielecirulli.us8.list-manage.com/subscribe/post?u=991201206817cfb4e4247ed6c&id=7928ea817b" method="post" name="mc-embedded-subscribe-form" class="mailing-list-form" target="_blank">
              <strong>Get email updates from Gabriele</strong>

              <input type="email" value="" name="EMAIL" class="mailing-list-email-field" placeholder="Your email address" spellcheck="false">

              <!\\-- real people should not fill this in and expect good things - do not remove this or risk form bot signups--\\>
              <div style="position: absolute; left: -9999px;">
                <input type="text" name="b_991201206817cfb4e4247ed6c_7928ea817b" value="">
              </div>

              <input type="submit" value="Go" name="subscribe" class="mailing-list-subscribe-button">
            </form>
          </div>
		  -->
		  
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
        <div class="grid-row">
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
          <div class="grid-cell"></div>
        </div>
      </div>

      <div class="tile-container"><div class="tile tile-2 tile-position-1-4 tile-new"><div class="tile-inner">2</div></div><div class="tile tile-4 tile-position-3-4 tile-new"><div class="tile-inner">4</div></div><div class="tile tile-2 tile-position-4-1 tile-new"><div class="tile-inner">2</div></div><div class="tile tile-4 tile-position-4-4 tile-new"><div class="tile-inner">4</div></div></div>
    </div> 
	<br>
    <p style="color:#007529">
      <strong class="important">[玩法]</strong> 

	  <br>
	  用手指上下左右滑动，将两个相同的数字合成一个，如2+2 合成4， 4+4 合成8... 直到1024+1024 合出2048.
    </p>
                      <hr>

	<div class="sharing">
            <!--
			<script async="" src="./2048_files/analytics.js"></script>
			-->
			<!--
			<script id="twitter-wjs" src="http://platform.twitter.com/widgets.js"></script>
			
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			-->
    </div>
  </div>
  <script src="../../web/js/wechat.js"></script>
  
<?php 
//$appid = Yii::$app->wx->gh['appid'];
$appid = 'wx1b122a21f985ea18';
//$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/luck:'.Yii::$app->wx->getGhid());
$url = 'http://www.hoyatech.net/wx/webtest/2048/index.php';
//$myImg = Url::to('images/game_2048.jpg');
$myImg = 'http://www.hoyatech.net/wx/webtest/2048/2048_files/game_2048.png';
$title = '游戏2048';
$desc = '游戏2048, 全球最火益智游戏. 今天你2048了吗?';

?>

<script>
var dataForWeixin={
	appId:"<?php echo $appid; ?>",
	MsgImg:"<?php echo $myImg; ?>",
	TLImg:"<?php echo $myImg; ?>",
	url:"<?php echo $url; ?>",
	title:"<?php echo $title; ?>",
	desc:"<?php echo $desc; ?>",
	fakeid:"",
	prepare:function(argv)
	{
            
	},

	callback:function(res)
	{
		//发送给好友或应用
		if (res.err_msg=='send_app_msg:confirm') {
			//todo:func1();
			///alert(res.err_desc);
		}
		if (res.err_msg=='send_app_msg:cancel') {
		}
		//分享到朋友圈
		if (res.err_msg=='share_timeline:confirm') {
		}
		if (res.err_msg=='share_timeline:cancel') {
		}
		//分享到微博
		if (res.err_msg=='share_weibo:confirm') {
		}
		if (res.err_msg=='share_weibo:cancel') {
		}
		//收藏或分享到应用
		if (res.err_msg=='send_app_msg:ok') {
		}   	
	}
};
</script>
  
  <script src="./2048_files/bind_polyfill.js"></script>
  <script src="./2048_files/classlist_polyfill.js"></script>
  <script src="./2048_files/animframe_polyfill.js"></script>
  <script src="./2048_files/keyboard_input_manager.js"></script>
  <script src="./2048_files/html_actuator.js"></script>
  <script src="./2048_files/grid.js"></script>
  <script src="./2048_files/tile.js"></script>
  <script src="./2048_files/local_storage_manager.js"></script>
  <script src="./2048_files/game_manager.js"></script>
  <script src="./2048_files/application.js"></script>
  
  
  <script>
  /*
    (function(i,s,o,g,r,a,m){i["GoogleAnalyticsObject"]=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,"script","//www.google-analytics.com/analytics.js","ga");

    ga("create", "UA-42620757-2", "gabrielecirulli.github.io");
    ga("send", "pageview");
	*/
</script>



<?php 

        $subscribed = true;
        if (!$subscribed)
        //echo Html::img(Url::to('images/wx-tuiguang1.png'), ['class'=>'img-responsive']); 
                            echo "<img scr=\"http://www.hoyatech.net/wx/web/images/wx-tuiguang1.png\" width=\"100%\">";
?>
</body>
</html>