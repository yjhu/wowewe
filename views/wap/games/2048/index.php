<?php
  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Url;
  use app\models\U;
  use app\models\MG2048;

  $this->title = '2048';
  $assetsPath = Yii::$app->getRequest()->baseUrl.'/../views/wap/games/2048/assets';
?>

<style type="text/CSS">
  .ui-content {
      padding: 0.5em !important;
      margin-top: 1em !important;
  }
  .game-container {
      margin-left: 1.2em !important;
  }
  .score-container, .best-container {
    height: 30px !important;
  }

  .unicom-red{
    color:#d9080d;
  }

</style>
  
<link href="<?php echo "$assetsPath/main.css?"; ?>" rel="stylesheet" type="text/css">


<div data-role="page" id="page1" data-theme="c">
<!--
<div data-role="header" data-position="fixed">
  <h1>游戏2048</h1>
</div>
-->
<?php echo $this->render('/wap/header1', ['menuId'=>'menu1','title' => '游戏2048']); ?>

<div data-role="popup" id="popupDialog" data-overlay-theme="c" data-theme="c" data-dismissible="false" style="max-width:450px">
    <div data-role="header" data-theme="c">
    <h1>Game over</h1>
    </div>
    <div id="gameover_content" role="main" class="ui-content">
      <h3 class="ui-title">你的游戏排名时 第一名！</h3>
      <p>本次成绩: 666</p>
      <p>最好记录: 888</p>

      <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">确定</a>
    </div>
</div>

  <div data-role="content">

    <div class="heading">

      <h1 class="title">2048</h1>

      <div class="scores-container">
          
          <img src="<?php echo "$assetsPath/10010-logo.png"; ?>">
        <div class="score-container">8<div class="score-addition">+8</div></div>
        <div class="best-container">8</div>
      </div>
    </div>

    <div class="above-game">
      <p class="game-intro">全球最火益智游戏，今天你<strong>2048</strong>了吗？</p>
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
  <?php echo $this->render('/wap/menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid ]); ?>
</div>


<div data-role="dialog" id="help" data-theme="c">
  <div data-role="header"><h1>帮助</h1></div>
  <div role="main" class="ui-content">
      <p style="color:#007529">
      <strong class="important">玩法</strong> 
      <br>
      用手指上下左右滑动, 将相邻的两个相同的数字合成一个. 如2+2合成4, 4+4合成8... 直到1024+1024合出2048.

      <br><br>
      <strong class="important">查看排名</strong> 
      <br>
      通过底部工具栏, 点击我的成绩可查看我的得分和最好记录; 点击英雄榜可查看所有玩家周/月/总排名.

      <br><br>
      <strong class="important">分享与收藏</strong> 
      <br>
      通过微信... 可以把游戏或你的游戏成绩发送给朋友/分享到朋友圈和收藏.

    </p>
  </div>
</div>


<div data-role="dialog" id="myscore">
  <?php $rows = MG2048::getMyScoreTop($gh_id, $openid, 10);?>
  <div data-role="header"><h1>我的成绩</h1></div>
  <div role="main" class="ui-content">
    <ul data-role="listview" data-count-theme="c" data-inset="true" data-divider-theme="c">

      <?php foreach($rows as $row) { ?>
      <li>
        <p>成绩:<span><?= $row['score'] ?></span></p>
        <p>时间:<span><?= $row['create_time'] ?></span></p>
        <p>当周排名:<span><?= $row['position_week'] ?></span></p>
        <p>当月排名:<span><?= $row['position_month'] ?></span></p>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<div data-role="dialog" id="top10">
  <?php $rowsWeek = MG2048::getScoreTop($gh_id,  'week', 10); ?>
  <?php $rowsMonth = MG2048::getScoreTop($gh_id,  'month', 10); ?>
  <?php $rowsAll = MG2048::getScoreTop($gh_id,  '', 10); ?>
  <div data-role="header"><h1>英雄榜</h1></div>
  <div role="main" class="ui-content">
    <ul data-role="listview" data-count-theme="c" data-inset="true" data-divider-theme="c">
     <li data-role="list-divider">周排名</li>
      <?php foreach($rowsWeek as $row) { ?>
      <li>
        <img style="width:64px" src="<?php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
        <h2><?= $row['nickname'] ?></h2>
        
        <span class="ui-li-count"><?= $row['max_score'] ?></span>
      </li>
      <?php } ?>

      <li data-role="list-divider">月排名</li>
      <?php foreach($rowsMonth as $row) { ?>
      <li>
        <img style="width:64px" src="<?php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
        <h2><?= $row['nickname'] ?></h2>
        
        <span class="ui-li-count"><?= $row['max_score'] ?></span>
      </li>
      <?php } ?>
  
      <li data-role="list-divider">总排名</li>
      <?php foreach($rowsAll as $row) { ?>
      <li>
        <img style="width:64px" src="<?php echo U::getUserHeadimgurl($row['headimgurl'], 64);  ?> ">
        <h2><?= $row['nickname'] ?></h2>
        
        <span class="ui-li-count"><?= $row['max_score'] ?></span>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>


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

    //submit data to server
    $.ajax({
      type: "get",
      type:"GET",
      cache:false,
      dataType:'json',
      url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wap/ajaxdata' ; ?>"+"&cat=g2048Save"+"&gh_id="+gh_id+"&openid="+openid+"&bigNum="+bigNum+"&score="+myGameStateObj.score+"&best="+myScore,
      beforeSend: function(json_data){
        //ShowLoading();
        $.mobile.loading( 'show', {
          text: '歇会儿, 请稍后...',
          textVisible: true,
          //theme: theme,
          textonly: false,
          html: ''
        });
      },
      success: function(json_data){

        if(json_data.isSubcribed == 0) /* not subscribed*/
        {
          dataForWeixin.desc = '我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n你能有我牛X吗？啊哈哈哈...";
          $("#gameover_content").html('<h1 class=unicom-red>Game over!</h1>盘面最大数是<b>'+bigNum+'</b><br>总分<b>'+myGameStateObj.score+"</b><br>最好记录<b>"+myScore+"<br><br>你能超过我吗？啊哈哈哈...<p><a href='#' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-rel='back'>知道了</a></p>");
        }
        else
        {
          dataForWeixin.desc = '我的盘面最大数是'+bigNum+'\n总分是'+myGameStateObj.score+"\n最好记录是"+myScore+"\n游戏排名是"+json_data.position +"名";
          $("#gameover_content").html('<h1 class=unicom-red>Game over!</h1>盘面最大数是<b>'+bigNum+'</b><br>总分<b>'+myGameStateObj.score+"</b><br>最好记录<b>"+myScore+"</b><br>在所有襄阳联通关注号中游戏排名<b class=unicom-red>"+json_data.position+"</b><br>你能超过我吗？啊哈哈哈...<p><a href='#' class='ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b' data-rel='back'>知道了</a></p>");
        }


        //$("#list_common_tbody").append(text).trigger('create');

        $("#popupDialog").popup("open");

      },
      complete: function(json_data){
        //HideLoading();
        $.mobile.loading( "hide" );
      }
    });/*end ajax*/
               
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


<?php
/*
<script src="<?php echo Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v=0.1'; ?> "></script>


*/