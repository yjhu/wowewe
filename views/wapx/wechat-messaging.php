<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$messages = \app\models\WechatMessage::find()
        ->where(['sender_id' => $wx_user->id])
        ->orWhere(['reciever_id' => $wx_user->id])
        ->orderBy(['send_time'=>SORT_DESC])
        ->limit(50)
        ->orderBy(['send_time' => SORT_ASC])
        ->all();
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
        <style>
            .bar-footer-secondary {
                border-top: 0;
                height: 65px;
            }
            .bar-footer {
                border-top: 0;
            }

            .table-view-cell {
              position: relative;
              padding: 1px 11px 1px 15px;
              overflow: hidden;
              border-bottom: 0px solid #ddd;
            }

            .table-view {

              border-top: 0px solid #ddd;
              border-bottom: 0px solid #ddd;
            }

            .s1{
                margin: 0.1em 0px; padding: 0px; border: 0px; font-family: 微软雅黑; font-size: 13px; white-space: normal; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; text-align: right; word-wrap: break-word !important; background-color: rgb(255, 255, 255);
            }
            .s2{
                margin: 11px 0px 0px; padding: 0px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; width: 300px; border-radius: 0px; text-align: left; word-wrap: break-word !important; color:#ccc;
            }
            .s3{
                margin: 0px; padding: 0px; border: 0px rgb(180, 235, 124); display: inline-block; box-sizing: border-box; max-width: 100%; width: 256px; font-size: 1em; font-family: inherit; text-align: inherit; text-decoration: inherit; word-wrap: break-word !important;
            }
            .s4{
                margin: 1px 0px 0px; padding: 16px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; width: 234.59px; border-radius: 16px; text-align: left; word-wrap: break-word !important; background-color: rgb(180, 235, 124);
            }
            .s5{
                margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; word-wrap: break-word !important;
            }
            .s6{
                margin: 29px 0px 0px; padding: 0px; border: 0px; box-sizing: border-box; vertical-align: top; max-width: 100%; word-wrap: break-word !important; background-color: rgb(180, 235, 124);
            }
            .s7{
                margin: 0px; padding: 0px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; vertical-align: top; width: 48px; word-wrap: break-word !important;
            }


            .r1{
                margin: 0.2em 0px; padding: 0px; border: 0px; font-family: 微软雅黑; font-size: 13px; white-space: normal; box-sizing: border-box; color: rgb(62, 62, 62); line-height: 25px; word-wrap: break-word !important; background-color: rgb(255, 255, 255);
            }

            .r2{
                margin: 1px 90px 0px; padding: 0px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; width: 300px; border-radius: 0px; text-align: left; word-wrap: break-word !important; color:#ccc;
            }

            .r3{
                margin: 0px; padding: 0px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; width: 48px; vertical-align: top; word-wrap: break-word !important;
            }

            .r4{
                margin: 0px; padding: 0px; border: 0px rgb(210, 210, 210); display: inline-block; box-sizing: border-box; max-width: 100%; width: 276px; text-align: inherit; text-decoration: inherit; color: inherit; word-wrap: break-word !important;
            }

            .r5{
                margin: 29px 0px 0px; padding: 0px; border: 0px; box-sizing: border-box; vertical-align: top; max-width: 100%; word-wrap: break-word !important; background-color: rgb(210, 210, 210);
            }

            .r6{
                margin: 1px -6px 0px; padding: 16px; border: 0px; display: inline-block; box-sizing: border-box; max-width: 100%; width: 234.59px; border-radius: 16px; word-wrap: break-word !important; background-color: rgb(210, 210, 210);
            }

            .r7{
                margin: 0px; padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; word-wrap: break-word !important;
            }

        </style>
        <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="./php-emoji/emoji.css" rel="stylesheet">

        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    </head>
    <body>
        <!------------------- BEGIN OF HEADER --------------------------------->
        <header class="bar bar-nav">
            <?php if ($backwards) { ?>
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
            <?php } ?>
            <h1 class="title">
                <?= emoji_unified_to_html(emoji_softbank_to_unified($reciever->nickname)) ?>
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <ul class="table-view" id='ul-body'>
            <?php 
            foreach($messages as $message) { 
                $message_sender = \app\models\MUser::findOne(['id' => $message->sender_id]);
                $message_reciever = \app\models\MUser::findOne(['id' => $message->reciever_id]);
            ?>
                <?php if($wx_user->id == $message_sender->id) {?>
                <li class="table-view-cell">
                    <fieldset class='s1'>
                        <span class='s2'>                    
                        <?= emoji_unified_to_html(emoji_softbank_to_unified($message_reciever->nickname)); ?>
                        &nbsp;
                        <?= $message->send_time ?>
                        </span>

                        <section class='s3'>
                            <section class='s4'>
                                <section class='s5'>
                                    <div class="media-body">
                                        <p style="color:#000"><?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content))?></p>
                                    </div>
                                    </section>
                                </section><img src="http://img.yead.net/201506/a5b060a038.png" class='s6'>
                            </section>
                            <section class='s7'>
                                <section style="margin: 5px 0px 0px 1px; padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; width: 48px; height: 48px; border-radius: 40px; word-wrap: break-word !important; background-image: url('<?= $message_sender->headImgUrl ?>'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></section>
                            </section>
                        </fieldset>
                </li>
                <?php } else { ?>
                 <li class="table-view-cell">
                    <fieldset class='r1'>
                    <span class='r2'>        
                        <?= $message->send_time ?>
                    </span>

                    <section style="" class='r3'>
                        <section style="padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; width: 48px; height: 48px; border-radius: 40px; word-wrap: break-word !important; background-image: url('<?= $message_sender->headImgUrl ?>'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></section>
                    </section>
                    <section style="" class='r4'>
                        <img src="http://img.yead.net/201506/08c12cfe03.png" class='r5'>
                        <section class='r6'>
                            <section style="" class='r7'>
                                  <div class="media-body">
                                 <p style="color:#000"><?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content))?></p>
                                </div> 
                            </section>
                        </section>
                    </section>
                </fieldset>
                </li>
                <?php } ?>




            <?php } ?>
            </ul>
            <div>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div>
        </div>
        <!-- ######################END OF CONTENT###################### -->

        <!-- ######################BEGIN OF FOOTER###################### -->
        <div class="bar bar-footer-secondary">
            <textarea id="message-content" rows="3" placeholder="请输入消息文本，最多500字。"></textarea>
        </div>
        <div class="bar bar-footer">
            <button id="message-submit" class="btn btn-block btn-positive"><i class="fa fa-weixin"></i>&nbsp;发送</button>
        </div>
        <!-- ######################END OF FOOTER###################### -->
    </body>
    <script>
 
        $(document).ready(function() {
            'use strict';           
            
            alert("ready");
            $('#message-submit').click(function() {
                 alert("click");
                var content = $('#message-content').val();
                if ('' !== content) {
                    var args = {
                        'classname':    '\\app\\models\\WechatMessage',
                        'funcname':     'sendMessageAjax',
                        'params':       {
                            'sender_id':    '<?= $wx_user->id; ?>',
                            'receiver_id':  '<?= $reciever->id; ?>',                   
                            'content_type':  '<?= \app\models\WechatMessageContent::MSGTYPE_TEXT ?>',
                            'content':       content
                        } 
                    };
                    
//                    alert('AJAX sending message.');
                    $.ajax({
                        url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                        type:       "GET",
                        cache:      false,
                        dataType:   "json",
                        data:       "args=" + JSON.stringify(args),
                        success:    function() {
                            alert('发送成功。');
                            /*
                            var now = new Date();
                          
                            var sendMsgStr= "<li class='table-view-cell'>"+
                                "<fieldset class='s1'>"+
                                "<span class='s2'>"+                    
                   
                                "&nbsp;"+
                                now.getYear()+"-"+now.getMonth()+"-"+now.getDate() + " " + now.getHours()+":"+now.getMinutes()+
                                "</span>"+
                                "<section class='s3'>"+
                                "<section class='s4'>"+
                                "<section class='s5'>"+
                                "<div class='media-body'>"+
                                "<p style='color:#000'>"+$('#message-content').val()+"</p>"+
                                "</div>"+
                                "</section>"+
                                "</section><img src='http://img.yead.net/201506/a5b060a038.png' class='s6'>"+
                                "</section>"+
                                "</fieldset>"+
                                "</li>";

                                $("#ul-body").append(sendMsgStr);
                                */

                                $('#message-content').val('');

                                location.reload();
                            /**/

                        },                        
                        error:      function(){
                            alert('发送失败。');
                        }
                    });
                }
            });
        });
    </script>
</html>
