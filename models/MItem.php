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
kind tinyint(3) NOT NULL DEFAULT 0,
ctrl_mobnumber tinyint(3) NOT NULL DEFAULT 0,
ctrl_userinfo tinyint(3) NOT NULL DEFAULT 0,
ctrl_office tinyint(3) NOT NULL DEFAULT 0,
ctrl_package tinyint(3) NOT NULL DEFAULT 0,
ctrl_supportpay VARCHAR(128) NOT NULL DEFAULT '',
ctrl_address tinyint(3) NOT NULL DEFAULT 0,
ctrl_detail tinyint(3) NOT NULL DEFAULT 0,
scene_percent int(10) unsigned NOT NULL DEFAULT '0',
ctrl_pkg_3g4g VARCHAR(32) NOT NULL DEFAULT '',
ctrl_pkg_period VARCHAR(32) NOT NULL DEFAULT '',
ctrl_pkg_monthprice VARCHAR(64) NOT NULL DEFAULT '',
ctrl_pkg_plan VARCHAR(8) NOT NULL DEFAULT '',
ctrl_soldout tinyint(3) unsigned NOT NULL DEFAULT '0',

KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

 */

use yii\db\ActiveRecord;

class MItem extends ActiveRecord {
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

    const ITEM_CAT_MOBILE_HUAWEI_HONOR_3C_BLACK = 325;
    const ITEM_CAT_MOBILE_HUAWEI_HONOR_3C_WHITE = 326;

    const ITEM_CAT_MOBILE_HUAWEI_HONOR_6_BLACK = 327;
    const ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE = 328;

    const ITEM_CAT_MOBILE_HUAWEI_P7_BLACK = 329;
    const ITEM_CAT_MOBILE_HUAWEI_P7_WHITE = 330;

    const ITEM_CAT_MOBILE_XIAOMI4 = 331;

    //双十一活动手机
    //----------------------------------------------------------
    //ITEM_CAT_MOBILE_IPHONE4S iPhone 4S  8GB GSM  =12
    //ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE 荣耀6 =328
    //ITEM_CAT_MOBILE_XIAOMI4 小米4 =331
    const ITEM_CAT_APPLE_5S_16G = 332;
    const ITEM_CAT_APPLE_6_16G = 333;
    const ITEM_CAT_MOBILE_XIAOMI_HM_NOTE = 334;
    const ITEM_CAT_MOBILE_SONY_S55U = 335;
    const ITEM_CAT_MOBILE_XIAOMI_HM_1S = 336;

    const ITEM_CAT_CARD_45GLIULIANG = 700;
    const ITEM_CAT_CARD_96GLIULIANG = 701;

    const ITEM_KIND_INTERNET_CARD_FLOW100MB = 702;
    const ITEM_KIND_INTERNET_CARD_FLOW300MB = 703;
    const ITEM_KIND_INTERNET_CARD_FLOW500MB = 704;
    const ITEM_KIND_INTERNET_CARD_FLOW1GB_1 = 705;
    const ITEM_KIND_INTERNET_CARD_FLOW2DOT5GB = 706;
    const ITEM_KIND_INTERNET_CARD_FLOW1GB_2 = 707;

    //双十一活动 上网卡
    //----------------------------------------------------------
    const ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG = 708;
    const ITEM_CAT_CARD_1111_3GLIULIANG = 709;
    const ITEM_CAT_CARD_1111_6GLIULIANG = 710;
    const ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG = 711;
    const ITEM_CAT_CARD_1111_45GLIULIANG = 712;
    const ITEM_CAT_CARD_1111_96GLIULIANG = 713;

    const ITEM_KIND_INTERNET_CARD_FLOW_FREE = 714;

    const ITEM_KIND_INTERNET_CARD_300YUANSHICHANGBANNIANKA = 715;
    const ITEM_KIND_INTERNET_CARD_600YUANSHICHANGNIANKA = 716;
    const ITEM_KIND_INTERNET_CARD_1200YUANSHICHANGNIANKA = 717;

    const ITEM_CAT_CARD_120GLIULIANG = 718;
    const ITEM_CAT_CARD_240GLIULIANG = 719;

    const ITEM_CAT_CARD_60YUANBAO5G_SHANGWANGKA = 720;

