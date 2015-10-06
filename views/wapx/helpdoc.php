<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

use app\models\MHelpdoc;

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

    <link href="/wx/web/js/jqm/idangerous.swiper.css" rel="stylesheet">
  
    <style type="text/css">

        img {
          width:100%;
          display:block;
        }

        .yuedu {
          color: #ccc;
          text-align: right;
        }

    </style>


    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>
      <h1 class="title">
       帮助中心
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

      <!--
      <img width=100%  src="/wx/web/images/helpdoc-head.jpg?v3">
      <br>
      -->

      <div class="content-padded">
              <h5><?= $helpdoc->title ?></h5>

              <p class="helpdoc_content"><?= $helpdoc->content ?></p>

              <p class="yuedu">阅读 <?= $helpdoc->sort ?></p>

              <h5>相关主题</h5> 
              <ul class="table-view">
              <?php 
                if(!empty($helpdoc->relate))
                {
                  $relates = explode(",",$helpdoc->relate);
                  foreach ($relates as $relate) 
                  {
                    $hd = MHelpdoc::findOne(['visual' => 1, 'helpdoc_id' => $relate]);
              ?>
                
                <li class="table-view-cell">
                  <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['helpdoc', 'helpdoc_id'=> $relate],true) ?>">
                    &nbsp;&nbsp;
                    <?= $hd->title ?>
                  </a>
                </li>

                <?php 
                    }
                  }
                ?>

                </ul>
              &nbsp;&nbsp;
              <br>
      </div>

    </div>


  <script type="text/javascript">
    function back2pre()
    {
      location.href = "<?php echo Url::to(['helpdoclist'],true) ?>";
    }
  </script>


  </body>

</html>