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
    	<h1>特惠手机</h1>
    </div>

    <div data-role="content">
        
        <!--<ul data-role="listview" data-inset="true">-->
        <ul data-role="listview" data-inset="false" data-filter="true" data-filter-placeholder="搜索..." class="ui-nodisc-icon ui-alt-icon">

        <!-- 20141103 add start -->

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409287410.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89249193eee01495071e2020052&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/samsung-N9106W-750x750jpg-120x120.jpg">
                <h2>三星Note4 SM-N9106W</h2>
                <p>三星(Samsung) GALAXY Note4 SM-N9106W 4G全国合约套餐合约机 5.7英寸2k分辨率 支持联通双4G网络 1600万光学防抖摄像头</p>
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
                <p>合约价: ￥5399</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409166943.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29301490db9579000d0&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-4-white-700x500.jpg-120x120.jpg">
                <h2>小米4</h2>
                <p>小米 小米4 4G全国合约套餐合约机 5英寸高饱和度屏幕 骁龙801四核2.5GHz处理器</p>
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
                <p>合约价: ￥2199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409166959.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29301490db813c900cb&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-note-700x500.jpg-120x120.jpg">
                <h2>小米 红米Note</h2>
                <p>小米 红米Note 联通4G增强版 4G全国套餐合约机 5.5英寸全贴合IPS大屏 高通骁龙400系列 四核1.6GHz</p>
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
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
                <!--<p class='line'>原价: ￥<?//= $model->old_price/100 ?></p>-->
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
        <!--
        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111409307598.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89249193eee01495b4bb192005c&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/huawei-mate7-white-700x500.jpg-120x120.jpg">
                <h2>华为Ascend Mate7 4G</h2>
                <p>华为(HUAWEI) Ascend Mate7 4G 全国套餐合约机 6英寸高清大屏 全金属材质 极简设计</p>
                 <p>合约价: ￥3199</p>
                <p>&nbsp;</p>
            </a>
        </li>
        
        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/711409287410.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89249193eee01495071e2020052&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/samsung-N9106W-750x750jpg-120x120.jpg">
                <h2>三星Note4 SM-N9106W</h2>
                <p>三星(Samsung) GALAXY Note4 SM-N9106W 4G全国合约套餐合约机 5.7英寸2k分辨率 支持联通双4G网络 1600万光学防抖摄像头</p>
                  <p>合约价: ￥5399</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111410108357.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89248edb29c0148f7e9ec5b014e&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/iphone6-white-700x500.jpg-120x120.jpg">
                <h2>苹果iPhone6 (Plus)</h2>
                <p>苹果(APPLE) iPhone 6/iPhone 6 Plus 六模全兼容版 (FDD-LTE/TDD-LTE/WCDMA/TDS/EVDO/GSM) 巅峰之作 岂止于大！64位架构 A8芯片 M8运动协处理器iOS8六模全兼容</p>
                <p>合约价: ￥5499</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111405139288.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c6577d0148c6cf32fc008d&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/huawei-p7-white-120x120.jpg">
                <h2>华为Ascend P7 4G联通版</h2>
                <p>华为(HUAWEI) Ascend P7 4G全国合约套餐合约机 华为年度旗舰 创新工艺设计 支持联通4G</p>
                <p>合约价: ￥2599</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111407153411.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148c6577d0148c6c45e760006&recommendName=&recommendCode=&exp=">
                <img style='padding-top:20px' src="../web/images/item/huawei-3c-120x120.jpg">
                <h2>荣耀3c联通4G版</h2>
                <p>华为(HUAWEI)荣耀3C-LTE标准版 联通4G全国套餐合约机 千元机之王 四核 1.6GHz极速处理器</p>
                <p>合约价: ￥999</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111409166950.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148bf74920148bf776aa40005">
                <img style='padding-top:20px' src="../web/images/item/meizu-mx4-700x500.jpg-120x120.jpg">
                <h2>魅族MX4</h2>
                <p>魅族(MEIZU) MX4(16G) 4G全国合约套餐合约机 真八核2070万像素摄像头 支持联通双4G网络 </p>
                    <p>合约价: ￥1999</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111409166944.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148bf74920148bf7589030001">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-4-white-700x500.jpg-120x120.jpg">
                <h2>小米4</h2>
                <p>小米 小米4 4G全国合约套餐合约机 5英寸高饱和度屏幕 骁龙801四核2.5GHz处理器</p>
                <p>合约价: ￥2199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111406181646.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148bbab480148bf6f7bf1001d">
                <img style='padding-top:20px' src="../web/images/item/htc-one-750x750.jpg-120x120.jpg">
                <h2>HTC One (M8Sw)</h2>
                <p>HTC One 时尚版(M8Sw) 5英寸大屏 支持联通4G 双卡双待</p>
                <p>合约价: ￥2999</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111409016101.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a89148bbab480148bf4e1e780019">
                <img style='padding-top:20px' src="../web/images/item/lenovo-A806-750x750.jpg-120x120.jpg">
                <h2>联想(Lenovo) A806</h2>
                <p>联想(Lenovo) A806 全面支持4G网络 真八核超强处理器</p>
                <p>合约价: ￥1198</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111403161860.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891488a676c01488df340c70020">
                <img style='padding-top:20px' src="../web/images/item/iphone5s-700x500.jpg-120x120.jpg">
                <h2>iPhone5s 4G联通合约机</h2>
                <p>iPhone5s 4G全国合约套餐合约机</p>
                <p>合约价: ￥4699</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111409166959.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891488a676c01488de434ad001c">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-note-700x500.jpg-120x120.jpg">
                <h2>小米 红米Note</h2>
                <p>小米 红米Note 联通4G增强版 4G全国套餐合约机 5.5英寸全贴合IPS大屏 高通骁龙400系列 四核1.6GHz</p>
                <p>合约价: ￥1199</p>
                <p>&nbsp;</p>
            </a>
        </li>

        <li><a data-ajax="false" href="http://m.10010.com/mobilegoodsdetail/111404307757.html?src=wolm&channel=cps&cid=8a94a89148bf746b0148bfe4ee5600ef&adid=8a94a891487978800148827f8c1200a2">
                <img style='padding-top:20px' src="../web/images/item/xiaomi-1s-700x500.jpg-120x120.jpg">
                <h2>小米 红米</h2>
                <p>小米 红米1S 4G全国合约套餐合约机 更强配置更高性价比 采用高通骁龙四核处理器 高通闪存升至8GB</p>
                    <p>合约价: ￥999</p>
                <p>&nbsp;</p>
            </a>
        </li>
        -->

        <!-- 20141103 add end -->


        <?php foreach($models as $model) { if($model->cid==317 || $model->cid==331 || $model->cid==310 || $model->cid==311) continue; else { ?>
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid],true) ?>">
                    <img style='padding-top:20px' src="<?php echo $model->pic_url.'-120x120.jpg' ?>">
                    <h2><?= $model->title ?></h2>
                    <p><?= $model->title_hint ?></p>
                    <p class='line'>原价: ￥<?= round($model->old_price/100) ?></p>
                    <p>惊爆价: ￥<?= round($model->price/100) ?></p>
                </a>
            </li>
        <?php } } ?>
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
	$url = Yii::$app->wx->WxGetOauth2Url('snsapi_base', 'wap/mobilelist:'.Yii::$app->wx->getGhid().":wid={$wid}");
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
            <li><a data-ajax="false" href="<?php echo  Url::to(['wap/mobile', 'cid'=>$model->cid, 'price'=>$model->price, 'title_hint'=>$model->title_hint],true) ?>">

 */
