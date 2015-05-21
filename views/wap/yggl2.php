<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\U;
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

            <a class="icon icon-left-nav pull-left" id="btn_back" onclick="back2pre();"></a>

            <h1 class="title">
                <!--
                <img src="../web/images/comm-icon/iconfont-liwu.png?v5" width="18">&nbsp;
                -->
                员工管理
            </h1>

        </header>

        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <p class="content-padded">
            <table width="100%" border=0 style="padding:3px;text-align:center">
                <tr>
                    <td width=100%>
                        <a class="btn btn-positive btn-block" href="#showQr">
                            <?= $outlet->title ?>员工
                            <br>
                            <span style="font-size:48px;font-weight:bolder">
                                <?= $entity->name ?>

                                <img src="../web/images/woke/qr.png" width=24px>
                            </span>

                        </a>
                    </td>
                </tr>
            </table>

        </p>

        <div class="input-group">
            <!--
            <div class="input-row">
              <label style="color:#777777">姓名</label>
              <input type="text" value="<//?//= $entity->name ?>" id="ygxm">
            </div>
            -->

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
    
            <?php
              if (!empty($entity->wechat) && !empty($entity->wechat->headimgurl)) {
                  $wx_nickname = $entity->wechat->nickname;
                  $wx_mobile = $entity->wechat->getBindMobileNumbersStr();
                  $wx_country = $entity->wechat->country;
                  $wx_province = $entity->wechat->province;
                  $wx_city = $entity->wechat->city;
              } else {
                  $wx_nickname = "";
                  $wx_mobile = "";
                  $wx_country = "";
                  $wx_province = "";
                  $wx_city = "";
              }
            ?>

            <p class="content-padded">微信信息 </p>

            <div class="input-row">
                <label style="color:#777777">昵称</label>
                <input type="text" value="<?= $wx_nickname ?>" readonly>
            </div>
            <div class="input-row">
                <label style="color:#777777">地区</label>
                <input type="text" value="<?= $wx_country ?> <?= $wx_province ?> <?= $wx_city ?>" readonly>
            </div>
            <div class="input-row">
                <label style="color:#777777">绑定手机</label>
                <input type="text" value="<?= $wx_mobile ?>" readonly>
            </div>

            <br>
            <?php if ($is_agent) { ?>
                <button class="btn btn-positive btn-block" style="border-radius:3px" id="btnEdit" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->agent_id ?>">修改</button>
                <button class="btn btn-negative btn-block" style="border-radius:3px" id="btnDel" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->agent_id ?>">删除</button>
            <?php } else { ?>
                <button class="btn btn-positive btn-block" style="border-radius:3px" id="btnEdit" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->employee_id ?>">修改</button>
                <button class="btn btn-negative btn-block" style="border-radius:3px" id="btnDel" outlet_id="<?= $outlet->outlet_id ?>" is_agent="<?= $is_agent ?>" entity_id="<?= $entity->employee_id ?>">删除</button>
            <?php } ?>
            <button class="btn btn-block" style="border-radius:3px" onclick="back2pre();">返回</button>

        </div>

    </div><!-- end of content -->

    <div id="showQr" class="modal">
        <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#showQr"></a>
            <h1 class="title"><?= $entity->name ?>的推广二维码</h1>
        </header>

        <div class="content">

            <center>

                <?php
                if (!empty($entity->wechat))
                    echo Html::img($entity->wechat->getQrImageUrl(), ['style' => 'display: block;max-width:100%;height: auto;']);
                ?>

                <br><br>

                &nbsp;
            </center>

            <a class="btn btn-block" href="#showQr">返回</a>
        </div>
    </div>

    <script type="text/javascript">

        var yuangongFlag = 1;


        function ygglshanchuajax()
        {
            //alert('czhm'+czhm+'czje'+czje);
            $.ajax({
                url: "<?php echo Url::to(['wap/ygglshanchuajax'], true); ?>",
                type: "GET",
                cache: false,
                dataType: "json",
                data: "is_agent=" + is_agent + "&entity_id=" + entity_id + "&outlet_id=" + outlet_id,
                success: function (t) {

                    if (t.code == 0)
                    {
                        var url = "<?php echo Url::to(['yggl1'],true) ?>";
                        location.href = url + '&outlet_id=' + outlet_id;
                        //                    alert("delete ok");
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


        function ygglxiugaiajax()
        {
            //alert('czhm'+czhm+'czje'+czje);
            $.ajax({
                url: "<?php echo Url::to(['wap/ygglxiugaiajax'], true); ?>",
                type: "GET",
                cache: false,
                dataType: "json",
                data: "is_agent=" + is_agent + "&outlet_id=" + outlet_id + "&entity_id=" + entity_id + "&mobile=" + mobile + "&position=" + position,
                success: function (t) {

                    if (t.code == 0)
                    {
                        var url = "<?php echo Url::to(['yggl2'], true) ?>";
                        location.href = url + '&is_agent=' + is_agent + '&entity_id=' + entity_id + '&outlet_id=' + outlet_id;                       
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


        function back2pre()
        {
            location.href = "<?php echo Url::to(['yggl1', 'outlet_id' => $entity->outlets[0]->outlet_id]) ?>";
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


            $('#btnDel').click(function () {
                is_agent = $(this).attr('is_agent');
                entity_id = $(this).attr('entity_id');
                outlet_id = $(this).attr("outlet_id");
                if (!confirm("删除这个员工，确定?"))
                    return false;

                ygglshanchuajax();
                return false;
            });

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
