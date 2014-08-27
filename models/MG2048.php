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

use app\models\MUser;

class MG2048 extends ActiveRecord
{

	public static function tableName()
	{
		return 'wx_g2048';
	}

	public static function getScoreTop($gh_id, $period='week', $n=5)
	{
		//$key = __METHOD__."{$gh_id}_{$n}";
		$key = md5(serialize([$_GET, $gh_id, $period, $n]));
		$value = Yii::$app->cache->get($key);
		if ($value !== false)
			return $value;

		$tableName = self::tableName();
		$sql = "SELECT *, MAX(score) as max_score  from $tableName GROUP BY gh_id,openid ORDER BY max_score DESC LIMIT $n";		
		$rows = Yii::$app->db->createCommand($sql)->queryAll();
		foreach($rows as $idx => &$row)
		{				
			$user = MUser::findOne(['gh_id'=>$row['gh_id'], 'openid'=>$row['openid']]);
			if ($user === null)
			{
				unset($rows[$idx]);
				continue;
			}
			$row['nickname'] = $user->nickname;
			$row['headimgurl'] = $user->headimgurl;
		}
		unset($row);
		//U::W($rows);		
		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 3600);
		return $rows;
	}

	public static function getMyScoreTop($gh_id, $openid, $n=5)
	{
		$tableName = self::tableName();
		$sql = "SELECT * from $tableName WHERE gh_id=:gh_id AND openid=:openid ORDER BY score DESC LIMIT $n";
		$rows = Yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':openid'=>$openid])->queryAll();
		//U::W($rows);		
		return $rows;
	}

	public static function getMyHistoryScore($gh_id, $openid, $n=1)
	{
		$tableName = self::tableName();
		$sql = "SELECT * from $tableName WHERE gh_id=:gh_id AND openid=:openid ORDER BY id DESC LIMIT $n";
		$rows = Yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':openid'=>$openid])->queryAll();
		return $rows;
	}

	public static function getCurrentScorePosition($gh_id, $score)
	{
		$tableName = self::tableName();
		$sql = "SELECT COUNT(*) FROM $tableName WHERE gh_id=:gh_id AND score >= :score";
		$command = yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':score'=>$score]);
		$n = $command->queryScalar();
		U::W("getCurrentScorePosition=$n");
		return $n;
	}

}




/*
SELECT * from wx_g2048 ORDER BY score desc

SELECT *, MAX(score) as max_score  from wx_g2048 GROUP BY gh_id,openid ORDER BY max_score DESC limit 10
*/
