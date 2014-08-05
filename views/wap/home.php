<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Alert;

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="/wx/web/css/bootstrap.home.min.css" rel="stylesheet">
</head>

<body>
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
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzc3NyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojNTU1O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+Rmlyc3Qgc2xpZGU8L3RleHQ+PC9zdmc+" alt="...">
                <div class="carousel-caption">
                    Welcome
                </div>
            </div>
            <div class="item">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI5MDAiIGhlaWdodD0iNTAwIj48cmVjdCB3aWR0aD0iOTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iIzY2NiI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjQ1MCIgeT0iMjUwIiBzdHlsZT0iZmlsbDojNDQ0O2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjU2cHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+U2Vjb25kIHNsaWRlPC90ZXh0Pjwvc3ZnPg==" alt="...">
                <div class="carousel-caption">
                  Hello world
                </div>
            </div>

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
        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203635121&idx=1&sn=b47bc2f6a4490819227853e8ffed72c9#rd" >
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

</div>
</div>
</body>
</html>
<script src="/wx/web/css/jquery.home.min.js"></script>
<script src="/wx/web/css/bootstrap.home.min.js"></script>