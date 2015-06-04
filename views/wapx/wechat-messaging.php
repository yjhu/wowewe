<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$messages = \app\models\WechatMessage::find()
        ->where(['sender_id' => $wx_user->id])
        ->orderBy(['send_time'=>SORT_DESC])
        ->limit(20)
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
            <ul class="table-view">
            <?php 
            foreach($messages as $message) { 
                $message_sender = $wx_user;
                $message_reciever = \app\models\MUser::findOne(['id' => $message->reciever_id]);
            ?>
                <li class="table-view-cell media">
                    <img class="media-object pull-right" width=24px src="<?= $message_sender->headImgUrl ?>">
                    <div class="media-body">
                    TO: <?= emoji_unified_to_html(emoji_softbank_to_unified($message_reciever->nickname)); ?>  
                    <p>发送时间：<?= $message->send_time ?></p>
                    <p><?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content))?></p>
                    <p>接受时间：<?= $message->recieve_time ?></p>
                    </div>                    
                </li>
            <?php } ?>
            </ul>
            <div>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div>
        </div>
        <!------------------- END OF CONTENT ---------------------------------->

        <!------------------- BEGIN OF FOOTER --------------------------------->
        <div class="bar bar-footer-secondary">
            <textarea id="message-content" rows="3" placeholder="请输入消息文本，最多500字。"></textarea>
        </div>
        <div class="bar bar-footer">
            <button id="message-submit" class="btn btn-block btn-positive"><i class="fa fa-weixin"></i>&nbsp;发送</button>
        </div>
        <!------------------- END OF FOOTER ----------------------------------->
    </body>
    <script>
        $(document).ready(function() {
            'use strict';           
            
            $('#message-submit').click(function() {
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
                            $('#message-content').val('');
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
