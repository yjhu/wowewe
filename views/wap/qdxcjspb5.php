<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
?>
    


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>襄阳联通</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">

    <style type="text/css">
    #show{
      color: red;
      font-size: 24pt;
      font-weight: bolder;
    }
    </style>
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
  
      <h1 class="title">
       渠道宣传竞赛评选
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p>
        <?= $model_ocpc->name ?>
      </p>
       <img width=100% class="media-object pull-left" src="http://placehold.it/240x240">

       <br>
        &nbsp;
       <br>


      <form>
            <div style="float:left">
                <input id="myrange" type="range"  style="height:20px;width:280px;" value=1 min="1" max="18" onchange="change()"> 
                &nbsp;
                <span id="show">1</span>
            </div>

              &nbsp;<br><br>
              <button class="btn btn-positive btn-block" id="submit_rank">提交评分成绩</button>
      </form>

    </div>
      <script type="text/javascript"> 
        function change(){ 
          var num=document.getElementById("myrange"); 
          var show=document.getElementById("show"); 
          show.innerHTML=num.value; 
        } 
      </script>
      
  </body>
</html>