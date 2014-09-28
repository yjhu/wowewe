<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_activity;
CREATE TABLE wx_activity (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	start_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	end_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
	title VARCHAR(128) NOT NULL DEFAULT '',
	descr VARCHAR(256) NOT NULL DEFAULT '',
	status tinyint(10) unsigned NOT NULL DEFAULT '0',
	iids VARCHAR(256) NOT NULL DEFAULT '',
	KEY idx_gh_id(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MUser;


class MActivity extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_activity';
	}


	public function rules()
	{
		return [
			[['start_time','end_time','title','descr'], 'safe'],
		];
	}

}

/*


*/
