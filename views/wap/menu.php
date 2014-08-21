<div data-role="panel" id="menu" data-position="right" data-display="overlay">

 
  <!--
   <h3>主菜单</h3>
  <ul data-role="listview" data-filter="true" data-filter-placeholder="Search fruits..." data-inset="true">
  -->   
  <!--
   <ul data-role="listview" data-inset="true">
      <li><a href="index.php">page1</a></li>
      <li><a href="page2.php">page2</a></li>
      <li><a href="page3.php">page3</a></li>
      <li><a href="#">Cranberry</a></li>
      <li><a href="#">Grape</a></li>
      <li><a href="#">Orange</a></li>

  </ul>
  -->

  <!--
<div data-role="collapsibleset">
  <div data-role="collapsible">
  <h2>选套餐</h2>
      <ul data-role="listview">
          <li><a href="index.php">自由组合套餐</a></li>
          <li><a href="page2.php">沃派校园卡</a></li>
          <li><a href="page3.php">微信沃卡</a></li>
      </ul>
  </div>
  <div data-role="collapsible">
  <h2>选手机</h2>
      <ul data-role="listview">
          <li><a href="index.html">iPhone 4S 8G</a></li>
          <li><a href="index.html">HTC</a></li>
          <li><a href="index.html">CoolPad K1</a></li>
      </ul>
  </div>
  <div data-role="collapsible">
  <h2>选号码</h2>
      <ul data-role="listview">
          <li><a href="index.html">精选靓号</a></li>
      </ul>
  </div>
  <div data-role="collapsible">
  <h2>沃服务</h2>
      <ul data-role="listview">
          <li><a href="index.html">...</a></li>
      </ul>
  </div>
</div>
-->


<ul data-role="listview" data-inset="false" data-divider-theme="a" class="ui-nodisc-icon ui-alt-icon">
  <li data-role="list-divider">选套餐</li>
  <li><a href="index.php">自由组合套餐</a></li>
  <li><a href="page2.php">沃派校园卡</a></li>
  <li><a href="page3.php">微信沃卡</a></li>
  <li data-role="list-divider">选手机</li>
  <li><a href="index.html">iPhone 4S 8G</a></li>
  <li><a href="index.html">HTC</a></li>
  <li><a href="index.html">CoolPad K1</a></li>

  <li data-role="list-divider">选号码</li>
  <li><a href="index.html">精选靓号</a></li>

  <li data-role="list-divider">沃服务</li>
  <li><a data-ajax=false href="<?php echo Yii::$app->getRequest()->baseUrl.'/../views/wap/games/2048/index.php'?>">游戏2048</a></li>
</ul>



</div><!-- end of menu panel-->