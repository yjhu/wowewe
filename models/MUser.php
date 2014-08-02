<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_user;
CREATE TABLE wx_user (
	id int(10) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	nickname VARCHAR(32) NOT NULL DEFAULT '',	
	sex tinyint(3) unsigned NOT NULL DEFAULT 0,		
	city VARCHAR(32) NOT NULL DEFAULT '',
	country VARCHAR(32) NOT NULL DEFAULT '',
	province VARCHAR(32) NOT NULL DEFAULT '',
	headimgurl VARCHAR(256) NOT NULL DEFAULT '',
	subscribe tinyint(3) unsigned NOT NULL DEFAULT 0,
	subscribe_time int(10) unsigned NOT NULL DEFAULT '0',
	password CHAR(16) NOT NULL DEFAULT '',
	email VARCHAR(32) NOT NULL DEFAULT '',	
	role tinyint(3) NOT NULL DEFAULT 0,
	status int(10) unsigned NOT NULL DEFAULT '0',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	update_time TIMESTAMP NOT NULL DEFAULT 0,
	mobile VARCHAR(64) NOT NULL DEFAULT '',
	msg_time int(10) unsigned NOT NULL DEFAULT '0',
	scene_id int(10) unsigned NOT NULL DEFAULT '0',
	scene_pid int(10) unsigned NOT NULL DEFAULT '0',
	KEY idx_gh_id_scene_pid(gh_id,scene_pid),
	UNIQUE KEY idx_gh_id_open_id(gh_id, openid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'admin', 'admin','1', 2);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'root', 'root','1', 9);
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_78539d18fdcc', 'o6biBt5yaB7d3i0YTSkgFSAHmpdo','hoya-hehbhehb','1');
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_1ad98f5481f3', 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o','woso-hehbhehb','1');

INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '1', 'office#1','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '2', 'office#2','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_03a74ac96138', '3', 'office#3','1', 1);

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class MUser extends ActiveRecord implements IdentityInterface
{
	const STATUS_DELETED = 10;
	const STATUS_ACTIVE = 0;

	const ROLE_NONE = 0;
	const ROLE_OFFICE = 1;	
	const ROLE_ADMIN = 2;	
	const ROLE_ROOT = 9;	

	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
					ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time',
				],
				'value' => new Expression('NOW()'),
			],
		];
	}

	public static function tableName()
	{
		return 'wx_user';
	}

	public static function findIdentity($id)
	{
		return static::findOne($id);
	}

	public static function findByUsername($nickname)
	{
		return static::findOne(['nickname' => $nickname, 'status' => static::STATUS_ACTIVE]);
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		//return static::find(['nickname' => $nickname, 'status' => static::STATUS_ACTIVE]);
		return null;
	}

	public function getUsername()
	{
		return $this->nickname;
	}

	public function getId()
	{
		return $this->id;
		//return $this->openid;
	}

	public function getAuthKey()
	{
		//return $this->auth_key;
		return $this->id;
	}

	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	public function validatePassword($password)
	{
		//return Security::validatePassword($password, $this->password_hash);
		return $password === $this->password;
	}

	public function rules()
	{
		return [
			['nickname', 'filter', 'filter' => 'trim'],
			['nickname', 'required'],
			['nickname', 'string', 'min' => 2, 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'message' => 'This email address has already been taken.', 'on' => 'signup'],
			['email', 'exist', 'message' => 'There is no user with such email.', 'on' => 'requestPasswordResetToken'],

			['password', 'required'],
			['password', 'string', 'min' => 1, 'max' => 16],
                                                            
			['mobile', 'filter', 'filter' => 'trim'],
			['mobile', 'required'], 
			['mobile', 'match', 'pattern' => '/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/' ],
                                                           
		];
	}

	public function attributeLabels()
	{
		return [
			'mobile'=>'手机号',
		];
	}



/*
	public function scenarios()
	{
		return [
			Yii\base\Model::SCENARIO_DEFAULT => ['nickname', 'email', 'password'],
			'signup' => ['nickname', 'email', 'password'],
			'resetPassword' => ['password'],
			'requestPasswordResetToken' => ['email'],
		];
	}
	
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if (($this->isNewRecord || $this->getScenario() === 'resetPassword') && !empty($this->password)) {
				//$this->password_hash = Security::generatePasswordHash($this->password);
			}
			if ($this->isNewRecord) {
				//$this->auth_key = Security::generateRandomKey();
			}
			return true;
		}
		return false;
	}
*/	
}

