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
       渠道宣传竞赛评选
      </h1>
    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
      <?= $msc->marketingRegion->name ?> > <?= $msc->name ?> > 门店选择
      </p>

        <ul class="table-view">

        <?php 
        foreach($models_office as $model_office) {  
          if (!empty($model_office->supervisor)) {
        ?>

            <li class="table-view-cell media">
            <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb4','office_id'=>$model_office->office_id],true) ?>">
            <!--
              <img class="media-object pull-left" src="http://placehold.it/80x80">
            -->
            <div class="pull-right">
              <?php
                $score = \app\models\MOfficeCampaignScore::getScore($model_office->office_id); 
                if ($score) {
                  $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]); 
                  $staff = $wx_user->staff;
                  if ($staff->isOfficeCampaignScorer()) {
                    $myscore = \app\models\MOfficeCampaignScore::getScoreByScorer($model_office->office_id, $staff->staff_id);
                    if ($myscore === false) {
              ?>
                    <span class="icon icon-info" style="color:red"></span>
                    <?php }} ?>
                <span class="badge badge-positive"><?= printf("%.1F", $score); ?></span>
              <?php 
                } else { 
                  if (\app\models\MOfficeCampaignDetail::getDetailReadyStatus($model_office->office_id) != \app\models\MOfficeCampaignDetail::DETAIL_COMPLETE) {
              ?>
                <span class="badge badge-negative"><?= "督导员未提交资料"; ?></span>
              <?php } else { ?>
                <span class="badge badge-negative"><?= "未评分"; ?></span>    
              <?php }} ?> 
             </div>
              <div class="media-body">
                <?= $model_office->title ?>
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
        <?php }} ?>
        </ul>
             &nbsp;<br>&nbsp;<br>&nbsp;<br>  

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