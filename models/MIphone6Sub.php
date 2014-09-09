<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_iphone6sub;
CREATE TABLE wx_iphone6sub (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	user_name VARCHAR(32) NOT NULL DEFAULT '',
	user_contact VARCHAR(128) NOT NULL DEFAULT '',
	user_id VARCHAR(32) NOT NULL DEFAULT '',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	KEY idx_create_time(create_time)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


*/

use Yii;
use yii\db\ActiveRecord;
use app\models\U;

class MIphone6Sub extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_iphone6sub';
	}

	public function rules()
	{
		return [
			[['user_name', 'user_contact', 'user_id'], 'filter', 'filter' => 'trim'],
			[['user_name', 'user_contact', 'user_id'], 'required'],
			['user_name', 'string', 'min' => 2, 'max' => 10],
			['user_contact', 'string', 'min' => 1, 'max' => 128],
			['user_id', 'string', 'min' => 18, 'max' => 18],
			['user_id', 'unique', 'message' => '此身份证号码已存在'],
		];
	}

	public function attributeLabels()
	{
		return [
			'user_name'=>'姓名',
			'user_contact'=>'联系方式',
			'user_id'=>'身份证号码',
			'create_time'=>'提交时间',
		];
	}

}

/*


*/
