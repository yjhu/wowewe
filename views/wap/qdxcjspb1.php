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
      <a class="icon icon-info pull-right" href="#myModalexample" class="btn"></a>
      <h1 class="title">
       渠道宣传竞赛评选
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
      区县选择
      </p>

        <ul class="table-view">

        <?php foreach($models_mr as $model_mr) {  ?>

            <li class="table-view-cell media">
            <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb2','mr_id'=>$model_mr->id],true) ?>">
            <!--
              <img class="media-object pull-left" src="http://placehold.it/80x80">
            -->
             <div class="pull-right">
              <?php
                $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]); 
                $staff = $wx_user->staff;
                if ($staff->isOfficeCampaignScorer()) {
                  $myScoredCount = $model_mr->getScoredOfficeCountByScorer($staff->staff_id);
                  $detailedCount = $model_mr->getDetailedOfficeCount();
                  if ($myScoredCount < $detailedCount) {
              ?>
                <span class="badge badge-negative"><?= $detailedCount - $myScoredCount ?></span>
              <?php }} ?>
              <span class="badge badge-positive"><?= $model_mr->getScoredOfficeCount(); ?></span>
              <span class="badge badge-primary"><?= $model_mr->getDetailedOfficeCount(); ?></span>
              <span class="badge"><?= $model_mr->getOfficeCount(); ?></span>     
             </div>


              <div class="media-body">
                <?= $model_mr->name ?>
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
        <?php } ?>
        </ul>
             &nbsp;<br>&nbsp;<br>&nbsp;<br>  


      <?php
        $start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
        $end_date =  \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();
      ?>

      <div class="bar bar-standard bar-footer-secondary">
        <a class="btn btn-block btn-primary" style="color:#fff" href="<?php echo  Url::to(['qdxcjspbpm'],true) ?>">排行榜</a>
      </div>
      &nbsp;<br><br>

      <div class="bar bar-standard bar-footer">
        <a class="tab-item" href="#">
        本期活动时间：<?= $start_date->format('Y-m-d'); ?> 至 <?= $end_date->format('Y-m-d'); ?>
        </a>
      </div>



      <div id="myModalexample" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#myModalexample"></a>
          <h1 class="title">Modal</h1>
        </header>

        <div class="content">
            <ul class="table-view">
            <li class="table-view-cell"><span class="badge">1</span></li>
            <li class="table-view-cell"><span class="badge badge-primary">2</span></li>
            <li class="table-view-cell"><span class="badge badge-positive">3</span></li>
            <li class="table-view-cell"><span class="badge badge-negative">4</span></li>
            </ul>
        </div>
      </div>
    </div>



      
      
  </body>
</html>