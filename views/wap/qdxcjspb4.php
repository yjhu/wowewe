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
           <?= $office->msc->marketingRegion->name ?>><?= $office->msc->name ?>><?= $office->title ?>
        </p>
      <ul class="table-view">
        <?php if ((!empty($office->supervisor)) || ($office->is_selfOperated)) { 
          $officeScore = \app\models\MOfficeCampaignScore::getScore($office->office_id);
          if ($office->is_selfOperated) {
        ?>
          <li class="table-view-cell table-view-divider">班长：<?= $office->manager." ".$office->mobile ?></li>
        <?php } else { ?>
          <li class="table-view-cell table-view-divider">督导员：<?= $office->supervisor->name." ".$office->supervisor->mobile ?></li>
        <?php } ?>
        <li class="table-view-cell table-view-divider">门店当前总分：<span class="badge badge-positive pull-left"><?= $officeScore?printf("%.1F",floatval($officeScore)):'未评分' ?></span></li>

        <?php } ?>
          <?php 
            foreach($models_categories as $model_category) {  
              if ((!$office->is_selfOperated) && ($model_category->sort_order == 6)) continue;
          ?>
             
                <li class="table-view-cell media">

                    <?php 
                        // $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_category->id, 'office_id' => $office->office_id]);
                        $model_office_campaign_detail = MOfficeCampaignDetail::getDetailByOfficeAndPicCategory($office->office_id, $model_category->id);
                        if(!empty($model_office_campaign_detail))
                        {
                          $url = $model_office_campaign_detail->getImageUrl();
                        }
                        else
                        {
                          $url = '../web/images/comm-icon/upload-pic-64x64.png';
                        }
                    ?>

                  <?php if(!empty($model_office_campaign_detail)) {?>
                    <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb5', 'gh_id'=>$gh_id, 'openid'=>$openid, 'office_id'=>$office->office_id, 'model_category_id'=>$model_category->id],true) ?>">
                    <!--
                    <span class="badge">1</span>
                    <span class="badge badge-primary">2</span>
                    <span class="badge badge-positive">3</span>
                    <span class="badge badge-negative">4</span>
                    -->
                    <div class="pull-right">
                      <?php
                        $score = \app\models\MOfficeCampaignScore::getScoreByPicCategory($office->office_id, $model_category->id); 
                        if ($score['count'] != 0) {
                          $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]); 
                          $staff = $wx_user->staff;
                          if ($staff->isOfficeCampaignScorer()) {
                            $myscore = \app\models\MOfficeCampaignScore::getScoreByScorerAndPicCategory($office->office_id, $staff->staff_id, $model_category->id);
                            if ($myscore === false) {
                      ?>
                              <span class="icon icon-info" style="color:red"></span>
                            <?php }}?>
                        <span class="badge badge-positive"><?= $score['count'] == 1 ? $score['total'] : printf("%.1F", $score['total']/$score['count']); ?>分</span>
                      <?php } else { ?>
                        <span class="badge badge-negative"><?= "未评分"; ?></span>    
                      <?php } ?> 
                    </div>

                  <?php } else {?>    
                       <span class="badge badge-negative">未提交资料</span>
                  <?php } ?>
                    <img class="media-object pull-left" src="<?= $url ?>" width="64" height="64">
                    
                    <div class="media-body">
                      <?= $model_category->name ?>
                      <!--
                      <p>...</p>
                      -->

                    </div>

                  <?php if(!empty($model_office_campaign_detail)) { ?>
                    </a>
                  <?php } ?>


                </li>
          <?php } ?>

        </ul>
      
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 
        
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
      
  </body>
</html>