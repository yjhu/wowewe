<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_chat;
CREATE TABLE wx_chat (
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	openid VARCHAR(32) NOT NULL DEFAULT '',	
	
	to_user_name VARCHAR(32) NOT NULL DEFAULT '',	
	from_user_name VARCHAR(32) NOT NULL DEFAULT '',		
	create_time TIMESTAMP,
	msg_type VARCHAR(16) NOT NULL DEFAULT '',
				

	PRIMARY KEY (id),	
	UNIQUE KEY idx_openid(openid),	
	UNIQUE KEY idx_nickname(nickname)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_chat (id,openid,nickname,password) VALUES ('1','abc','hehbhehb','1');
*/

use Yii;
use yii\db\ActiveRecord;

class MChat extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_chat';
	}

}

/*
*/
