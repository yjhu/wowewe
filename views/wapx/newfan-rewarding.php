<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;

    include('../models/utils/emoji.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>缤纷盛夏邀你共享微信好礼</title>

        <!-- Sets initial viewport load and disables zooming  -->
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <!-- Makes your prototype chrome-less once bookmarked to your phone's home screen -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Include the compiled Ratchet CSS -->
        <link href="./ratchet/dist/css/ratchet.css" rel="stylesheet">
        <link rel="stylesheet" href="http://libs.useso.com/js/font-awesome/4.2.0/css/font-awesome.min.css">

        <link href="./php-emoji/emoji.css" rel="stylesheet">
        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
    </head>
    <body>
        <header class="bar bar-nav">            
            <h1 class="title">关注有礼</hi>            
        </header>
        <div class="content">

            <img width=100% src="/wx/web/images/huodong71.png?v2">

            <br>
            <?php if (empty($rewarding->getting_time)) { ?>
                <br>
                
                <center>
                <h4>恭喜您！</h4>
                </center>
                <p align="center"> 
                    您已通过关注襄阳联通微信公众号赢得一份清凉好礼。可到附近营业厅出示本页面并点击领取礼品按钮领取。
                </p>

                <br>
                <p align="center">
                    <span style='font-size:0.8em;'><i class='fa fa-exclamation-triangle' style='color:red;'></i>您需要到<a href='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1b122a21f985ea18&redirect_uri=http%3A%2F%2Fwosotech.com%2Fwx%2Fweb%2Findex.php%3Fr%3Dwap%2Foauth2cb&response_type=code&scope=snsapi_base&state=wapx/nearestoutlets:gh_03a74ac96138#wechat_redirect'>附近营业厅</a>领取奖品后才点击此按钮！<i class='fa fa-exclamation-triangle'  style='color:red;'></i></span>
                    <a class="btn btn-primary btn-block" style="width: 300px" id='ivegetit'>领取礼品</a>
                </p>
            <?php } else { ?>
                <br>
                
                <center>
                <h4>您已经领取了一份清凉好礼。</h4>
                </center>
                <p align="center"> 
                领取时间：<?= date('Y-m-d H:i:s', $rewarding->getting_time); ?>.
                </p>

            <?php } ?>

        </div>
        
    </body>


<script type="text/javascript">
    //var newfan_openid = '<?= $rewarding->newfan_openid ?>';
    //alert(newfan_openid);

  $(document).ready(function () {

            $('#ivegetit').click (function () {
                if (!confirm('您需要到营业厅领取奖品后才点击此按钮！'))
                    return;
                
                var args = {
                    'classname':    '\\app\\models\\NewfanReward',
                    'funcname':     'rewardconfirmAjax',
                    'params':       {
                        'newfan_openid':   '<?= $rewarding->newfan_openid ?>'                     
                    } 
                };
                $.ajax({
                    url:        "<?= \yii\helpers\Url::to(['wapx/wapxajax'], true) ; ?>",
                    type:       "GET",
                    cache:      false,
                    dataType:   "json",
                    data:       "args=" + JSON.stringify(args),
                    success:    function(ret) { 
                        if (0 === ret['code']) {
                            location.href = '<?= Url::to() ?>';
                        }
                    },                        
                    error:      function(){
                        alert('发送失败。');
                    }
                });
            });

  })
</script>

</html>

