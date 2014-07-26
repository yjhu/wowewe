<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_g2048;
CREATE TABLE wx_g2048 (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	score int(10) unsigned NOT NULL DEFAULT 0,
	best int(10) unsigned NOT NULL DEFAULT 0,
	big_num int(10) unsigned NOT NULL DEFAULT 0,
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MG2048 extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_g2048';
	}

}




/*

*/
