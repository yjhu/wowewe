<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MChannel;
    use app\models\MSceneDetail;
    use app\models\MUser;
?>


    
<style type="text/CSS">

    #qrBtn{
        background-image: ../web/images/woke/qr.png;
    }
    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

    .ui-listview>li.ui-first-child, .ui-listview>li.ui-first-child>a.ui-btn {
        background-color: #FFF0CC !important;
    }

    .perImg_bg{ width:60px; height:68px; position:relative;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;}
    .perImg{width:60px; height:60px; position:absolute; top:6px; left:6px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; overflow:hidden;}
    .perImg img{width:60px; height:60px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; }
    .client_dl dt{ width:68px; overflow:hidden; margin:0 10px; text-align:center; float:left; padding-top:3px;}
    .client_dl dd{ position:relative; float:left;}
    .client_dl dd f15{ line-height:22px;}

    .perImg{width:56px; height:56px; position:absolute; top:6px; left:6px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; overflow:hidden;}
    .perImg img{width:56px; height:56px;-moz-border-radius:28px;-webkit-border-radius:28px;border-radius:28px; }

    .jin_vip, .zuan_vip, .pu_vip,.yin_vip,.tong_vip{ width:80px; height:20px;margin-left:4px;display:inline-block; vertical-align:middle;}
    .jin_vip{background:url(../web/images/woke/jinpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .zuan_vip{background:url(../web/images/woke/zuanshi.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .pu_vip{ background:url(../web/images/woke/putong.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .yin_vip{background:url(../web/images/woke/yinpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}
    .tong_vip{background:url(../web/images/woke/tongpai.png) no-repeat 0 0;-webkit-background-size: contain;-moz-background-size: contain;-o-background-size: contain;background-size: contain;}

    .c_txwdlist_0 { font-size:14px; background-color: #FFF0CC !important;} 
    .c_txwdlist_1 { font-size:14px; background-color: #C3FFC0 !important;} 

    .c_list_0 { font-size:14px; background-color: #fff !important;} 
    .c_list_1 { font-size:14px; background-color: #eee !important;} 

   
    #my_list1>li, #my_list2>li
    {
         background-color: #ffffff !important;
    }

    .bankSelected{
        background-color: #FCEB9F;
    }

    .myHeadIcon
    {
        /* border-radius: 50%; */
    }

    .we{
        line-height:120%;
        color:#aaa;
        font-size:12pt;
    }

    div#sharePop .modal-header
    {
        padding: 0 !important;
    }

</style>



<div data-role="page" id="wokelist" data-theme="c">

    <?php echo $this->render('header1', ['menuId'=>'menu1','title' => '我的客服经理' ]); ?>
    <div data-role="content">
        
        <ul data-role="listview" data-inset="false" id="woke-ul">


        <?php foreach ($myManagers as $myManager) { ?>
        <li>
        <dl class="client_dl">
            <dt>
                <div class="perImg_bgxxx">
                    <div class="perImgxxx">
              

                        <img id="myphoto" src="../web/images/woke/kf1.jpg" width="64">
   
                        <!--
                        <img id="myphoto" src="<//?php echo $user->headimgurl; ?>" width="64">
                        -->

                    </div>
                </div>
                <p class="f9 marT7">
                <!--
                <em id="vip_p" class="pu_vip"></em>
                -->
                </p>
            </dt>

            <dd>
                <p><span style="font-size:19px;font-weight: border">
                <!--
                杨念念
                -->

                <?= $myManager->name ?>
   
                </span> 
                &nbsp;&nbsp;&nbsp;&nbsp;

                </p>

                <p class="f13">
                <!--
                <a href="#" style="color:#00CC00" class="ui-btn ui-shadow ui-corner-all ui-icon-phone ui-btn-icon-notext ui-btn-inline"></a>
                -->

                <a style="color:#aaa;font-size: 22pt" href="tel:<?= $myManager->mobile ?>">
                 <?= $myManager->mobile ?>
                </a>

                </p>

            </dd>
        </dl>
 
        </li>
        <?php 
                }
        ?>
        <!--
        <li><a ajax-data="false" href="#wytg"><img src="../web/images/woke/wdmy.gif" alt="推荐有礼" class="ui-li-icon ui-corner-none">推荐有礼<span class="ui-li-count"><?= $user->getScore() ?></span></a></li>
        <li><a href="<//?php echo Url::to(['order', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-icon="shop" data-ajax="false"><img src="../web/images/woke/wdcf.gif" alt="我的订单" class="ui-li-icon ui-corner-none">我的订单<span class="ui-li-count"><?= count($user->orders) ?></span></a></li>
        <li><a href="<//?php echo Url::to(['addbindmobile', 'gh_id'=>$user->gh_id, 'openid'=>$user->openid]) ?>" data-icon="shop" data-ajax="false"><img src="../web/images/woke/aqsz.gif" alt="绑定管理" class="ui-li-icon ui-corner-none">绑定管理<span class="ui-li-count"><?= count($user->openidBindMobiles) ?></span></a></li>
        -->

        </ul>

    <!--
    <br>
    <a href="javascript:reloadVipfwzq();" class="ui-btn">返回</a>
    -->

    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>

</div> <!-- page1 end -->



<script>

function reloadVipfwzq()
{
    var url = "<?php echo Url::to(['wap/vipfwzq'], true); ?>";
    location.href = url;
}



</script>

<?php
/*
 *
 *
 */
?>
