<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_staff;
CREATE TABLE wx_staff (
	staff_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	office_id int(10) unsigned NOT NULL DEFAULT '0',
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	name VARCHAR(16) NOT NULL DEFAULT '',
	mobile VARCHAR(16) NOT NULL DEFAULT '',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MStaff extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_staff';
	}


	
}

/*

*/
