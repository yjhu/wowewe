<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_feedback;
CREATE TABLE wx_feedback (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	title VARCHAR(128) NOT NULL DEFAULT '',
	mobile VARCHAR(16) NOT NULL DEFAULT '',
	detail VARCHAR(512) NOT NULL DEFAULT '',
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

class MFeedback extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_feedback';
	}

}




/*

*/
