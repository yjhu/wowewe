<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_actfollower;
CREATE TABLE wx_actfollower (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	act_id int(10) unsigned NOT NULL DEFAULT '0',
	KEY idx_gh_id_create_time(gh_id,create_time)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MUser;


class MActfollower extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_actfollower';
	}


	public function rules()
	{
		return [
			[['create_time'], 'safe'],
		];
	}

}

/*


*/
