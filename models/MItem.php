<?php
namespace app\models;

//$("#title").html("【校园专享】沃派校园卡");


/*
DROP TABLE IF EXISTS wx_item;
CREATE TABLE wx_item (
	iid int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	price int(10) unsigned NOT NULL DEFAULT '0',
	price_hint VARCHAR(128) NOT NULL DEFAULT '',
	title VARCHAR(128) NOT NULL DEFAULT '',
	title_hint VARCHAR(256) NOT NULL DEFAULT '',
	pkg_name VARCHAR(128) NOT NULL DEFAULT '',
	pkg_name_hint VARCHAR(256) NOT NULL DEFAULT '',
	detail text NOT NULL DEFAULT '',
	pic_url VARCHAR(256) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	status int(10) unsigned NOT NULL DEFAULT '0',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `wx_item` (`gh_id`, `price`, `price_hint`, `title`, `title_hint`, `pkg_name`, `pkg_name_hint`, `detail`, `pic_url`, `cid`, `status`) VALUES
('gh_1ad98f5481f3', 5000, '含预存款50元', '沃派校园套餐', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量, 100分钟本地长市话, 100条短信, 500M省内流量自动升级至50元包1G, 100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 10, 0),
('gh_03a74ac96138', 5000, '含预存款50元', '沃派校园卡', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量100分钟本地长市话100条短信500M省内流量自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 11, 0),
('gh_1ad98f5481f3', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 11, 0),
('gh_03a74ac96138', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 11, 0);


*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MItem extends ActiveRecord
{
	const ITEM_CAT_DIY = 0;
	const ITEM_CAT_CARD_WO = 10;
	const ITEM_CAT_CARD_XIAOYUAN = 11;

	public static function tableName()
	{
		return 'wx_item';
	}


	
}

/*
//$("#title").html("【校园专享】沃派校园卡");
$("#imgURL").html("<img width=\"60%\" src=\"http://res.mall.10010.com/mall/res/uploader/temp/20140719115711-1726575840_310_310.jpg\" alt=\"\"/>");
$("#desc").html("【校园专享】沃派校园卡 26元/月 享500M省内流量 ");

$("#price").html(" 价格  <span class='fee'>￥50</span>");
$("#priceHint").html("含预存款50元");

$("#productPkgName").html("沃派校园套餐");
$("#productPkgHint").html("500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G ");
$("#richtextDesc").html("<img width=\"100%\" style=\"display:block\"  src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404210955181014136816.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140801164013-1800990032.jpg\" alt=\"\" />\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140421114304-463429008.jpg\" alt=\"\" />\
                                                <a href=\"http://www.10010.com/pushpage/59800000134189.71.html\" target=\"_blank\"><img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201407201133341283576080.jpg\" alt=\"\" /> </a>\
                                                <a href=\"http://www.10010.com/static/homepage/subjectpage/57100000121535.html\" target=\"_blank\"><img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/201404091216411015373808.jpg\" alt=\"\" /></a>\
                                                <img width=\"100%\" style=\"display:block\" src=\"http://res.mall.10010.com/mall/res/uploader/gdesc/20140317125516342466672.jpg\" alt=\"\" />");
*/
