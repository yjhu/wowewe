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
                        $pic_url = $outlet->getPicUrl($pic);
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
            <div class="slider">
            <div  class="slide-group">
            <?php 
            if (!empty($outlet->pics)) { 
                $pics = explode(",", $outlet->pics);
            ?>

                    <?php 
                    foreach ($pics as $pic){ 
                        $pic_url = $outlet->getPicUrl($pic);
                    ?>  
                    <div class="slide">
                        <center>
                            <a data-ignore="push" href="#showPics">
                                <img height=50% src="<?= $pic_url ?>">
                            </a>
                        </center>
                    </div>
                    <?php } ?>                     
            <?php             
            } 
            ?>
                <div class="slide">
                    <center>
                    <a data-ignore='push' class='btn btn-link' id='uploadImages'>
                    <img height=50% src="../web/images/comm-icon/iconfont-shangchuantupian.png">
                    </a>
                    </center>
                </div>
            </div>
            </div>
            
            <ul class="table-view">
                <li class="table-view-cell table-view-divider">门店管理归属</li>                
                <li class="table-view-cell">                        
                    <?= $outlet->supervisionOrganization->title ?>
                </li>
                <li class="table-view-cell table-view-divider">
                    门店地址及电话<a class="btn btn-link pull-right" href="#composeOutletInfo" id="editClientOutletInfo"><img src="../web/images/comm-icon/iconfont-xiugai.png" /></span></a>
                    <!--
                    <a href="#editClientOutlet" id="editClientOutletInfo">
                    <span class='icon icon-compose pull-right'></span>
                    </a>
                    -->
                </li>                
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
<!--- -->
        <div id='composeOutletInfo' class='modal'>
            <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#composeOutletInfo"></a>
            <h1 class="title"><span class="icon icon-compose"></span><?= $outlet->title ?></h1>
            </header>
            <div class='content'>
                <form class="input-group">
                  <div class="input-row">
                    <label>地址：</label>
                    <input type="text" id='address' value='<?= $outlet->address ?>'>
                  </div>
                  <div class="input-row">
                    <label>电话：</label>
                    <input type="tel" id='telephone' value='<?= $outlet->telephone ?>'>
                  </div>
                </form>
                <button class="btn btn-positive btn-block" style="border-radius:3px" id="confirmOutletInfo">确定</button>
                <a class="btn btn-block" style="border-radius:3px" href="#composeOutletInfo"> 返回</a>
            </div>
        </div>

        <div id="editClientOutlet" class="modal">
          <header class="bar bar-nav">
            <a class="icon icon-close pull-right" href="#editClientOutlet"></a>
            <h1 class="title">门店信息修改</h1>
          </header>

          <div class="content">
              <center>
                <div class="input-group">

                  <div class="input-row">
                      <label style="color:#777777">地址</label>
                      <input type="texteara" id="addressClientOutlet" value="<?= $outlet->address ?>">
                    </div>

                    <div class="input-row">
                      <label style="color:#777777">电话</label>
                       <input type="text"  id="telephoneClientOutlet" value="<?= $outlet->telephone ?>">
                    </div>
                </div>

                <p class="content-padded"></p>
                <ul class="table-view">
                  <li class="table-view-cell">
                  门店图片
                  </li>

                 <?php 
                if (!empty($outlet->pics)) { 
                    $pics = explode(",", $outlet->pics);
                ?>
                    <?php 
                    foreach ($pics as $pic){ 
                        $pic_url = $outlet->getPicUrl($pic);

                    ?>  
      
                    <li class="table-view-cell" id="<?= $pic ?>">
                        <img class="media-object pull-left" src="<?= $pic_url ?>" width="64" height="64">
                        
                        <button class="btn-negative icon icon-close" picname="<?= $pic ?>" onclick="delPicBtn('<?= $pic ?>');">删除</button>
                    </li>
                    <?php } ?>  
                <?php             
                } 
                ?>
                </ul>

                 <ul class="table-view" id="ext-pics">
                 </ul>

                 <ul class="table-view">
                    <li class="table-view-cell" id="addpic">
                    <img class="media-object pull-left" src="/wx/web/images/comm-icon/upload-pic-64x64.png" width="64" height="64">
                    <button class="btn-positive icon icon-plus" id="addPicBtn">新增</button>
                    </li>
                </ul>            
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
        $("#editClientOutletInfo").hide();
        $('#openLocation').hide();
        $('#getLocation').hide();
