<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_office;
CREATE TABLE wx_office (
	office_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	title VARCHAR(128) NOT NULL DEFAULT '',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO wx_office (gh_id,title) VALUES ('gh_1ad98f5481f3','Office#1');
INSERT INTO wx_office (gh_id,title) VALUES ('gh_1ad98f5481f3','Office#2');
INSERT INTO wx_office (gh_id,title) VALUES ('gh_1ad98f5481f3','Office#3');
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MOffice extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_office';
	}

	public function rules()
	{
		return [
			['title', 'string', 'max' => 128],
			['title', 'filter', 'filter' => 'trim'],
		];
	}

	
}

/*

*/
