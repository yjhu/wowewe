<?php
include('../models/utils/emoji.php');
$client = \app\models\ClientWechat::findOne(['gh_id' => $wx_user->gh_id])->client;
\Yii::$app->wx->setGhId($wx_user->gh_id);
$gh = \Yii::$app->wx->getGh();
$jssdk = new \app\models\JSSDK($gh['appid'], $gh['appsecret']);
$signPackage = $jssdk->GetSignPackage();

use \yii\helpers\Url;
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
        <link href="./ratchet/dist/css/ratchet.css" rel="stylesheet">
        <link href="./php-emoji/emoji.css" rel="stylesheet">    
    </head>
    <body>
        <header class="bar bar-nav">
            <?php if ($backwards) { ?>
                <a  data-ignore="push" class="btn btn-link btn-nav pull-left" href="<?= \app\models\utils\BrowserHistory::previous($wx_user->gh_id, $wx_user->openid) ?>">
                    <span class="icon icon-left-nav"></span>
                </a>
            <?php } ?>

            <a href="#outletMenuItems">
                <h1 class="title"><span class="icon icon-home"></span>&nbsp;<?= $outlet->title ?>&nbsp;<span class="icon icon-caret"></span></h1>        
            </a>
            
            <a data-ignore="push" class="btn btn-link btn-nav pull-right" href="#showQr"><img src="../web/images/woke/qr.png" width=18px></a>
        </header>

        <div id="outletMenuItems" class="popover">
          <ul class="table-view">
            <li class="table-view-cell">
                  <a class="navigate-right">
                  <span class="badge badge-primary">5</span>
                    订单管理
                  </a>
            </li>
            <li class="table-view-cell">
                  <a class="navigate-right">
                  <span class="badge badge-primary">320</span>
                    粉丝管理
                  </a>
            </li>
            <li class="table-view-cell">
                  <a class="navigate-right">
                  <span class="badge badge-primary">3000</span>
                    用户管理
                  </a>
            </li>
          </ul>          
        </div>
        
        <div id="showQr" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#showQr"></a>
                <h1 class="title"><?= $outlet->title ?>的推广二维码</h1>
            </header>

            <div class="content">

                <center>

                    <img src="<?= $outlet->getPromoter($wx_user->gh_id)->getQrImageUrl() ?>" width="100%">
                    <br><br>

                    &nbsp;
                </center>

            </div>
        </div>
        
        <div id="showPics" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#showPics"></a>
                <h1 class="title"><span class="icon icon-home">&nbsp;</span><?= $outlet->title ?></h1>
            </header>

            <div class="content">

                            <?php 
            if (!empty($outlet->pics)) { 
                $pics = explode(",", $outlet->pics);
            ?>
                <div class="slider">
                  <div  class="slide-group">
                    <?php 
                    foreach ($pics as $pic){ 
                        $pic_url = \Yii::$app->request->getHostInfo() . 
                                \Yii::$app->request->getBaseUrl() . 
                                '/' . 
                                'office_campaign_detail' . 
                                '/' .
                                "{$pic}";
                    ?>  
                    <div class="slide">
                        <center>
                                <img width=100% src="<?= $pic_url ?>">
                        </center>
                    </div>
                    <?php } ?>  
                  </div>
                </div>
                <?php } ?> 
            </div>
        </div>

        <div class="content">
            <?php 
            if (!empty($outlet->pics)) { 
                $pics = explode(",", $outlet->pics);
            ?>
                <div class="slider">
                  <div  class="slide-group">
                    <?php 
                    foreach ($pics as $pic){ 
                        $pic_url = \Yii::$app->request->getHostInfo() . 
                                \Yii::$app->request->getBaseUrl() . 
                                '/' . 
                                'office_campaign_detail' . 
                                '/' .
                                "{$pic}";
                    ?>  
                    <div class="slide">
                        <center>
                            <a data-ignore="push" href="#showPics">
                                <img height=50% src="<?= $pic_url ?>">
                            </a>
                        </center>
                    </div>
                    <?php } ?>  
                  </div>
                </div>
            <?php             
            } 
            ?>
            
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">门店管理归属</li>                
                <li class="table-view-cell">                        
                    <?= $outlet->supervisionOrganization->title ?>
                </li>
                <li class="table-view-cell table-view-divider">门店地址及电话</li>                
                <li class="table-view-cell">                        
                    地址：<?= $outlet->address ?>
                    <?php if (!empty($outlet->latitude) && !empty($outlet->longitude)) { ?>
                    <a data-ignore="push" class="btn btn-link pull-right" id="openLocation"><img src="../web/images/comm-icon/iconfont-weizhi3.png" /></a>
                    <?php  } ?>
                </li>
                <li class="table-view-cell">                        
                    电话：<?= $outlet->telephone ?><a data-ignore="push" class="btn btn-link pull-right" id="getLocation"><img src="../web/images/comm-icon/iconfont-tuding.png" /></a>
                </li>
            </ul>

            <p class="content-padded">
               <a href="#editClientOutlet" class="btn btn-positive btn-block">修改信息</a>
            </p>
            
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">所属员工列表</li>                
                <?php foreach ($outlet->employees as $employee) { ?> 
                    <li class="table-view-cell media">
                        <a  data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                                'client-employee', 
                                'gh_id' => $wx_user->gh_id, 
                                'openid' => $wx_user->openid, 
                                'employee_id' => $employee->employee_id,
                                'backwards' => 1,
                            ]) ?>">
                            <?php if (!empty($employee->wechat) && !empty($employee->wechat->headimgurl)) { ?>
                            <span class="media-object pull-left"><img style="width:48px;" src="<?= $employee->wechat->headimgurl ?>"></span>
                            <?php } else { ?>
                            <span style="width:48px;" class="media-object pull-left icon icon-person"></span>
                            <?php } ?>
                            <div class="media-body">
                                <?= $employee->name ?><p><?= implode("<br>", $employee->mobiles) ?></p>
                                <p><span class="badge badge-positive pull-right"><?= $employee->getOutletPosition($outlet->outlet_id) ?></span></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php foreach ($outlet->agents as $agent) { ?> 
                    <li class="table-view-cell media">
                        <a  data-ignore="push" class="navigate-right" href="<?= \yii\helpers\Url::to([
                                'client-agent', 
                                'gh_id' => $wx_user->gh_id, 
                                'openid' => $wx_user->openid, 
                                'agent_id' => $agent->agent_id,
                                'backwards' => 1,
                            ]) ?>">
                            <?php if (!empty($agent->wechat) && !empty($agent->wechat->headimgurl)) { ?>
                            <span class="media-object pull-left"><img style="width:48px;" src="<?= $agent->wechat->headimgurl ?>"></span>
                            <?php } else { ?>
                            <span style="width:48px;" class="media-object pull-left icon icon-person"></span>
                            <?php } ?>
                            <div class="media-body">
                                <?= $agent->name ?><p><?= implode("<br>", $agent->mobiles) ?></p>
                                <p><span class="badge badge-positive pull-right"><?= $agent->getOutletPosition($outlet->outlet_id) ?></span></p>
                            </div>
                        </a>
                    </li>
                <?php } ?>     
            </ul>
            <div>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></div>
        </div>
        <div class="bar bar-standard bar-footer">
            <div class="content" style="font-size: 10px;color:#ccc;">
            <center>
            <span><img style='width:18px;' src="<?= $wx_user->headimgurl ?>"/>&nbsp;&nbsp;</span>
            <span><?= emoji_unified_to_html(emoji_softbank_to_unified($wx_user->nickname)) ?>&nbsp;</span>
            <span><?= $wx_user->getBindMobileNumbersStr() ?></span>
            <br>
            <span><?= $client->title_abbrev ?>&copy;<?= date('Y') ?></span>
            </center>
            </div>
        </div>


        <div id="editClientOutlet" class="modal">
          <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#editClientOutlet"></a>
            <h1 class="title">营业厅信息修改</h1>
          </header>

          <div class="content">
              <center>
                <div class="input-group">

                  <div class="input-row">
                      <label style="color:#777777">地址</label>
                      <input type="text" id="addressClientOutlet" value="<?= $outlet->address ?>">
                    </div>

                    <div class="input-row">
                      <label style="color:#777777">电话</label>
                       <input type="text"  id="telephoneClientOutlet" value="<?= $outlet->telephone ?>">
                    </div>
                </div>

                <p class="content-padded"></p>

                 <?php 
                if (!empty($outlet->pics)) { 
                    $pics = explode(",", $outlet->pics);
                ?>
                        <ul class="table-view">
                        <?php 
                        foreach ($pics as $pic){ 
                            $pic_url = \Yii::$app->request->getHostInfo() . 
                                    \Yii::$app->request->getBaseUrl() . 
                                    '/' . 
                                    'office_campaign_detail' . 
                                    '/' .
                                    "{$pic}";
                        ?>  
          
                        <li class="table-view-cell" id="<?= basename($pic_url) ?>">
                            <img class="media-object pull-left" src="<?= $pic_url ?>" width="64" height="64">

                                <button class="btn-positive icon icon-edit">更换</button>
                                &nbsp;&nbsp;
                                <button class="btn-negative icon icon-close" id="delBtn" picname="aaa" onclick="delPic();">删除</button>
                        <?php } ?>  
                        </ul>
                <?php             
                } 
                ?>
                            
                <br>
                  <button class="btn btn-positive btn-block" style="border-radius:3px" id="applyBtn">确定</button>

                  <a class="btn btn-block" style="border-radius:3px" href="#editClientOutlet"> 返回</a>
              </center>
          </div>
        </div>




        <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js"></script>
        <!-- Include the compiled Ratchet JS -->
        <script src="/wx/web/ratchet/dist/js/ratchet.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
