﻿<?php
  use yii\helpers\Html;
  //use yii\widgets\ActiveForm;
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Url;

  use app\assets\JqmAsset;
  JqmAsset::register($this);

  $this->title = '2048';
  $assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/2048/assets';
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

<style type="text/CSS">
  .ui-content {
      padding: 0.5em !important;
      margin-top: 1em !important;
  }

  .score-container, .best-container {
    height: 30px !important;
  }

  .sbgshow{display:block;position:fixed;top:0;left:0;width:100%;height:100%;text-align:center;color:#fff;font-size:30px;line-height:1.7em;background:rgba(0,0,0,0.85);}
  .sbgshow .arron{ position:absolute;top:8px;right:8px;width:100px;height:100px;background:url(http://baby.ci123.com/yunqi/m/weixin/images/arron.png) no-repeat; background-size:100px 100px;}
  .sbgshow p{padding-top:78px;}
  .sbg{display:none;position:fixed;top:0;left:0;width:100%;height:100%;text-align:center;color:#fff;font-size:26px;line-height:1.7em;background:rgba(0,0,0,0.85);}
  .sbg .arron{ position:absolute;top:8px;right:8px;width:100px;height:100px;background:url(http://baby.ci123.com/yunqi/m/weixin/images/arron.png) no-repeat; background-size:100px 100px;}
  .sbg p{padding-top:78px;}
  .msgstyle {color:#F7EA45;}/*yellow*/
</style>
  
<link href="<?php echo "$assetsPath/main.css?"; ?>" rel="stylesheet" type="text/css">

<script>
  function share(){
      document.getElementById("sbg").className="sbgshow";
      window.setTimeout(hiddenMe, 9000);
  }

  function hiddenMe(){
      document.getElementById("sbg").className="sbg";
  }
</script>

<?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div data-role="page" id="page1" data-theme="c">
<!--
<div data-role="header" data-position="fixed">
  <h1>游戏2048</h1>
</div>
-->

<?php echo $this->render('header1', ['menuId'=>'menu1','title' => '游戏2048']); ?>

<div data-role="popup" id="popupDialog" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:400px;">
    <div data-role="header" data-theme="c">
    <h1>Game Over</h1>
    </div>
    <div role="main" class="ui-content">
      <h3 class="ui-title">你的游戏排名时 第一名！</h3>
      <p>本次成绩: 666</p>
      <p>最好记录: 888</p>

    <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确定</a>
       
    </div>
</div>

  <div data-role="content">

    <div class="heading">
      <!--
      <h1 class="title">2048</h1>
      -->
      <div class="scores-container">
              <link href="assets/main.css" rel="stylesheet" type="text/css"/>
          <img src="<?php echo "$assetsPath/10010-logo.png"; ?>">
        <div class="score-container">8<div class="score-addition">+8</div></div>
        <div class="best-container">8</div>
      </div>
    </div>

    <div class="above-game">
      <p class="game-intro">
      全球最火益智游戏，今天你<strong>2048</strong>了吗？
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

  <div class="sharing">
  </div>

        
  <div id="sbg" class="sbg">
    <div class="arron"></div>
    <p id="msg" class="msgstyle">请点击右上角<br />点击【分享到朋友圈】<br /></p>
  </div>

  </div>


  <div data-role="footer" data-position="fixed">
    <div data-role="navbar">
      <ul>
        <li><a href="#myscore" data-icon="heart">我的成绩</a></li>
        <li><a href="#top10" data-icon="bullets">英雄榜</a></li>
        <li><a href="#help" data-icon="info">帮助</a></li>
      </ul>
      </div>
  </div>
  <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$ ]); ?>
</div>


<div data-role="dialog" id="help" data-theme="c">
  <div data-role="header"><h1>帮助</h1></div>
  <div role="main" class="ui-content">
      <p style="color:#007529">
      <strong class="important">[玩法]</strong> 
      <br>
      用手指上下左右滑动，将两个相同的数字合成一个，如2+2 合成4， 4+4 合成8... 直到1024+1024 合出2048.
    </p>
  </div>
</div>

<div data-role="dialog" id="myscore" data-theme="c">

  <div data-role="header"><h1>我的成绩</h1></div>
  <div role="main" class="ui-content">
    <ul data-role="listview" data-count-theme="c" data-inset="true">

      <li>
        <!--
        <img src="<//?php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
        -->
        <h2>Jack</h2>
        <p>1688</p>
      </li>

    </ul>
  </div>
</div>

<!--
<div data-role="dialog" id="top10">
  <?//php $rows = MStaff::getStaffScoreTop($user->gh_id, 10); ?>
  <div data-role="header"><h1>英雄榜</h1></div>
  <div role="main" class="ui-content">
    <ul data-role="listview" data-count-theme="b" data-inset="true">
      <?//php foreach($rows as $row) { ?>
      <li>
        <img src="<?//php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
        <h2><?//= $row['name'] ?></h2>
        <p><?//= $row['title'] ?></p>
        <span class="ui-li-count"><?//= $row['score'] ?></span>
      </li>
      <?//php } ?>
    </ul>
  </div>
</div>
-->



<?php
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');

	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/g2048:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/game_2048.png", true);
	$title = '游戏2048';
	$desc = '游戏2048, 全球最火益智游戏. 今天你2048了吗?';
?>

<script>

var gh_id = '<?php echo $gh_id; ?>';
var openid = '<?php echo $openid; ?>';

var dataForWeixin={
	appId:"<?php echo $appid; ?>",
	MsgImg:"<?php echo $myImg; ?>",
	TLImg:"<?php echo $myImg; ?>",
	url:"<?php echo $url; ?>",
	title:"<?php echo $title; ?>",
	desc:"<?php echo $desc; ?>",
	fakeid:"",
	prepare:function(argv) {	},
	callback:function(res){	 }
};

function showScore(msg)
{
		var i,j;
		var bigNum = 0;
		var myScore;
		var myGameState;	
		var storage = window.localStorage;
		myScore = storage.getItem("bestScore");
		myGameState = storage.getItem("gameState");
		
		//create JSON Object
		var myGameStateObj = eval('('+myGameState+')');
		
		for(i=0;i<4;i++)
		{
			for(j=0;j<4;j++)
			{
				if((myGameStateObj.grid.cells == null) || (myGameStateObj.grid.cells[i][j] == null ))
					continue;
					
        if(myGameStateObj.grid.cells == null )
					continue; 
				if((myGameStateObj.grid.cells[i][j].value) > bigNum)
					bigNum = myGameStateObj.grid.cells[i][j].value;
			}
		}

    //alert("bigNum is:"+bigNum);		
    //alert("myScore:" + myScore);
    //alert("myBestScore:" + myGameStateObj.score);
    //alert("可点击...微信菜单\n 深度分享到朋友圈或转发给朋友  ;-)");
    //alert('我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n你能有我牛X吗？啊哈哈哈...");
    //dataForWeixin.desc = '我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n你能有我牛X吗？啊哈哈哈...";
     
    //submit data to server
    $.ajax({
      type: "get",
      async: true,
      cache:false,
      url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/ajaxdata' ; ?>"+"&cat=g2048Save"+"&gh_id="+gh_id+"&openid="+openid+"&bigNum="+bigNum+"&score="+myGameStateObj.score+"&best="+myScore,
      success: function(json_data){
        // if(msg=="ok")
        if(msg != 0)
        {
          //alert("process ok");
          $scoreRanking = msg; 
        }
        else
        {
          //alert("process NOT ok");
          $scoreRanking = 0; 
        }

        if($scoreRanking == 0) /* not subscribed*/
        {
          dataForWeixin.desc = '我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n你能有我牛X吗？啊哈哈哈...";
          $("#result").html('<h1>Game over!</h1><br>我的盘面最大数是<b>'+bigNum+'</b><br>总分是<b>'+myGameStateObj.score+"</b><br>最好记录是<b>"+myScore+"<br><br>你能超过我吗？啊哈哈哈...");
        }
        else
        {
          dataForWeixin.desc = '我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n游戏排名是"+$scoreRanking +"名";
          $("#result").html('<h1>Game over!</h1><br>我的盘面最大数是<b>'+bigNum+'</b><br>总分是<b>'+myGameStateObj.score+"</b><br>最好记录是<b>"+myScore+"</b><br>在所有襄阳联通关注号中游戏排名是<b>"+$scoreRanking+"</b><br><br>你能超过我吗？啊哈哈哈...");
        }

        $("#popupDialog").popup("open");

      }
    });/*end ajax*/
               
    //share(); //pop a mask div 
}
</script>
  
<script src="<?php echo "$assetsPath/bind_polyfill.js"; ?> "></script>
<script src="<?php echo "$assetsPath/classlist_polyfill.js";?> "></script>
<script src="<?php echo "$assetsPath/animframe_polyfill.js"; ?> "></script>
<script src="<?php echo "$assetsPath/keyboard_input_manager.js"; ?> " ></script>
<script src="<?php echo "$assetsPath/html_actuator.js?v=11"; ?> "></script>
<script src="<?php echo "$assetsPath/grid.js"; ?> "></script>
<script src="<?php echo "$assetsPath/tile.js"; ?> "></script>
<script src="<?php echo "$assetsPath/local_storage_manager.js";?>"></script>
<script src="<?php echo "$assetsPath/game_manager.js"; ?>"></script>
<script src="<?php echo "$assetsPath/application.js"; ?>"></script>


<!--
<?//php echo Html::img(Url::to('images/wx-tuiguang2.jpg'), ['class'=>'img-responsive']); ?>
-->


<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>

<?php
/*
<script src="<?php echo Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v=0.1'; ?> "></script>


*/