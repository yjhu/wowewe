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

      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>

      <h1 class="title">
       参赛门店资料提交
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
      督导门店选择
      </p>

        <ul class="table-view">
        <li class="table-view-cell table-view-divider"><?= "督导员：{$staff->name} {$staff->mobile}" ?></li>
        <?php foreach($models_office as $model_office) {  
            $detail_status = \app\models\MOfficeCampaignDetail::getDetailReadyStatus($model_office->office_id);
        ?>

            <li class="table-view-cell media">
            <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['csmdzltj2','office_id'=>$model_office->office_id, 'staff_id' => $staff->staff_id],true) ?>">

            <?php if($detail_status == \app\models\MOfficeCampaignDetail::DETAIL_COMPLETE) { ?>
              <span class="badge badge-positive">已提交</span>
            <?php } elseif($detail_status == \app\models\MOfficeCampaignDetail::DETAIL_IMCOMPLETE) { ?> 
              <span class="badge badge-negative">未提交</span>
            <?php } else { ?>
              <span class="badge badge-primary">部分提交</span>
            <?php } ?>
            
            <!--
              <img class="media-object pull-left" src="http://placehold.it/80x80">
            -->
              <div class="media-body">
                <?= $model_office->title ?>
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
        <?php } ?>
        </ul>
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

  <?php
          $gh_id = U::getSessionParam('gh_id');
          $openid = U::getSessionParam('openid');
  ?>

  <script type="text/javascript">
    function back2pre()
    {
      location.href = "<?php echo Url::to(['hyzx', 'gh_id'=>$gh_id, 'openid'=>$openid, 'item'=>'hyzx'],true) ?>";
    }
  </script>

      
  </body>
</html>