<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_custom;
CREATE TABLE wx_custom (
    custom_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    mobile VARCHAR(32) NOT NULL DEFAULT '',    
    name VARCHAR(16) NOT NULL DEFAULT '',
    is_vip tinyint(3) NOT NULL DEFAULT 0,
    office_id int(10) unsigned NOT NULL DEFAULT '0',     
    vip_level_id int(10) unsigned NOT NULL DEFAULT '0',     
    vip_join_time TIMESTAMP,
    vip_start_time TIMESTAMP,    
    vip_end_time TIMESTAMP,    
    UNIQUE KEY idx_mobile(mobile),
    KEY idx_office_id(office_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/


use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

use app\models\U;
use app\models\MOffice;
use app\models\MSceneDay;
use app\models\MAccessLog;
use app\models\OpenidBindMobile;


class Custom extends ActiveRecord
{
    public static function tableName()
    {
        return 'wx_custom';
    }

    public function rules()
    {
        return [
            [['name', 'mobile'], 'filter', 'filter' => 'trim'],
            [['mobile', 'office_id'], 'required'],
            [['name', 'mobile'], 'string', 'min' => 1, 'max' => 255],
            [['office_id'], 'integer', 'integerOnly' =>true, 'min'=>0],       
            [['is_vip'], 'boolean'],            
            [['vip_level_id'], 'integer', 'integerOnly' =>true, 'min'=>0],       
        ];
    }

    public function attributeLabels()
    {
        return [
            'vip_id' => 'VIP IP',
            'name' => '姓名',
            'mobile' => '手机号码',
            'vip_join_time' => '加入时间',
            'vip_start_time' => '开始时间',
            'vip_end_time' => '结束时间',
            'vip_level_id' => 'VIP级别',
            'office_id' => '营业厅编号',
            'is_vip' => 'VIP',
        ];
    }


    public function getOffice()
    {
        return $this->hasOne(MOffice::className(), ['office_id' => 'office_id']);
    }

    public function getVipLevel()
    {
        return $this->hasOne(VipLevel::className(), ['vip_level_id' => 'vip_level_id']);
    }

    public function isVip()
    {
        return $this->is_vip ? true : false;
    }    
    
    public function getUser()
    {
//        return $this->hasOne(MUser::className(), ['gh_id' => 'gh_id', 'openid' => 'openid']);
        return empty($this->openidBindMobile->user) ? null : $this->openidBindMobile->user;
    }
    
    public function getWechat() {
        return $this->getUser();
    }
            

    public function getCustomManager()
    {
        return $this->hasOne(CustomManager::className(), ['custom_id' => 'custom_id']);
    }

    public function getOpenidBindMobile()
    {
        return $this->hasOne(OpenidBindMobile::className(), ['mobile' => 'mobile']);
    }

    public function getVipStartTime()
    {
        return substr($this->vip_start_time, 0, 10);
    }

    public function getVipEndTime()
    {
        return substr($this->vip_end_time, 0, 10);
    }

    public function getVipJoinTime()
    {
        return substr($this->vip_join_time, 0, 10);
    }
    
    public static function getBoundCustomerCount($gh_id, $office_id) {
        return self::find()
                ->join('INNER JOIN', 'wx_openid_bind_mobile', 'wx_openid_bind_mobile.mobile=wx_custom.mobile')
                ->join('INNER JOIN', 'wx_user', 'wx_openid_bind_mobile.gh_id = wx_user.gh_id and wx_openid_bind_mobile.openid = wx_user.openid')
                ->where(['wx_user.subscribe' => 1])
                ->andWhere(['wx_custom.office_id' => $office_id])
                ->andWhere(['wx_user.gh_id' => $gh_id])
                ->count();
    }

    public static function getBindVipCustoms($in_office)
    {
        $mobiles = OpenidBindMobile::getMobiles();
        if ($in_office == '1') {
            $customs = Custom::find()->where(['mobile'=>$mobiles])->andWhere("office_id > 0 AND is_vip = 1")->all();
        } else {
            $customs = Custom::find()->where(['mobile'=>$mobiles])->andWhere("office_id = 0 AND is_vip = 1")->all();
        }
        return $customs;
    }

    public static function getNotBindVipCustoms($in_office)
    {
        $mobiles = OpenidBindMobile::getMobiles();
        if ($in_office == '1') {
            $customs = Custom::find()->where(['mobile'=>$mobiles])->andWhere("office_id > 0 AND is_vip = 1")->all();
        } else {
            $customs = Custom::find()->where(['mobile'=>$mobiles])->andWhere("office_id = 0 AND is_vip = 1")->all();
        }
        return $customs;
    }

}


