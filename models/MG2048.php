<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_g2048;
CREATE TABLE wx_g2048 (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	score int(10) unsigned NOT NULL DEFAULT 0,
	best int(10) unsigned NOT NULL DEFAULT 0,
	big_num int(10) unsigned NOT NULL DEFAULT 0,
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	KEY idx_gh_id_openid(gh_id, openid),
	KEY idx_gh_id_openid(gh_id, score)	
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MG2048 extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_g2048';
	}

	public static function getScoreTop($gh_id, $n=5)
	{
		$key = __METHOD__."{$gh_id}_{$n}";
		$value = Yii::$app->cache->get($key);
		if ($value !== false)
			return $value;

		$tableName = self::tableName();
		$sql = "SELECT *, MAX(score) as max_score  from $tableName GROUP BY gh_id,openid ORDER BY max_score DESC LIMIT $n";		
		$rows = Yii::$app->db->createCommand($sql)->queryAll();
		foreach($rows as $idx => $row)
		{			
			if (empty($row['name']))
				unset($rows[$idx]);
		}
		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 100 : 12*3600);
		return $rows;
	}

}




/*
SELECT * from wx_g2048 ORDER BY score desc

SELECT *, MAX(score) as max_score  from wx_g2048 GROUP BY gh_id,openid ORDER BY max_score DESC limit 10
*/
