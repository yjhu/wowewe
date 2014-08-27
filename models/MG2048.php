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
	KEY idx_gh_id_create_time(gh_id, create_time),	
	KEY idx_gh_id_score(gh_id, score)	
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

	public static function getScoreTop($gh_id, $period='week', $n=10)
	{
		$key = md5(serialize([$_GET, $gh_id, $period, $n]));
		$value = Yii::$app->cache->get($key);
		if ($value !== false)
			return $value;

		$tableName = self::tableName();
		if ($period == 'week')
			$sql = "SELECT *, MAX(score) as max_score  from $tableName WHERE gh_id=:gh_id AND WEEKOFYEAR(create_time) = WEEKOFYEAR(NOW()) GROUP BY gh_id,openid ORDER BY max_score DESC LIMIT $n";	
		else if ($period == 'month')
			$sql = "SELECT *, MAX(score) as max_score  from $tableName WHERE gh_id=:gh_id AND MONTH(create_time) = MONTH(NOW()) GROUP BY gh_id,openid ORDER BY max_score DESC LIMIT $n";				
		else
			$sql = "SELECT *, MAX(score) as max_score  from $tableName WHERE gh_id=:gh_id GROUP BY gh_id,openid ORDER BY max_score DESC LIMIT $n";				
		
		$rows = Yii::$app->db->createCommand($sql,  [':gh_id'=>$gh_id])->queryAll();
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
		//Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 3600);
		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 10);
		return $rows;
	}

	public static function getMyScoreTop($gh_id, $openid, $n=10)
	{
		$key = md5(serialize([$_GET, $gh_id, $openid, $n]));
		$value = Yii::$app->cache->get($key);
		if ($value !== false)
			return $value;
	
		$tableName = self::tableName();
		$sql = "SELECT * from $tableName WHERE gh_id=:gh_id AND openid=:openid ORDER BY score DESC LIMIT $n";
		$rows = Yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':openid'=>$openid])->queryAll();
		//U::W($rows);		
		foreach($rows as $idx => &$row)
		{				
			$row['position_week'] = self::getMyScorePosition($gh_id, $row['score'], $row['create_time'], 'week');
			$row['position_month'] = self::getMyScorePosition($gh_id, $row['score'], $row['create_time'], 'month');
		}
		unset($row);		

//		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 3600);
		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 10);
		return $rows;
	}

	public static function getMyScorePosition($gh_id, $score, $create_time, $period='week')
	{
		$tableName = self::tableName();
		if ($period == 'week')
			$sql = "SELECT COUNT(*) FROM (SELECT * FROM $tableName WHERE gh_id=:gh_id AND WEEKOFYEAR(create_time) = WEEKOFYEAR(:create_time) AND score >= :score GROUP BY gh_id,openid) t1";
		else if ($period == 'month')
			$sql = "SELECT COUNT(*) FROM (SELECT * FROM $tableName WHERE gh_id=:gh_id AND MONTH(create_time) = MONTH(:create_time) AND score >= :score GROUP BY gh_id,openid) t1";
		else		
			$sql = "SELECT COUNT(*) FROM (SELECT * FROM $tableName WHERE gh_id=:gh_id AND score >= :score GROUP BY gh_id,openid) t1 ";
		$command = yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':score'=>$score, ':create_time'=>$create_time]);
		$n = $command->queryScalar();
		//U::W("getMyScorePosition,period=$period,n=$n, ");
		return $n;
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
		$sql = "SELECT COUNT(*) FROM $tableName WHERE gh_id=:gh_id AND score >= :score GROUP BY gh_id,openid ";
		$command = yii::$app->db->createCommand($sql, [':gh_id'=>$gh_id, ':score'=>$score]);
		$n = $command->queryScalar();
		//U::W("getCurrentScorePosition=$n");
		return $n;
	}


}




/*

ALTER TABLE wx_g2048 ADD KEY idx_gh_id_create_time(gh_id, create_time);
ALTER TABLE wx_g2048 ADD KEY idx_gh_id_score(gh_id, score);


SELECT * from wx_g2048 ORDER BY score desc
SELECT *, MAX(score) as max_score  from wx_g2048 GROUP BY gh_id,openid ORDER BY max_score DESC limit 10

$a = MG2048::getMyScoreTop($gh_id, $openid, 10);	
U::W($a);
return;


*/
