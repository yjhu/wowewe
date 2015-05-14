<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;

    //use app\models\utils;
    //use app\models\utils\emoji;
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
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">

    <link href="./php-emoji/emoji.css" rel="stylesheet">
    <style type="text/css">
    .btn {
      font-size: 16px;
    }

    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
    <!--
      <a class="icon icon-left-nav pull-left" id="btn_back"></a>
    -->

      <h1 class="title">
        <!--
        <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
        -->
        会员中心
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
         <span style="float:left">
            <img id="myphoto" src="<?php echo $user->headimgurl; ?>" width="64" height="64">
          </span>

          <span style="float:left">
            &nbsp;&nbsp;<b><?= emoji_unified_to_html(emoji_softbank_to_unified($user->nickname)) ?></b> <br>
            &nbsp;&nbsp;
            <?php foreach($user->openidBindMobiles as $openidBindMobile): ?>
              <?=  $openidBindMobile->mobile ?>
            <?php endforeach; ?>
             <br>
            &nbsp;&nbsp;<a href="#rhtg">如何推广?</a>
          </span>

          <span style="float:right"><br>
              <a href="#showQr"><img src='../web/images/woke/qr.png' width=24></a>
          </span>
      </p>

      <br><br><br><br><br>

        <span>
          <ul class="table-view">

            <li class="table-view-cell table-view-divider">我的账户</li>
            <li class="table-view-cell">余额 <button class="btn btn-positive btn-outlined" style="width:90px;height:40px;size:12px">￥50</button></li>
            <li class="table-view-cell">支付历史 <button class="btn btn-primary btn-outlined" style="width:90px;height:40px;size:12px">￥2048</button></li>


            <li class="table-view-cell table-view-divider"></li>

            <li class="table-view-cell media">
              <a class="navigate-right" href="<?php echo Url::to(['myorder', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
                <span class="badge badge-negative">
                <?= $user->getOrderInfoCount() ?>
                </span>
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  我的订单
                </div>
              </a>
            </li>


            <!--
            <li class="table-view-cell">Item 3 <button class="btn btn-positive">Button</button></li>
            <li class="table-view-cell">Item 4 <button class="btn btn-negative">Button</button></li>
            -->
          </ul>
        </span>
 
      <br><br><br>

      <p>

        <?php
            //$str = emoji_unified_to_html('U+1F64F');
            //$str = emoji_unified_to_html("\xe2\x98\x80");
            //$nickname = emoji_unified_to_html(emoji_softbank_to_unified($nicknameStr));
            //echo $str;
        ?>

      </p>
    </div>

    </div><!-- end of content -->

    <nav class="bar bar-tab">
      <a class="tab-item active" href="<?php echo Url::to(['hyzx1', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-person"></span>
        <span class="tab-label">我</span>
      </a>

      <a class="tab-item" href="<?php echo Url::to(['hyzx2', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-star-filled"></span>
        <span class="tab-label">活动</span>
      </a>

      <a class="tab-item" href="<?php echo Url::to(['hyzx3', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-home"></span>
        <span class="tab-label">营业厅</span>
      </a>

      <a class="tab-item" href="<?php echo Url::to(['hyzx4', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-gear"></span>
        <span class="tab-label">设置</span>
      </a>
    </nav>


    <div id="showQr" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#showQr"></a>
        <h1 class="title">我的推广二维码</h1>
      </header>

      <div class="content">

          <br>
          <center>
              <?php echo Html::img($user->getQrImageUrl(), ['style'=>'display: block;max-width:100%;height: auto;']); ?>
          </center>
          <br>
          <br>
          <a class="btn btn-block" href="#showQr">返回</a>
      </div>
    </div>
    

    <!-- 如何推广窗口 -->
    <div id="rhtg" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#rhtg"></a>
        <h1 class="title">如何推广？</h1>
      </header>

      <div class="content">

          <p>如何推广123...</p>
          <br>
          <a class="btn btn-block" href="#rhtg">返回</a>
      </div>
    </div>
    

  <script type="text/javascript">

  </script>

  </body>
</html>