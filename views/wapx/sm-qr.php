<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <title>襄阳联通 官方微信号</title>
        <link rel="stylesheet" href="/wx/web/frozen/css/frozen.css">

    </head>
    <body ontouchstart="">
        <header class="ui-header ui-header-positive ui-border-b" style="background-color: #ED6D00">
            <h1>邀您关注</h1>
        </header>
        <footer class="ui-footer ui-footer-btn" style="background-color: #ED6D00; color: #fff; height:45px">
            <ul class="ui-tiled ui-border-t" style="background-color: #ED6D00; color: #fff">
                <li data-href="#" class="ui-border-r"><div>襄阳联通 &copy; 2015</div></li>
            </ul>
        </footer>

        <section class="ui-container ui-center">
    
            <img width=168 height=168 src="<?= $qr_url.'?v='.mt_rand(); ?>">
            <br>
    
            <div id="btn1" class="ui-center-hor" style="color:#aaa;"><?= $mobile ?> 专享关注二维码<i class="ui-reddot" style="height:12px"></i></div>
        </section>

        <ul class="ui-list ui-list-text ui-border-tb">
            <li class="ui-border-t">
                    <i class="ui-icon-info" style="color:#18B4ED"></i>
                    <h4 class="ui-nowrap">长按二维码，保存图片。</h4>
            </li>
            <li class="ui-border-t">
                    <i class="ui-icon-info" style="color:#18B4ED"></i>
                    <h4 class="ui-nowrap">微信扫码->右上角菜单->相册选取二维码。</h4>
            </li>
            <li class="ui-border-t">
                    <i class="ui-icon-success" style="color:#5FB336"></i>
                    <h4 class="ui-nowrap">关注公众号，完成。</h4>
            </li>
        </ul>
        &nbsp;
        <br>
        <!--
        <div class="ui-slider"><ul class="ui-slider-content" style="width: 300%"><li><span style="background-image:url(https://www.baidu.com/img/bd_logo1.png)"></span></li><li><span style="background-image:url(http://photocdn.sohu.com/20130728/Img382749805.jpg)"></span></li><li><span style="background-image:url(https://www.baidu.com/img/bd_logo1.png)"></span></li></ul></div>
        -->
        &nbsp;
        <br>
        <script src="/wx/web/frozen/lib/zepto.min.js"></script>
        <script src="/wx/web/frozen/js/frozen.js"></script>
        <script>

            $("#btn1").tap(function(){

            var mySlider = "<div class=\"ui-slider\" style=\"height:220px;width:100%\"><ul class=\"ui-slider-content\" style=\"width: 300%;\"><li><span style=\"background-image:url(http://wosotech.com/wx/web/images/hytq1.png?v1)\"></span></li><li><span style=\"background-image:url(http://wosotech.com/wx/web/images/hytq2.png?v1)\"></span></li></ul></div>";

            //var mySlider = '<br>每月手机免费贴膜一次。<br>购全场配件享七折优惠。<br>可参与每月会员日活动。<br>自营厅提供免费充电/饮水/下载手机软件等服务。<br>免费停车位，购机免费送货上门(仅限市区)。<br>微信平台每周会推出微信会员特价机。<br>...';

                var dia=$.dialog({
                    title:'襄阳联通-会员特权',
                    content:mySlider,
                    button:["确认"]
                });

                var slider = new fz.Scroll('.ui-slider', {
                    role: 'slider',
                    indicator: true,
                    autoplay: true,
                    interval: 4000
                });

                slider.on('beforeScrollStart', function(from, to) {
                    console.log(from, to);
                });

                slider.on('scrollEnd', function(cruPage) {
                    console.log(curPage);
                });
                /*
                dia.on("dialog:action",function(e){
                    console.log(e.index)
                });
                dia.on("dialog:hide",function(e){
                    console.log("dialog hide")
                });
                */

            })
  
        </script>


        <script>
            (function(){



            })();
    </script>


    </body>
</html>