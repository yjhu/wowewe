<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_staff;
CREATE TABLE wx_staff (
	staff_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	office_id int(10) unsigned NOT NULL DEFAULT '0',
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	name VARCHAR(16) NOT NULL DEFAULT '',
	mobile VARCHAR(16) NOT NULL DEFAULT '',
	is_manager tinyint(3) NOT NULL DEFAULT 0,
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE wx_staff ADD is_manager tinyint(3) NOT NULL DEFAULT 0;

*/

		
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\MOffice;

class MStaff extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_staff';
	}

	public function rules()
	{
		return [
			[['name', 'mobile'], 'filter', 'filter' => 'trim'],
			[['name', 'mobile', 'office_id'], 'required'],
			[['name', 'mobile'], 'string', 'min' => 2, 'max' => 255],
			[['office_id'], 'integer', 'integerOnly' =>true, 'min'=>1],       
			[['gh_id', 'openid'], 'safe'],			
			[['is_manager'], 'boolean'],			
		];
	}

	public function attributeLabels()
	{
		return [
			'staff_id' => '员工编号',
			'office_id' => '营业厅编号',
			'name' => '姓名',
			'mobile' => '手机号',
			'is_manager' => '是否主管',
		];
	}
	
	public function getOffice()
	{
		return $this->hasOne(MOffice::className(), ['office_id' => 'office_id']);
	}

	public function getScore()
	{
		if (empty($this->openid))
			return 0;
		$model = MUser::findOne(['gh_id'=>$this->gh_id, 'openid'=>$this->openid]);
		if ($model === null)
			return 0;
		return $model->getScore();
	}

	public static function getStaffScoreTop($gh_id, $n=0)
	{
		$key = __METHOD__."{$gh_id}_{$n}";
		$value = Yii::$app->cache->get($key);
		if ($value !== false)
			return $value;
		
		$sql = <<<EOD
SELECT t1.score, t3.name, t3.office_id, t4.title, t2.scene_id, t2.headimgurl  FROM (SELECT scene_pid, count(*) as score FROM wx_user 
WHERE gh_id='$gh_id' and scene_pid != 0 GROUP BY scene_pid ORDER BY score desc) t1 
LEFT JOIN wx_user t2 ON t1.scene_pid = t2.scene_id AND t2.scene_id != 0 
LEFT JOIN wx_staff t3 ON t2.openid = t3.openid 
LEFT JOIN wx_office t4 ON t3.office_id = t4.office_id
EOD;
		if ($n)
			$sql .= " LIMIT $n";

		$rows = Yii::$app->db->createCommand($sql)->queryAll();
		foreach($rows as $idx => $row)
		{
			if (empty($row['name']))
				unset($rows[$idx]);
		}
		Yii::$app->cache->set($key, $rows, YII_DEBUG ? 100 : 12*3600);
		return $rows;
	}

//	sendWxm($order->getWxNotice(true))
	public function sendWxm($content)
	{
		if (empty($this->gh_id) || empty($this->openid))
		{
			U::W(["manager's gh_id or openid is empty", $this->getAttributes(), __METHOD__]);
			return false;
		}
		try
		{
			Yii::$app->wx->setGhId($this->gh_id);
			$arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$this->openid,'msgtype'=>'text', 'text'=>['content'=>$content]]);
			U::W($arr);
		}
		catch (\Exception $e)
		{
			U::W($e->getCode().':'.$e->getMessage());
			return false;
		}
		return true;
	}

	public function sendSm($content)
	{
		if (empty($this->mobile))
		{
			U::W(["manager's mobile is empty", $this->getAttributes(), __METHOD__]);
			return false;
		}
		return true;
	
	}
	
}

/*
		$rows = Yii::$app->db->cache(function (\yii\db\Connection $db) {
			return $db->createCommand($sql)->queryAll();
		}, YII_DEBUG ? 100 : 3600);


			[['name', 'mobile'], 'filter', 'filter' => 'trim'],
			[['name', 'mobile'], 'required'],
			[['name', 'mobile'], 'string', 'min' => 2, 'max' => 255],
			[['office_id'], 'integer'],     
*/			

