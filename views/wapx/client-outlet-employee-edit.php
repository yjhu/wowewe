<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;

$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
\Yii::$app->wx->setGhId($wx_user->gh_id);
$gh = \Yii::$app->wx->getGh();
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
        <link href="/wx/web/ratchet/dist/css/ratchet.css?v12" rel="stylesheet">

        <link href="./php-emoji/emoji.css" rel="stylesheet">


        <style type="text/css">

            .btn {
                border-radius: 0 ;
            }

            .btn1 {
                border-radius: 2px ;
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

            <?php if ($backwards) { ?>
              <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                  <span class="icon icon-left-nav"></span>
              </a>
            <?php } ?>

            <h1 class="title">
                员工信息修改
            </h1>

        </header>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <p class="content-padded"><?= $outlet->title ?>员工 <?= $entity->name ?> </p>
        <div class="input-group">
 
            <div class="input-row">
                <label style="color:#777777">手机号码</label>
                <input type="text" value="<?= implode(',', $entity->mobiles) ?>"  id="ygsjhm">
            </div>

            <div class="input-row">
                <label style="color:#777777">职位</label>
                <input type="text" value="<?= $entity->getOutletPosition($outlet->outlet_id) ?>" id="ygzw">
            </div>
<!--
            <p class="content-padded"> </p>
            <div class="input-row">
              <label style="color:#777777">联通员工</label>

                  <div class="toggle pull-left" id="myToggle">
                  <div class="toggle-handle"></div>
                  </div>
            </div>
-->
    
            <br>
            <?php if ($is_agent) { ?>
                <button class="btn btn-positive btn-block" style="border-radius:3px" id="btnEdit" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->agent_id ?>">修改</button>

            <?php } else { ?>
                <button class="btn btn-positive btn-block" style="border-radius:3px" id="btnEdit" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->employee_id ?>">修改</button>

            <?php } ?>

        </div>

    </div><!-- end of content -->


    <script type="text/javascript">

        var yuangongFlag = 1;

        function ygglxiugaiajax()
        {
            $.ajax({
                url: "<?php echo Url::to(['wap/ygglxiugaiajax'], true); ?>",
                type: "GET",
                cache: false,
                dataType: "json",
                data: "is_agent=" + is_agent + "&outlet_id=" + outlet_id + "&entity_id=" + entity_id + "&mobile=" + mobile + "&position=" + position,
                success: function (t) {

                    if (t.code == 0)
                    {
                        var url = "<?php echo \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid); ?>";
                        location.href = url;                       
                    }
                    else
                    {
                        alert('error');
                    }

                },
                error: function () {
                    alert('error!');
                }
            });

            return false;
        }



        $(document).ready(function () {

            if(yuangongFlag == 1)/*联通员工，checked*/
            {
              $("#myToggle").attr("class", "toggle active pull-left");
            }
            else
            {
              $("#myToggle").attr("class", "toggle pull-left");
            }


            $('#btnEdit').click(function () {
                is_agent = $(this).attr('is_agent');
                entity_id = $(this).attr('entity_id');
                outlet_id = $(this).attr("outlet_id");
                
                mobile   = $("#ygsjhm").val();
                position = $("#ygzw").val();
         
                var usermobileReg = /(^(1)\d{10}$)/;
                if((usermobileReg.test(mobile) === false) || (mobile == ""))
                {
                  alert("手机号码不正确，\n请重新填写。");
                  return  false;
                }
          
                if (!confirm("修改这个员工，确定?"))
                    return false;

                ygglxiugaiajax();
                return false;
            });


            $('#myToggle').click(function(){
                    if ($('#myToggle').hasClass('active'))
                    {
                      yuangongFlag = 1;
                      //alert("内部员工:" + yuangongFlag);
                    }
                    else
                    {
                      yuangongFlag = 0;
                      //alert("不是内部员工:" + yuangongFlag);
                    }
            });

            $("#myToggle").swipe( {
              //Generic swipe handler for all directions
              threshold: 30,
              swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                //$(this).text("You swiped " + direction );  
                    if ($('#myToggle').hasClass('active'))
                    {
                      yuangongFlag = 1;
                      //alert("内部员工:" + yuangongFlag);
                    }
                    else
                    {
                      yuangongFlag = 0;
                      //alert("不是内部员工:" + yuangongFlag);
                    }
              }
            });





        })



    </script>

</body>
</html>
