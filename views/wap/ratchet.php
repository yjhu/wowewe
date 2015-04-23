<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ratchet template page</title>

    <!-- Sets initial viewport load and disables zooming  -->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Include the compiled Ratchet CSS -->
    <link href="/wx/web/ratchet/dist/css/ratchet.css" rel="stylesheet">
    <link href="/wx/web/ratchet/dist/css/ratchet-theme-ios.css" rel="stylesheet">

    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left"></a>
      <a class="icon icon-compose pull-right"></a>
      <h1 class="title">Title</h1>
    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
      <p class="content-padded">Thanks for downloading Ratchet. This is an example HTML page that's linked up to compiled Ratchet CSS and JS, has the proper meta tags and the HTML structure. Need some more help before you start filling this with your own content? Check out some Ratchet resources:</p>

        <ul class="table-view">
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/64x64">
              <div class="media-body">
                Item 1
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore. Lorem ipsum dolor sit amet.</p>
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/64x64">
              <div class="media-body">
                Item 1
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore. Lorem ipsum dolor sit amet.</p>
              </div>
            </a>
          </li>
          <li class="table-view-cell media">
            <a class="navigate-right">
              <img class="media-object pull-left" src="http://placehold.it/64x64">
              <div class="media-body">
                Item 1
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore. Lorem ipsum dolor sit amet.</p>
              </div>
            </a>
          </li>
        </ul>
        
        
        
        <ul class="table-view">
          <li class="table-view-cell">
            Item 1
            <div class="toggle">
              <div class="toggle-handle"></div>
            </div>
          </li>
          <li class="table-view-cell">
            Item 2
            <div class="toggle active">
              <div class="toggle-handle"></div>
            </div>
          </li>
          <li class="table-view-cell">
            Item 3
            <div class="toggle">
              <div class="toggle-handle"></div>
            </div>
          </li>
        </ul>
        
        
    </div>

      
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
      
  </body>
</html>