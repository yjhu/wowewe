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
	KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
			[['name', 'mobile'], 'required'],
			[['name', 'mobile'], 'string', 'min' => 2, 'max' => 255],
			[['office_id'], 'integer'],            					
		];
	}

	public function attributeLabels()
	{
		return [
			'staff_id' => '员工编号',
			'office_id' => '营业厅编号',
			'name' => '姓名',
			'mobile' => '手机号',
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
		$gh_id = $this->gh_id;
		$openid = $this->openid;
		$model = MUser::findOne(['gh_id'=>$gh_id, 'openid'=>$openid]);
		if ($model === null)
			return 0;
		if ($model->scene_id == 0)
			$count = 0;
		else
			$count = MUser::find()->where(['gh_id'=>$gh_id, 'scene_pid' => $model->scene_id])->count();
		return $count;

	}

	
}

/*

*/