//            alert("wx_config begins.");
        wx.config({
      debug: false,
/*
      appId: 'wxf8b4f85f3a794e77',
      timestamp: 1427958791,
      nonceStr: '0vCuuppVAquWN5C0',
      signature: '07185778be0ca277f7a6d6440e80596b3c5b409c',
*/
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
//  alert("wx_config ends.");
</script>

<script>
        function delPic()
        {
                picname = $(this).attr('picname');
                
                alert(picname);
                $("#"+picname).remove();
        }




        function wapxajax(args)
        {
            //alert(JSON.stringify(args));
            //alert("<//?php echo Url::to(['wapx/wapxajax'], true) ; ?>");
              $.ajax({
              url: "<?php echo Url::to(['wapx/wapxajax'], true) ; ?>",
              type:"GET",
              cache:false,
              dataType:"json",
              data: "args=" + JSON.stringify(args),
              success: function(t){

                      if(t.code==0)
                      {
                          alert(t.msg);
                          var url = "<?php echo \app\models\utils\BrowserHistory::current($wx_user->gh_id, $wx_user->openid); ?>";
                          location.href = url;
                      }
                      else
                      {
                        alert(t.msg);
                      }
                },
                error: function(){
                  alert('error!');
                }
            });

            return false;
        }


        wx.ready(function () {
            //alert("wx_ready!");

            try {
            document.querySelector('#openLocation').onclick = function () {
                wx.openLocation({
                  latitude: <?= $outlet->latitude; ?>,
                  longitude: <?= $outlet->longitude; ?>,
                  name: '<?= $outlet->title; ?>',
                  address: '<?= $outlet->address; ?>',
                  scale: 12,
                  infoUrl: ''
                });
            };
            } catch(e) {
                //alert("error!!!");
            }
            
            // 7.2 获取当前地理位置
            document.querySelector('#getLocation').onclick = function () {

            if(!confirm("当前位置设为门店位置?"))
            return false;

              wx.getLocation({
                success: function (res) {
                  //alert(JSON.stringify(res));
                    //params = new Array();
//                    var params = {};                    
//                    params.outlet_id = '<//?= $outlet->outlet_id; ?>';
//                    params.latitude = res.latitude;
//                    params.longitude = res.longitude;
//
//                    classname = 'ClientOutlet';
//                    funcname = 'setOutletLocation';              
//                    wapxajax(classname, funcname, params);
                    wapxajax({
                        'classname':    '\\app\\models\\ClientOutlet',
                        'funcname':     'setOutletLocationAjax',
                        'params':       {
                            'outlet_id':    '<?= $outlet->outlet_id; ?>',
                            'latitude':     res.latitude,
                            'longitude':    res.longitude
                        }                           
                    });
                    return false;
                },
                cancel: function (res) {
                  alert('用户拒绝授权获取地理位置');
                }
              });
            };
     


        });
        </script>
    </body>
</html>

