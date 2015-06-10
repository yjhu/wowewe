<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
$messages = \app\models\WechatMessage::getRecentMessages($wx_user->id, $reciever->id);
$communicatee_ids = \app\models\WechatMessage::getUniqueCommunicateeIds($wx_user->id);
\Yii::$app->wx->setGhId($wx_user->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();
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
                height: 88px;
            }
/*
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
*/
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

            .table-view-wechat-message {
                border-top: 0px;
                border-bottom: 0px;
            }
            .table-view-cell-wechat-message {
                padding-right: 15px;
                border: 0px;
            }
            .message-time {
                font-size: 0.5em;
                color: #ccc;
            }
            .message-content {
                padding: 5px;
                border-radius: 5px; 
                max-width: 230px;
            }
            .message-content-send {
                color: black;
                background-color: #ade870;
            }
            .message-content-recieve {
                color: black;
                background-color: #ddd;
            }

        </style>
        <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="./php-emoji/emoji.css" rel="stylesheet">

        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    </head>
    <body>
        <!------------------- BEGIN OF HEADER --------------------------------->
        <header class="bar bar-nav">
            <?php if ($backwards) { ?>
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
            <?php } ?>
            <a data-ignore="push" class="btn btn-link pull-right" href="#show-communicatee"><i class="fa fa-bars" style="width:24px;"></i></a>
            <h1 class="title">
                <?= emoji_unified_to_html(emoji_softbank_to_unified($reciever->nickname)) ?>
            </h1>
        </header>
        <!------------------- END OF HEADER ----------------------------------->

        <!------------------- BEGIN OF CONTENT -------------------------------->
        <div class="content">
            <ul class="table-view table-view-wechat-message" id='ul-body'>
            <?php 
            foreach($messages as $message) { 
                $message_sender = \app\models\MUser::findOne(['id' => $message->sender_id]);
                $message_reciever = \app\models\MUser::findOne(['id' => $message->reciever_id]);
            ?>
                <?php 
                if($wx_user->id == $message_sender->id) { 
                    if (\app\models\WechatMessageContent::MSGTYPE_TEXT == $message->content->content_type) {
                ?>
                <li class="table-view-cell table-view-cell-wechat-message wechat-message-send media" id="<?= 'message-'."{$message->message_id}" ?>">
                    <img class="media-object pull-right" style="width:48px;" src="<?= $message_sender->headImgUrl ?>">
                    <div class="media-body pull-right">
                        <p class="message-content message-content-send"><?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content)) ?></p>
                        <p><span class="message-time"><?= $message->send_time ?></span></p>
                    </div>
                </li>
                <?php } else if (\app\models\WechatMessageContent::MSGTYPE_VOICE == $message->content->content_type) { ?>
                <li class="table-view-cell table-view-cell-wechat-message wechat-message-send media" id="<?= 'message-'."{$message->message_id}" ?>">
                    <img class="media-object pull-right" style="width:48px;" src="<?= $message_sender->headImgUrl ?>">
                    <div class="media-body pull-right">
                        <p class="message-content message-content-send">
                            <i  style="color:#666;" class="fa fa-volume-up fa-2x voice-playback" serverId="<?= $message->content->content; ?>"></i>
                        </p>
                        <p><span class="message-time"><?= $message->send_time ?></span></p>
                    </div>
                </li>
                <?php } ?>
                
<!--                
                <li class="table-view-cell">
                    <fieldset class='s1'>
                        <span class='s2'>                    
                        <//?= emoji_unified_to_html(emoji_softbank_to_unified($message_reciever->nickname)); ?>
                        &nbsp;
                        <//?= $message->send_time ?>
                        </span>

                        <section class='s3'>
                            <section class='s4'>
                                <section class='s5'>
                                    <div class="media-body">
                                        <p style="color:#000"><//?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content))?></p>
                                    </div>
                                    </section>
                                </section><img src="http://img.yead.net/201506/a5b060a038.png" class='s6'>
                            </section>
                            <section class='s7'>
                                <section style="margin: 5px 0px 0px 1px; padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; width: 48px; height: 48px; border-radius: 40px; word-wrap: break-word !important; background-image: url('<?= $message_sender->headImgUrl ?>'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></section>
                            </section>
                        </fieldset>
                </li>
