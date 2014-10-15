<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_channel;
CREATE TABLE wx_channel (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',
    scene_id int(10) unsigned NOT NULL DEFAULT '0',
    title VARCHAR(128) NOT NULL DEFAULT '',
    mobile VARCHAR(16) NOT NULL DEFAULT '',
    cat tinyint(3) NOT NULL DEFAULT 0,
    level tinyint(3) NOT NULL DEFAULT 0,
    status int(10) unsigned NOT NULL DEFAULT 0,    
    UNIQUE KEY idx_gh_id_title(gh_id, title),    
    KEY gh_id_idx(gh_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

        
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\U;
use app\models\MOffice;

use app\models\MAccessLog;

class MChannel extends ActiveRecord
{
    const CAT_LIANTONG_DEALER = 0;
    const CAT_SOCIAL = 1;

    const STATUS_WAIT = 1;
    const STATUS_OK = 0;

    static function getCatOptionName($key=null)
    {
        $arr = array(
            self::CAT_LIANTONG_DEALER => '联通经销商',
            self::CAT_SOCIAL => '社会化渠道',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    static function getStatusOptionName($key=null)
    {
        $arr = array(
            self::STATUS_WAIT => '等待审核',
            self::STATUS_OK => '正常',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

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
            [['status','cat'], 'integer', 'integerOnly' =>true],
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
            'cat' => '渠道类别',
            'level' => '等级',
            'status' => '状态',
            'scene_id' => '推广Id',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
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

    public function Release()
    {    
        $gh = MGh::findOne($this->gh_id);        
        $gh->freeSceneId($this->scene_id);
        if ($gh->save(false))
            $this->delete();
    }

    public function getScoreFromLog($month)
    {
        if ($this->scene_id == 0)
            $count = 0;
        else
            $count = MAccessLog::find()->where(['ToUserName'=>$this->gh_id, 'scene_pid' => $this->scene_id, 'month(create_time)'=>$month])->count();
        return $count;
    }

    public static function getChannelScoreTop($gh_id,$month)
    {
        $key = md5(serialize([$_GET, $gh_id, $month]));
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
    
}

/*
ALTER TABLE wx_channel ADD cat tinyint(3) NOT NULL DEFAULT 0;
ALTER TABLE wx_channel ADD level tinyint(3) NOT NULL DEFAULT 0;
ALTER TABLE wx_channel ADD status int(10) unsigned NOT NULL DEFAULT 0;


*/            

