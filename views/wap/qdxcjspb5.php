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
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>

    <script type="text/javascript">
         var cat = "<?= $model_ocpc->id ?>";
    </script>

  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       渠道宣传竞赛评选
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <button class="btn btn-block" style="background-color:#d9d9d9"><?= $model_ocpc->name ?></button>
        <p>
        <span class="badge"><?= $office->title ?> </span>   
        <span class="badge">督导员:<?= $supervisor->name ?>&nbsp;<?= $supervisor->mobile ?></span>
        </p>
   
       <img width=100% class="media-object pull-left" src="http://placehold.it/200x200">


      <form id="productForm">
            <!--
            <input id="myrange" type="number"  style="height:64px;width:80%;font-size:48px;color:red;font-weight:bolder;text-align:center" value=1 min="1" max="18"> 
            -->
            <center>
            <div style="vertical-align: middle;">

            <span id="minStr" class="badge"></span>
            <span style="height:50px;font-size:48px;" class="icon icon-left" onclick="sub()"></span>
            &nbsp;&nbsp;
            <span id="myrangeStr" style="height:50px;width:50%;font-size:48px;color:red;font-weight:bolder;text-align:center">1</span>
            <input type=hidden id="myrange" name="myrange">
            &nbsp;&nbsp;
            <span style="height:50px;font-size:48px;" class="icon icon-right" onclick="add()"></span>
            <span id="maxStr" class="badge"></span>

            </div>
            </center>

            <button class="btn btn-positive btn-block" id="submit_rank">提交评分成绩</button>
      </form>

    </div>

    <script type="text/javascript">
           var MIN=1;
        var MAX;
        if(cat == 6) 
        {
          MAX = 10 
        }
        else
        {
          MAX = 18;
        } 
        $("#minStr").html(MIN);
        $("#maxStr").html(MAX);
        
        $("#myrangeStr").html(MAX/2);
        $("#myrange").val(MAX/2);
          
        var range = MAX/2;

        function add()
        {
          range++;
          if(range>MAX) range = MAX;
          $("#myrangeStr").html(range);
          $("#myrange").val(range);
        }

        function sub()
        {
          range--
          if(range<MIN) range = MIN;

          $("#myrangeStr").html(range);
          $("#myrange").val(range);
        }

      $(document).ready(function(){
       // alert('ready');


        $("#submit_rank").click(function(){
         // alert("click and submit");

          $.ajax({
            url: "<?php echo Url::to(['wap/handleqdxcjspb'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: $("#productForm").serialize(),

            //data: "&currentPage="+currentPage+"&size="+size+"&cid="+cid+"&feeSum="+feeSum,
            success: function(json_data){
                    //var json_data = eval('('+msg+')');
   
                    alert("submit ok");
                    //var url = "<?php echo Url::to(['wap/jssdksample'], true); ?>";
                    //location.href = url;
              }
          });

        })

      })

    </script>
  </body>
</html>