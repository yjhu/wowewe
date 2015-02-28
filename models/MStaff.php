<?php
namespace app\models;

/*
#wx_staff就是推广者表，原来wx_user中的scene_id, 全部移到wx_staff中, 原来的wx_channel已弃用，因此所有scene_id仅存在于wx_office和wx_staff中
#如果一个粉丝的pid=0，表示是总部的推广成绩

#当总部(gh_id)增加一个部门(office)时，颁发一个scene_id，并在wx_office中插入一条记录(内含此office的推广id)
#当某个office增加一个staff(即推广者时)，颁发一个scene_id，并在wx_staff表中插入一条记录
#一个总部下面可设N个office,一个office可以增加N个推广者(员工也是一种推广者，只不是推广者的身份标志为员工而已)
#同一个gh_id，scene_id不能重复

DROP TABLE IF EXISTS wx_staff;
CREATE TABLE wx_staff (
    staff_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    office_id int(10) unsigned NOT NULL DEFAULT '0',
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '' COMMENT '此推广者绑定的微信号',
    name VARCHAR(16) NOT NULL DEFAULT '',
    mobile VARCHAR(16) NOT NULL DEFAULT '',
    is_manager tinyint(3) NOT NULL DEFAULT 0,
    scene_id int(10) unsigned NOT NULL DEFAULT '0' COMMENT '推广者的推广id',
    cat tinyint(3) NOT NULL DEFAULT 0 COMMENT '推广者身份类型, 0:员工, 1:外部推广者',
    KEY office_id_idx(office_id),
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

class MStaff extends ActiveRecord
{
    static function getStaffCatOptionName( $key = null )
    {
        $arr = array(
            '0' => '内部员工',
            '1' => '外部推广者',
        );      
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }

    public static function tableName()
    {
        return 'wx_staff';
    }

    public function rules()
    {
        return [
            [['name', 'mobile'], 'filter', 'filter' => 'trim'],
            [['name', 'mobile', 'office_id'], 'required'],
            [['name', 'mobile'], 'string', 'min' => 2, 'max' => 255],
            [['office_id'], 'integer', 'integerOnly' =>true, 'min'=>1],       
            [['gh_id', 'openid', 'scene_id'], 'safe'],            
            [['is_manager'], 'boolean'],            
            [['cat'], 'integer', 'integerOnly' =>true, 'min'=>0, 'max' => 1],       
        ];
    }

    public function attributeLabels()
    {
        return [
            'staff_id' => '员工编号',
            'office_id' => '营业厅编号',
            'name' => '姓名',
            'mobile' => '手机号',
            'is_manager' => '是否主管',
            'cat' => '类型',
        ];
    }
    
    public function getOffice()
    {
        return $this->hasOne(MOffice::className(), ['office_id' => 'office_id']);
    }

    public function getScore()
    {
        if ($this->scene_id == 0)
            $count = 0;
        else
            $count = MUser::find()->where(['gh_id'=>$this->gh_id, 'scene_pid' => $this->scene_id, 'subscribe' => 1])->count();                        
        return $count;    
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
        }
        else
        {
            $newFlag = false;        
            $scene_id = $this->scene_id;
        }
        $log_file_path = Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'qr'.DIRECTORY_SEPARATOR."{$gh_id}_{$scene_id}.jpg";
        if (!file_exists($log_file_path))
        {
            Yii::$app->wx->setGhId($gh_id);    
            $arr = Yii::$app->wx->WxgetQRCode($scene_id, true);
            $url = Yii::$app->wx->WxGetQRUrl($arr['ticket']);
            Wechat::downloadFile($url, $log_file_path);
        }
        if ($newFlag)
        {
            if ($this->save(false))
               $gh->save(false);                    
        }        
        $url = Yii::$app->getRequest()->baseUrl."/../runtime/qr/{$gh_id}_{$scene_id}.jpg";
        //U::W($url);
        return $url;
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

/*
select t1.c, t3.name, t3.office_id, t4.title, t2.scene_id  from (select scene_pid, count(*) as c from wx_user
where gh_id='gh_03a74ac96138' and scene_pid != 0 group by scene_pid order by c desc) t1
left join wx_user t2 on t1.scene_pid = t2.scene_id and t2.scene_id != 0
left join wx_staff t3 on t2.openid = t3.openid
left join wx_office t4 on t3.office_id = t4.office_id;
*/
    public static function getStaffScoreTop($gh_id, $n=0)
    {
        $key = __METHOD__."{$gh_id}_{$n}";
        $value = Yii::$app->cache->get($key);
        if ($value !== false)
            return $value;
        
        $sql = <<<EOD
SELECT t1.score, t3.name, t3.office_id, t3.mobile, t4.title, t2.scene_id, t2.headimgurl,t2.gh_id,t2.openid  FROM (SELECT scene_pid, count(*) as score FROM wx_user 
WHERE gh_id='$gh_id' and scene_pid != 0 GROUP BY scene_pid ORDER BY score desc) t1 
LEFT JOIN wx_user t2 ON t1.scene_pid = t2.scene_id AND t2.scene_id != 0 
LEFT JOIN wx_staff t3 ON t2.openid = t3.openid 
LEFT JOIN wx_office t4 ON t3.office_id = t4.office_id
EOD;
        if ($n)
            $sql .= " LIMIT $n";

        $rows = Yii::$app->db->createCommand($sql)->queryAll();
        foreach($rows as $idx => $row)
        {
            if (empty($row['name']))
                unset($rows[$idx]);
        }
        Yii::$app->cache->set($key, $rows, YII_DEBUG ? 100 : 12*3600);
        return $rows;
    }

    public function sendWxm($content)
    {
        if (empty($this->gh_id) || empty($this->openid))
        {
            U::W(["manager's gh_id or openid is empty", $this->getAttributes(), __METHOD__]);
            return false;
        }
        try
        {
            Yii::$app->wx->setGhId($this->gh_id);
            $arr = Yii::$app->wx->WxMessageCustomSend(['touser'=>$this->openid,'msgtype'=>'text', 'text'=>['content'=>$content]]);
            //U::W(['sendwxm....', $arr, ['touser'=>$this->openid,'msgtype'=>'text', 'text'=>['content'=>$content]], $this->gh_id]);
        }
        catch (\Exception $e)
        {
            U::W($e->getCode().':'.$e->getMessage());
            return false;
        }
        return true;
    }

    public function sendSm($content)
    {
        try
        {
            if (empty($this->mobile) || !U::mobileIsValid($this->mobile))
            {
                U::W(["manager's mobile is empty or invalid", $this->getAttributes(), __METHOD__]);
                return false;
            }
            U::W("balance before is ".\app\models\sm\ESmsGuodu::B());
            //$s = Yii::$app->sm->S($this->mobile, $content, '', 'guodu', true);        
            $s = Yii::$app->sm->S($this->mobile, $content, '', null, true);
            //U::W($s->resp);        
            $err_code = $s->getErrorMsg();
            $className = get_class($s);                
            $err_code .= get_class($s);        
            $smQueue = new MSmQueue;
            $smQueue->gh_id = $this->gh_id;
            $smQueue->receiver_mobile = $this->mobile;
            $smQueue->msg = $content;
            $smQueue->err_code = $err_code;
            if ($s->isSendOk())
            {
                U::W('Send Sm OK');
                $smQueue->status = MSmQueue::STATUS_SENT;
            }
            else 
            {
                U::W(['Send Sm ERR', $err_code, $s->resp]);
                $smQueue->status = MSmQueue::STATUS_ERR;            
            }
            $smQueue->save(false);
            U::W("balance after is ".\app\models\sm\ESmsGuodu::B());        
        }
        catch (\Exception $e)
        {
            U::W($e->getCode().':'.$e->getMessage());
        }    
        return true;
    }

    public function isManager()
    {
        return $this->is_manager ? true : false;
    }    
}


