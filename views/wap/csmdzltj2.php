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
  
      <h1 class="title">
       参赛门店资料提交
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <p class="content-padded">
          <?= $model_office->title ?>
        </p>



      <?php foreach($models_categories as $model_category) {  ?>
          <ul class="table-view">
            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['csmdzltj3','cat_name'=>$model_category->name],true) ?>">
                <img class="media-object pull-left" src="http://placehold.it/80x80">
                <div class="media-body">
                  <?= $model_category->name ?>
                  <!--
                  <p>...</p>
                  -->
                </div>
              </a>
            </li>
      <?php } ?>

        </ul>
      

    </div>

      
      
  </body>
</html>