/*

DROP TABLE IF EXISTS wx_user;
CREATE TABLE wx_user (
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
	nickname VARCHAR(32) NOT NULL DEFAULT '',	
	sex tinyint(3) unsigned NOT NULL DEFAULT 0,		
	city VARCHAR(32) NOT NULL DEFAULT '',
	country VARCHAR(32) NOT NULL DEFAULT '',
	province VARCHAR(32) NOT NULL DEFAULT '',
	headimgurl VARCHAR(256) NOT NULL DEFAULT '',
	subscribe tinyint(3) unsigned NOT NULL DEFAULT 0,
	subscribe_time int(10) unsigned NOT NULL DEFAULT '0',
	password CHAR(16) NOT NULL DEFAULT '',
	email VARCHAR(32) NOT NULL DEFAULT '',	
	role tinyint(3) NOT NULL DEFAULT 0,
	status int(10) unsigned NOT NULL DEFAULT '0',
	create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	update_time TIMESTAMP NOT NULL DEFAULT 0,
	mobile VARCHAR(16) NOT NULL DEFAULT '',
	msg_time int(10) unsigned NOT NULL DEFAULT '0',	
	KEY idx_gh_id(gh_id),	
	PRIMARY KEY (openid)	
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'admin', 'admin','1', 1);
INSERT INTO wx_user (gh_id, openid,nickname,password, role) VALUES ('gh_78539d18fdcc', 'root', 'root','1', 9);
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_78539d18fdcc', 'o6biBt5yaB7d3i0YTSkgFSAHmpdo','hoya-hehbhehb','1');
INSERT INTO wx_user (gh_id, openid,nickname,password) VALUES ('gh_1ad98f5481f3', 'oSHFKs7-TgmNpLGjtaY4Sto9Ye8o','woso-hehbhehb','1');

CREATE TABLE wx_user (
	id int(10) unsigned NOT NULL AUTO_INCREMENT,
	openid VARCHAR(64) NOT NULL DEFAULT '',	
	nickname VARCHAR(24) NOT NULL DEFAULT '',	
	password CHAR(16) NOT NULL DEFAULT '',
	password_hash CHAR(64) NOT NULL DEFAULT '',	
	password_reset_token CHAR(32) NOT NULL DEFAULT '',	
	email VARCHAR(32) NOT NULL DEFAULT '',	
	auth_key CHAR(32) NOT NULL DEFAULT '',	
	role int(10) unsigned NOT NULL DEFAULT '0',
	status int(10) unsigned NOT NULL DEFAULT '0',
	create_time TIMESTAMP,				
	update_time TIMESTAMP,				
	PRIMARY KEY (id),	
	UNIQUE KEY idx_openid(openid),	
	UNIQUE KEY idx_nickname(nickname)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO wx_user (id,nickname,password) VALUES ('1','hehbhehb','1');

ALTER TABLE wx_user CHANGE mobile mobile VARCHAR(64) NOT NULL DEFAULT '';
ALTER TABLE wx_user ADD pid int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user ADD office_id int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user CHANGE pid pid VARCHAR(32) NOT NULL DEFAULT '';
ALTER TABLE wx_user DROP INDEX idx_gh_id;
ALTER TABLE wx_user ADD KEY idx_gh_id_pid(gh_id,pid);
ALTER TABLE wx_user DROP INDEX idx_gh_id_pid;
ALTER TABLE wx_user ADD scene_id int(10) unsigned NOT NULL DEFAULT '0' after msg_time;
ALTER TABLE wx_user CHANGE pid scene_pid int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE wx_user ADD KEY idx_gh_id_scene_pid(gh_id,scene_pid);


// for test
class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
	public $id;
	public $nickname;
	public $password;
	public $authKey;
	public $accessToken;

	private static $users = [
		'100' => [
			'id' => '100',
			'nickname' => 'admin',
			'password' => 'admin',
			'authKey' => 'test100key',
			'accessToken' => '100-token',
		],
		'101' => [
			'id' => '101',
			'nickname' => 'demo',
			'password' => 'demo',
			'authKey' => 'test101key',
			'accessToken' => '101-token',
		],
	];

	public static function findIdentity($id)
	{
		return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
	}

	public static function findIdentityByAccessToken($token)
	{
		foreach (self::$users as $user) {
			if ($user['accessToken'] === $token) {
				return new static($user);
			}
		}
		return null;
	}

	public static function findByUsername($nickname)
	{
		foreach (self::$users as $user) {
			if (strcasecmp($user['nickname'], $nickname) === 0) {
				return new static($user);
			}
		}
		return null;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getAuthKey()
	{
		return $this->authKey;
	}

	public function validateAuthKey($authKey)
	{
		return $this->authKey === $authKey;
	}

	public function validatePassword($password)
	{
		return $this->password === $password;
	}
}
*/
