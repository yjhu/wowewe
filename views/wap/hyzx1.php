<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
    use app\models\MUserAccount;
    

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
    .orderitem{
          color:#aaaaaa;
          font-size: 11pt;
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
            <li class="table-view-cell">余额 
            <a class="btn btn-positive btn-outlined" style="width:150px;size:12px" href="#zhmx">
            <?= $user->getUserAccountBalanceInfo() ?>
            </a>
            </li>

            <li class="table-view-cell">总收入
            <a class="btn btn-primary btn-outlined" style="width:150px;size:12px" href="#zhmx">
            <?= $user->getUserAccountDepositTotal() ?>
            </a>
            </li>

            </ul>
            <?php if ($user->user_account_balance > 0) { ?>
              <a class="btn btn-positive btn-block"  href="#txcz">我要提现充话费</a>
            <?php } ?>

            <ul class="table-view">
            <li class="table-view-cell table-view-divider"></li>

            <li class="table-view-cell media">
              <a class="navigate-right" href="<?php echo Url::to(['myorder', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
                
                <?php if($user->getOrderInfoCount() > 0) { ?>
                  <span class="badge badge-negative">
                  <?= $user->getOrderInfoCount() ?>
                  </span>
                <?php } ?>

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
      <a data-ignore="push" class="tab-item active" href="<?php echo Url::to(['hyzx1', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-person"></span>
        <span class="tab-label">我</span>
      </a>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx2', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-star-filled"></span>
        <span class="tab-label">活动</span>
      </a>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx3', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>">
        <span class="icon icon-home"></span>
        <span class="tab-label">营业厅</span>
      </a>

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
    
    <!-- 提现充值窗口 -->
    <div id="txcz" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#txcz"></a>
        <h1 class="title">提现充话费</h1>
      </header>

      <div class="content">
          <p class="content-padded">
          敬请注意：所充话费每月底统一处理，下月初到帐。
          </p>

          <input type="tel" id="czhm" placeholder="手机号码" value="<?=  empty($openidBindMobile->mobile)? "" : $openidBindMobile->mobile ?>">
          
          <input type="tel" id='czje' placeholder="请输入5的倍数，最多可充金额 <?= $user->user_account_balance/100 ?>">

          <br>
          <button class="btn btn-positive btn-block" id='qdchf'>确定充话费</button>
          <a class="btn btn-block" href="#txcz">暂不充话费, 返回</a>
      </div>
    </div>



    <!-- 我的账户明细显示窗口 -->
    <div id="zhmx" class="modal">
      <header class="bar bar-nav">
        <a class="icon icon-close pull-right" href="#zhmx"></a>
        <h1 class="title">账户明细</h1>
      </header>

      <div class="content">
          <p class="content-padded">
          </p>

          <ul class="table-view">

          <?php 
            foreach ($user->userAccounts as $user_account) { 
              if ($user_account->amount > 0)
                $bk_color = "green";
              else
                $bk_color = "red";
          ?>
  
            <li class="table-view-cell" >                
                  <p><span class="orderitem">时间</span>&nbsp;&nbsp;<?= $user_account->create_time ?></p>
                  <p><span class="orderitem">金额</span>&nbsp;&nbsp;<span style="color: <?= $bk_color ?>"><?= Yii::$app->formatter->asCurrency($user_account->amount/100) ?></span></p>
                  <p>
                  <span class="orderitem">备注</span>&nbsp;&nbsp;<?= $user_account->memo ?>

                  <?php
                      if($user_account->status == MUserAccount::STATUS_CHARGE_REQUEST) {
                  ?>
                      <span id="qxsq" class="btn btn-outlined pull-right" uid="<?= $user_account->id ?>"  amount="<?= $user_account->amount ?>">取消申请</span>
                  <?php 
                    }
                  ?>
                  </p>
            </li>
            <?php } ?>


    
          </ul>

          <a class="btn btn-block" href="#zhmx"> 返回</a>

      </div>
    </div>



  <script type="text/javascript">

    var gh_id = "<?= $user->gh_id ?>";
    var openid = "<?= $user->openid ?>";

    function qdchfajax(czhm,czje)
    {
          //alert('czhm'+czhm+'czje'+czje);
          $.ajax({
          url: "<?php echo Url::to(['wap/chonghuafeiajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "czhm="+czhm+"&czje="+czje+"&gh_id="+gh_id+"&openid="+openid,
          success: function(t){

                  if(t.code==0)
                  {
                      alert("您本次的话费充值申请已提交，所有申请会在月底统一处理，下月初到帐，敬请查收。");
                      var url = "<?php echo Url::to(['hyzx1'],true) ?>";
                      location.href = url+'&gh_id=<?= $user->gh_id ?>&openid<?= $user->openid ?>';
                  }
                  else
                  {
                    alert('error');
                  }

            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    }


    function qxsqajax(uid,amount)
    {
          $.ajax({
          url: "<?php echo Url::to(['wap/qxchonghuafeiajax'], true) ; ?>",
          type:"GET",
          cache:false,
          dataType:"json",
          data: "uid="+uid,
          success: function(t){

                  if(t.code==0)
                  {
                      alert("本次话费充值申请已取消。\n"+Math.abs(amount/100)+"元已返还到您的帐户。");
                      var url = "<?php echo Url::to(['hyzx1'],true) ?>";
                      location.href = url+'&gh_id=<?= $user->gh_id ?>&openid<?= $user->openid ?>';
                  }
                  else
                  {
                    alert('error');
                  }
            },
            error: function(){
              alert('error!');
            }
        });

        return false;
    }


    $(document).ready(function(){

      $("#qdchf").click(function(){
          //alert("确定充话费");
          //mobile = $(this).attr('mobile');
          //alert('解除绑定'+mobile);

          var czhm = $("#czhm").val();
          var czje = $("#czje").val();
          //alert("czhm"+ czhm + "czje"+czje);

          var usermobileReg = /(^(1)\d{10}$)/;
          if((usermobileReg.test(czhm) === false) || (czhm == ""))
          {
            alert("充值手机号码不正确，\n请重新填写。");
            return  false;
          }

          var ye = '<?= $user->user_account_balance/100 ?>';
    
          if(czje < 5)
          {
            alert("充值金额至少为5元，\n请重新填写。");
            return  false;
          }

          if(czje > parseInt(ye))
          {
            alert("充值金额超出了您的帐户余额，\n请重新填写。");
            return  false;
          }

          if(czje%5 != 0)
          {
            alert("充值金额必须是5的倍数，\n请重新填写。");
            return  false;
          }

          if(!confirm("现在就申请充话费，确定?"))
            return false;

          qdchfajax(czhm,czje);
          return false;
      });

      $("#qxsq").click(function(){
            //alert("取消申请");
            uid = $(this).attr('uid');
            amount = $(this).attr('amount');

            if(!confirm("取消充话费申请，确定?"))
              return false;

            qxsqajax(uid,amount);
            return false;
          });

    });


  </script>

  </body>
</html>