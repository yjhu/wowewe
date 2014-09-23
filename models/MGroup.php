<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_group;
CREATE TABLE wx_group (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	gid int(10) unsigned NOT NULL DEFAULT '0',
	gname VARCHAR(64) NOT NULL DEFAULT '',
	office_id int(10) unsigned NOT NULL DEFAULT '0',
	KEY idx_gh_id_gid(gh_id,gid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;
use app\models\MUser;


class MGroup extends ActiveRecord
{
	//const STATUS_UNUSED = 0;
	
	public static function tableName()
	{
		return 'wx_group';
	}


	public function rules()
	{
		return [
			[['gid'], 'integer'],   
			[['gname'], 'safe'],
		];
	}

}

/*


*/
