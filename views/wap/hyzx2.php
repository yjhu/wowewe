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
            <img src='../web/images/woke/0.jpg' width="64" height="64">
          </span>

          <span style="float:left">
            &nbsp;&nbsp;<b>曾开</b> <br>
            &nbsp;&nbsp;13545296480 <br>
            &nbsp;&nbsp;<a href="#rhtg">如何推广?</a>
          </span>

          <span style="float:right"><br>
              <a href="#showQr"><img src='../web/images/woke/qr.png' width=24></a>
          </span>
      </p>
    
      <br><br><br><br><br>

        <span>
          <ul class="table-view">

            <li class="table-view-cell media">
              <a class="navigate-right">
                <!--
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                -->
                <div class="media-body">
                  推荐有礼
                </div>
              </a>
            </li>

            <li class="table-view-cell media">
              <a class="navigate-right">
                <!--
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                -->
                <div class="media-body">
                  4G测速有奖
                </div>
              </a>
            </li>

            <li class="table-view-cell media">
              <a class="navigate-right">
                <!--
                <span class="media-object pull-left icon icon-list" style="color:#428bca"></span>
                -->
                <div class="media-body">
                  渠道宣传竞赛评选
                </div>
              </a>
            </li>


            <li class="table-view-cell media">
              <a class="navigate-right">
                <!--
                <span class="media-object pull-left icon icon-list" style="color:#42a8e1"></span>
                -->
                <div class="media-body">
                  渠道宣传资料提交
                </div>
              </a>
            </li>
            <!--
            <li class="table-view-cell">
            渠道宣传资料提交
            </li>
            -->

            <!--
            <li class="table-view-cell">Item 3 <button class="btn btn-positive">Button</button></li>
            <li class="table-view-cell">Item 4 <button class="btn btn-negative">Button</button></li>
            -->
          </ul>
        </span>
 
    </div>

    </div><!-- end of content -->

    <nav class="bar bar-tab">
      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx1']) ?>">
        <span class="icon icon-person"></span>
        <span class="tab-label">我</span>
      </a>

      <a data-ignore="push" class="tab-item active" href="<?php echo Url::to(['hyzx2']) ?>">
        <span class="icon icon-star-filled"></span>
        <span class="tab-label">活动</span>
      </a>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx3']) ?>">
        <span class="icon icon-home"></span>
        <span class="tab-label">营业厅</span>
      </a>

      <a data-ignore="push" class="tab-item" href="<?php echo Url::to(['hyzx4']) ?>">
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
          <img src="../web/images/woke/qr.png" width=240>
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