    /*
    4G全国数据套餐6G半年包
    4G全国数据套餐12G半年包
    4G省内数据套餐17G半年包
    45G包年流量套餐
    600元时长年卡
    */
    const ITEM_CAT_CARD_4GQGSJTC6GBNB = 7000;
    const ITEM_CAT_CARD_4GQGSJTC12GBNB = 7001;
    const ITEM_CAT_CARD_4GQGSJTC17GBNB = 7002;
    const ITEM_CAT_CARD_45GBNLLTC = 7003;
    const ITEM_CAT_CARD_600YSCNK = 7004;


    //数信业务
    const ITEM_CAT_SXYW_WKHB = 800;
    const ITEM_CAT_SXYW_AIQIYI10 = 801;
    const ITEM_CAT_SXYW_AIQIYI15 = 802;
    const ITEM_CAT_SXYW_PPTV = 803;
    //老友季焕新机
    const ITEM_CAT_LYJHXJ = 804;

    //双12活动
    const ITEM_CAT_D12_IPHONE6 = 805;
    const ITEM_CAT_D12_HONGMI_NOTE = 806;
    const ITEM_CAT_D12_HUAWEI_MATE7 = 807;
    const ITEM_CAT_D12_45G_SHANGWANGKA = 808;
    const ITEM_CAT_D12_96G_SHANGWANGKA = 809;

    //双旦活动
    const ITEM_CAT_CARD_DD_100YUAN5G_SHANGWANGKA = 810;
    const ITEM_CAT_CARD_DD_3GBANNIAN_SHANGWANGKA = 811;
    const ITEM_CAT_CARD_DD_6GNIANKA_SHANGWANGKA = 812;
    //const ITEM_CAT_D12_45G_SHANGWANGKA = 808;
    //const ITEM_CAT_D12_96G_SHANGWANGKA = 809;
    const ITEM_CAT_DD_IPHONE4S = 813;
    const ITEM_CAT_DD_IPHONE5S = 814;
    //const ITEM_CAT_D12_IPHONE6 = 805;
    const ITEM_CAT_DD_HONOR6 = 815;
    const ITEM_CAT_DD_XIAOMI4 = 816;
    const ITEM_CAT_DD_SAMSUNGG5108Q = 817;
    const ITEM_CAT_DD_SAMSUNGNOTE3 = 818;

    const ITEM_CAT_4GTAOCAN = 819;

    //购机有优惠 2015-3-20
    const ITEM_CAT_MOBILE_OPPOR830S = 820;
    const ITEM_CAT_MOBILE_LIANGXIANGA399 = 821;
    const ITEM_CAT_MOBILE_ZHONGXINGV5 = 822;
    const ITEM_CAT_MOBILE_HONGMI2 = 823;

    //双4G双百兆手机
    const ITEM_CAT_MOBILE_MEILANNOTE_16G = 850;
    const ITEM_CAT_MOBILE_MEIZUMX4_16G = 851;
    const ITEM_CAT_MOBILE_IPHONE6_16G = 852;
    const ITEM_CAT_MOBILE_IPHONE6PLUS_16G = 853;
    const ITEM_CAT_MOBILE_IPHONE6_64G = 854;
    const ITEM_CAT_MOBILE_IPHONE6_128G = 855;
    const ITEM_CAT_MOBILE_IPHONE6PLUS_64G = 856;
    const ITEM_CAT_MOBILE_ZHONGXINGV5S = 857;
    const ITEM_CAT_MOBILE_HUAWEI_MT7 = 858;
    /*4G手机疯狂直降 活动*/
    const ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE4S_8G = 859;
    const ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE5C_8G = 860;
    const ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE6_16G = 861;
    const ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_G5108Q = 862;
    const ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_9006V = 863;
    //双4G双百兆手机 5.1 活动
    const ITEM_CAT_MOBILE_4G_LIANGXIANG_A3600 = 864;
    const ITEM_CAT_MOBILE_4G_KUPAI_7061 = 865;
    const ITEM_CAT_MOBILE_4G_KUPAI_Y76 = 866;
    const ITEM_CAT_MOBILE_4G_XIAOMI_4G = 867;
    const ITEM_CAT_MOBILE_4G_HTC_820U = 868;
    const ITEM_CAT_MOBILE_4G_IPHONE6_16G = 869;
    //双4G双百兆手机 7.22 cid from 4000
    const ITEM_CAT_MOBILE_4G_KAMEIOU_C6 = 4000;
    const ITEM_CAT_MOBILE_4G_FEIXUN_C630LW = 4001;
    const ITEM_CAT_MOBILE_4G_TCL_P502U = 4002;
    const ITEM_CAT_MOBILE_4G_FEIXUN_E653 = 4003;
    const ITEM_CAT_MOBILE_4G_XIAOLAJIAO_LA2S = 4004;
    const ITEM_CAT_MOBILE_4G_IPHONE6PLUS_16G = 4005;



