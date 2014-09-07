<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_contract;
CREATE TABLE wx_contract (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	3g4g VARCHAR(16) NOT NULL DEFAULT '',
	month_fee int(10) unsigned NOT NULL DEFAULT '0',
	price int(10) unsigned NOT NULL DEFAULT '0',
	prom_price int(10) unsigned NOT NULL DEFAULT '0',
	ychf int(10) unsigned NOT NULL DEFAULT '0',
	income_return int(10) unsigned NOT NULL DEFAULT '0',
	month_return int(10) unsigned NOT NULL DEFAULT '0',
	period int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO wx_contract (num, ychf, zdxf, num_cat, is_good) VALUES ('13035200056', 0, 0, 0, 0);
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MItem;

class MContract extends ActiveRecord
{
	const STATUS_UNUSED = 0;
	
	public static function tableName()
	{
		return 'wx_contract';
	}


}

/*


*/
