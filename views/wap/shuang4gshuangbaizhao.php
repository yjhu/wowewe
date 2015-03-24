<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MItem;

?>
    
<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

</style>

<div data-role="page" id="page1" data-theme="c">

	<div data-role="header">
            <h1>4G专区</h1>
    </div>

    <div data-role="content">
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" class="ui-nodisc-icon ui-alt-icon">
        
        <!-- 链接到网厅 -->
        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/meilan-note-120x120.jpg">
                <h2>魅蓝note</h2>
                <p>5.5英寸,分辨率1920×1080(FHD,1080P),1300万像素,八核</p>
                <p>价格: ￥1199</p>
            </a>
        </li>

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/meizu-4X-120x120.jpg">
                <h2>魅族4X</h2>
                <p>5.36英寸,分辨率1920×1152,2070万像素,八核,拍照神器1080P屏</p>
                <p>价格: ￥1999</p>
            </a>
        </li>

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/iphone6plus-120x120.jpg">
                <h2>iPhone6 plus</h2>
                <p>5.5英寸,分辨率1920x1080,800万像素,配备 64 位架构的 A8 芯片,M8 运动协处理器</p>
                <p>价格: ￥6299</p>
            </a>
        </li>


        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/iphone6-120x120.jpg">
                <h2>iPhone6</h2>
                <p>4.7英寸,分辨率1334x750,800万像素,配备 64 位架构的 A8 芯片,M8 运动协处理器</p>
                <p>价格: ￥5499</p>
            </a>
        </li>
    

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/lianxiang-s856-120x120.jpg">
                <h2>联想S856</h2>
                <p> 5.5英寸,分辨率1280x720,4核,双卡双模,运行内存1GB,机身8GB</p>
                <p>价格: ￥1599</p>
            </a>
        </li>

        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/changwan-4X-120x120.jpg">
                <h2>畅玩4X</h2>
                <p>5.5英寸,分辨率1280x720,八核1.2Ghz,运行内存1GB,机身内存8GB,电池容量3000mAh </p>
                <p>价格: ￥999</p>
            </a>
        </li>


        <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/sanxing-5108q-120x120.jpg">
                <h2>三星5108Q</h2>
                <p>4.8英寸,分辨率960×540(QHD),800万像素,四核1.2GHz</p>
                <p>价格: ￥1799</p>
            </a>
        </li>

          <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/zhongxing-v5-120x120.jpg">
                <h2>中兴V5  </h2>
                <p>5.0英寸,分辨率1280×720(HD,720P),800万像素,四核1.2GHz</p>
                <p>价格: ￥799</p>
            </a>
        </li>
                              
         <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/huawei-mate7-120x120.jpg">
                <h2>华为mate 7</h2>
                <p>6.0英寸,分辨率1920×1080(FHD,1080P),1300万像素,4核A15 1.8 GHz+4核A7 </p>
                <p>价格: ￥3199</p>
            </a>
        </li>

          <li><a data-ajax="false" href="xxxxxxxxxxxxxxxxxxxxxxxxxxxxx">
                <img style='padding-top:20px' src="../web/images/item/sanxing-note4-120x120.jpg">
                <h2>三星note4</h2>
                <p>5.7英寸,分辨率2560×1440,1600万像素,四核2.7GHz</p>
                <p>价格: ￥5399</p>
            </a>
        </li>
                   
        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2015</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->

<?php
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '特惠手机';
	$desc = '多款热销机型，优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
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
		prepare:function(argv) {	},
		callback:function(res){	 }
	};
</script>

<?php
/*
 *
       <li><a data-ajax="false" href="http://wap.10010.com/t/businessTransact/query3gFlow.htm?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c215960148c4e5b725006e&menuId=000300010001">
                <img style='padding-top:20px' src="../web/images/item/liuliangbao-120x120.jpg">
                <h2>3G国内流量包</h2>
                <p>流量在手, 别无所求！</p>
                <p>&nbsp;</p>
            </a>
        </li>
 *
 */
?>
