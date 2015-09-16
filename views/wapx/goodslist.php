<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
    use app\models\MOrder;
    use app\models\MGoods;
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
      .goodsitem{
          color:#aaaaaa;
          font-size: 11pt;
      }

      .goodprice
      {
          font-size: 14px;
          color:#000;
          font-weight:  bolder;
      }
      .goodrmb
      {
          font-size: 12px;
          color:#000;
      }

      .goodpriceold {
        color: #aaaaaa;
        font-size: 12px;
        text-decoration: line-through;
      }
              
      .jiang {
          color: #aaaaaa;
          font-size: 12px;
          font-weight: bolder;
      }
    </style>
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
          <h1 class="title">
          <?php if($goods_kind == 1) { ?>
              特价手机
          <?php } else if($goods_kind == 2) { ?>
              老用户专享
          <?php } else if($goods_kind == 3) { ?>
              惠购流量包
          <?php } else if($goods_kind == 4) { ?>
              活动宣传产品
          <?php } else { ?>
              商品列表
          <?php } ?>
          </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <br>
        <p>
          
        </p>

       <ul class="table-view">
   
          <?php foreach($goods as $good) {  ?>

            <li class="table-view-cell media">
              <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['goods', 'goods_id'=>$good->goods_id, 'goods_kind'=>$goods_kind],true) ?>">

                <img class="media-object pull-left" src="<?php echo $good->list_img_url ?>" width="64" height="64">
               
                <div class="media-body">
                  <p><span class="goodsitem"><?= $good->title; ?></span>&nbsp;&nbsp;</p>

                  <p><span class="goodsitem"><?= mb_substr($good->descript,0,28,'utf-8'); ?> ...</span>&nbsp;&nbsp;</p>

                  <p>
                      <sapn class="goodrmb">￥</sapn>
                      <sapn class="goodprice"><?= $good->price ?>元</sapn>
                      &nbsp;&nbsp;
                      <?php if($good->price_old != 0) { ?>
                        &nbsp;
                        <span class='jiang'>直降&#8595; ￥<?= $good->price_old-$good->price  ?></span>
                      <?php } ?>
                  </p>
                </div> 
              </a>
            </li>

            <?php } ?>
        </ul>
        &nbsp;<br>&nbsp;<br>&nbsp;<br> 

    </div>



    <script type="text/javascript">

    </script>
  </body>
</html>