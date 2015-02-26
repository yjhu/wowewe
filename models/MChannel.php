<?php
namespace app\models;

/*
#经销商渠道放在wx_channel中, 自营业厅渠道放在wx_office中
#全部挪到wx_office中
DROP TABLE IF EXISTS wx_channel;
CREATE TABLE wx_channel (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
	openid varchar(32) NOT NULL DEFAULT '' COMMENT '渠道所绑定的微信id',
    scene_id int(10) unsigned NOT NULL DEFAULT '0',
    title VARCHAR(128) NOT NULL DEFAULT '',
    mobile VARCHAR(16) NOT NULL DEFAULT '',
    UNIQUE KEY idx_gh_id_title(gh_id, title),    
    KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE wx_channel DROP cat;
ALTER TABLE wx_channel DROP status;
ALTER TABLE wx_channel DROP level;
*/

        
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\U;
use app\models\MGh;
use app\models\MOffice;

use app\models\MAccessLog;

class MChannel extends ActiveRecord
{
    public static function tableName()
    {
        return 'wx_channel';
    }

    public function rules()
    {
        return [
            [['title', 'mobile'], 'filter', 'filter' => 'trim'],
            [['title'], 'required'],
            [['title'], 'string', 'min' => 2, 'max' => 255],
            [['mobile'], 'string', 'length'=>11],
            [['id'], 'integer', 'integerOnly' =>true, 'min'=>1],
            [['gh_id', 'openid'], 'safe'],
            ['title', 'unique', 'message' => 'This title has already been taken.'],            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '渠道编号',
            'title' => '名称',
            'mobile' => '手机号',
            'scene_id' => '推广Id',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
    }

    public function getFans()
    {
		//return $this->hasMany(MUser::className(), ['gh_id' => 'gh_id', 'scene_pid' => 'scene_id'])->where(['subscribe' => 1]);
        return $this->hasMany(MUser::className(), ['gh_id' => 'gh_id', 'scene_pid' => 'scene_id']);
    }

    public function getFansCount()
    {
        return $this->hasMany(MUser::className(), ['gh_id' => 'gh_id', 'scene_pid' => 'scene_id'])->count('*');
    }

    public function getQrImageUrl()
    {
        $gh_id = $this->gh_id;
        if (empty($this->scene_id))
        {
            $newFlag = true;
            $gh = MGh::findOne($gh_id);
            $scene_id = $gh->newSceneId();
            $this->scene_id = $scene_id;
            //U::W("scene_id=$scene_id");                                
        }
        else
        {
            $newFlag = false;        
            $scene_id = $this->scene_id;
        }
        $log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
        //U::W($log_file_path);                            
        if (!file_exists($log_file_path))
        {
            Yii::$app->wx->setGhId($gh_id);    
            $arr = Yii::$app->wx->WxgetQRCode($scene_id, true);
            if (empty($arr['ticket']))
                U::W([__METHOD__, $arr]);
            $url = Yii::$app->wx->WxGetQRUrl($arr['ticket']);
            Wechat::downloadFile($url, $log_file_path);
        }
        if ($newFlag)
        {
            if ($this->save(false))
               $gh->save(false);
        }      
        if (Yii::$app->getRequest()->getIsConsoleRequest())
            $url = '';
        else
            $url = Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg";
        //U::W($url);
        return $url;
    }

    public function getScore()
    {
        if ($this->scene_id == 0)
            $count = 0;
        else
            $count = MUser::find()->where(['gh_id'=>$this->gh_id, 'scene_pid' => $this->scene_id, 'subscribe' => 1])->count();            
        return $count;        
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            if (!empty($this->scene_id))
            {
                $gh = MGh::findOne($this->gh_id);        
                $gh->freeSceneId($this->scene_id);
                return $gh->save(false);
            }
            return true;            
        } else {
            return false;
        }
    }

