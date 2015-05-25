<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MStaff;
    $client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
?>

<?php
  include('../models/utils/emoji.php');
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
    <link href="/wx/web/ratchet/dist/css/ratchet.css?v11" rel="stylesheet">

  
    <link href="./php-emoji/emoji.css" rel="stylesheet">


    <style type="text/css">

      .btn {
        border-radius: 0 ;
      }

    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>

    <script src="/wx/web/js/jquery.touchSwipe.min.js"></script>
   
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <!--
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>
      -->

      <h1 class="title">
      <!--
      <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
      -->
       员工管理
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

    <p class="content-padded">
    所属营业厅 > <?= $outlet->title ?>
    <span class="badge badge-primary pull-right">  <?= ($outlet->employeeCount + $outlet->agentCount) ?>人</span>
    </p>
    <ul class="table-view" id="ul-content">

        <?php 
          foreach ($outlet->employees as $employee) { 
        ?>
        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['clientemployee', 'gh_id'=>$gh_id, 'openid'=>$openid, 'outlet_id'=>$outlet->outlet_id, 'entity_id'=>$employee->employee_id ]) ?>">
        <img class="media-object pull-left" src="<?= (empty($employee->wechat) || empty($employee->wechat->headimgurl)) ? '../web/images/wxmpres/headimg-blank.png':$employee->wechat->headimgurl ?>" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          <?= $employee->name ?>
          &nbsp;<span class="badge badge-positive pull-right"><?= $employee->getOutletPosition($outlet->outlet_id) ?></span>
          <p>
            手机号码 <?= implode(",", $employee->mobiles) ?>
            <br>

          </p>
        </div>
        </a>
        </li>
        <?php } ?>

 
    </ul>

    &nbsp;
    <br>
    &nbsp;
    <br>

    </div><!-- end of content -->

    <div class="bar bar-standard bar-footer">
        <div class="content" style="font-size: 10px;color:#ccc;">
        <center>
        <span><img style='width:18px;' src="<?= $wx_user->headimgurl ?>"/>&nbsp;&nbsp;</span>
        <span><?= emoji_unified_to_html(emoji_softbank_to_unified($wx_user->nickname)) ?>&nbsp;</span>
        <span><?= $wx_user->getBindMobileNumbersStr() ?></span>

        <br>
        <span><?= $client->title_abbrev ?>&copy;<?= date('Y') ?></span>
        </center>
        </div>
    </div>

  <script type="text/javascript">
  


  </script>

  </body>
</html>