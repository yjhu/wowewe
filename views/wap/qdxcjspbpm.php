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
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="javascript:history.back();"></a>
      <h1 class="title">
       <img src="../web/images/comm-icon/iconfont-paiming-blue.png">&nbsp;渠道宣传竞赛评选排行榜
      </h1>
    </header>

    <?php
      $ranking = \app\models\MOfficeCampaignScore::getScoreRanking();
      $ranking_2 = \app\models\MOfficeCampaignScore::getScoreRanking(1); 
    ?>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

        <div class="segmented-control">
          <a class="control-item active" href="#item1mobile">
           自营厅
          </a>
          <a class="control-item" href="#item2mobile">
           合作厅
          </a>
        </div>
        <div class="card">
          <span id="item1mobile" class="control-content active">
              <ul class="table-view">
              <?php 
                if (count($ranking_2) == 0) {
              ?>
                <li class="table-view-cell media">
                  <div class="pull-right"></div>
                  <div class="media-body">本期活动暂无排名</div>
                </li>
              <?php 
                } else {
                  $rank = 0;
                  foreach ($ranking_2 as $rank_item) {
                    $rank++;
                    $office = \app\models\MOffice::findOne(['office_id' => $rank_item['office_id']]);
              ?>
                    <li class="table-view-cell media">
                      <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb4','office_id'=>$rank_item['office_id']],true) ?>">
                        <div class="pull-right">
                          <span class="badge badge-primary"><?= printf("%.1f", $rank_item['score']); ?>分</span>
                        </div>
                        <div class="media-body">
                          <?= $rank;?>&nbsp;&nbsp;<?= $office->title; ?>
                        </div>
                      </a>
                    </li>
              <?php 
                  }
                }
              ?>
              </ul>

          </span>


          <span id="item2mobile" class="control-content">
              <ul class="table-view">
              <?php 
                if (count($ranking) == 0) {
              ?>
                <li class="table-view-cell media">
                  <div class="pull-right"></div>
                  <div class="media-body">本期活动暂无排名</div>
                </li>
              <?php 
                } else {
                  $rank = 0;
                  foreach ($ranking as $rank_item) {
                    $rank++;
                    $office = \app\models\MOffice::findOne(['office_id' => $rank_item['office_id']]);
              ?>
                    <li class="table-view-cell media">
                      <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb4','office_id'=>$rank_item['office_id']],true) ?>">
                        <div class="pull-right">
                          <span class="badge badge-primary"><?= printf("%.1f", $rank_item['score']); ?>分</span>
                        </div>
                        <div class="media-body">
                          <?= $rank;?>&nbsp;&nbsp;<?= $office->title; ?>
                        </div>
                      </a>
                    </li>
              <?php 
                  }
                }
              ?>
              </ul>
          </span>
        </div>

        &nbsp;<br>&nbsp;<br>&nbsp;<br>  

    </div>
  <?php
    $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
    $end_date =  \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();
  ?>

 
  <nav class="bar bar-tab">
    <a class="tab-item" href="#">
      本期活动时间：<?= $start_date->format('Y-m-d'); ?> 至 <?= $end_date->format('Y-m-d'); ?>
    </a>
  </nav> 
      
      
  </body>
</html>