-->
                <?php                 
                } else { 
                    if (\app\models\WechatMessageContent::MSGTYPE_TEXT == $message->content->content_type) {
                ?>
                <li class="table-view-cell table-view-cell-wechat-message wechat-message-recieve media" id="<?= 'message-'."{$message->message_id}" ?>">
                    <img class="media-object pull-left" style="width:48px;" src="<?= $message_sender->headImgUrl ?>">
                    <div class="media-body pull-left">                        
                        <p class="message-content message-content-recieve"><?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content)) ?></p>
                        <p><span class="message-time"><?= $message->send_time ?></span></p>
                    </div>
                </li>
                <?php } else if (\app\models\WechatMessageContent::MSGTYPE_VOICE == $message->content->content_type) { ?>
                <li class="table-view-cell table-view-cell-wechat-message wechat-message-recieve media" id="<?= 'message-'."{$message->message_id}" ?>">
                    <img class="media-object pull-left" style="width:48px;" src="<?= $message_sender->headImgUrl ?>">
                    <div class="media-body pull-left">                        
                        <p class="message-content message-content-recieve">
                            <i style="color:#666;" class="fa fa-volume-up fa-2x voice-playback" serverId="<?= $message->content->content ?>"></i>
                        </p>
                        <p><span class="message-time"><?= $message->send_time ?></span></p>
                    </div>
                </li>                
                <?php } ?>

<!--
                 <li class="table-view-cell">
                    <fieldset class='r1'>
                    <span class='r2'>        
                        <//?= $message->send_time ?>
                    </span>

                    <section style="" class='r3'>
                        <section style="padding: 0px; border: 0px; box-sizing: border-box; max-width: 100%; width: 48px; height: 48px; border-radius: 40px; word-wrap: break-word !important; background-image: url('<?= $message_sender->headImgUrl ?>'); background-size: cover; background-position: 50% 50%; background-repeat: no-repeat;"></section>
                    </section>
                    <section style="" class='r4'>
                        <img src="http://img.yead.net/201506/08c12cfe03.png" class='r5'>
                        <section class='r6'>
                            <section style="" class='r7'>
                                  <div class="media-body">
                                 <p style="color:#000"><//?= emoji_unified_to_html(emoji_softbank_to_unified($message->content->content))?></p>
                                </div> 
                            </section>
                        </section>
                    </section>
                </fieldset>
                </li>
