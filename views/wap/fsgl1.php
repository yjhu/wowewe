<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MStaff;
    
?>

<?php
  include('../models/utils/emoji.php');
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
    <link href="/wx/web/ratchet/dist/css/ratchet.css?v11" rel="stylesheet">

  
    <link href="./php-emoji/emoji.css" rel="stylesheet">


    <style type="text/css">

      .btn {
        border-radius: 0 ;
      }

    </style>

    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>

    <script src="/wx/web/js/jquery.touchSwipe.min.js"></script>
   
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">

      <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>

      <h1 class="title">
      <!--
      <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
      -->
       粉丝管理
      </h1>

    </header>


    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
    <p class="content-padded">
      <table width="100%" border=0 style="padding:3px;text-align:center">
      <tr>

        <td width=100%>
          <button class="btn btn-positive btn-block">
    
              <?= $office->title ?>粉丝总数
              <br>
              <span style="font-size:48px;font-weight:bolder;vertical-align: middle;">
              <?= $office->getWechatFanCount(); ?>
              </span>

        </button>
        </td>
      </tr>
      </table>

    </p>



    <input type="search" id="searchStr"  placeholder="按姓名、手机号、关注时间查找粉丝">

    <ul class="table-view" id="ul-content">

        <?php 
            foreach ($office->wechatFans as $fan) 
            { 
             
        ?>

        <li class="table-view-cell media">
        <a data-ignore="push" class="navigate-right" href="<?php echo Url::to(['fsgl2','id'=>$fan->id]) ?>">
        <img class="media-object pull-left" src="<?= empty($fan->headimgurl)?'../web/images/wxmpres/headimg-blank.png':$fan->headimgurl ?>" width="64" height="64">
        <div class="media-body">
          <!--粉丝昵称--> 
          <?= emoji_unified_to_html(emoji_softbank_to_unified($fan->nickname)) ?>
          <p>

            地区 <?= $fan->country ?> <?= $fan->province ?> <?= $fan->city ?>
            <br>
            绑定手机 <?= $fan->mobile ?>
            <br>
            关注时间 <?= $fan->create_time ?>
     
            <br>
        
            <!-- <span style="color:red">已取消关注</span> -->
          </p>
        </div>
        </a>
        </li>
        <?php } ?>
      

    </ul>

    </div><!-- end of content -->


  <script type="text/javascript">
  //var ul-content;
  //alert($("#ul-content").html());
  var count = 0;
  var office_id = "<?= $office->office_id ?>";

  function load_data2(i, n)
  {
    count++;
    //alert(n.staff_id);

    text ="<li class=\"table-view-cell media\">"+
            "<a data-ignore='push' class='navigate-right' href=/wx/web/index.php?r=wap/fsgl2&id="+n.id+"&searchStr="+$("#searchStr").val()+">"+
            "<div class=\"media-body\">"+
            n.nickname+
            "<p>"+
            "手机号码 "+n.mobile+
            "<br>"+
            "关注时间 "+n.create_time+
            "</p>"+
            "</div>"+
            "</a>"+
            "</li>";

    $("#ul-content").append(text);
  }

  function fsglchaxunajax(office_id,searchStr)
  {
      //alert('czhm'+czhm+'czje'+czje);
      $.ajax({
      url: "<?php echo Url::to(['wap/fsglchaxunajax'],true); ?>",
      type:"GET",
      cache:false,
      dataType:"json",
      data: "office_id="+office_id+"&searchStr="+searchStr,
      success: function(t){

              if(t.code==0)
              {
                  //var url = "<//?//php echo Url::to(['hyzx1'],true) ?>";
                  //location.href = url+'&gh_id=<//?//= $user->gh_id ?>&openid<//?//= $user->openid ?>';
                  //alert("query ok");
                  //$("#ul-content").hide();
                  //$("#ul-content").html("<p>没有找到哟 :( </p");
                  $("#ul-content").html("");
                  $.each(t.data, load_data2);
              }
              else
              {
                alert('error');
              }

        },
        error: function(){
          alert('error!');
        }
    });

    return false;
  }

  $(document).ready(function(){


      $('#searchStr').change(function() {
          //ajax 
          //alert($('#searchStr').val());
          var searchStr = $('#searchStr').val();

          fsglchaxunajax(office_id,searchStr);
          return false;
      }); 


  })


  function back2pre()
  {
     location.href = "<?php echo Url::to(['hyzx3']) ?>";
  }


  </script>

  </body>
</html>