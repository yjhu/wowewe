<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_item;
CREATE TABLE wx_item (
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	iid int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	price int(10) unsigned NOT NULL DEFAULT '0',
	title VARCHAR(128) NOT NULL DEFAULT '',
	desc VARCHAR(512) NOT NULL DEFAULT '',
	attr text NOT NULL DEFAULT '',
	cid int(10) unsigned NOT NULL DEFAULT '0',
	pic_url VARCHAR(128) NOT NULL DEFAULT '',
	status int(10) unsigned NOT NULL DEFAULT '0',
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO wx_item (gh_id, price, title, desc, attr, pic_url) VALUES ('gh_1ad98f5481f3', '199900', 'Title: Sony DC T70','Desc, Sony DC new arrival!', '', 'http://www.w3cschool.cc/try/demo_source/firefox.png');
INSERT INTO wx_item (gh_id, price, title, desc, attr, pic_url) VALUES ('gh_1ad98f5481f3', '199900', 'Title: Sony DC T70','Desc, Sony DC new arrival!', '', 'http://www.w3cschool.cc/try/demo_source/chrome.png');


*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class MItem extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_item';
	}


	
}

/*

*/
