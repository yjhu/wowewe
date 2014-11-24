<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_act_winmobilenum;
CREATE TABLE wx_act_winmobilenum (
	id int(10) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid VARCHAR(32) NOT NULL DEFAULT '',
    mobile VARCHAR(64) NOT NULL DEFAULT '',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    finished tinyint(3) unsigned NOT NULL DEFAULT 0

) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use app\models\MUser;

class Mwinmobilenum extends ActiveRecord
{
	public static function tableName()
	{
		return 'wx_act_winmobilenum';
	}

    public function rules()
    {
		return [
			['mobile', 'filter', 'filter' => 'trim', 'on'=>'join'],
			['mobile', 'required', 'on'=>'join'], 
			['mobile', 'match', 'pattern' => '/((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/' , 'on'=>'join'],        
			[['openid', 'create_time'], 'safe'],
		];
    }


    public function attributeLabels()
    {
        return [
            'mobile'=>'手机号',
        ];
    }
	/*
    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getUserFan()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid_fan']);
    }
    */


}

/*

*/
