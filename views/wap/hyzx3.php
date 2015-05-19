<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MOrder;
    
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
            &nbsp;&nbsp;<?=  $user->getBindMobileNumbersStr() ?><br>
            &nbsp;&nbsp;
            <?php 
            if (
              !empty($user->staff) &&
              $user->staff->cat == \app\models\MStaff::SCENE_CAT_IN
            ) { 
                //$is_employee = true;
                $mobiles = $user->getBindMobileNumbers();
                if (count($mobiles) > 0) {
                  $mobile = $mobiles[0];
                  $employee = \app\models\ClientEmployee::findOne([
                    'gh_id' => $user->gh_id,
                    'mobile' => $mobile,
                  ]);
                }
            ?>
              襄阳联通员工 <?= !empty($employee) ? $employee->name : '' ?>
            <?php } else { ?>
              会员
            <?php } ?>
          </span>

          <span style="float:right"><br>
              <a href="#showQr"><img src='../web/images/woke/qr.png' width=24></a>
          </span>
      </p>
    
      <br><br><br><br><br>

        <span>
          <ul class="table-view">

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['officeorder', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid, 'staff_id'=>$staff->staff_id]) ?>">

                <?php if(MOrder::getOfficeOrderInfoCount($staff->office_id) > 0) { ?>
                  <span class="badge badge-negative">
                  <?= MOrder::getOfficeOrderInfoCount($staff->office_id) ?>
                  </span>
                <?php } ?>

                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  营业厅订单
                </div>
              </a>
            </li>
 
 <!--
    const GH_XIANGYANGUNICOM_OPENID_HBHE = 'oKgUduNHzUQlGRIDAghiY7ywSeWk';
    const GH_XIANGYANGUNICOM_OPENID_KZENG = 'oKgUduJJFo9ocN8qO9k2N5xrKoGE';
    const GH_XIANGYANGUNICOM_OPENID_GTSUN = 'oKgUduNaK7mfojofz2qnSxa_FTMs';
    const GH_XIANGYANGUNICOM_OPENID_YJHU = 'oKgUduHLF-HAxvHYIwmm3qjfqNf0';
 -->
            <?php if($user->openid=='oKgUduNHzUQlGRIDAghiY7ywSeWk' ||
                    $user->openid=='oKgUduJJFo9ocN8qO9k2N5xrKoGE' ||
                    $user->openid=='oKgUduHLF-HAxvHYIwmm3qjfqNf0') { ?>
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['yggl1', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid, 'staff_id'=>$staff->staff_id]) ?>">
                <!--
                <span class="badge badge-negative">
                1000
                </span>
                -->
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  员工管理
                </div>
              </a>
            </li>


            <li class="table-view-cell media">
              <a data-ignore="push"  class="navigate-right" href="#">
                <!--
                <span class="badge badge-negative">
                1000
                </span>
                -->
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  粉丝管理
                </div>
              </a>
            </li>

            <li class="table-view-cell media">
              <a data-ignore="push"  class="navigate-right" href="#">
                <!--
                <span class="badge badge-negative">
                1000
                </span>
                -->
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  客户管理
                </div>
              </a>
            </li>      

            <li class="table-view-cell media">
              <a class="navigate-right" href="#">
                <!--
                <span class="badge badge-negative">
                1000
                </span>
                -->
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                <div class="media-body">
                  推广查询
                </div>
              </a>
            </li>      
            <?php } ?>



            <!--
            <li class="table-view-cell">Item 3 <button class="btn btn-positive">Button</button></li>
            <li class="table-view-cell">Item 4 <button class="btn btn-negative">Button</button></li>
            -->
          </ul>
        </span>
 
    </div>

    </div><!-- end of content -->

    <nav class="bar bar-tab">
      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx1', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-person"></span>
        <span class="tab-label">我</span>
      </a>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx2', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-star-filled"></span>
        <span class="tab-label">活动</span>
      </a>

      <?php 
      if (
        !empty($user->staff) &&
        !empty($user->staff->office) &&
        $user->staff->office->is_selfOperated
      ) { 
      ?>
      <a data-ignore="push" class="tab-item active" href="<?php echo Url::to(['hyzx3', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-home"></span>
        <span class="tab-label">营业厅</span>
      </a>
      <?php } ?>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx4', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
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

          <center>
              <?php echo Html::img($user->getQrImageUrl(), ['style'=>'display: block;max-width:100%;height: auto;']); ?>
              <br>
              <a href="#rhtg">如何推广?</a>
              <br> <br>
              &nbsp;
          </center>

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

         <div class="card" style="border:0">
          <p></p>
          <p>1、首先，您关注<strong>襄阳联通官方微信服务号</strong>后，还需要绑定手机号成为会员，联通、移动、电信的号码都可以绑定。</p>
          <p>2、成为襄阳联通官方微信服务号会员后，进入会员中心，点击顶部的二维码图标就可以获得您专属的<strong>推广二维码</strong>。</p>
          <p>3、将您的<strong>专属推广二维码</strong>通过微信发送到<strong>朋友圈</strong>或者直接<strong>转发给您的好友</strong>，也可以直接让他们面对面扫码。当您的朋友或好友<strong>扫码关注襄阳联通官方微信服务号</strong>后，即记为您的推广成绩。</p>
          <p>4、如果您的朋友或者好友关注后还<strong>继续绑定手机号成为会员</strong>，那就更好了。现在襄阳联通正在进行<strong>推荐有礼</strong>的活动，每推广一个关注会员，你就会获得<strong>5元推广奖金</strong>哦。</p>
          <p>5、请注意：您推广的会员必须关注襄阳联通官方微信服务号<strong>达一个月</strong>后，您的推广奖金才会生效，生效时会有微信消息发送给您。</p>
          <p>6、您的推广奖金会存入您的<strong>会员帐号</strong>中，您可以在每月底从会员帐户中<strong>提现进行话费充值</strong>，有几点约定：
          <ul><li>充值号码必须是襄阳联通本地手机号码；</li><li>充值金额不能超过您的帐户余额；</li><li>充值金额必须是5元的整数倍。</li></ul>
          </p>
          <p>7、所有的话费充值会在<strong>每月初统一处理，统一到帐</strong>，到帐后会有短信和微信通知，还请您注意查收。</p>
          </div>
          <br>
          <a class="btn btn-block" href="#rhtg">返回</a>
      </div>
    </div>
    

  <script type="text/javascript">

  </script>

  </body>
</html>