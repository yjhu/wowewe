<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_sm_queue;
CREATE TABLE wx_sm_queue (
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	status int(10) unsigned NOT NULL DEFAULT '0', 		
	sendtime DATETIME NOT NULL,	
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,			
	receiver_mobile TEXT,
	cat int(10) unsigned NOT NULL DEFAULT '1', 
	msg VARCHAR(1024) NOT NULL DEFAULT '',
	err_code VARCHAR(64) NOT NULL DEFAULT '',				
	PRIMARY KEY (id),
	KEY gh_id_idx(gh_id)	
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;

class MSmQueue extends ActiveRecord
{
	const CAT_COMM = 0;		
	const CAT_ORDER = 1;	
	
	const STATUS_WAIT = 0;	
	const STATUS_SENT = 1;	
	const STATUS_ERR = 2;	
	
	const ERRCODE_NO_FEE = 900;		
	
	public static function tableName()
	{
		return 'wx_sm_queue';
	}

}

