<?php
use app\models\MOfficeCampaignDetail;
use yii\helpers\Url;

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
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">

      <?php if ($backwards) {?>
          <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?=\app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid)?>">
              <span class="icon icon-left-nav"></span>
          </a>
      <?php }
?>

        <?php if ($wx_user->staff->isOfficeCampaignScorer()) {?>
        <a data-ignore='push' class='btn btn-link pull-right' href='#quick-scoring'><span class='icon icon-compose'></span></a>
        <?php }
?>
      <h1 class="title">
       渠道宣传竞赛评选
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <p class="content-padded">
           <?=$office->msc->marketingRegion->name?>><?=$office->msc->name?>><?=$office->title?>
        </p>
      <ul class="table-view">
        <?php if ((!empty($office->supervisor)) || ($office->is_selfOperated)) {
    $officeScore = \app\models\MOfficeCampaignScore::getScore($office->office_id);
    if ($office->is_selfOperated) {
        ?>
          <li class="table-view-cell table-view-divider">班长：<?=$office->manager . " " . $office->mobile?></li>
        <?php } else {?>
          <li class="table-view-cell table-view-divider">督导员：<?=$office->supervisor->name . " " . $office->supervisor->mobile?></li>
        <?php }
    ?>
        <li class="table-view-cell table-view-divider">门店当前总分：<span class="badge badge-positive pull-left"><?=$officeScore ? number_format(floatval($officeScore), 2) : '未评分'?></span></li>

        <?php }
?>
          <?php
foreach ($models_categories as $model_category) {
    if ((!$office->is_selfOperated) && ($model_category->sort_order == 6)) {
        continue;
    }

    ?>

                <li class="table-view-cell media">

                    <?php
// $model_office_campaign_detail = MOfficeCampaignDetail::findOne(['pic_category' => $model_category->id, 'office_id' => $office->office_id]);
    $model_office_campaign_detail = MOfficeCampaignDetail::getDetailByOfficeAndPicCategory($office->office_id, $model_category->id);
    if (!empty($model_office_campaign_detail)) {
        $url = $model_office_campaign_detail->getImageUrl();
    } else {
        $url = '../web/images/comm-icon/upload-pic-64x64.png';
    }
    ?>

                  <?php if (!empty($model_office_campaign_detail)) {
        ?>
                    <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['qdxcjspb5', 'gh_id' => $gh_id, 'openid' => $openid, 'office_id' => $office->office_id, 'model_category_id' => $model_category->id], true)?>">
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
            $staff = $wx_user->mobileStaff;
            if (empty($staff)) {
                $staff = $wx_user->staff;
            }

            if ($staff->isOfficeCampaignScorer()) {
                $myscore = \app\models\MOfficeCampaignScore::getScoreByScorerAndPicCategory($office->office_id, $staff->staff_id, $model_category->id);
                if ($myscore === false) {
                    ?>
                              <span class="icon icon-info" style="color:red"></span>
                            <?php }}
            ?>
                        <span class="badge badge-positive"><?=$score['count'] == 1 ? $score['total'] : number_format($score['total'] / $score['count'], 2);?>分</span>
                      <?php } else {?>
                        <span class="badge badge-negative"><?="未评分";?></span>
                      <?php }
        ?>
                    </div>

                  <?php } else {?>
                       <span class="badge badge-negative">未提交资料</span>
                  <?php }
    ?>
                    <img class="media-object pull-left" src="<?=$url?>" width="64" height="64">

                    <div class="media-body">
                      <?=$model_category->name?>
                      <!--
                      <p>...</p>
                      -->

                    </div>

                  <?php if (!empty($model_office_campaign_detail)) {?>
                    </a>
                  <?php }
    ?>


                </li>
          <?php }
?>

        </ul>

        &nbsp;<br>&nbsp;<br>&nbsp;<br>

      <?php