    //老用户户专享 参与机型及优惠合约
    const ITEM_CAT_MOBILE_SANXIN_SM_G9006VW = 870;
    const ITEM_CAT_MOBILE_HTC_ONE = 871;
    const ITEM_CAT_MOBILE_ZHONGXING_Q801U = 872;
    const ITEM_CAT_MOBILE_LIANXIANG_A606 = 873;
    const ITEM_CAT_MOBILE_ZHONGXINGV5S_1 = 874;
    //老用户户专享 5.1
    const ITEM_CAT_MOBILE_LYH_IPHONE4S_8GB = 875;
    const ITEM_CAT_MOBILE_LYH_IPHONE5S_16GB = 876;
    const ITEM_CAT_MOBILE_SANXING_N9106W = 877;

    //老用户户专享 6.18
    const ITEM_CAT_MOBILE_LYH_IPHONE6PLUS_128GB = 878;
    const ITEM_CAT_MOBILE_LYH_KUPAI_Y76 = 879;
    const ITEM_CAT_MOBILE_LYH_XIAOMI4_4G = 880;
    const ITEM_CAT_MOBILE_LYH_HONGMI2_4G = 881;
    const ITEM_CAT_MOBILE_LYH_HONGMINOTE_4G = 882;
    const ITEM_CAT_MOBILE_LYH_CFSF = 883;
    const ITEM_CAT_MOBILE_LYH_CFSYW = 884;
    //双4G 618 新增乐视手机
    const ITEM_CAT_MOBILE_LESHI1 = 885;
    //6.30
     const ITEM_CAT_MOBILE_LYH_KUPAI_K1 = 886;
     const ITEM_CAT_MOBILE_LYH_HUAWEI_MT7 = 887;
     const ITEM_CAT_MOBILE_LYH_LESHI1 = 888;
     const ITEM_CAT_MOBILE_LYH_RONGYAO_4X_HI = 889;
     const ITEM_CAT_MOBILE_LYH_RONGYAO_4X_ST = 890;



    //流量包 国内
    const ITEM_KIND_INTERNET_CARD_FLOW100MB_GUONEI = 902;
    const ITEM_KIND_INTERNET_CARD_FLOW300MB_GUONEI = 903;
    const ITEM_KIND_INTERNET_CARD_FLOW500MB_GUONEI = 904;

    //增值业务
    const ITEM_KIND_ZZYW = 1000;

    const ITEM_KIND_MOBILE = 1;
    const ITEM_KIND_CARD = 2;
    const ITEM_KIND_INTERNET_CARD = 3;
    const ITEM_KIND_FLOW_CARD = 4;

    public static function tableName() {
        return 'wx_item';
    }

