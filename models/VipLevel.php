<?php
namespace app\models;

/*
DROP TABLE IF EXISTS wx_vip_level;
CREATE TABLE wx_vip_level (
    vip_level_id int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64) NOT NULL DEFAULT '',
    sort_order int(10) unsigned NOT NULL DEFAULT 0,
    UNIQUE KEY idx_title(title)
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

class VipLevel extends ActiveRecord
{
    public static function tableName()
    {
        return 'wx_vip_level';
    }

    public function rules()
    {
        return [
            [['title'], 'filter', 'filter' => 'trim'],
            [['title'], 'required'],
            [['title'], 'string', 'min' => 1, 'max' => 64],
            [['vip_level_id'], 'integer', 'integerOnly' =>true, 'min'=>0],       
            [['sort_order'], 'integer', 'integerOnly' =>true, 'min'=>0],       
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'title',
            'sort_order' => 'sort_order',
        ];
    }

    public static function items($key = null)
    {    
        $models = self::find()->orderBy(['sort_order'=>SORT_DESC])->all();
        $arr = \yii\helpers\ArrayHelper::map($models, 'vip_level_id', 'title');
        return $key === null ? $arr : (isset($arr[$key]) ? $arr[$key] : '');            
    }

}


