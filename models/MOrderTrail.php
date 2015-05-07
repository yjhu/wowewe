<?php
namespace app\models;


/*
DROP TABLE IF EXISTS wx_order_trail;
CREATE TABLE wx_order_trail (
    order_trail_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    oid VARCHAR(32) NOT NULL DEFAULT '',
    staff_id int(10) unsigned NOT NULL DEFAULT '0',
    status_old int(10) unsigned NOT NULL DEFAULT '0',
    status_new int(10) unsigned NOT NULL DEFAULT '0',
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    KEY idx_oid(oid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
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
use app\models\MStaff;
use app\models\MOrder;

class MOrderTrail extends ActiveRecord
{
    
    public static function tableName()
    {
        return 'wx_order_trail';
    }

    public function attributeLabels()
    {
        return [
            'oid' => '订单号',
            'status_old' => '原订单状态',
            'status_new' => '修改后的订单状态',
        ];
    }

    public function rules()
    {
        return [
            [['status_old', 'status_new', 'staff_id'], 'integer'],       
            [['oid'],  'string', 'min' => 1, 'max' => 64],          
        ];
    }

    public function getOrder()
    {
        return $this->hasOne(MOrder::className(), ['oid' => 'oid']);
    }

    public function getStaff()
    {
        return $this->hasOne(MStaff::className(), ['staff_id' => 'staff_id']);
    }

    
}

