<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_disk;
CREATE TABLE wx_disk (
	id int(10) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	cnt int(10) unsigned NOT NULL DEFAULT '0',
	UNIQUE KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MDisk extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_disk';
	}

	public static function getDiskQualification($gh_id, $openid, $save=true)
	{
		$model = MDisk::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);		
		if ($model === null)
			return true;
		else if ($model->cnt > 0)
		{
			if ($save)
			{
				$model->cnt = $model->cnt - 1;
				$model->save(false);
			}
			return true;
		}
		return false;
	}

}

/*

*/
