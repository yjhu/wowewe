<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_warn;
CREATE TABLE wx_warn (
	id int(10) unsigned NOT NULL AUTO_INCREMENT,			
	appid VARCHAR(32) NOT NULL DEFAULT '',
	error_type VARCHAR(32) NOT NULL DEFAULT '',
	description VARCHAR(256) NOT NULL DEFAULT '',
	alarm_content VARCHAR(256) NOT NULL DEFAULT '',
	time_stamp int(10) unsigned NOT NULL DEFAULT 0,
	status int(10) unsigned NOT NULL DEFAULT 0,	
	PRIMARY KEY (id)	
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;

class MWarn extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_warn';
	}

	public static function insertOne($appid, $error_type, $description, $alarm_content, $time_stamp)
	{
		$model = new MWarn();
		$model->appid = $appid;
		$model->error_type = $error_type;		
		$model->description = $description;
		$model->alarm_content = $alarm_content;		
		$model->time_stamp = $time_stamp;
		return $model->save(false);
	}
	
}

