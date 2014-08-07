<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_contact;
CREATE TABLE wx_contact (
	id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(128) NOT NULL DEFAULT '',
	detail VARCHAR(1024) NOT NULL DEFAULT '',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MContact extends ActiveRecord
{
    public $verifyCode;

	public static function tableName()
	{
		return 'wx_contact';
	}

	public function rules()
	{
		return [      
				['detail', 'filter', 'filter' => 'trim'],
				['detail', 'required'],
				['detail', 'string', 'min' => 2, 'max' => 1024],
				['email', 'string', 'min' => 2, 'max' => 128],
	            ['verifyCode', 'captcha'],
		];
	}
	
	public function attributeLabels()
	{
		return [
			'email'=>'邮箱或联系方式',
			'detail'=>'内容',
		];
	}
	
	
}




/*

*/
