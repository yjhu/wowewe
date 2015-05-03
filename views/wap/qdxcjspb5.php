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
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       渠道宣传竞赛评选
      </h1>
    </header>

    <?php
      $scores = \app\models\MOfficeCampaignScore::getOfficeScoreByPicCategory($office->office_id, $model_ocpc->id); 
      $is_scorer = false;
      if ($staff->isOfficeCampaignScorer()) {
        $is_scorer = true;
        $scorer_score = \app\models\MOfficeCampaignScore::getOfficeScoreByStaffAndPicCategory($office->office_id, $staff->staff_id, $model_ocpc->id);
        $scorer = $staff->officeCampaignScorer;
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
        <span class="badge">督导员:<?= $supervisor->name ?>&nbsp;<?= $supervisor->mobile ?></span>
        </p>
      <?php } ?>

       <?php 
        $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_ocpc->id, 'office_id' => $office->office_id]);

        if(!empty($model_office_campaign_detail))
        {
          $url = $model_office_campaign_detail->getImageUrl();
        }
        else
          $url = 'http://placehold.it/200x200';
        ?>

       <img width=100% class="media-object pull-left" src="<?= $url ?>">

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
              <span id="minIcon" style="height:50px;font-size:48px;color:#ccc" class="icon icon-left" onclick="sub()"></span>
              &nbsp;
              <span id="myrangeStr" style="height:50px;width:50%;font-size:48px;color:red;font-weight:bolder;text-align:center">1</span>
              <input type=hidden id="myrange" name="myrange">
              &nbsp;
              <span id="maxIcon" style="height:50px;font-size:48px;color:#ccc" class="icon icon-right" onclick="add()"></span>
              <span id="maxStr" class="badge"></span>

              </div>
              </center>
              &nbsp;<br>
              <button class="btn btn-positive btn-block" id="submit_rank">提交评分成绩</button>
        </form>



      <?php } else { ?>
        <span>
            <ul class="table-view">
            <li class="table-view-cell table-view-divider"><?= $office->msc->marketingRegion->name.">".$office->msc->name.">".$office->title ?></li>
            <li class="table-view-cell table-view-divider"><?= "督导员：{$supervisor->name} {$supervisor->mobile}" ?></li>
            <li class="table-view-cell table-view-divider"><?= "评选内容：{$model_ocpc->name}" ?></li>
            <li class="table-view-cell">平均得分：<span class="badge badge-primary pull-right"><?= printf("%.1f", $scores['total']/$scores['count']) ?></span></li>
            <li class="table-view-cell">评分人数：<span class="badge badge-primary pull-right"><?= $scores['count'] ?></span></li>
            <?php if ($is_scorer) { ?>
            <li class="table-view-cell table-view-divider"><?= $scorer->department." ".$scorer->position ?></li>
            <li class="table-view-cell table-view-divider"><?= $scorer->name." ".$scorer->mobile ?></li>
            <li class="table-view-cell">您的评分：<span class="badge badge-positive pull-right"><?= $scorer_score ?></span></li>
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
        
        var office_campaign_id = "<?= $model_office_campaign_detail->id ?>";
        var staff_id = "<?= $staff->staff_id ?>";

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

        $("#submit_rank").click(function(){
         // alert("click and submit");

          score = $("#myrange").val();
          //alert("office_campaign_id="+office_campaign_id+"&staff_id="+staff_id+"&score="+score);

          $.ajax({
            url: "<?php echo Url::to(['wap/handleqdxcjspb'], true) ; ?>",
            type:"GET",
            cache:false,
            dataType:'json',
            data: "office_campaign_id="+office_campaign_id+"&staff_id="+staff_id+"&score="+score,
            success: function(json_data){
                    //var json_data = eval('('+msg+')');
                    //alert("submit ok");
                    var url = "<?php echo Url::to(['wap/qdxcjspb4', 'office_id'=>$office->office_id], true); ?>";
                    location.href = url;
              }
          });

        })

      })

    </script>
          <?php } ?>



    <?php
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
        $end_date =  \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();
      ?>

      <div class="bar bar-standard bar-footer-secondary">
        <a class="btn btn-block btn-primary" style="color:#fff" href="<?php echo  Url::to(['qdxcjspbpm'],true) ?>">排行榜</a>
      </div>
    
      <br>
      <br>

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          本期活动时间：<?= $start_date->format('Y-m-d'); ?> 至 <?= $end_date->format('Y-m-d'); ?>
        </a>
      </nav>   

    </div>

  </body>
</html>