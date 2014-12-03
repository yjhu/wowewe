<?php
	use yii\helpers\Html;
    use yii\helpers\Url;

    use app\models\U;
    use app\models\MOffice;
    use app\models\MSceneDetail;
?>
    
<style type="text/CSS">

    .ui-header .ui-title, .ui-footer .ui-title {
        margin-right: 0 !important; margin-left: 0 !important;
    }

    .line {
        color: #aaaaaa;
        text-decoration: line-through;
    }

    .activity {
        color: red;
        font-size:14px;
        font-weight: bolder;
    } 

</style>

<div data-role="page" id="page1" data-theme="c">

	<div data-role="header">
    	<h1>沃联盟商铺</h1>
    </div>

    <div data-role="content">
        
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" data-filter="true" data-filter-placeholder="搜索..." class="ui-nodisc-icon ui-alt-icon">


        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409287410.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89249193eee01495071e2020052&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/samsung-N9106W-750x750jpg-120x120.jpg">
                <h2>三星Note4 SM-N9106W</h2>
                <p>三星(Samsung) GALAXY Note4 SM-N9106W 4G全国合约套餐合约机 5.7英寸2k分辨率 支持联通双4G网络 1600万光学防抖摄像头</p>
                <p>合约价: ￥5399</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409166943.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29301490db9579000d0&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-4-white-700x500.jpg-120x120.jpg">
                <h2>小米4</h2>
                <p>小米 小米4 4G全国合约套餐合约机 5英寸高饱和度屏幕 骁龙801四核2.5GHz处理器</p>
                <p>合约价: ￥2199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409166959.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29301490db813c900cb&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-note-700x500.jpg-120x120.jpg">
                <h2>小米 红米Note</h2>
                <p>小米 红米Note 联通4G增强版 4G全国套餐合约机 5.5英寸全贴合IPS大屏 高通骁龙400系列 四核1.6GHz</p>
                <p>合约价: ￥1199</p>
                <p>&nbsp;</p>
            </a>
        </li>


        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409307712.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148edb02a014908b5459700a2&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/HTC-D820u-700x500.jpg-120x120.jpg">
                <h2>HTC D820u 4G</h2>
                <p>HTC D820u 4G 全国套餐合约机 5.5英寸高超清大屏 双前置立体震撼影音</p>
                <p>合约价: ￥2199</p>
                <p>&nbsp;</p>
            </a>
        </li>


        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409238196.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29301490d8ed0ae00b2&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/lenevo-A916-700x500.jpg-120x120.jpg">
                <h2>联想(Lenovo) A916 4G</h2>
                <p>联想(Lenovo) A916 4G 全国套餐合约机 5.5英寸大屏 八核LTE多模手机 极速畅游 呼啸而至</p>
                <p>合约价: ￥1199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711408014789.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891487978800148826b0d5a005a">
                <img style='padding-top:20px' src="../web/images/item/huawei-honor6-120x120.jpg">
                <h2>华为荣耀6</h2>
                <p>全球首款八核4G CAT6手机 顶级品质5.0英寸全高清屏 八核1.7GHz极速处理器</p>
                <p>合约价: ￥2199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <!-- -->
        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711408065085.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89149af6e830149c0f3e6db012b&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/wlm-sony-s55u.jpg">
                <h2>索尼C3 S55u</h2>
                <p>索尼（SONY）Xperia C3 4G LTE联通版双卡双待4G-LTE多模多频 5.5英寸高清IPS大屏</p>
                <p>合约价: ￥1999</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711410108357.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a892496245bd0149a79b933a01b0&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/wlm-apple-iphone6.jpg">
                <h2>苹果iPhone 6/iPhone 6 Plus</h2>
                <p>六模全兼容版,巅峰之作岂止于大！64位架构 A8芯片 M8运动协处理器 iOS8 六模全兼容</p>
                <p>合约价: ￥6299</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711301216259.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891496245270149655488cd001a&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/wlm-3gshangwangka.jpg">
                <h2>3G上网卡 </h2>
                <p>200元上网费+SIM卡+60元/月包5GB本地流量套餐</p>
                <p>合约价: ￥130</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711407234349.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891496245270149654fca0e0010&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/wlm-96gbaonianliuliangka.jpg">
                <h2>96G包年流量卡</h2>
                <p>包含90G省内流量和6G国内流量,超出流量按0.0001元/KB计费,本地主叫0.6元/分钟,本地被叫免费.</p>
                <p>合约价: ￥650</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711407234350.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891496245270149654f0b1d000b&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/wlm-45gbaonianliuliangka.jpg">
                <h2>45G包年流量卡</h2>
                <p>包含40G省内流量和5G国内流量,超出流量按0.0001元/KB计费,本地主叫0.6元/分钟,本地被叫免费.</p>
                <p>合约价: ￥390</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <!-- -->

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711403121719.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d40ab930009">
                <img style='padding-top:20px' src="../web/images/item/4Gliuliangbao-120x120.jpg">
                <h2>4G全国套餐</h2>
                <p>让您用得起 用得放心的套餐!</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://www.10010.com/goodsdetail/711405149472.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a8914879788001487d3a26690005&menuId=000300010001">
                <img style='padding-top:20px' src="../web/images/item/ziyoutaocan-120x120.jpg">
                <h2>4G组合套餐</h2>
                <p>自由选择, 随意组合!</p>
                <p>&nbsp;</p>
            </a>
        </li>

        </ul>
    </div>

    <div data-role="footer" data-position="fixed">
        <h4>&copy; 襄阳联通 2014</h4>
    </div>
    <?php echo $this->render('menu', ['menuId'=>'menu1','gh_id'=>$gh_id, 'openid'=>$openid]); ?>
</div> <!-- page1 end -->

<?php
	$src = MSceneDetail::SRC_ID_SHARE_FRIEND;
	$wid = implode('_', [U::getWid($gh_id, $openid), $src]);
	$this->registerJsFile(Yii::$app->getRequest()->baseUrl.'/js/wechat.js');
	$assetsPath = Yii::$app->getRequest()->baseUrl.'/images';
	$appid = Yii::$app->wx->gh['appid'];
	//$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid());
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/wlmshop:'.Yii::$app->wx->getGhid().":wid={$wid}");
	$myImg = Url::to("$assetsPath/share-icon.jpg", true);
	$title = '沃联盟商铺';
	$desc = '多款热销产品，优惠大放送，快来瞄瞄吧~~ 心动不如行动！';
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
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid, 'price'=>$model->price, 'title_hint'=>$model->title_hint],true) ?>">

 */
