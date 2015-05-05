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
      <a class="icon icon-left-nav pull-left" id="btn_back" href="#exit"></a>
      <!--
      <a class="icon icon-info pull-right" href="#myModalexample" class="btn"></a>
      -->
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
            <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['qdxcjspb2','gh_id'=>$gh_id, 'openid'=>$openid, 'mr_id'=>$model_mr->id],true) ?>">
            <!--
              <img class="media-object pull-left" src="http://placehold.it/80x80">
            -->
             <div class="pull-right">
              <?php
                $wx_user = \app\models\MUser::findOne(['gh_id' => $gh_id, 'openid' => $openid]); 
                $staff = $wx_user->staff;
                $scored_count = $model_mr->getScoredOfficeCount();
                if ($staff->isOfficeCampaignScorer()) {
                  $myScoredCount = $model_mr->getScoredOfficeCountByScorer($staff->staff_id);
                  $detailedCount = $model_mr->getDetailedOfficeCount();
                  if ($myScoredCount < $detailedCount) {
              ?>
                <span class="badge badge-negative"><?= $detailedCount - $myScoredCount ?></span>
              <?php }} ?>
              <?php if ($scored_count > 0) { ?>
              <span class="badge badge-positive">已评:<?= $scored_count; ?></span>
              <?php } ?>
              <!--<span class="badge badge-primary"><?= $model_mr->getDetailedOfficeCount(); ?></span>-->
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


      <div id="myModalexample" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#myModalexample"></a>
          <h1 class="title">图例说明</h1>
        </header>

        <div class="content">
            <ul class="table-view">
            <li class="table-view-cell"><span class="badge badge-positive">&nbsp;</span>参加评分门店数量</li>
            <li class="table-view-cell"><span class="badge badge-primary">&nbsp;</span>已提交资料门店数量</li>
            <li class="table-view-cell"><span class="badge">&nbsp;</span>参赛门店数量</li>
            <li class="table-view-cell"><span class="badge badge-inverted"><span class="icon icon-info" style="color:red"></span></span>你未评分</li>
            </ul>
        </div>
      </div>

      <div id="exit" class="modal">
        <header class="bar bar-nav">
          <a class="icon icon-close pull-right" href="#exit"></a>
          <h1 class="title">确认要退出？</h1>
        </header>

        <div class="content">
  
            <br>
            <a class="btn btn-block" href="#exit">不退出，再看看。</a>
            <a class="btn btn-negative btn-block" onclick="javascript:history.back();">退出</a>
            
     
        </div>
      </div>


  </body>
</html>