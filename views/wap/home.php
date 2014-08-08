<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\models\U;

use app\assets\JqmAsset;
JqmAsset::register($this);

$assetsPath = Yii::$app->getRequest()->baseUrl.'/../web/images';

$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js?v0.1');

$gh_id = U::getSessionParam('gh_id');
Yii::$app->wx->setGhid($gh_id);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="/wx/web/css/bootstrap.home.min.css" rel="stylesheet">

    <style type="text/CSS">

        .wrap > .container {
            padding: 0px 0px 0px !important;
        }
    </style>


    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div data-role="page" id="page1" data-theme="e">

    <div data-role="header" data-theme="e">
        <h1>襄阳联通官方微信营业厅</h1>
    </div>

    <div data-role="content">

        <div class="wrap">
            <div class="container" style="padding-top:0px;">

                <!--
                每个小色块换成 345x190（原230x137）
                长色块换成 700x190（原来是 465x127）
                整个布局换成 2 - 2 - 1 - 2 - 1 - 2
                第一行： 自由组合套餐， 微信沃卡
                第二行： 沃派校园套餐， 精选靓号
                第三行：特惠手机
                第四行：账单查询，流量包订购
                第5行：关注有礼
                第6行：用户吐槽，2048
                另，画内色块间距，横竖都换成10（原来是5）
                -->

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <!--
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        -->
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="../web/images/metro_home_head1.jpg" alt="八月浪漫季">
                            <div class="carousel-caption">
                            </div>
                        </div>

                        <div class="item">
                            <img src="../web/images/metro_home_head2.jpg" alt="八月浪漫季">
                            <div class="carousel-caption">
                            </div>
                        </div>
                        <!--
                        <div class="item">
                            <img src="../web/images/metro_home_head1.jpg" alt="八月浪漫季">
                            <div class="carousel-caption">
                            </div>
                        </div>
                        -->
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


                <div class="row" style="margin-top: 10px">
                    <div class="col-md-6 col-xs-6" >
                        <a href="<?php echo Url::to(['wap/product'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-zyzhtc.jpg">
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6" >
                        <a href="<?php echo Url::to(['wap/cardwo'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-wxwk.jpg">
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="<?php echo Url::to(['wap/cardxiaoyuan'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-wpxytc.jpg">
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="http://m.10010.com/mall-mobile/NumList/search" >
                            <img width=100% src="../web/images/metro-jxlh.jpg">
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12 col-xs-12" >
                        <a href="<?php echo Url::to(['wap/mobilelist'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-thsj.jpg">
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="http://wap.10010.com/t/siteMap.htm?menuId=query" >
                            <img width=100% src="../web/images/metro-zdcx.jpg">
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd" >
                            <img width=100% src="../web/images/metro-llbdg.jpg">
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12 col-xs-12">
                        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203837364&idx=1&sn=e320d6d5bc60b71bdedabe25b515f93d#rd" >
                            <img width=100% src="../web/images/metro-gzyl.jpg">
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="<?php echo Url::to(['wap/suggest'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-yhtc.jpg">
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6" style="margin: 10px auto">
                        <a href="<?php echo Url::to(['wap/g2048'], true) ; ?>" >
                            <img width=100% src="../web/images/metro-2048.jpg">
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <div class="col-md-12 col-xs-12">
                        <!--
                        <img width=100% src="../web/images/metro-gzyl.jpg">
                        -->
                        <img class="img-responsive" src="/wx/web/images/wx-tuiguang2.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div data-role="footer">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>

</div> <!-- page1 end -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php
$appid = Yii::$app->wx->gh['appid'];

$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/home:'.Yii::$app->wx->getGhid());
$myImg = Url::to("$assetsPath/share-icon.jpg", true);
$title = '襄阳联通官方微信营业厅';
$desc = '欢迎进入襄阳联通官方微信营业厅';

?>

<script>
    var dataForWeixin={
        appId:"<?php echo $appid; ?>",
        MsgImg:"<?php echo $myImg; ?>",
        TLImg:"<?php echo $myImg; ?>",
        url:"<?php echo $url; ?>",
        title:"<?php echo $title; ?>",
        desc:"<?php echo $desc; ?>",
        fakeid:"",
        prepare:function(argv)
        {

        },

        callback:function(res)
        {
            //发送给好友或应用
            if (res.err_msg=='send_app_msg:confirm') {
                //todo:func1();
                ///alert(res.err_desc);
            }
            if (res.err_msg=='send_app_msg:cancel') {
            }
            //分享到朋友圈
            if (res.err_msg=='share_timeline:confirm') {
            }
            if (res.err_msg=='share_timeline:cancel') {
            }
            //分享到微博
            if (res.err_msg=='share_weibo:confirm') {
            }
            if (res.err_msg=='share_weibo:cancel') {
            }
            //收藏或分享到应用
            if (res.err_msg=='send_app_msg:ok') {
            }
        }
    };


</script>
<script src="/wx/web/css/jquery.home.min.js"></script>
<script src="/wx/web/css/bootstrap.home.min.js"></script>





