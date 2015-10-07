<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
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

    <style type="text/css">
    
      li {
        color: #aaa;
        font-size: 14px;
      }
              
    </style>
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <!--
    <header class="bar bar-nav">
          <h1 class="title">
            帮助中心
          </h1>
    </header>
    -->

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

      <img width=100%  src="/wx/web/images/helpdoc-head.png?v5">
      <br><br>
       <ul class="table-view">
   
          <?php 
            $idx = 1;
            foreach($helpdocs as $helpdoc) 
            {
          ?>
            
            <li class="table-view-cell">
              <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['helpdoc', 'helpdoc_id'=>$helpdoc->helpdoc_id],true) ?>">
                <?= $helpdoc->title ?>

                <?php if($idx<5) {?>
                 <span class="badge badge-negative"><?= $helpdoc->sort ?></span>
                <?php } ?>
              </a>
            </li>

            <?php 
              $idx = $idx + 1;
              } 
            ?>
        </ul>
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 

    </div>

    <script type="text/javascript">

    </script>
  </body>
</html>