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
	PRIMARY KEY (num)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205015', '100000', '1000', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205017', '0', '0', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205018', '0', '0', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205019', '0', '0', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205020', '0', '0', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205021', '0', '0', 1);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205022', '200000', '2000', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205023', '0', '0', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205024', '0', '0', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205025', '0', '0', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205026', '0', '0', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf, num_cat) VALUES ('18696205027', '0', '0', 2);
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205028', '300000', '3000');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205029', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205030', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205031', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205032', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205033', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205034', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205035', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205036', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205037', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205038', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205039', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205040', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205041', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205042', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205043', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205044', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205045', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205046', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205047', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205048', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205049', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205050', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205051', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205052', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205053', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205054', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205055', '0', '200');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205056', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205057', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205058', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205059', '0', '0');
INSERT INTO wx_mobnum (num, ychf, zdxf) VALUES ('18696205060', '800000', '8000');

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;

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
			return self::NUM_CAT_MOBILE;
	}

}

