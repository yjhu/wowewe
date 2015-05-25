<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MOfficeCampaignDetail;


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

      <?php if ($backwards) { ?>
          <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
              <span class="icon icon-left-nav"></span>
          </a>
      <?php } ?>

      <h1 class="title">
       渠道宣传竞赛评选
      </h1>
    </header>

    <?php
      $scores = \app\models\MOfficeCampaignScore::getScoreByPicCategory($office->office_id, $model_ocpc->id); 
      $is_scorer = false;
      if ($staff->isOfficeCampaignScorer()) {
        $is_scorer = true;
        $scorer_score = \app\models\MOfficeCampaignScore::getScoreByScorerAndPicCategory($office->office_id, $staff->staff_id, $model_ocpc->id);
        $scorer = $staff->officeCampaignScorer;
        $scorer_comment = \app\models\MOfficeCampaignScore::getCommentByScorerAndPicCategory($office->office_id, $staff->staff_id, $model_ocpc->id);
       
        if ($scorer_score === false) 
          $can_score = true;
        else
          $can_score = false;
      } else {
        $can_score = false; 
      }
    ?>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <?php if ($can_score) { ?>
        <button class="btn btn-block" style="background-color:#d9d9d9"><?= $model_ocpc->name ?></button>
      
        <p>
        <span class="badge"><?= $office->title ?> </span>
        <?php if ($office->is_selfOperated) { ?>
          <span class="badge">班长：<?= $office->manager ?>&nbsp;<?= $office->mobile ?></span>
        <?php } else { ?>   
          <span class="badge">督导员：<?= $supervisor->name ?>&nbsp;<?= $supervisor->mobile ?></span>
        <?php } ?>
        </p>
      <?php } ?>

      <?php if($wx_user->openid=='oKgUduNHzUQlGRIDAghiY7ywSeWk' ||
              $wx_user->openid=='oKgUduJJFo9ocN8qO9k2N5xrKoGE' ||
              $wx_user->openid=='oKgUduHLF-HAxvHYIwmm3qjfqNf0') { ?>

        <a class="btn btn-negative" href="#edit">编辑</a>

      <?php } ?>

       <?php 
        $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_ocpc->id, 'office_id' => $office->office_id]);

        if(!empty($model_office_campaign_detail))
        {
          $urls = $model_office_campaign_detail->getImageUrls();
        }
        else
          //$url = 'http://placehold.it/200x200';
          $urls = ['../web/images/comm-icon/upload-pic-700x700.gif'];
        ?>

        <!--
       <img width=100% class="media-object pull-left" src="<//?= $url ?>">
        -->

        <div class="slider" id="mySlider">
            <div class="slide-group">
                <?php foreach ($urls as $url) { ?>
                    <div class="slide">
                        <img width=100% src="<?= $url ?>">
                    </div>
                <?php } ?>  
            </div>
        </div>
       
      <?php 
          

          if( $can_score)
          {
      ?>
        <form id="productForm">
              <!--
              <input id="myrange" type="number"  style="height:64px;width:80%;font-size:48px;color:red;font-weight:bolder;text-align:center" value=1 min="1" max="18"> 
              -->
              <center>
              <div style="vertical-align: middle;">
              
              <span id="minStr" class="badge"></span>
              <span id="minIcon" style="height:50px;font-size:48px;color:#ccc" class="icon icon-left"></span>
              &nbsp;
              <span id="myrangeStr" style="height:50px;width:50%;font-size:48px;color:red;font-weight:bolder;text-align:center">1</span>
              &nbsp;
              <input type="hidden" id="myrange" name="myrange" placeholder="评分">

              <span id="maxIcon" style="height:50px;font-size:48px;color:#ccc" class="icon icon-right"></span>
              <span id="maxStr" class="badge"></span>
              <br>
              <input type="text" id="comment" name="comment" placeholder="评语">
         
              </div>
              </center>
     
              <button class="btn btn-positive btn-block" id="submit_rank">提交评分成绩</button>
        </form>



      <?php } else { ?>
        <span>
            <ul class="table-view">
            <li class="table-view-cell table-view-divider"><?= $office->msc->marketingRegion->name.">".$office->msc->name.">".$office->title ?></li>
          <?php if ($office->is_selfOperated) { ?>
            <li class="table-view-cell table-view-divider"><?= "班长：{$office->manager} {$office->mobile}" ?></li>
          <?php } else { ?>
            <li class="table-view-cell table-view-divider"><?= "督导员：{$supervisor->name} {$supervisor->mobile}" ?></li>
          <?php } ?>
            <li class="table-view-cell table-view-divider"><?= "评选内容：{$model_ocpc->name}" ?></li>


            <li class="table-view-cell">平均得分：<span class="badge badge-primary pull-right"><?= $scores['count'] == 0 ? 0 : ($scores['count'] == 1 ? $scores['total'] : number_format($scores['total']/$scores['count'], 2)) ?></span></li>

            <li class="table-view-cell">评分人数：<span class="badge badge-primary pull-right"><?= $scores['count'] ?></span></li>
            <?php if ($is_scorer) { ?>
            <li class="table-view-cell table-view-divider"><?= $scorer->department." ".$scorer->position ?></li>
            <li class="table-view-cell table-view-divider"><?= $scorer->name." ".$scorer->mobile ?></li>
            <li class="table-view-cell">您的评分：<span class="badge badge-positive pull-right"><?= $scorer_score ?></span></li>
            <li class="table-view-cell">您的评语：<span><?= $scorer_comment ?></span></li>
            <?php } ?>
            </ul>
        </span>
      <?php } ?>
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 

      <?php         

          if( $can_score)
          {
      ?>
    <script type="text/javascript">

      $(document).ready(function(){

        var office_campaign_id = "<?= $model_office_campaign_detail->id ?>";
        var staff_id = "<?= $staff->staff_id ?>";
        var office_isSelfOperated = "<?= $office->is_selfOperated ?>";
        //var score = $("#myrange").val();

        var MIN=0;
        if(cat == 6) 
        {
          var MAX = 10;
        }
        else
        {
          var MAX = 18;
          if (!parseInt(office_isSelfOperated)) MAX = 20;
        } 

        $("#minStr").html(MIN);
        $("#maxStr").html(MAX);
        
        $("#myrangeStr").html(MAX/2);
        $("#myrange").val(MAX/2);
          
        var range = MAX/2;

        $("#maxIcon").click(function(){
            range++;
            if(range>MAX) range = MAX;
            $("#myrangeStr").html(range);
            $("#myrange").val(range);
            //alert(range);
        });

        $("#minIcon").click(function(){
            range--;
            if(range<MIN) range = MIN;
            $("#myrangeStr").html(range);
            $("#myrange").val(range);
            //alert(range);
        });

     
        $("#submit_rank").click(function(){
          //alert("office_campaign_id="+office_campaign_id+"&staff_id="+staff_id+"&score="+$('#myrange').val());
          //

            /*
            if(($('#myrange').val() < MIN) || ($('#myrange').val() > MAX))
            {
              alert("您的评分超出了评分范围，请重新输入。");
              return false;
            }
            */

            if(!confirm("现在就提交评分，确定?"))
              return false;

            $.ajax({
            url: "<?php echo Url::to(['wap/handleqdxcjspb','gh_id'=>$gh_id, 'openid'=>$openid], true) ; ?>",
            type:"GET",
            cache:false,
            //async:false,
            dataType:"json",
            data: "office_campaign_id="+office_campaign_id+"&staff_id="+staff_id+"&score="+$('#myrange').val()+"&comment="+$('#comment').val(),
            success: function(t){
                    //var json_data = eval('('+msg+')');
                    //alert("感谢您的评分。");
                    //alert(t.code)
                    location.href = "<?php echo Url::to(['qdxcjspb4', 'gh_id'=>$_GET['gh_id'], 'openid'=>$_GET['openid'], 'office_id'=>$office->office_id],true) ?>";
              },
              error: function(){
                alert('error!');
              }
          });

           return false;


        });

      });

    </script>

    <?php } ?>


    <?php
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
        $end_date =  \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();
      ?>

      <div class="bar bar-standard bar-footer-secondary">
        <a class="btn btn-block btn-primary" style="color:#fff" href="<?php echo  Url::to(['qdxcjspbpm'],true) ?>">
        <img src="../web/images/comm-icon/iconfont-paiming.png" height="16">
        排行榜
        </a>
      </div>
    
      <br>
      <br>

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          本期活动时间：<?= $start_date->format('Y-m-d'); ?> 至 <?= $end_date->format('Y-m-d'); ?>
        </a>
      </nav>   

    </div>



 <!-- edit -->
    <div id="edit" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#edit"></a>
        <h1 class="title">编辑</h1>
      </header>

      <div class="content">
        <ul class="table-view">

            <?php foreach ($urls as $url) { ?>

                <li class="table-view-cell">


                <img class="media-object pull-left" src="<?= $url ?>" width="64" height="64">
                
                <button class="btn-positive icon icon-edit">修改</button>
                &nbsp;&nbsp;
                <button class="btn-negative icon icon-close">删除</button>

            </li>
            <?php } ?>  

          </ul>
      </div>

    </div>


  </body>
</html>