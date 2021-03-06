<?php
namespace app\models;


/*
DROP TABLE IF EXISTS wx_access_log;
CREATE TABLE wx_access_log (
    access_log_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
ALTER TABLE wx_access_log CHANGE id access_log_id int(10) unsigned NOT NULL AUTO_INCREMENT;

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

    public function attributeLabels()
    {
        return [
            'FromUserName' => '粉丝openid',
            'scene_pid' => '第一推荐者',
            'EventKey' => '直接推荐者',
            'create_time' => '时间',
            'Event' => '事件',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'ToUserName', 'openid' => 'FromUserName']);
    }

    public function getStaff()
    {
        return $this->hasOne(MStaff::className(), ['gh_id' => 'ToUserName','scene_id' => 'scene_pid']);
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
        $fan_openids = array();
        $accesslogs = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$gh_id, ':scene_pid' => $scene_id, ':Event'=>'subscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->all();
        foreach($accesslogs as $accesslog) {
            $fan = $accesslog->user;
            if (!empty($fan)) {
                if (!in_array($fan->openid, $fan_openids) && $fan->subscribe) {
                    $fan_openids[] = $fan->openid;
                } 
            }
        }
        return count($fan_openids);
    }    

    public static function getRealScoreByRange($gh_id, $scene_id, $date_start, $date_end)
    {    
        //U::W("scene_id=$scene_id,$date_start, $date_end");    
        $count_plus = 0;
        $fan_openids = array();
        $accessLogs = MAccessLog::find()
                ->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$gh_id, ':scene_pid' => $scene_id, ':Event'=>'subscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])
                ->andWhere(['booked' => 0])
                ->all();        
        foreach ($accessLogs as $accessLog) {
            $fan = $accessLog->user;
            if (!empty($fan)) {                
                // just can get money only if the recommended fan bind a mobile
                if (in_array($fan->openid, $fan_openids)) {
                    $accessLog->updateAttributes(['booked' => 1]);
                    continue;
                }
                $fan_openids[] = $fan->openid;
                if ($fan->subscribe && !empty($fan->openidBindMobiles)) {
                    $accessLog->updateAttributes(['booked' => 1]);
                    $count_plus++;
                }
            }
        }
//        $count_minus = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$gh_id, ':scene_pid' => $scene_id, ':Event'=>'unsubscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->count();
//        return $count_plus - $count_minus;
        return $count_plus;
    }    
    
}

/*        
*/