    static function getItemCatName($key = null) {
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
            self::ITEM_CAT_MOBILE_XIAOMI4 => '小米4',

            self::ITEM_CAT_CARD_45GLIULIANG => '45G包年流量套餐',
            self::ITEM_CAT_CARD_96GLIULIANG => '96G包年流量套餐',
            self::ITEM_KIND_INTERNET_CARD_FLOW100MB => '10元包100MB 3G省内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW300MB => '20元包300MB 3G省内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW500MB => '30元包500MB 3G省内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW1GB_1 => '50元包1G 3G省内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW2DOT5GB => '100元包2.5G 3G省内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW1GB_2 => '100元包1G 全国流量半年包',

            self::ITEM_KIND_INTERNET_CARD_300YUANSHICHANGBANNIANKA => '300元时长半年卡',
            self::ITEM_KIND_INTERNET_CARD_600YUANSHICHANGNIANKA => '600元时长年卡',
            self::ITEM_KIND_INTERNET_CARD_1200YUANSHICHANGNIANKA => '1200元时长年卡',

            self::ITEM_KIND_INTERNET_CARD_FLOW_FREE => '拼人品抢流量包',

            self::ITEM_CAT_SXYW_WKHB => '沃看湖北可看在线卫视及各种栏目10元包6G',
            self::ITEM_CAT_SXYW_AIQIYI10 => '爱奇艺内容丰富10元包2.5G',
            self::ITEM_CAT_SXYW_AIQIYI15 => '爱奇艺内容丰富15元包6G',
            self::ITEM_CAT_SXYW_PPTV => 'PPTV无广告流畅收看内容丰富15元包6G',
            self::ITEM_CAT_LYJHXJ => '老友季焕新机',

            self::ITEM_CAT_D12_IPHONE6 => '苹果iPhone6',
            self::ITEM_CAT_D12_HONGMI_NOTE => '红米Note',
            self::ITEM_CAT_D12_HUAWEI_MATE7 => '华为Mate7',
            self::ITEM_CAT_D12_45G_SHANGWANGKA => '45G上网卡',
            self::ITEM_CAT_D12_96G_SHANGWANGKA => '96G上网卡',

            //双旦活动
            self::ITEM_CAT_CARD_DD_100YUAN5G_SHANGWANGKA => '100元本地流量卡5G',
            self::ITEM_CAT_CARD_DD_3GBANNIAN_SHANGWANGKA => '3G半年卡',
            self::ITEM_CAT_CARD_DD_6GNIANKA_SHANGWANGKA => '6G年卡',
            //self::ITEM_CAT_D12_45G_SHANGWANGKA => 808;
            //self::ITEM_CAT_D12_96G_SHANGWANGKA => 809;
            self::ITEM_CAT_DD_IPHONE4S => '苹果 iPhone4S',
            self::ITEM_CAT_DD_IPHONE5S => '苹果 iPhone5S 16GB',
            //self::ITEM_CAT_D12_IPHONE6 => '805';
            self::ITEM_CAT_DD_HONOR6 => '华为荣耀6',
            self::ITEM_CAT_DD_XIAOMI4 => '小米4',
            self::ITEM_CAT_DD_SAMSUNGG5108Q => '三星G5108Q',
            self::ITEM_CAT_DD_SAMSUNGNOTE3 => '三星Note3',

            //双十一活动
            self::ITEM_CAT_APPLE_5S_16G => 'APPLE 苹果 iPhone5S 16G',
            self::ITEM_CAT_APPLE_6_16G => 'APPLE 苹果 iPhone6 16G',
            self::ITEM_CAT_MOBILE_XIAOMI_HM_NOTE => '小米 红米 NOTE',
            self::ITEM_CAT_MOBILE_SONY_S55U => '索尼 SONY S55u',
            self::ITEM_CAT_MOBILE_XIAOMI_HM_1S => '小米 红米 1S',
            self::ITEM_CAT_MOBILE_HUAWEI_HONOR_6_WHITE => '华为HuaWei 荣耀6',
            self::ITEM_CAT_CARD_1111_200YUAN_BENDI_5GLIULIANG => '200元本地5G流量卡',
            self::ITEM_CAT_CARD_1111_3GLIULIANG => '3G半年卡',
            self::ITEM_CAT_CARD_1111_6GLIULIANG => '6G年卡',
            self::ITEM_CAT_CARD_1111_100YUAN_BENDI_5GLIULIANG => '100元本地5G流量卡',
            self::ITEM_CAT_CARD_1111_45GLIULIANG => '45G包年卡',
            self::ITEM_CAT_CARD_1111_96GLIULIANG => '96G包年卡',

            self::ITEM_CAT_CARD_120GLIULIANG => '120G流量上网卡',
            self::ITEM_CAT_CARD_240GLIULIANG => '240G流量上网卡',

            self::ITEM_CAT_CARD_60YUANBAO5G_SHANGWANGKA => '60元包5G上网卡',

            self::ITEM_CAT_CARD_4GQGSJTC6GBNB => '4G全国数据套餐6G半年包',
            self::ITEM_CAT_CARD_4GQGSJTC12GBNB => '4G全国数据套餐12G半年包',
            self::ITEM_CAT_CARD_4GQGSJTC17GBNB => '4G省内数据套餐17G半年包',
            self::ITEM_CAT_CARD_45GBNLLTC => '45G包年流量套餐',
            self::ITEM_CAT_CARD_600YSCNK => '600元时长年卡',
            

            self::ITEM_CAT_4GTAOCAN => '4G套餐',

            //购机有优惠 2015-3-20
            self::ITEM_CAT_MOBILE_OPPOR830S => 'OPPO R830S',
            self::ITEM_CAT_MOBILE_LIANGXIANGA399 => '联想A399',
            self::ITEM_CAT_MOBILE_ZHONGXINGV5 => '中兴红牛V5',
            self::ITEM_CAT_MOBILE_HONGMI2 => '红米2',

            //双4G双百兆手机
            self::ITEM_CAT_MOBILE_MEILANNOTE_16G => '魅蓝note 16G',
            self::ITEM_CAT_MOBILE_MEIZUMX4_16G => '魅族 MX4',
            self::ITEM_CAT_MOBILE_IPHONE6_16G => 'iPhone6 16G',
            self::ITEM_CAT_MOBILE_IPHONE6PLUS_16G => 'iPhone6 Plus 16G',
            self::ITEM_CAT_MOBILE_IPHONE6_64G => 'iPhone6 64G',
            self::ITEM_CAT_MOBILE_IPHONE6_128G => 'iPhone6 128G',
            self::ITEM_CAT_MOBILE_IPHONE6PLUS_64G => 'iPhone6 Plus 64G',
            self::ITEM_CAT_MOBILE_ZHONGXINGV5S => '中兴V5S',
            self::ITEM_CAT_MOBILE_HUAWEI_MT7 => '华为 Mate7',
            /*4G手机疯狂直降 活动*/
            self::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE4S_8G => 'iPhone4S 8G',
            self::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE5C_8G => 'iPhone5C 8G',
            self::ITEM_CAT_MOBILE_4GSJFKZJ_IPHONE6_16G => 'iPhone6 16G',
            self::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_G5108Q => '三星 G5108Q',
            self::ITEM_CAT_MOBILE_4GSJFKZJ_SANXING_9006V => '三星 9006V',

            //双4G双百兆手机 5.1 活动
            self::ITEM_CAT_MOBILE_4G_LIANGXIANG_A3600 => '联想A3600',
            self::ITEM_CAT_MOBILE_4G_KUPAI_7061 => '酷派7061',
            self::ITEM_CAT_MOBILE_4G_KUPAI_Y76 => '酷派y76',
            self::ITEM_CAT_MOBILE_4G_XIAOMI_4G => '小米4（4G）',
            self::ITEM_CAT_MOBILE_4G_HTC_820U => 'HTC 820U',
            self::ITEM_CAT_MOBILE_4G_IPHONE6_16G => 'iPhone6 (16G)',
            //双4G双百兆手机 7.22 cid from 4000
            self::ITEM_CAT_MOBILE_4G_KAMEIOU_C6 => '卡美欧C6',
            self::ITEM_CAT_MOBILE_4G_FEIXUN_C630LW => '斐讯C630Lw',
            self::ITEM_CAT_MOBILE_4G_TCL_P502U => 'TCL P502U',
            self::ITEM_CAT_MOBILE_4G_FEIXUN_E653 => '斐讯 E653',
            self::ITEM_CAT_MOBILE_4G_XIAOLAJIAO_LA2S => '小辣椒 LA2S',
            self::ITEM_CAT_MOBILE_4G_IPHONE6PLUS_16G => 'iPhone6 Plus 16G',

            //老用户户专享 参与机型及优惠合约
            self::ITEM_CAT_MOBILE_SANXIN_SM_G9006VW => '三星SM-G9006V/W',
            self::ITEM_CAT_MOBILE_HTC_ONE => 'HTC One',
            self::ITEM_CAT_MOBILE_ZHONGXING_Q801U => '中兴 Q801U',
            self::ITEM_CAT_MOBILE_LIANXIANG_A606 => '联想A606',
            self::ITEM_CAT_MOBILE_ZHONGXINGV5S_1 => '中兴V5S',

            //老用户户专享 5.1
            self::ITEM_CAT_MOBILE_LYH_IPHONE4S_8GB => 'iPhone4S 8GB',
            self::ITEM_CAT_MOBILE_LYH_IPHONE5S_16GB => 'iPhone5S 16GB',

            self::ITEM_CAT_MOBILE_SANXING_N9106W => '三星N9106W',

            //老用户户专享 6.18
            self::ITEM_CAT_MOBILE_LYH_IPHONE6PLUS_128GB => 'iPhone6+ 128G',
            self::ITEM_CAT_MOBILE_LYH_KUPAI_Y76 => '酷派 Y76',
            self::ITEM_CAT_MOBILE_LYH_XIAOMI4_4G => '小米手机4 联通4G',
            self::ITEM_CAT_MOBILE_LYH_HONGMI2_4G => '红米手机2 联通4G双卡版',
            self::ITEM_CAT_MOBILE_LYH_HONGMINOTE_4G => '红米NOTE 4G双卡双待',
            //存费送费/业务5折优惠
            self::ITEM_CAT_MOBILE_LYH_CFSF => '存费送费 5折优惠',
            self::ITEM_CAT_MOBILE_LYH_CFSYW => '存费送业务 5折优惠',
			//双4G 618 新增乐视手机
			self::ITEM_CAT_MOBILE_LESHI1 => '乐视（Letv）乐1',

            //6.30
             self::ITEM_CAT_MOBILE_LYH_KUPAI_K1 => '酷派K1 （7260）',
             self::ITEM_CAT_MOBILE_LYH_HUAWEI_MT7 => '华为MT7',
             self::ITEM_CAT_MOBILE_LYH_LESHI1 => '乐视乐1',
             self::ITEM_CAT_MOBILE_LYH_RONGYAO_4X_HI => '荣耀4X（高配版）',
             self::ITEM_CAT_MOBILE_LYH_RONGYAO_4X_ST => '荣耀4X（标配版）',


            //流量包 国内
            self::ITEM_KIND_INTERNET_CARD_FLOW100MB_GUONEI => '10元包100M 3G国内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW300MB_GUONEI => '20元包300M 3G国内流量包',
            self::ITEM_KIND_INTERNET_CARD_FLOW500MB_GUONEI => '30元包500M 3G国内流量包',

            //增值业务
            self::ITEM_KIND_ZZYW => '增值业务',

        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public function rules() {
        return [
            [['cid'], 'integer'],
            [['price', 'old_price', 'price_hint', 'title', 'title_hint', 'pkg_name', 'pkg_name_hint', 'pic_url', 'pic_urls', 'detail', 'ctrl_mobnumber', 'ctrl_userinfo', 'ctrl_office', 'ctrl_package', 'ctrl_supportpay', 'ctrl_pkg_3g4g', 'ctrl_pkg_period', 'ctrl_pkg_monthprice', 'ctrl_pkg_plan', 'ctrl_soldout', 'ctrl_address', 'ctrl_picurls', 'scene_percent'], 'safe'],
        ];
    }

    static function getPkg3g4gName($key = null) {
        $arr = array(
            '3g' => '3G普通套餐',
            '4g' => '4G/3G一体化套餐',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    function getPkg3g4gOption() {
        if (empty($this->ctrl_pkg_3g4g)) {
            //$arr['3g'] = self::getPkg3g4gName('3g');
            return [];
        }
        $cids = explode(',', trim($this->ctrl_pkg_3g4g));

        foreach ($cids as $cid) {
            $arr[$cid] = self::getPkg3g4gName($cid);
        }
        return $arr;
    }

    static function getPkgPeriodName($key = null) {
        $arr = array(
            '12' => '12个月',
            '24' => '24个月',
            '30' => '30个月',
            '36' => '36个月',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    function getpkgPeriodOption() {
        if (empty($this->ctrl_pkg_period)) {
            return [];
        }
        $cids = explode(',', trim($this->ctrl_pkg_period));

        foreach ($cids as $cid) {
            $arr[$cid] = self::getPkgPeriodName($cid);
        }
        return $arr;
    }

    static function getPkgMonthpriceName($key = null) {
        $arr = array(
            '46' => '&nbsp;&nbsp;46元/月',
            '66' => '&nbsp;&nbsp;66元/月',
            '96' => '&nbsp;&nbsp;96元/月',
            '126' => '126元/月',
            '156' => '156元/月',
            '186' => '186元/月',
            '226' => '226元/月',
            '286' => '286元/月',
            '386' => '386元/月',
            '586' => '586元/月',
            '886' => '886元/月',
            //----------------------------
            '76' => '&nbsp;&nbsp;76元/月',
            '106' => '106元/月',
            '136' => '136元/月',
            '166' => '166元/月',
            '196' => '196元/月',
            '296' => '296元/月',
            '396' => '396元/月',
            '596' => '596元/月',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    function getpkgMonthpriceOption() {
        if (empty($this->ctrl_pkg_monthprice)) {
            return [];
        }
        $cids = explode(',', trim($this->ctrl_pkg_monthprice));

        foreach ($cids as $cid) {
            $arr[$cid] = self::getPkgMonthpriceName($cid);
        }
        return $arr;
    }

    static function getPkgPlanName($key = null) {
        $arr = array(
            'a' => 'A计划',
            'b' => 'B计划',
            'c' => 'C计划',
        );
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    function getpkgPlanOption() {
        if (empty($this->ctrl_pkg_plan)) {
            return [];
        }
        $cids = explode(',', trim($this->ctrl_pkg_plan));

        foreach ($cids as $cid) {
            $arr[$cid] = self::getPkgPlanName($cid);
        }
        return $arr;
    }

    public function attributeLabels() {
        return [
            'quantity' => '数量',
            'price' => '现价',
            'old_price' => '原价',
            'title' => '标题',
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


ALTER TABLE wx_item ADD quantity int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD old_price int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    old_price_hint VARCHAR(128) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    kind tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_mobnumber tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_userinfo tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_office tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_package tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_supportpay VARCHAR(128) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    ctrl_address tinyint(3) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_detail tinyint(3) unsigned NOT NULL DEFAULT '1';
ALTER TABLE wx_item ADD    scene_percent int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_item ADD    ctrl_pkg_3g4g VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    ctrl_pkg_period VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    ctrl_pkg_monthprice VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    ctrl_pkg_plan VARCHAR(8) NOT NULL DEFAULT '';
ALTER TABLE wx_item ADD    ctrl_soldout tinyint(3) unsigned NOT NULL DEFAULT '0';

INSERT INTO `wx_item` (`gh_id`, `price`, `price_hint`, `title`, `title_hint`, `pkg_name`, `pkg_name_hint`, `detail`, `pic_url`, `cid`, `status`) VALUES
('gh_03a74ac96138', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 10, 0);
('gh_03a74ac96138', 5000, '含预存款50元', '沃派校园卡', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量100分钟本地长市话100条短信500M省内流量自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 11, 0),
('gh_1ad98f5481f3', 5000, '含预存款50元', '微信沃卡', '微信沃卡 <span class="title_hint"> 尊享微信6大特权, 50元入网得530元话费, 500M省内流量+500M微信定向流量, 仅需31元/月</span>', '微信沃卡', '500M微信定向流量；100分钟本地长市话&100条短信;500M省内流量,自动升级至50元包1G/100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wxwk001.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk002.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk003.jpg" alt="" />\r\n<img width="100%" style="display:block"  src="../web/images/item/wxwk004.jpg" alt="" />', '../web/images/item/wxwk000.jpg', 10, 0),
('gh_1ad98f5481f3', 5000, '含预存款50元', '沃派校园套餐', '沃派校园套餐 <span class="title_hint"> 500M省内流量, 100分钟通话+100条短信, 存50得530元话费, 每月仅付26元</span>', '沃派校园套餐', '500M微信定向流量, 100分钟本地长市话, 100条短信, 500M省内流量自动升级至50元包1G, 100元包2.5G', '<img width="100%" style="display:block"  src="../web/images/item/wpxytc_002.jpg" alt="" />', '../web/images/item/wpxytc_001.jpg', 11, 0),

 */
