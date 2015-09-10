<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
use app\models\MOrder;
use app\models\MGoods;
use app\models\MOffice;
use app\models\MUser;
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
        .gooditem{
        color:#aaaaaa;
        font-size: 11pt;
        }
        .goodprice
        {
            font-size: 18px;
            color:#ff8600;
            font-weight:  bolder;
        }
        .goodpriceold {
          color: #aaaaaa;
          font-size: 12px;
          text-decoration: line-through;
        }
        .goodrmb
        {
            font-size: 12px;
            color:#ff8600;
        }   
        .jiang {
            color: #aaaaaa;
            font-size: 12px;
            font-weight: bolder;
        }

        img {
          width:100%;
          display:block;
        }

        .swiper-container, .swiper-slide {
        width: 100%;
        height: 260;
        color: #fff;
        text-align: center;
        }
        /*
        .swiper-slide .title {
        font-style: italic;
        font-size: 42px;
        margin-top: 80px;
        margin-bottom: 0;
        line-height: 45px;
        }
        */
        .pagination {
        position: absolute;
        z-index: 20;
        left: 10px;
        bottom: 0px;
        }
        .swiper-pagination-switch {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 8px;
        background: #ccc;
        margin-right: 5px;
        opacity: 0.8;
        border: 1px solid #fff;
        cursor: pointer;
        }
        .swiper-visible-switch {
        background: #fff;
        }
        .swiper-active-switch {
        background: #ff4c01;
        }     
    </style>


    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    <script src="/wx/web/js/jqm/idangerous.swiper.min.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>
      <h1 class="title">
       <?= $good->title; ?>
      </h1>
    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">

      <!--
      <img width=100% height=240 class="media-object pull-left" src="<//?= $order->item->pic_url ?>">
      -->
      <div class="swiper-container" style="height:300px">
        <div class="swiper-wrapper" >
          <?php
                $n = 0;
                $imgs = $good->body_img_url;
                $imgUrls = explode(";",$imgs);
                foreach($imgUrls as $imgUrl) {
                    $n++;
                    if($n == count($imgUrls)) break;
            ?>
                <div class="swiper-slide">
                <img id='transparent' width="100%" src="<?php echo  $imgUrl; ?>" alt=""/>
                </div>
            <?php } ?>
         
        </div>
        <div class="pagination"></div>
      </div>

        <span>
          <ul class="table-view">
            <li class="table-view-cell">
              <sapn class="goodrmb">￥</sapn>
              <sapn class="goodprice"><?= $good->price ?>元</sapn>
              &nbsp;&nbsp;
              <sapn class="goodpriceold">原价 ￥<?= $good->price_old ?>元</sapn>
              <?php if($good->price_old != 0) { ?>
                &nbsp;
                <span class='jiang'>直降&#8595;: ￥<?= $good->price_old-$good->price  ?></span>
              <?php } ?>
            </li>
            <li class="table-view-cell"><span class="gooditem"><?= $good->descript ?></span></li>
          </ul>
        </span>

        <p>商品详情</p>
        <p><?= $good->detail ?></p>

        &nbsp;&nbsp;<br>
        &nbsp;&nbsp;<br>
        &nbsp;&nbsp;<br>
    </div>

  <nav class="bar bar-tab">
    <center>
       <a class="btn btn-positive" href="#yhxx" style="height:39px; width:160px; font-size:16px; line-height: 32px">立即购买</a>
    </center>
  </nav>


    <!-- 下一步窗口，收集用户信息 -->
    <div id="yhxx" class="modal">
      <header class="bar bar-nav">
        <span class="pull-left"><img src='<?= $good->list_img_url ?>' style="width:42px;height:42px"></span>
        <a class="icon icon-close pull-right" href="#yhxx"></a>
        <h1 class="title">
          <sapn class="goodrmb">￥</sapn>
          <sapn class="goodprice"><?= $good->price ?>元</sapn>
            &nbsp;
          <span class="gooditem">
          <?= $good->title ?> 
          </span>
        </h1>
      </header>

      <div class="content">
            <div class="content-padded">
            <p class="content-padded">营业厅</p>
            <p>
                <?php echo Html::dropDownList('office', 0, MOffice::getOfficeNameOption($gh_id, false),["id"=>"office"]); ?>
            </p>

            <form>
              <?php
                 $user = Muser::findOne(['openid' => $openid]);
                 $mobile = $user->getBindMobileNumbersStr();
              ?>
              <p class="content-padded">联系电话</p> 
              <input type="tel" placeholder="您的联系电话" id="usermobile" value="<?= $mobile ?>">
            </form>
            </div>
          <br>
          <center>
          <button class="btn btn-positive" id='qdBtn' style="height:39px; width:160px; font-size:16px; line-height: 32px">下一步</button>
          </center>
      </div>
    </div>


  <script type="text/javascript">

    var mySwiper = new Swiper('.swiper-container',{
      pagination: '.pagination',
      paginationClickable: true,
      slidesPerView: 1,
      autoplay: 3000,
      loop: true
    })

    function back2pre()
    {
      location.href = "<?php echo Url::to(['goodslist', 'goods_kind'=>$goods_kind],true) ?>";
    }


    $(document).ready(function(){

        $("#qdBtn").click(function(){

            cid = '<?= $good->goods_id ?>';
            prom = "";
            pkg3g4g = null;
            pkgPeriod = null;
            pkgMonthprice = null;
            pkgPlan = null;
            realFee = '<?= $good->price ?>';
            office = $("#office").val();
            selectNum = null;
            username = null;
            usermobile = $("#usermobile").val();
            userid = null;
            address = null;
            wid = '1_0_1';

            //一些数据校验 begin
            var usermobileReg = /(^(1)\d{10}$)/;
            if(usermobileReg.test(usermobile) === false)
            {
                alert("手机号码输入错误。");
                return  false;
            }

            if(office == 0)
            {
                alert("请选择为您服务的营业厅。");
                return  false;
            }
            ///一些数据校验 end

            //alert(office);

            $.ajax({
              url: "<?php echo Yii::$app->getRequest()->baseUrl.'/index.php?r=wapx/goodssave' ; ?>",
              type:"GET",
              cache:false,
              dataType:'json',
              data: "cid="+cid+"&prom="+prom+"&cardType=0"+"&pkg3g4g="+pkg3g4g+"&pkgPeriod="+pkgPeriod+"&pkgMonthprice="+pkgMonthprice+"&pkgPlan="+pkgPlan+"&feeSum="+realFee+"&office="+office+"&selectNum="+selectNum+"&username="+username+"&usermobile="+usermobile+"&userid="+userid+"&address="+address+"&wid="+wid,
              success:function(json_data){
                if(json_data.status == 0)
                {
                    //alert(json_data.oid);
                    localStorage.setItem("oid",json_data.oid);
                    localStorage.setItem("url",json_data.pay_url);

                    var url = "<?php echo Url::to(['wap/orderinfo'], true); ?>";
                    window.location.href = url+'&oid='+json_data.oid;
                }
                else
                {
                  alert("ret false!!!")
                  return false;
                }
              }
            });//end of ajax


        });

    });


  </script>


  </body>

</html>