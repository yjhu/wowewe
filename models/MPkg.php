<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_pkg;
CREATE TABLE wx_pkg (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	
	3g4g VARCHAR(16) NOT NULL DEFAULT '',
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

INSERT INTO wx_pkg (gh_id, cid, 3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 76, 12, '', 6299, 5399, 900, 0, 75);
INSERT INTO wx_pkg (gh_id, cid, 3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 106, 12, '', 6299, 5299, 1000, 0, 83);
INSERT INTO wx_pkg (gh_id, cid, 3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 136, 12, '', 6299, 5099, 1200, 0, 100);
INSERT INTO wx_pkg (gh_id, cid, 3g4g, monthprice, period, plan, pkg_price, prom_price, yck, income_return, month_return) VALUES ('gh_03a74ac96138', 317, '4g', 166, 12, '', 6299, 4999, 1300, 0, 108);


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
