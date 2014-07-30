<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_order;
CREATE TABLE wx_order (
	oid VARCHAR(32) NOT NULL DEFAULT '',
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	iid int(10) unsigned NOT NULL DEFAULT '0',
	total_fee int(10) unsigned NOT NULL DEFAULT '0',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,	
	status int(10) unsigned NOT NULL DEFAULT '0',
	title VARCHAR(128) NOT NULL DEFAULT '',
	attr VARCHAR(256) NOT NULL DEFAULT '',
	detail VARCHAR(512) NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	PRIMARY KEY (oid),
	KEY gh_id_idx(gh_id,openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MOrder extends ActiveRecord
{
	const ITEM_CAT_DIY = 0;

	
	public static function tableName()
	{
		return 'wx_order';
	}

	public static function generateOid()
	{
		return uniqid();
	}

}

/*

*/