//            alert("wx_config begins.");


      var images = {
        localId: [],
        serverId: []
      };

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
                         // alert(t.action);

                         //if(!t.hasOwnProperty("refresh") || t.refresh==1)
                         if(false)
                          {
                              var url = "<?php echo \app\models\utils\BrowserHistory::current($wx_user->gh_id, $wx_user->openid); ?>";
                              location.href = url;
                          }
                          else if(t.action=='add')
                          {
                            //alert("add"+ t.values.length);
                            var text = "";

                            for(i=0; i < t.values.length; i++)
                            {
                                pic = t.values[i];
                                pic_url = "/wx/web/images/outlets/"+pic+".jpg";

                                var text = "<li class=\"table-view-cell\" id=\""+pic+"\">"+
                                "<img class=\"media-object pull-left\" src=\""+pic_url+"\" width=\"64\" height=\"64\">"+
                                "<button class=\"btn-negative icon icon-close\" picname=\""+pic+"\" onclick=\"delPicBtn($(this).attr('picname'));\">删除</button>"+
                                "</li>";

                                $("#ext-pics").append(text);
                                //alert("门店图片新增成功。");
                         
                            }

                            return false;
                          }
                          else if(t.action=='delete')
                          {
                                a = t.values[0];
                                //alert("a="+a);
                                document.getElementById(a).style.display = 'none';
                                //alert("门店图片删除成功。");
                          }

                            images.localId = [];
                            images.serverId = [];

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




        function delPicBtn(picname)
        {
            myserverId= [];
            myserverId.push(picname);
            //alert(myserverId[0]);

              wapxajax({
                'classname':    '\\app\\models\\ClientOutlet',
                'funcname':     'setOutletPicsAjax',
                'params':       {
                    'outlet_id':    '<?= $outlet->outlet_id; ?>',
                    'gh_id':        '<?= $wx_user->gh_id; ?>',                   
                    'media_ids':     myserverId,
                    'action':       'delete'
                } 
            });

        }
  
        wx.ready(function () {
            $("#editClientOutletInfo").show();
            $('#openLocation').show();
            $('#getLocation').show();

            $('#openLocation').click(function () {
                wx.openLocation({
                  latitude: <?= $outlet->latitude; ?>,
                  longitude: <?= $outlet->longitude; ?>,
                  name: '<?= $outlet->title; ?>',
                  address: '<?= $outlet->address; ?>',
                  scale: 12,
                  infoUrl: ''
                });
            });
            
            $('#getLocation').click(function () {
                if ( !confirm("当前位置设为门店位置?") )
                    return false;

                wx.getLocation({
                    success: function (res) {
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
            });
            
            $('#confirmOutletInfo').click(function () {
                var telephone = $('#telephone').val();
                var address   = $('#address').val();
//                alert(address);
                wapxajax({
                    'classname':    '\\app\\models\\ClientOutlet',
                    'funcname':     'setOutletInfoAjax',
                    'params':       {
                        'outlet_id':    '<?= $outlet->outlet_id; ?>',
                        'telephone':     telephone,
                        'address':       address
                    } 
                });
//                return false;
            });
            
            $('#uploadImages').click(function() {
                var uploadImages = {
                    localIds:   [],
                    serverIds:  []
                };
                
                if ( !confirm("更新当前门店图片?") )
                    return false;
                
                wx.chooseImage({
                    success:    function (res) {
                        if (res.localIds.length > 5) {
                            alert('最多只能选择5张图片，请重新选择！');
                            return false;
                        }
                        uploadImages.localIds = res.localIds;
                        var i = 0;
                        function uploadImage() {
                            //alert("开始上传。");
                            wx.uploadImage({
                                localId:     uploadImages.localIds[i],
                                success:    function (res) {
                                    alert("成功上传"+(i + 1)+"张照片。");
                                    uploadImages.serverIds[i] = res.serverId;
                                    i++;
                                    if (i < uploadImages.localIds.length) {
                                        uploadImage();
                                    } else {
                                        wapxajax({
                                            'classname':    '\\app\\models\\ClientOutlet',
                                            'funcname':     'setOutletPicsAjax',
                                            'params':       {
                                                'outlet_id':    '<?= $outlet->outlet_id; ?>',
                                                'gh_id':        '<?= $wx_user->gh_id; ?>',                          
                                                'media_ids':     uploadImages.serverIds,
                                                'action':       'replace'
                                            } 
                                        });
                                        return false;
                                    }
                                },
                                fail:       function (res) {
                                    alert('wx.uploadImage failed: ' + JSON.stringify(res));
                                    return false;
                                }                
                            });
                        }
                        alert("开始上传。");
                        uploadImage();
                    }
                });
            });
            
            document.querySelector('#applyBtn').onclick = function () {

                telephone = $("#telephoneClientOutlet").val();
                address = $("#addressClientOutlet").val();

                  wapxajax({
                    'classname':    '\\app\\models\\ClientOutlet',
                    'funcname':     'setOutletInfoAjax',
                    'params':       {
                        'outlet_id':    '<?= $outlet->outlet_id; ?>',
                        'telephone':     telephone,
                        'address':    address
                    } 
                });
                return false;  
            };


            /*新增门店图片*/
            
          // 5.1 拍照、本地选图
          document.querySelector('#addPicBtn').onclick = function () {
            wx.chooseImage({
              success: function (res) {
                //alert("up");
                /*
                if (res.localIds.length > 1) {
                  alert('只能选择一张图片，请重新选择！');
                  return;
                  //return false;
                }
                */

                if (res.localIds.length > 5) {
                  alert('最多只能选择5张图片，请重新选择！');
                  return;
                  //return false;
                }
 //alert("up1");
                images.localId = res.localIds;
                //alert('已选择 ' + res.localIds.length + ' 张图片');
                //alert(images.localId[0]);
                if (images.localId.length == 0) {
                    alert('请先选择上传图片');
                    return false;
                }
                var i = 0, length = images.localId.length;
                images.serverId = [];

                 //start upload function -----------------------------------------------
                 //alert("start upload");

                function upload() {
                wx.uploadImage({
                localId: images.localId[i],
                success: function (res) {
                  //alert('localid=' + images.localId[i] + 'serverId=' + res.serverId);
                  i++;
                  alert('已上传：' + i + '/' + length);
                  // alert('恭喜你，已成功上传！');
                  images.serverId.push(res.serverId);
                  if (i < length) {
                    upload();
                  } 
                  else {

                    //alert('localid=' + images.localId[0] + ', serverId=' + images.serverId[0]);
                    //alert('恭喜你，已成功上传！');
                    //$("#serverId").val(JSON.stringify(images.serverId));
                    
                    //serverId = $("#serverId").val();
                    serverId = JSON.stringify(images.serverId);

                    //alert(serverId);
                    //alert('status'+status);
                    //alert("cat="+cat+"&office_id="+office_id+"&serverId="+serverId);

                      wapxajax({
                        'classname':    '\\app\\models\\ClientOutlet',
                        'funcname':     'setOutletPicsAjax',
                        'params':       {
                            'outlet_id':    '<?= $outlet->outlet_id; ?>',
                            'gh_id':        '<?= $wx_user->gh_id; ?>',                          
                            'media_ids':     serverId,
                            'action':       'add'
                        } 
                    });
                
                  }
                },
                fail: function (res) {
                  alert("fail::"+JSON.stringify(res));
                }
              });
            }
            //endof upload function -----------------------------------------------
            upload();

              }
            });
            return false;
          };


        });
        </script>
    </body>
</html>

