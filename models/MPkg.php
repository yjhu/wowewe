<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_pkg;
CREATE TABLE wx_pkg (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	
	pkg3g4g VARCHAR(16) NOT NULL DEFAULT '',
	monthprice int(10) unsigned NOT NULL DEFAULT '0',
	period int(10) unsigned NOT NULL DEFAULT '0',	
	plan VARCHAR(8) NOT NULL DEFAULT '',
	pkg_price int(10) unsigned NOT NULL DEFAULT '0',
	prom_price int(10) unsigned NOT NULL DEFAULT '0',
	yck int(10) unsigned NOT NULL DEFAULT '0',
	income_return int(10) unsigned NOT NULL DEFAULT '0',
	month_return int(10) unsigned NOT NULL DEFAULT '0',
	
	KEY idx_gh_id_cid(gh_id,cid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

//Apple iphone 5s 32G  --- 4g
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 12, '', 6299, 4799, 1500, 0, 125);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 12, '', 6299, 4399, 1900, 0, 158);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 12, '', 6299, 3899, 2400, 0, 200);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 12, '', 6299, 2899, 3400, 0, 283);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 24, '', 6299, 4499, 1800, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 24, '', 6299, 4199, 2100, 0, 87);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 24, '', 6299, 3899, 2400, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 24, '', 6299, 2899, 3400, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 24, '', 6299, 1999, 4300, 0, 179);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 24, '', 6299, 99, 6200, 0, 258);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 36, '', 6299, 4299, 2000, 0, 55);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 36, '', 6299, 3399, 2900, 0, 80);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 169, 36, '', 6299, 2999, 3300, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 296, 36, '', 6299, 1499, 4800, 0, 133);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 396, 36, '', 6299, 99, 6200, 0, 172);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 596, 36, '', 6299, 0, 6299, 0, 174);
//-----------------------------------------
Apple iphone 5s 32G  --- 3g

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 12, '', 6299, 4999, 1300, 0, 108);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 12, '', 6299, 4799, 1500, 0, 125);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 12, '', 6299, 4599, 1700, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 12, '', 6299, 4299, 2000, 0, 166);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 12, '', 6299, 3699, 2600, 0, 216);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 12, '', 6299, 2599, 3700, 0, 308);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 12, '', 6299, 999, 5300, 0, 441);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 24, '', 6299, 5099, 1200, 0, 50);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 24, '', 6299, 4799, 1500, 0, 62);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 24, '', 6299, 4399, 1900, 0, 79);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 24, '', 6299, 4099, 2200, 0, 91);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 24, '', 6299, 3799, 2500, 0, 104);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 24, '', 6299, 3399, 2900, 0, 120);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 24, '', 6299, 2699, 3600, 0, 150);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 24, '', 6299, 1599, 4700, 0, 195);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 24, '', 6299, 0, 6299, 0, 262);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 24, '', 6299, 0, 6299, 0, 262);

INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 66, 36, '', 6299, 4699, 1600, 0, 44);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 96, 36, '', 6299, 4199, 2100, 0, 58);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 126, 36, '', 6299, 3799, 2500, 0, 69);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 156, 36, '', 6299, 3299, 3000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 186, 36, '', 6299, 2799, 3500, 0, 97);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 226, 36, '', 6299, 2099, 4200, 0, 116);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 286, 36, '', 6299, 1199, 5100, 0, 141);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 386, 36, '', 6299, 0, 6299, 0, 174);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 586, 36, '', 6299, 0, 6299, 0, 174);
INSERT INTO wx_pkg (gh_id, cid, pkg3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '3g', 886, 36, '', 6299, 0, 6299, 0, 174);

*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MItem;

class MPkg extends ActiveRecord
{
	//const STATUS_UNUSED = 0;
	
	public static function tableName()
	{
		return 'wx_pkg';
	}

	public static function getVoiceAndFlowValues($k1=null, $k2=null)
	{
		$arr = [
			'46' => [
				'a' => ['50', '150'],
				'b' => ['120', '40'],
				'c' => ['260', '40'],
			],
			'66' => [
				'a' => ['50', '300'],
				'b' => ['200', '60'],
				'c' => ['380', '60'],
			],
			'96' => [
				'a' => ['240', '300'],
				'b' => ['450', '80'],
				'c' => ['550', '80'],
			],
			'126' => [
				'a' => ['320', '400'],
				'b' => ['680', '100'],
			],
			'156' => [
				'a' => ['420', '500'],
				'b' => ['920', '120'],
			],
			'186' => [
				'a' => ['510', '650'],
				'b' => ['1180', '150'],
			],
			'226' => [
				'a' => ['700', '750'],
			],
			'286' => [
				'a' => ['900', '950'],
			],
			'386' => [
				'a' => ['1250', '1300'],
			],
			'586' => [
				'a' => ['1950', '2000'],
			],
			'886' => [
				'a' => ['3000', '3000'],
			],
		];
		if ($k1 === null)
			return $arr;
			
		if ($k2 === null)
			return isset($arr[$k1]) ? $arr[$k1] : null;
			
		return isset($arr[$k1][$k2]) ? $arr[$k1][$k2] : null;
	}


}

/*


*/