    public function getScoreFromLog($month)
    {
        if ($this->scene_id == 0)
            $count = 0;
        else
            $count = MAccessLog::find()->where(['ToUserName'=>$this->gh_id, 'scene_pid' => $this->scene_id, 'month(create_time)'=>$month])->count();
        return $count;
    }

/*
select t1.c, t2.title, t2.mobile, t2.scene_id  
from (select scene_pid, count(*) as c from wx_user where gh_id='gh_03a74ac96138' and scene_pid != 0 AND subscribe=1 group by scene_pid) t1
inner join wx_channel t2 on t1.scene_pid = t2.scene_id and t2.scene_id != 0
order by c desc
INTO OUTFILE '/tmp/top.csv'
CHARACTER SET gbk
FIELDS ENCLOSED BY '"' TERMINATED BY ',' ESCAPED BY '"'
LINES TERMINATED BY '\r\n';
*/
    public static function getChannelScoreTop($gh_id, $month)
    {
        $key = md5(serialize([__METHOD__, $gh_id, $month]));
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $channels = MChannel::findAll(['gh_id' => $gh_id]);
        $rows = [];
        foreach($channels as $channel)
        {
            $row = [];
            $row['id'] = $channel->id;            
            $row['title'] = $channel->title;         
            $row['cnt_sum'] = $channel->getScoreFromLog($month);                       
            $rows[] = $row;
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 12*3600);
        return $rows;
    }

/*
select t1.c, t2.title, t2.mobile, t2.scene_id  
from (select ToUserName, scene_pid, count(*) as c from wx_access_log where ToUserName='gh_03a74ac96138' and scene_pid != 0 AND Event='subscribe' AND month(create_time)>='10' AND month(create_time)<='11' group by scene_pid) t1
RIGHT JOIN wx_channel t2 on t1.ToUserName=t2.gh_id AND t1.scene_pid = t2.scene_id and t2.scene_id != 0
order by c desc


select t1.c, t2.title, t2.mobile, t2.scene_id  
from (select ToUserName, scene_pid, count(*) as c from wx_access_log where ToUserName='gh_03a74ac96138' and scene_pid != 0 AND Event='subscribe' AND date(create_time)='2014-11-03' group by scene_pid) t1
RIGHT JOIN wx_channel t2 on t1.ToUserName=t2.gh_id AND t1.scene_pid = t2.scene_id and t2.scene_id != 0
order by c desc

select t1.c, t2.title, t2.mobile, t2.scene_id  
from (select ToUserName, scene_pid, count(*) as c from wx_access_log where ToUserName='gh_03a74ac96138' and scene_pid != 0 AND Event='subscribe' AND date(create_time)='2014-11-01' group by scene_pid) t1
INNER JOIN wx_channel t2 on t1.ToUserName=t2.gh_id AND t1.scene_pid = t2.scene_id and t2.scene_id != 0
order by c desc
*/
    public static function getChannelScoreTopx($gh_id, $date_start, $date_end)
    {
        $key = md5(serialize([__METHOD__, $gh_id, $date_start, $date_end]));
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        $channels = MChannel::findAll(['gh_id' => $gh_id]);
        $rows = [];
        foreach($channels as $channel)
        {
            $row = [];
            $row['id'] = $channel->id;            
            $row['title'] = $channel->title;         
            $row['cnt_sum'] = $channel->getScoreFromLogRange($date_start, $date_end);
            $rows[] = $row;
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 10 : 12*3600);
        return $rows;
    }

    public function getScoreFromLogRange($date_start, $date_end)
    {
        if ($this->scene_id == 0)
            return 0;
        $count_plus = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$this->gh_id, ':scene_pid' => $this->scene_id, ':Event'=>'subscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->count();
        $count_minus = MAccessLog::find()->where('ToUserName=:ToUserName AND scene_pid=:scene_pid AND Event=:Event AND date(create_time)>=:date_start AND date(create_time)<=:date_end ', [':ToUserName'=>$this->gh_id, ':scene_pid' => $this->scene_id, ':Event'=>'unsubscribe', ':date_start'=>$date_start, ':date_end'=>$date_end])->count();
        return $count_plus - $count_minus;
    }    
}

/*
ALTER TABLE wx_channel ADD cat tinyint(3) NOT NULL DEFAULT 0;
ALTER TABLE wx_channel ADD level tinyint(3) NOT NULL DEFAULT 0;
ALTER TABLE wx_channel ADD status int(10) unsigned NOT NULL DEFAULT 0;

    level tinyint(3) NOT NULL DEFAULT 0,
    status int(10) unsigned NOT NULL DEFAULT 0,    
    cat tinyint(3) NOT NULL DEFAULT 0,


    public function Release()
    {    
        $gh = MGh::findOne($this->gh_id);        
        $gh->freeSceneId($this->scene_id);
        if ($gh->save(false))
            $this->delete();
    }
//            $row['cat'] = $channel->cat;                     
//            $row['status'] = $channel->status;                                 
    
*/