-->
                <?php } ?>
            <?php } ?>
            <li id="ul-body-bottom"> 
                <br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
            </li>
            </ul>
            <div id="bottom">&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br></div>
        </div>
        <!-- ######################END OF CONTENT###################### -->
        
        <div id="show-communicatee" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#show-communicatee"></a>
                <h1 class="title">选择聊天对象</h1>
            </header>
            <div class="content">
                <ul class="table-view">
                <?php 
                    foreach($communicatee_ids as $communicatee_id) { 
                        $communicatee = \app\models\Muser::findOne(['id' => $communicatee_id]);
                ?>
                    <li class="table-view-cell media">
                        <a data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                            'wechat-messaging',
                            'gh_id'     => $wx_user->gh_id,
                            'openid'    => $wx_user->openid,
                            'reciever_id'   => $communicatee_id,
                            'backwards' => true,
                        ]); ?>">
                            <img class="media-object pull-left" src="<?= $communicatee->headImgUrl; ?>" style="width:48px;">
                            <div class="media-body">
                                <?= emoji_unified_to_html(emoji_softbank_to_unified($communicatee->nickname)) ?>
                            </div>
                        </a>
                    </li>
                   
                <?php } ?>
                </ul>
            </div>
        </div>


        <!-- ######################BEGIN OF FOOTER###################### -->
        <div class="bar bar-tab">
            <div>
                <button id="voice-start" class="btn" style="border-radius: 65px;"><i class="fa fa-microphone fa-2x"></i></button>
                <button id="voice-stop" class="btn btn-negative" style="border-radius: 65px;display:none;"><i class="fa fa-microphone-slash fa-2x"></i></button>

                <input id="message-content" style="max-width:70%; border-top:0px; border-left:0px; border-right:0px; height:44px" type="text" placeholder="">
                
                <!--
                <button id="message-submit" class="btn btn-positive"><i class="fa fa-2x">发送</i></button>
                -->


                <button id="message-submit" class="btn" style="border-radius: 45px;"><i class="fa fa-comment-o fa-2x"></i></button>


            <div>

        </div>
        <!-- ######################END OF FOOTER###################### -->
    <script> 
        $(document).ready(function() {
            'use strict';   
            
            // confingure WeiXin JS SDK
            !(function(){
                wx.config({
                    debug: true,
                    appId: '<?php echo $signPackage["appId"];?>',
                    timestamp: <?php echo $signPackage["timestamp"];?>,
                    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                    signature: '<?php echo $signPackage["signature"];?>',
                    jsApiList: [
                        'checkJsApi',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                        'hideMenuItems',
                        'showMenuItems',
                        'hideAllNonBaseMenuItem',
                        'showAllNonBaseMenuItem',
                        'translateVoice',
                        'startRecord',
                        'stopRecord',
                        'onRecordEnd',
                        'playVoice',
                        'pauseVoice',
                        'stopVoice',
                        'uploadVoice',
                        'downloadVoice',
                        'chooseImage',
                        'previewImage',
                        'uploadImage',
                        'downloadImage',
                        'getNetworkType',
                        'openLocation',
                        'getLocation',
                        'hideOptionMenu',
                        'showOptionMenu',
                        'closeWindow',
                        'scanQRCode',
                        'chooseWXPay',
                        'openProductSpecificView',
                        'addCard',
                        'chooseCard',
                        'openCard'
                    ]
                });
            })();
                                   
            var senderHeadImgUrl = "<?= $wx_user->headImgUrl; ?>";
            var receiverHeadImgUrl = "<?= $reciever->headImgUrl; ?>";
            
            var appendSendMessage = function (msgid, send_time, content_type, content) {
                var elementHtml;
                if (1 === content_type) {
                    elementHtml = '<li class="table-view-cell table-view-cell-wechat-message wechat-message-send media" id="message-'
                                + msgid +'"><img class="media-object pull-right" style="width:48px;" src="' 
                                + senderHeadImgUrl + '"><div class="media-body pull-right"><p class="message-content message-content-send">' 
                                + content + '</p><p><span class="message-time">' 
                                + send_time + '</span></p></div></li>';
                } else if (3 === content_type){
                    elementHtml = '<li class="table-view-cell table-view-cell-wechat-message wechat-message-send media" id="message-'
                                + msgid +'"><img class="media-object pull-right" style="width:48px;" src="' 
                                + senderHeadImgUrl + '"><div class="media-body pull-right"><p class="message-content message-content-send">' 
                                + '<i class="fa fa-volume-up fa-2x voice-playback" serverId="'
                                + content +'"></i>' + '</p><p><span class="message-time">' 
                                + send_time + '</span></p></div></li>';
                }
                        
                return $(elementHtml).insertBefore('#ul-body-bottom');                           
            };
            
            var appendRecieveMessage = function (msgid, send_time, content_type, content) {
                var elementHtml; 
                if (1 === content_type) {
                    elementHtml = '<li class="table-view-cell table-view-cell-wechat-message wechat-message-recieve media" id="message-'
                                + msgid +'"><img class="media-object pull-left" style="width:48px;" src="' 
                                + receiverHeadImgUrl + '"><div class="media-body pull-left"><p class="message-content message-content-recieve">' 
                                + content + '</p><p><span class="message-time">' 
                                + send_time + '</span></p></div></li>';
                } else if ( 3 === content_type ) {
                    elementHtml = '<li class="table-view-cell table-view-cell-wechat-message wechat-message-recieve media" id="message-'
                                + msgid +'"><img class="media-object pull-left" style="width:48px;" src="' 
                                + receiverHeadImgUrl + '"><div class="media-body pull-left"><p class="message-content message-content-recieve">' 
                                + '<i class="fa fa-volume-up fa-2x voice-playback" serverId="'
                                + content + '"></i>' + '</p><p><span class="message-time">' 
                                + send_time + '</span></p></div></li>';
                }
                            
                return $(elementHtml).insertBefore('#ul-body-bottom'); 
            };
                        
//            alert("ready");
            $('html, body, .content').animate({scrollTop: $('#ul-body').height()}, 300);
            
            var playback_voice = {
                localId: undefined,
                serverId: undefined,
                state: 'stopped'
            };
            wx.onVoicePlayEnd({
                success: function (res) {
                    playback_voice.state = 'stopped';
                }
            });
            $('#ul-body').on('click', '.voice-playback', function (e) {
//            $('.voice-playback').click( function (e) {
                var serverId = $(e.target).attr('serverId');
               // alert(serverId);
                if ('playing' === playback_voice.state && serverId === playback_voice.serverId) {
                    wx.stopVoice({localId: playback_voice.localId});
                    playback_voice.state = 'stopped';
                    return;
                }
                if (serverId === playback_voice.serverId) { 
                    wx.playVoice({localId: playback_voice.localId});
                    return;
                }
                
                if ('playing' === playback_voice.state) {
                    wx.stopVoice({localId: playback_voice.localId});
                    playback_voice.state = 'stopped';
                }
                playback_voice.serverId = serverId;
                wx.downloadVoice({
                    serverId:   playback_voice.serverId,
                    success:    function (res) {
                        playback_voice.localId = res.localId;
                        wx.playVoice({localId: playback_voice.localId});
                        playback_voice.state = 'playing';                       
                    }
                });
            });

            $('#message-submit').click(function() {
//                alert("click");
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
                        success:    function(ret) {
//                            alert('发送成功。');
                            $('#message-content').val('');  
                            appendSendMessage(ret.msgid, ret.send_time, <?= \app\models\WechatMessageContent::MSGTYPE_TEXT ?>, ret.content); 
                            $('html, body, .content').animate({scrollTop: $('#ul-body').height()}, 0);
                        },                        
                        error:      function(){
                            alert('发送失败。');
                        }
                    });
                }
            });
            
            setInterval(function () {
                var args = {
                    'classname':    '\\app\\models\\WechatMessage',
                    'funcname':     'getRecentMessagesAjax',
                    'params':       {
                        'sender_id':    '<?= $wx_user->id; ?>',
                        'receiver_id':  '<?= $reciever->id; ?>',                   
                    } 
                };
                
//                alert('refreshing...');
                    
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) {
//                        alert('refreshing recieved.');
                        for (var i = 0, changed = 0; i < ret.length; i++) {
                            var msgid = '#message-' + ret[i].msgid;
                            if ($(msgid).length > 0) continue;
                            changed++;
                            if (ret[i].sending) {
                                appendSendMessage(ret[i].msgid, ret[i].send_time, ret[i].content_type, ret[i].content);
                            } else {
                                appendRecieveMessage(ret[i].msgid, ret[i].send_time, ret[i].content_type, ret[i].content);
                            }
                        }
                        if (changed > 0) {
                            $('html, body, .content').animate({scrollTop: $('#ul-body').height()}, 0); 
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            }, 1000 * 5);
        });
        
        $('#voice-start').click(function () {
            $('#voice-start').hide();
            $('#voice-stop').show();
            wx.startRecord({
                cancel: function () {
                    alert('用户拒绝授权录音');
                }
            });
        });
        var uploadVoiceAndAddDom = function ( res ) {
            var voice_localid = res.localId;
            wx.uploadVoice({
                localId: voice_localid,
                success: function (res) {
                    var voice_serverid = res.serverId;
                    var args = {
                        'classname':    '\\app\\models\\WechatMessage',
                        'funcname':     'sendMessageAjax',
                        'params':       {
                            'sender_id':    '<?= $wx_user->id; ?>',
                            'receiver_id':  '<?= $reciever->id; ?>',                   
                            'content_type':  '<?= \app\models\WechatMessageContent::MSGTYPE_VOICE ?>',
                            'content':       voice_serverid
                        } 
                    };

                    $.ajax({
                        url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                        type:       "GET",
                        cache:      false,
                        dataType:   "json",
                        data:       "args=" + JSON.stringify(args),
                        success:    function(ret) {                                   
                            appendSendMessage(ret.msgid, ret.send_time, ret.content_type, ret.content); 
                            $('html, body, .content').animate({scrollTop: $('#ul-body').height()}, 0);
                        },                        
                        error:      function(){
                            alert('发送失败。');
                        }
                    });

                }
            });
            $('#voice-start').show();
            $('#voice-stop').hide();
        };
        wx.onVoiceRecordEnd({
            // 录音时间超过一分钟没有停止的时候会执行 complete 回调
            complete: uploadVoiceAndAddDom
        });
        
        $('#voice-stop').click( function () {           
            wx.stopRecord({
                success: uploadVoiceAndAddDom               
            });            

        });
    </script>
    </body>
</html>
