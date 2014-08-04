<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\JqmAsset;
JqmAsset::register($this);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link href="/wx/web/css/metro-bootstrap/dist/css/metro-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/wx/web/css/metro-bootstrap/docs/styles/docs.css">

<!--
style="margin:10px;"
-->

<body>

<!-- Tile Colors -->
<h3 id="thumbnails-default"></h3>
<div class="bs-example">
<div class="row">
<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-wide tile-orange">
        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203635121&idx=1&sn=b47bc2f6a4490819227853e8ffed72c9#rd" >
            <h1>八月浪漫季
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-blue col-md-3" >
        <a href="<?php echo Url::to(['wap/product'], true) ; ?>" >
            <h1>自由组合套餐
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-red col-md-3">
        <a href="<?php echo Url::to(['wap/cardwo'], true) ; ?>" >
            <h1>微信沃卡
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-lime col-md-3">
        <a href="<?php echo Url::to(['wap/g2048'], true) ; ?>" >
            <h1>游戏2048
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-yellow col-md-3">
        <a href="<?php echo Url::to(['wap/cardxiaoyuan'], true) ; ?>" >
            <h1>沃派校园套餐
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-pink col-md-3">
        <a href="http://m.10010.com/mall-mobile/NumList/search" >
            <h1>精选靓号
            </h1>
        </a>
    </div>
</div>

    <div class="col-sm-6 col-md-3">
        <div class="thumbnail tile tile-medium tile-green-sea col-md-3">
            <a href="http://wap.10010.com/t/siteMap.htm?menuId=query" >
                <h1>账单查询
                </h1>
            </a>
        </div>
    </div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-wide tile-green">
        <a href="<?php echo Url::to(['wap/mobilelist'], true) ; ?>" >
            <h1>特惠手机
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-magenta col-md-3">
        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203635121&idx=1&sn=b47bc2f6a4490819227853e8ffed72c9#rd" >
            <h1>关注有礼
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-teal col-md-3">
        <a href="<?php echo Url::to(['wap/suggest'], true) ; ?>" >
            <h1>用户吐槽
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-turquoise col-md-3">
        <a href="http://mp.weixin.qq.com/s?__biz=MzA4ODkwOTYxMA==&mid=203609285&idx=1&sn=06c623779131934da8368482a55e5ba1#rd" >
            <h1>流量包订购
            </h1>
        </a>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="thumbnail tile tile-medium tile-emerald col-md-3">
        <a href="#" >
            <h1>
            </h1>
        </a>
    </div>
</div>

</div><!-- /.bs-example -->
</div>

<script type="text/javascript" src="/wx/web/assets/2d8fbc2a/jquery.js"></script>
<script type="text/javascript" src="/wx/web/css/metro-bootstrap/docs/scripts/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="/wx/web/css/metro-bootstrap/docs/scripts/metro-docs.js"></script>
<script type="text/javascript">
</body>
</html>