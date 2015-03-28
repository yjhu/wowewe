<?php
namespace app\models;


/*
DROP TABLE IF EXISTS wx_access_log;
CREATE TABLE wx_access_log (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    scene_pid int(10) unsigned NOT NULL DEFAULT '0',    
    ToUserName VARCHAR(32) NOT NULL DEFAULT '',
    FromUserName VARCHAR(32) NOT NULL DEFAULT '',
    CreateTime int(10) unsigned NOT NULL DEFAULT '0',
    MsgId bigint(20) unsigned NOT NULL DEFAULT '0',
    MsgType VARCHAR(32) NOT NULL DEFAULT '',
    Content VARCHAR(256) NOT NULL DEFAULT '',
    Event VARCHAR(32) NOT NULL DEFAULT '',
    EventKey VARCHAR(1024) NOT NULL DEFAULT '',
    EventKeyCRC bigint(20) unsigned NOT NULL DEFAULT '0',
    KEY gh_id_idx(ToUserName),
    KEY EventKeyCRC_idx(EventKeyCRC)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE wx_access_log ADD scene_pid int(10) unsigned NOT NULL DEFAULT '0' after create_time;

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MUser;
use app\models\MItem;
use app\models\MOffice;

// MAccessLog: just log subscribe unscribe info
// MAccessLogAll: log other info except subscribe and unscribe info
class MAccessLog extends ActiveRecord
{
    
    public static function tableName()
    {
        return 'wx_access_log';
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'ToUserName', 'openid' => 'FromUserName']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) 
        {
            $checksum = crc32(is_array($this->EventKey) ? json_encode($this->EventKey) : $this->EventKey);        
            $this->EventKeyCRC = sprintf("%u", $checksum);
            if ((!empty($this->EventKey)) && substr($this->EventKey, 0, 8) == 'qrscene_')
            {
                $this->scene_pid = substr($this->EventKey, 8);  
            }
            return true;
        } 
        return false;
    }

    public function setAttributes($values, $safeOnly = true)
    {
        if (is_array($values)) 
        {
            foreach($values as $key=>$value)
            {
                if (is_array($value))
                    unset($values[$key]);
            }
        }
        parent::setAttributes($values, $safeOnly);
    }

    public static function getScoreByRange($gh_id, $scene_id, $date_start, $date_end)
    {
        $count_plus = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$gh_id, ':scene_pid' => $scene_id, ':Event'=>'subscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->count();
        $count_minus = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$gh_id, ':scene_pid' => $scene_id, ':Event'=>'unsubscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->count();
        return $count_plus - $count_minus;
    }    
    
}

/*        
*/
