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
	quantity int(10) unsigned NOT NULL DEFAULT '0',
	old_price int(10) unsigned NOT NULL DEFAULT '0',
	old_price_hint VARCHAR(128) NOT NULL DEFAULT '',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE wx_item ADD quantity int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD old_price int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD	old_price_hint VARCHAR(128) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD	kind tinyint(3) unsigned NOT NULL DEFAULT '0';

ALTER TABLE wx_item ADD	ctrl_mobnumber tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD	ctrl_userinfo tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD	ctrl_office tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD	ctrl_supportpay VARCHAR(128) NOT NULL DEFAULT '';

ALTER TABLE wx_item ADD	ctrl_pkg_model VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD	ctrl_pkg_period VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD	ctrl_pkg_monthprice VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD	ctrl_pkg_plan VARCHAR(8) NOT NULL DEFAULT '';

INSERT INTO `wx_item` (`gh_id`, `price`, `price_hint`, `title`, `title_hint`, `pkg_name`, `pkg_name_hint`, `detail`, `pic_url`, `cid`, `status`) VALUES
('gh_03a74ac96138', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 10, 0);
('gh_03a74ac96138', 5000, '含预存款50元', '沃派校园卡', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量100分钟本地长市话100条短信500M省内流量自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 11, 0),
('gh_1ad98f5481f3', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 10, 0),
('gh_1ad98f5481f3', 5000, '含预存款50元', '沃派校园套餐', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量, 100分钟本地长市话, 100条短信, 500M省内流量自动升级至50元包1G, 100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 11, 0),


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

	const ITEM_CAT_MOBILE_IPHONE4S = 12;
	const ITEM_CAT_MOBILE_K1 = 13;
	const ITEM_CAT_MOBILE_HTC516 = 14;
	const ITEM_CAT_GOODNUMBER = 300;

	const ITEM_CAT_MOBILE_APPLE_5C_8G_WHITE = 310;
	const ITEM_CAT_MOBILE_APPLE_5C_8G_BLUE = 311;
	const ITEM_CAT_MOBILE_HTC_8160_SILVER = 312;
	const ITEM_CAT_MOBILE_SAMSUNG_7506V_BLACK = 313;
	const ITEM_CAT_MOBILE_COOLPAD_7298A_CHUNLEI_WHITE = 314;
	const ITEM_CAT_MOBILE_LENOVOA_A850_BLACK = 315;
	const ITEM_CAT_MOBILE_COOLPAD_7295C_WHITE = 316;
	
	const ITEM_CAT_MOBILE_APPLE_5S_32G_SILVER = 317;
	const ITEM_CAT_MOBILE_COOLPAD_7296_BLACK = 318;
	const ITEM_CAT_MOBILE_COOLPAD_7296_WHITE = 319;
	const ITEM_CAT_MOBILE_COOLPAD_K1_WHITE = 320;
	const ITEM_CAT_MOBILE_COOLPAD_7235_BLACK = 321;
	const ITEM_CAT_MOBILE_COOLPAD_7230S_BLACK = 322;
	const ITEM_CAT_MOBILE_HISENSE_U939 = 323;
	const ITEM_CAT_MOBILE_COOLPAD_7295C_BLACK = 324;


	const ITEM_KIND_CARD = 2;
	const ITEM_KIND_MOBILE = 1;

	

	public static function tableName()
	{
		return 'wx_item';
	}

	static function getItemCatName($key=null)
	{
		$arr = array(
			self::ITEM_CAT_DIY => '自由组合套餐',
			self::ITEM_CAT_CARD_WO => '微信沃卡',
			self::ITEM_CAT_CARD_XIAOYUAN => '校园沃卡',
            self::ITEM_CAT_MOBILE_IPHONE4S => 'Apple iPhone4S',
            self::ITEM_CAT_MOBILE_K1 => 'K1',
            self::ITEM_CAT_MOBILE_HTC516 => 'HTC516',
			self::ITEM_CAT_GOODNUMBER => '精选靓号',
		
			self::ITEM_CAT_MOBILE_APPLE_5C_8G_WHITE => '苹果5C 8G 白色',
			self::ITEM_CAT_MOBILE_APPLE_5C_8G_BLUE => '苹果5C 8G 蓝色',
			self::ITEM_CAT_MOBILE_HTC_8160_SILVER => 'HTC 8160 银色',
			self::ITEM_CAT_MOBILE_SAMSUNG_7506V_BLACK => '三星 7506V 黑色',
			self::ITEM_CAT_MOBILE_COOLPAD_7298A_CHUNLEI_WHITE => '酷派 7298A 春雷 白色',
			self::ITEM_CAT_MOBILE_LENOVOA_A850_BLACK => '联想 A850+ 黑色',
			self::ITEM_CAT_MOBILE_COOLPAD_7295C_WHITE => '酷派 7295C 白色',
			self::ITEM_CAT_MOBILE_APPLE_5S_32G_SILVER => '苹果 5S 32G 银色',
			self::ITEM_CAT_MOBILE_COOLPAD_7296_BLACK => '酷派 7296 黑色',
			self::ITEM_CAT_MOBILE_COOLPAD_7296_WHITE => '酷派 7296 白色',
			self::ITEM_CAT_MOBILE_COOLPAD_K1_WHITE => '酷派 K1 白色',
			self::ITEM_CAT_MOBILE_COOLPAD_7235_BLACK => '酷派 7235 黑色',
			self::ITEM_CAT_MOBILE_COOLPAD_7230S_BLACK => '酷派 7230S 黑色',
			self::ITEM_CAT_MOBILE_HISENSE_U939 => '海信 U939',
			self::ITEM_CAT_MOBILE_COOLPAD_7295C_BLACK => '酷派 7295C 黑色',

		);		
		return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
	}
	
	public function rules()
	{
		return [
			[['cid'], 'integer'],            
			[['price', 'price_hint', 'title', 'title_hint', 'pkg_name', 'pkg_name_hint', 'pic_url', 'detail', 'ctrl_mobnumber', 'ctrl_userinfo', 'ctrl_office', 'ctrl_supportpay'], 'safe'],
		];
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
