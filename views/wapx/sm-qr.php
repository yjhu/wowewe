<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title></title>
        <link rel="stylesheet" href="/wx/web/frozen/css/frozen.css">
    </head>
    <body ontouchstart="">
        <header class="ui-header ui-header-positive ui-border-b" style="background-color: #ED6D00">
            <h1>邀您关注</h1>
        </header>
        <footer class="ui-footer ui-footer-btn" style="background-color: #ED6D00; color: #fff">
            <ul class="ui-tiled ui-border-t" style="background-color: #ED6D00; color: #fff">
                <li data-href="#" class="ui-border-r"><div>襄阳联通 &copy; 2015</div></li>
            </ul>
        </footer>

        <section class="ui-container ui-center">
            <br>
            <img width=65%  src="<?= $qr_url ?>">
        </section>

        <center>
        <br><br>
        <span style="color:#aaa"><?= $mobile ?> 专享二维码</span>
        </center>
        <br>
        <ul class="ui-list ui-list-text ui-border-tb">
            <li class="ui-border-t">
                    <i class="ui-icon-info" style="color:#18B4ED"></i>
                    <h4 class="ui-nowrap">长按二维码，保存图片。</h4>
            </li>
            <li class="ui-border-t">
                    <i class="ui-icon-info" style="color:#18B4ED"></i>
                    <h4 class="ui-nowrap">微信扫一扫，从相册选取二维码。</h4>
            </li>
            <li class="ui-border-t">
                    <i class="ui-icon-success" style="color:#5FB336"></i>
                    <h4 class="ui-nowrap">关注公众号，完成。</h4>
            </li>
        </ul>
        &nbsp;
        <br>
        &nbsp;
        <br>
        <script src="/wx/web/frozen/lib/zepto.min.js"></script>
        <script src="/wx/web/frozen/js/frozen.js"></script>
        <script>

        </script>
    </body>
</html>