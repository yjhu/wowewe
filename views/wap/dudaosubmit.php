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
        襄阳联通督导评比
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">
      襄阳联通督导评比...
      </p>

        <ul class="table-view">
          <li class="table-view-cell media">
            <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['wap/dudaoview'],true) ?>">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店外部#1
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店外部#2
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店外部#3
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>          

          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店内部#1
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店内部#2
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/80x80">
              <div class="media-body">
                门店内部#3
                <!--
                <p>...</p>
                -->
              </div>
            </a>
          </li>   
        </ul>
      

    </div>

      
    <!--
    <nav class="bar bar-tab">
      <a class="tab-item active" href="#">
        <span class="icon icon-home"></span>
        <span class="tab-label">Home</span>
      </a>
      <a class="tab-item" href="#">
        <span class="icon icon-person"></span>
        <span class="tab-label">Profile</span>
      </a>
      <a class="tab-item" href="#">
        <span class="icon icon-star-filled"></span>
        <span class="tab-label">Favorites</span>
      </a>
      <a class="tab-item" href="#">
        <span class="icon icon-search"></span>
        <span class="tab-label">Search</span>
      </a>
      <a class="tab-item" href="#">
        <span class="icon icon-gear"></span>
        <span class="tab-label">Settings</span>
      </a>
    </nav>
    -->
      
  </body>
</html>