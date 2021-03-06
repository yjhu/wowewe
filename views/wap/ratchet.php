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

       <a href="#myPopover">
    <h1 class="title">
      Tap title
      <span class="icon icon-caret"></span>
    </h1>
  </a>
      
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
        
        <br>

      <form class="input-group">
      <input type="text" placeholder="Full name">
      <input type="email" placeholder="Email">
      <input type="text" placeholder="Username">
      </form>
      <br>

      <button class="btn">
        <span class="icon icon-search"></span>
        Button
      </button>
      <button class="btn btn-primary">
        <span class="icon icon-search"></span>
        Button
      </button>
      <button class="btn btn-positive">
        <span class="icon icon-search"></span>
        Button
      </button>
      <button class="btn btn-negative">
        <span class="icon icon-search"></span>
        Button
      </button>
      <button class="btn btn-link">
        <span class="icon icon-left"></span>
        Button
      </button>


    <br><br><br>

    <button class="btn btn-block">Block button</button>
<button class="btn btn-primary btn-block">Block button</button>
<button class="btn btn-positive btn-block">Block button</button>
<button class="btn btn-negative btn-block">Block button</button>

<button class="btn btn-block btn-outlined">Block button</button>
<button class="btn btn-primary btn-block btn-outlined">Block button</button>
<button class="btn btn-positive btn-block btn-outlined">Block button</button>
<button class="btn btn-negative btn-block btn-outlined">Block button</button>

<br><br>&nbsp;

<div class="segmented-control">
  <a class="control-item active" href="#item1mobile">
    手机
  </a>
  <a class="control-item" href="#item2mobile">
    号卡
  </a>
  <a class="control-item" href="#item3mobile">
    配件
  </a>
</div>
<div class="card">
  <span id="item1mobile" class="control-content active">各种手机终端</span>
  <span id="item2mobile" class="control-content">更多靓号</span>
  <span id="item3mobile" class="control-content">大量手机配件</span>
</div>
<br><br>&nbsp;

<div class="slider" id="mySlider">
  <div class="slide-group">
    <div class="slide">
      <img width="100%" src="/wx/web/images/item/iphone6-700x500-1.jpg">
      <span class="slide-text">
        <span class="icon icon-left-nav"></span>
        Slide me
      </span>
    </div>
    <div class="slide">
       <img width="100%" src="/wx/web/images/item/iphone6-700x500-2.jpg">
    </div>
    <div class="slide">
      <img width="100%" src="/wx/web/images/item/iphone6-700x500-3.jpg">
    </div>
  </div>
</div>
<br><br>&nbsp;



  <div id="myPopover" class="popover">
  <header class="bar bar-nav">
    <h1 class="title">Popover title</h1>
  </header>
  <ul class="table-view">
    <li class="table-view-cell">Item1</li>
    <li class="table-view-cell">Item2</li>
    <li class="table-view-cell">Item3</li>
    <li class="table-view-cell">Item4</li>
    <li class="table-view-cell">Item5</li>
    <li class="table-view-cell">Item6</li>
    <li class="table-view-cell">Item7</li>
    <li class="table-view-cell">Item8</li>
  </ul>
</div>

<h5>营业厅</h5>
<select>
<option>sample #1</option>
<option>sample #2</option>
<option>sample #3</option>
<option>sample #4</option>
<option>sample #5</option>
<option>sample #6</option>
</select>

<br>

<input type="radio" name="student" value="学生" checked="checked" />学生 
<input type="radio" name="teacher" value="教师" />教师 
<input type="radio" name="manager" value="管理员" />管理员
<br>


<input type="checkbox" name="test" />圣诞节  
<input type="checkbox" name="test" />股市
<input type="checkbox" name="test" />阿凡达  
<input type="checkbox" name="test" />十月围城
<input type="checkbox" name="test" />水价上调
<br>



<br><br>&nbsp;
<br><br>&nbsp;

<div class="content-padded">
  <span class="icon icon-back"></span>
  <span class="icon icon-bars"></span>
  <span class="icon icon-caret"></span>
  <span class="icon icon-check"></span>
  <span class="icon icon-close"></span>
  <span class="icon icon-code"></span>
  <span class="icon icon-compose"></span>
  <span class="icon icon-download"></span>
  <span class="icon icon-edit"></span>
  <span class="icon icon-forward"></span>
  <span class="icon icon-gear"></span>
  <span class="icon icon-home"></span>
  <span class="icon icon-info"></span>
  <span class="icon icon-list"></span>
  <span class="icon icon-more-vertical"></span>
  <span class="icon icon-more"></span>
  <span class="icon icon-pages"></span>
  <span class="icon icon-pause"></span>
  <span class="icon icon-person"></span>
  <span class="icon icon-play"></span>
  <span class="icon icon-plus"></span>
  <span class="icon icon-refresh"></span>
  <span class="icon icon-search"></span>
  <span class="icon icon-share"></span>
  <span class="icon icon-sound"></span>
  <span class="icon icon-sound2"></span>
  <span class="icon icon-sound3"></span>
  <span class="icon icon-sound4"></span>
  <span class="icon icon-star-filled"></span>
  <span class="icon icon-star"></span>
  <span class="icon icon-stop"></span>
  <span class="icon icon-trash"></span>
  <span class="icon icon-up-nav"></span>
  <span class="icon icon-up"></span>
  <span class="icon icon-right-nav"></span>
  <span class="icon icon-right"></span>
  <span class="icon icon-down-nav"></span>
  <span class="icon icon-down"></span>
  <span class="icon icon-left-nav"></span>
  <span class="icon icon-left"></span>
</div>



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