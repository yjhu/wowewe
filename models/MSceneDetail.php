<?php
namespace app\models;


/*
no use now

DROP TABLE IF EXISTS wx_scene_detail;
CREATE TABLE wx_scene_detail (
    id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gh_id VARCHAR(32) NOT NULL DEFAULT '',
    openid VARCHAR(32) NOT NULL DEFAULT '',    
    cat tinyint(1) unsigned NOT NULL DEFAULT '0',        
    scene_id int(10) unsigned NOT NULL DEFAULT '0',    
    scene_src_id int(10) unsigned NOT NULL DEFAULT '0',
    scene_amt int(10) NOT NULL DEFAULT '0',    
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    oid VARCHAR(32) NOT NULL DEFAULT '',
    openid_fan VARCHAR(32) NOT NULL DEFAULT '',        
    memo VARCHAR(256) NOT NULL DEFAULT '',   
    czhm VARCHAR(64) NOT NULL DEFAULT '', 
    status tinyint(1) unsigned NOT NULL DEFAULT '0',    
    KEY idx_gh_id_openid(gh_id, openid),    
    KEY idx_gh_id_scene_id(gh_id, scene_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



ALTER TABLE wx_scene_detail ADD KEY idx_gh_id_openid(gh_id, openid);

// czhm 充值号码
ALTER TABLE wx_scene_detail ADD czhm VARCHAR(64) NOT NULL DEFAULT '';

*/

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use app\models\U;
use app\models\MUser;
use app\models\MItem;
use app\models\MOrder;

class MSceneDetail extends ActiveRecord
{

    const SRC_ID_SHARE_FRIEND = 1;

    const STATUS_INIT = 0;
    const STATUS_CONFIRMED = 1;    
    const STATUS_CANCEL = 2;

    //amt<0 means tixian
    const STATUS_TIXIAN_APPLY = 0;
    const STATUS_TIXIAN_OK = 1;    
    const STATUS_TIXIAN_NOTOK = 2;

    const CAT_ITEM = 0;
    const CAT_FAN = 1;    
    const CAT_SIGN = 2;
    

    public function rules()
    {
        return [
            [['status'], 'safe'],
        ];
    }

    public static function getSceneDetailStatusOption()
    {
        $arr = array(
            self::STATUS_TIXIAN_APPLY => '申请提现',
            self::STATUS_TIXIAN_OK => '提现成功',
            self::STATUS_TIXIAN_NOTOK => '提现失败',
        );        
        return $arr;
    }    


    public static function getSceneDetailStatusName($key=null)
    {
        $arr = array(
            self::STATUS_TIXIAN_APPLY => '申请提现',
            self::STATUS_TIXIAN_OK => '提现成功',
            self::STATUS_TIXIAN_NOTOK => '提现失败',
        );        
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');
    }


    public static function tableName()
    {
        return 'wx_scene_detail';
    }

    public function getUser()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'scene_id' => 'scene_id']);
    }

    public function getUserFan()
    {
        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid_fan']);
    }

    public function getOrder()
    {
        return $this->hasOne(MOrder::className(), ['oid' => 'oid']);
    }
    
}

/*        
select count(*) as c, scene_pid from wx_access_log where date(create_time)='2014-10-26' and Event='subscribe' group by scene_pid order by c desc;
*/
