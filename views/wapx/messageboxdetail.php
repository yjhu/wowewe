<?php
  use yii\helpers\Html;
    use yii\helpers\Url;
    use app\models\U;
    use app\models\MUser;
    use app\models\MOrder;

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
    <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
      .orderitem{
          color:#aaaaaa;
          font-size: 11pt;
      }
    </style>
  
    <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include the compiled Ratchet JS -->
    <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
  </head>
  <body>

    <!-- Make sure all your bars are the first things in your <body> -->

    <header class="bar bar-nav">
      <a data-ignore="push" class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre()"></a>
      <h1 class="title">
       消息中心
      </h1>

    </header>

    <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
    <div class="content">
        <br>

       <ul class="table-view" id="ul-body">
      
            <li class="table-view-cell media">
                <a data-ignore="push" class="navigate-right" href="<?php echo  Url::to(['messageboxdetail', 'msg_id'=>1],true) ?>">
                <div class="media-body">
                  <p><span class="orderitem">标题</span>&nbsp;&nbsp;渠道竞赛评比打分开始了</p>
                  <p><span class="orderitem">作者</span>&nbsp;&nbsp;市场部</p>
                  <p><span class="orderitem">时间</span>&nbsp;&nbsp;2015-7-8 12:00:00</p>

                  <p>&nbsp;</p>

                  <p><span class="orderitem">详情</span>&nbsp;&nbsp;...</p>
                </div> 
                </a>

                <!--
                <a data-ignore="push" class="btn btn-link pull-right" id="messageItem"><i class="fa fa-eye li-body fa-2x" style="color:#629BD2" msg_id="1"></i></a>
                -->
            </li>

        </ul>

          <a class="btn btn-block" href="javascript:history.back();">返回</a>
          &nbsp;<br>&nbsp;<br> 

    </div>



    <script type="text/javascript">

        function back2pre()
        {
          //alert("back!");
          //location.href = "<//?php echo Url::to(['hyzx3', 'gh_id'=>$staff->gh_id, 'openid'=>$staff->openid]) ?>";
        }


        $(document).ready(function () {

            /*
            $('#ul-body').on('click', '.li-body', function (e) {
                var msg_id = $(e.target).attr('msg_id');
                alert(msg_id);
                //$("#messagedetail").open();
                location.href="#messagedetail";
            });
            */


        });

    </script>
  </body>
</html>