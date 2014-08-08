<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_mobnum;
CREATE TABLE wx_mobnum (
	num VARCHAR(16) NOT NULL DEFAULT '',
	ychf int(10) unsigned NOT NULL DEFAULT '0',
	zdxf int(10) unsigned NOT NULL DEFAULT '0',
	status int(10) unsigned NOT NULL DEFAULT '0',
	locktime int(10) unsigned NOT NULL DEFAULT '0',		
	num_cat tinyint(1) unsigned NOT NULL DEFAULT '0',	
	is_good tinyint(1) unsigned NOT NULL DEFAULT '0',		
	PRIMARY KEY (num)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205015', 100000, 1000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205017', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205018', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205019', 0, 0, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205020', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205021', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205022', 200000, 2000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205023', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205025', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205026', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205027', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205028', 300000, 3000, 1, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205029', 0, 0, 0, 0);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205030', 0, 0, 1, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205031', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205032', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205033', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205035', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205036', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205037', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205038', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205039', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205053', 0, 0, 0, 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205056', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205058', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205059', 0, 0, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205060', 800000, 8000, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205061', 810000, 8000, 0, 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, is_good, num_cat) VALUES ('18696205062', 820000, 8000, 0, 2);

18696205015
18696205016
18696205017
18696205018
18696205019
18696205020
18696205021
18696205022
18696205023
18696205025
18696205026
18696205027
18696205028
18696205029
18696205030
18696205031
18696205032
18696205033
18696205035
18696205036
18696205037
18696205038
18696205039
18696205053
18696205056
18696205058
18696205059
18696205060
18696205061
18696205062





*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MItem;

class MMobnum extends ActiveRecord
{
	const STATUS_UNUSED = 0;
	const STATUS_LOCKED = 1;
	const STATUS_USED = 2;

	const NUM_CAT_DIY = 0;
	const NUM_CAT_CARD = 1;
	const NUM_CAT_MOBILE = 2;
	
	public static function tableName()
	{
		return 'wx_mobnum';
	}

	public static function getNumCat($cid)
	{
		if ($cid == MItem::ITEM_CAT_DIY)
			return self::NUM_CAT_DIY;
		else if ($cid == MItem::ITEM_CAT_CARD_WO || $cid == MItem::ITEM_CAT_CARD_XIAOYUAN)
			return self::NUM_CAT_CARD;
		else
			return self::NUM_CAT_MOBILE;			// mobile and lianghao
	}

}

