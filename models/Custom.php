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
            [['name', 'mobile', 'office_id'], 'required'],
            [['name', 'mobile'], 'string', 'min' => 1, 'max' => 255],
            [['office_id'], 'integer', 'integerOnly' =>true, 'min'=>0],       
            [['is_vip'], 'boolean'],            
            [['vip_level_id'], 'integer', 'integerOnly' =>true, 'min'=>0],       
        ];
    }

    public function attributeLabels()
    {
        return [
            'vip_id' => 'Vip ID',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'join_time' => 'Join Time',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'vip_level_id' => 'vip_level_id',
            'office_id' => '营业厅编号',
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

}


