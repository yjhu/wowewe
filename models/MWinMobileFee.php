<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_act_winmobilefee;
CREATE TABLE wx_act_winmobilefee (
    id int(10) unsigned NOT NULL AUTO_INCREMENT  PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    openid_fan VARCHAR(32) NOT NULL DEFAULT '',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY gh_id_idx(gh_id,openid)    
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

use app\models\MUser;

class MWinMobileFee extends ActiveRecord
{    
    public static function tableName()
    {
        return 'wx_act_winmobilefee';
    }

    public function rules()
    {
		return [          
			[['openid', 'openid_fan', 'create_time'], 'safe'],
		];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getUserFan()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid_fan']);
    }


    
}

/*

*/