$start_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignBeginDate();
$end_date = \app\models\utils\OfficeCampaignUtils::getOfficeCampaignEndDate();
?>

      <div class="bar bar-standard bar-footer-secondary">
        <a class="btn btn-block btn-primary" style="color:#fff" href="<?php echo Url::to(['qdxcjspbpm'], true)?>">
        <i class="fa fa-trophy" style="color:#fff"></i>
        排行榜
        </a>
      </div>

      <br>
      <br>

      <nav class="bar bar-tab">
        <a class="tab-item" href="#">
          本期活动时间：<?=$start_date->format('Y-m-d');?> 至 <?=$end_date->format('Y-m-d');?>
        </a>
      </nav>

    </div>

    <div id='quick-scoring' class='modal'>
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" id='quick-scoring-close' href='#quick-scoring'></a>
            <h1 class='title'>快速评分</h1>
        </header>
        <div class="content">
            <div class="slider" id="office-campaign-details">
                <div class="slide-group">
                <?php
foreach ($models_categories as $category) {
    if ((!$office->is_selfOperated) && ($category->sort_order == 6)) {
        continue;
    }

    if (empty($staff)) {
        $staff = $wx_user->staff;
    }

    $myscore = \app\models\MOfficeCampaignScore::getScoreByScorerAndPicCategory($office->office_id, $staff->staff_id, $category->id);
    if ($myscore !== false) {
        continue;
    }

    $min_score = 0;
    if (!$office->is_selfOperated) {
        $max_score = 20;
    } else if ($category->sort_order == 6) {
        $max_score = 10;
    } else {
        $max_score = 18;
    }

    $detail = MOfficeCampaignDetail::getDetailByOfficeAndPicCategory($office->office_id, $category->id);
    if (!empty($detail)) {
        $url = $detail->getImageUrl();
    } else {
        $url = '../web/images/comm-icon/upload-pic-64x64.png';
    }
    ?>

                <?php if (!empty($detail)) {?>
                    <div style='background-color:white;' class="slide campaign-slide" detail_id = <?=$detail->id?>>
                        <div>
                        <ul class='table-view'>
                            <li class='table-view-cell'>
                                <span class='pull-left'><?=$office->title?></span>
                                <span class='pull-right'><?=$category->name?></span>
                            </li>
                        </ul>
                        </div>
                        <div>
                                <div class='input-row'>
                                    <label>评分：</label>
                                    <input class='campaign-score'type='number' min='<?=$min_score?>' max='<?=$max_score?>' placeholder="输入您的评分[<?=$min_score . '-' . $max_score?>]">
                                </div>
                                <div class='input-row'>
                                    <label>评语：</label>
                                    <input class='campaign-comment' type='text' placeholder="输入您的评语">
                                </div>
                                <button class='btn btn-block btn-positive campaign-confirm'>确定</button>
                        </div>

                        <center>
                        <img width=100% src='<?=$url?>'/>
                        </center>

                    </div>
                <?php }
    ?>


                <?php }
?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(window).bind('touchend', function (event) {
            if ( event.target === $( '#quick-scoring-close' )[0] ){
                location.href = "<?=\app\models\utils\BrowserHistory::current($wx_user->gh_id, $wx_user->openid);?>";
            }
        });

        $( '.campaign-confirm' ).click( function(event) {
            var slider          = $(this).parent().parent();
            var input_score     = $(this).parent().parent().find('.campaign-score');
            var input_comment   = $(this).parent().parent().find('.campaign-comment');

            var office_campaign_id  = slider.attr('detail_id');
            var staff_id            = <?=$wx_user->staff->staff_id?>;

            var min_score   = input_score.attr('min');
            var max_score   = input_score.attr('max');
            var score       = parseInt(input_score.val());
            var comment     = input_comment.val();

            if (isNaN(score) || (score < min_score) || (score > max_score)) {
                alert("输入的评分不正确！必须是" + min_score + "到" + max_score + "的数值。");
                return false;
            }

            $.ajax({
                url: "<?php echo Url::to(['wap/handleqdxcjspb', 'gh_id' => $gh_id, 'openid' => $openid], true);?>",
                type:"GET",
                cache:false,
                dataType:"json",
                data: "office_campaign_id="+office_campaign_id+"&staff_id="+staff_id+"&score="+score+"&comment="+comment,
                success: function(t){
                    alert('评分成功');
                    slider.hide();
                },
                error: function(){
                    alert('error!');
                }
            });
        });
    </script>
  </body>
</html>